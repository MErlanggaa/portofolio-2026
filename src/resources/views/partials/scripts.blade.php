    <script>
        // ── Matrix Rain ─────────────────────────────────
        (function() {
            const canvas = document.getElementById('matrix-canvas');
            const ctx = canvas.getContext('2d');
            const chars = '01アイウエオカキクケコ{}[]();=></>function class return const let var if else for while'.split('');
            let cols, drops;
            function resize() {
                canvas.width  = window.innerWidth;
                canvas.height = window.innerHeight;
                cols = Math.floor(canvas.width / 18);
                drops = Array(cols).fill(1);
            }
            resize();
            window.addEventListener('resize', resize);
            function draw() {
                ctx.fillStyle = 'rgba(12,12,15,0.05)';
                ctx.fillRect(0, 0, canvas.width, canvas.height);
                ctx.fillStyle = '#d4a44c';
                ctx.font = '13px Courier New';
                drops.forEach((y, i) => {
                    const c = chars[Math.floor(Math.random() * chars.length)];
                    ctx.fillText(c, i * 18, y * 18);
                    if (y * 18 > canvas.height && Math.random() > 0.975) drops[i] = 0;
                    drops[i]++;
                });
            }
            setInterval(draw, 55);
        })();

        // ── Smooth Nav Scroll + Active State ───────────────────────
        const secs  = [...document.querySelectorAll('section[id], #education')];
        const links = [...document.querySelectorAll('.nav-links a')];
        const hdr   = document.querySelector('header');

        // Custom RAF-based smooth scroll — easeInOutQuart feels very premium
        function easeInOutQuart(t) {
            return t < 0.5 ? 8 * t * t * t * t : 1 - Math.pow(-2 * t + 2, 4) / 2;
        }
        function smoothScrollTo(targetY, duration) {
            duration = duration || 900;
            const startY = window.scrollY;
            const dist   = targetY - startY;
            const t0     = performance.now();
            function step(now) {
                const elapsed  = now - t0;
                const progress = Math.min(elapsed / duration, 1);
                window.scrollTo(0, startY + dist * easeInOutQuart(progress));
                if (progress < 1) requestAnimationFrame(step);
            }
            requestAnimationFrame(step);
        }

        // Nav-link click handler
        links.forEach(function(link) {
            link.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                if (!targetId || !targetId.startsWith('#')) return;
                const target = document.querySelector(targetId);
                if (!target) return;
                e.preventDefault();

                const hdrH  = hdr ? hdr.offsetHeight : 64;
                const destY = target.getBoundingClientRect().top + window.scrollY - hdrH - 12;
                smoothScrollTo(destY, 900);
                history.pushState(null, '', targetId);

                // Center active nav link horizontally on click
                if (window.innerWidth < 768) {
                    this.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
                }

                // ✨ Golden flash highlight on the target section
                target.style.transition = 'box-shadow 0.12s ease';
                target.style.boxShadow  = '0 0 0 2px rgba(212,164,76,0.3), 0 0 50px rgba(212,164,76,0.07)';
                setTimeout(function() {
                    target.style.transition = 'box-shadow 0.9s ease';
                    target.style.boxShadow  = '';
                }, 900);
            });
        });

        // Active nav highlight on scroll with automatic scrollIntoView for active item on mobile
        let lastActive = '';
        window.addEventListener('scroll', function() {
            const hdrH = hdr ? hdr.offsetHeight : 64;
            let cur = '';
            secs.forEach(function(s) { if (window.scrollY >= s.offsetTop - hdrH - 25) cur = s.id; });
            
            if (cur !== lastActive) {
                lastActive = cur;
                links.forEach(function(a) { 
                    const isActive = a.getAttribute('href') === '#' + cur;
                    a.classList.toggle('active', isActive);
                    if (isActive && window.innerWidth < 768) {
                        a.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
                    }
                });
            }
        }, { passive: true });


        // ── Scroll Reveal ──────────────────────────────────
        const io = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (!e.isIntersecting) return;
                e.target.classList.add('vis');
                e.target.querySelectorAll('.skill-fill').forEach(b => b.style.width = b.dataset.width + '%');
                io.unobserve(e.target);
            });
        }, { threshold: 0.1 });
        document.querySelectorAll('.reveal,.reveal-l,.reveal-r,.stagger').forEach(el => io.observe(el));



        // ── Physics Lanyard (canvas rope + spring physics) ────────────────
        (function () {
            const scene  = document.getElementById('lanyard-scene');
            const pinEl  = document.getElementById('lanyard-pin');
            const swing  = document.getElementById('lanyard-swing');

            // Create canvas for rope
            const canvas = document.createElement('canvas');
            canvas.id = 'lanyard-canvas';
            canvas.style.cssText = 'position:absolute;top:0;left:0;width:100%;height:100%;pointer-events:none;';
            scene.insertBefore(canvas, scene.firstChild);
            const ctx = canvas.getContext('2d');

            // Physics constants
            const REST_LEN = 155;  // natural rope length in px
            const K_SWING  = 0.06; // horizontal spring
            const K_PULL   = 0.09; // vertical stretch spring
            const DAMP     = 0.70; // damping factor

            let angle    = -8;    // degrees from vertical
            let stretch  = 0;     // extra stretch beyond REST_LEN
            let vAngle   = 0;
            let vStretch = 0;
            let isDrag   = false;
            let prevDx   = 0, prevDy = 0;

            function resizeCanvas() {
                const w = scene.offsetWidth;
                const h = scene.offsetHeight;
                if (canvas.width !== w || canvas.height !== h) {
                    canvas.width  = w;
                    canvas.height = h;
                }
            }
            resizeCanvas();
            window.addEventListener('resize', resizeCanvas);

            function getPinCenter() {
                return {
                    x: pinEl.offsetLeft + pinEl.offsetWidth  / 2,
                    y: pinEl.offsetTop  + pinEl.offsetHeight / 2,
                };
            }

            function drawRope(px, py, cx, cy) {
                const dpr = window.devicePixelRatio || 1;
                ctx.clearRect(0, 0, canvas.width, canvas.height);

                const dist = Math.hypot(cx - px, cy - py);
                // Sag control point
                const sag  = dist * 0.18 + Math.abs(stretch) * 0.12;
                const mx   = (px + cx) / 2;
                const my   = (py + cy) / 2 + sag;

                // Rope gradient
                const grad = ctx.createLinearGradient(px, py, cx, cy);
                grad.addColorStop(0,   '#888');
                grad.addColorStop(0.5, '#d4a44c');
                grad.addColorStop(1,   '#b87333');

                ctx.beginPath();
                ctx.moveTo(px, py);
                ctx.quadraticCurveTo(mx, my, cx, cy);
                ctx.strokeStyle = grad;
                ctx.lineWidth   = 3;
                ctx.lineCap     = 'round';
                ctx.stroke();

                // Sheen overlay
                ctx.beginPath();
                ctx.moveTo(px, py);
                ctx.quadraticCurveTo(mx, my - 2, cx, cy);
                ctx.strokeStyle = 'rgba(255,255,255,0.08)';
                ctx.lineWidth   = 1.5;
                ctx.stroke();
            }

            function tick() {
                resizeCanvas();
                const pin = getPinCenter();

                if (!isDrag) {
                    vAngle   = (vAngle   - K_SWING * angle)  * DAMP;
                    vStretch = (vStretch - K_PULL  * stretch) * DAMP;
                    angle   += vAngle;
                    stretch += vStretch;
                    if (Math.abs(vAngle)   < 0.005 && Math.abs(angle)   < 0.005) { angle   = 0; vAngle   = 0; }
                    if (Math.abs(vStretch) < 0.005 && Math.abs(stretch) < 0.005) { stretch = 0; vStretch = 0; }
                }

                const totalLen = REST_LEN + stretch;
                const rad = angle * Math.PI / 180;
                const cardX = pin.x + Math.sin(rad) * totalLen;   // card-hole x
                const cardY = pin.y + Math.cos(rad) * totalLen;   // card-hole y

                 // Draw rope then position the card so its top-center aligns with cardX,cardY
                drawRope(pin.x, pin.y, cardX, cardY);

                const cardW = swing.offsetWidth  || 210;
                const cardH = swing.offsetHeight || 290;
                swing.style.left      = (cardX - cardW / 2) + 'px';
                swing.style.top       = cardY + 'px';
                swing.style.transform = `rotate(${angle}deg)`;
                swing.style.transformOrigin = '50% 0';

                requestAnimationFrame(tick);
            }

            function pointerStart(cx, cy) {
                isDrag = true;
                scene.style.cursor = 'grabbing';
                const pin = getPinCenter();
                const sr  = scene.getBoundingClientRect();
                prevDx = cx - sr.left - pin.x;
                prevDy = cy - sr.top  - pin.y;
            }

            function pointerMove(cx, cy) {
                if (!isDrag) return;
                const pin = getPinCenter();
                const sr  = scene.getBoundingClientRect();
                const dx  = cx - sr.left - pin.x;
                const dy  = cy - sr.top  - pin.y;

                angle   = Math.max(-72, Math.min(72, Math.atan2(dx, dy) * 180 / Math.PI));
                const dist = Math.hypot(dx, dy);
                stretch = Math.max(0, Math.min(220, dist - REST_LEN));

                vAngle   = (dx - prevDx) * 0.45;
                vStretch = (dy - prevDy) * 0.22;
                prevDx = dx; prevDy = dy;
            }

            function pointerEnd() {
                isDrag = false;
                scene.style.cursor = 'grab';
                // Natural upward bounce when released from stretch
                if (stretch > 10) vStretch = -Math.min(6, stretch * 0.05);
            }

            scene.addEventListener('mousedown',  e => { pointerStart(e.clientX, e.clientY); e.preventDefault(); });
            window.addEventListener('mousemove', e => pointerMove(e.clientX, e.clientY));
            window.addEventListener('mouseup',   () => pointerEnd());
            scene.addEventListener('touchstart', e => { pointerStart(e.touches[0].clientX, e.touches[0].clientY); e.preventDefault(); }, { passive: false });
            window.addEventListener('touchmove', e => { if (isDrag) pointerMove(e.touches[0].clientX, e.touches[0].clientY); }, { passive: true });
            window.addEventListener('touchend',  () => pointerEnd());

            tick();
        })();

        // ── Lofi Player (Audio Stream) ────────────────────────
        const player     = document.getElementById('lofi-player');
        const audio      = document.getElementById('lp-audio');
        const playToggle = document.getElementById('lp-play-toggle');
        const playIcon   = document.getElementById('lp-play-icon');
        const statusText = document.getElementById('lp-status-text');
        const volToggle  = document.getElementById('lp-volume-toggle');
        const volIcon    = document.getElementById('lp-volume-icon');
        const volSlider  = document.getElementById('lp-volume-slider');

        // Restore persisted settings
        let lastVolume   = parseFloat(localStorage.getItem('lofi_volume') || '0.5');
        let isMuted      = localStorage.getItem('lofi_muted') === 'true';
        let isPlaying    = false;
        let unmuteHandled = false;

        // Init slider/icon from saved prefs (audio itself is muted by html attr)
        volSlider.value = lastVolume;
        volIcon.className = isMuted ? 'fa-solid fa-volume-xmark'
            : lastVolume < 0.5 ? 'fa-solid fa-volume-low'
            : 'fa-solid fa-volume-high';

        // ── UI helpers ────────────────────────────────────────
        function markPlaying() {
            player.classList.add('playing');
            playIcon.className     = 'fa-solid fa-pause';
            statusText.textContent = 'Playing 🎵';
            isPlaying = true;
            localStorage.setItem('lofi_play_state', 'playing');
        }
        function markPaused() {
            player.classList.remove('playing');
            playIcon.className     = 'fa-solid fa-play';
            statusText.textContent = 'Paused';
            isPlaying = false;
            localStorage.setItem('lofi_play_state', 'paused');
        }

        // ── Unmute logic ──────────────────────────────────────
        // Called once on first user interaction (or immediately if page was
        // previously interacted with — document.hasFocus() + user gesture flag).
        function unmute() {
            if (unmuteHandled) return;
            unmuteHandled = true;

            const explicitPause = localStorage.getItem('lofi_play_state') === 'paused';
            if (explicitPause) {
                // User deliberately paused last session → keep paused but unmute audio
                audio.pause();
                audio.muted = false;
                markPaused();
                return;
            }

            // Resume: set real volume then unmute
            audio.volume = isMuted ? 0 : lastVolume;
            audio.muted  = false;

            if (!audio.paused) {
                markPlaying();
            } else {
                // If browser paused during muted phase, re-trigger play
                statusText.textContent = 'Loading…';
                audio.play()
                    .then(() => markPlaying())
                    .catch(() => {
                        statusText.textContent = 'Click to play';
                        markPaused();
                    });
            }
        }

        // ── Autoplay strategy ─────────────────────────────────
        // Audio element has autoplay+muted in HTML → browser starts it silently.
        // We unmute on the very first user interaction (any event).
        audio.addEventListener('play', () => {
            if (!unmuteHandled) {
                statusText.textContent = '🎵 Click anywhere to enable sound';
                player.classList.add('playing');
                playIcon.className = 'fa-solid fa-pause';
                isPlaying = true;
            }
        });

        const interactionEvents = ['click','keydown','touchstart','scroll','pointermove'];
        function onFirstInteraction() {
            unmute();
            interactionEvents.forEach(e => document.removeEventListener(e, onFirstInteraction));
        }
        interactionEvents.forEach(e =>
            document.addEventListener(e, onFirstInteraction, { once: true, passive: true })
        );

        // If audio.autoplay is blocked entirely, fall back to manual play on click
        audio.addEventListener('error', () => {
            statusText.textContent = 'Click to play';
            isPlaying = false;
        });

        // ── Manual toggle ─────────────────────────────────────
        function togglePlay() {
            // Make sure unmute ran first
            if (!unmuteHandled) { unmute(); return; }

            if (isPlaying) {
                audio.pause();
                markPaused();
            } else {
                statusText.textContent = 'Loading…';
                audio.muted = false;
                audio.volume = isMuted ? 0 : lastVolume;
                audio.play()
                    .then(() => markPlaying())
                    .catch(() => { statusText.textContent = 'Error loading stream'; });
            }
        }

        playToggle.addEventListener('click', togglePlay);
        document.querySelector('.lp-disc').addEventListener('click', togglePlay);

        // ── Volume controls ───────────────────────────────────
        volSlider.addEventListener('input', e => {
            const v = parseFloat(e.target.value);
            audio.volume = v;
            audio.muted  = (v === 0);
            if (v === 0) {
                volIcon.className = 'fa-solid fa-volume-xmark';
                localStorage.setItem('lofi_muted', 'true');
            } else {
                volIcon.className = v < 0.5 ? 'fa-solid fa-volume-low' : 'fa-solid fa-volume-high';
                localStorage.setItem('lofi_muted', 'false');
                lastVolume = v;
                localStorage.setItem('lofi_volume', String(v));
            }
        });

        volToggle.addEventListener('click', () => {
            if (audio.volume > 0 && !audio.muted) {
                lastVolume = audio.volume;
                localStorage.setItem('lofi_volume', String(lastVolume));
                audio.muted     = true;
                audio.volume    = 0;
                volSlider.value = 0;
                volIcon.className = 'fa-solid fa-volume-xmark';
                localStorage.setItem('lofi_muted', 'true');
            } else {
                audio.muted     = false;
                audio.volume    = lastVolume;
                volSlider.value = lastVolume;
                volIcon.className = lastVolume < 0.5 ? 'fa-solid fa-volume-low' : 'fa-solid fa-volume-high';
                localStorage.setItem('lofi_muted', 'false');
            }
        });

        // ── Cursor Glow ─────────────────────────────────────
        const cursorGlow = document.getElementById('cursor-glow');
        document.addEventListener('mousemove', e => {
            cursorGlow.style.left = e.clientX + 'px';
            cursorGlow.style.top = e.clientY + 'px';
        });
        document.addEventListener('mouseleave', () => cursorGlow.style.opacity = '0');
        document.addEventListener('mouseenter', () => cursorGlow.style.opacity = '1');

        // ── Card Tilt Effect ────────────────────────────────
        document.querySelectorAll('.card').forEach(card => {
            card.classList.add('tilt-card');
            card.style.position = 'relative';
            card.style.overflow = 'hidden';
            card.addEventListener('mousemove', e => {
                const r = card.getBoundingClientRect();
                const x = (e.clientX - r.left) / r.width - 0.5;
                const y = (e.clientY - r.top)  / r.height - 0.5;
                card.style.transform = `perspective(600px) rotateY(${x * 8}deg) rotateX(${-y * 8}deg) translateY(-5px)`;
                card.style.boxShadow = `${-x*12}px ${y*12}px 30px rgba(0,0,0,0.4), 0 0 20px rgba(212,164,76,0.08)`;
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = '';
                card.style.boxShadow = '';
            });
            // Click ripple
            card.addEventListener('click', e => {
                const r = card.getBoundingClientRect();
                const ripple = document.createElement('span');
                ripple.className = 'ripple';
                const size = Math.max(r.width, r.height);
                ripple.style.cssText = `width:${size}px;height:${size}px;left:${e.clientX-r.left-size/2}px;top:${e.clientY-r.top-size/2}px`;
                card.appendChild(ripple);
                setTimeout(() => ripple.remove(), 700);
            });
        });

        // ── Typing Code Widget ──────────────────────────────
        const typingSpan = document.querySelector('#cw-typing .cw-str');
        const words = ["'MySQL'", "'Docker'", "'Figma'", "'Leaflet'", "'Tailwind'", "'Git'", "'Postman'"];
        let wIdx = 0, cIdx = 0, deleting = false;
        function typeCode() {
            const word = words[wIdx];
            if (!deleting) {
                cIdx++;
                typingSpan.textContent = word.slice(0, cIdx);
                if (cIdx === word.length) { deleting = true; setTimeout(typeCode, 1400); return; }
            } else {
                cIdx--;
                typingSpan.textContent = word.slice(0, cIdx);
                if (cIdx === 0) { deleting = false; wIdx = (wIdx + 1) % words.length; }
            }
            setTimeout(typeCode, deleting ? 60 : 100);
        }
        typeCode();

        // ── Real GitHub Contribution Graph ─────────────────
        (function () {
            const g = document.getElementById('contrib-graph');
            if (!g) return;

            function renderCells(days) {
                g.innerHTML = '';
                // Group flat array into 7-day columns (weeks)
                for (let w = 0; w < days.length; w += 7) {
                    const col = document.createElement('div');
                    col.className = 'contrib-col';
                    const slice = days.slice(w, w + 7);
                    slice.forEach(function(day) {
                        const cell = document.createElement('div');
                        const lvl = day.level || 0;
                        cell.className = 'contrib-cell' + (lvl ? ' l' + lvl : '');
                        const cnt = day.count || 0;
                        cell.title = cnt + ' contribution' + (cnt !== 1 ? 's' : '') + ' on ' + day.date;
                        col.appendChild(cell);
                    });
                    g.appendChild(col);
                }
            }

            function renderFake() {
                let s = Date.now();
                function rnd() { s ^= s << 13; s ^= s >> 7; s ^= s << 17; return (s >>> 0) / 0xFFFFFFFF; }
                const days = [];
                for (let i = 0; i < 26 * 7; i++) {
                    const r = rnd();
                    let level = 0;
                    if (r > 0.6) level = 1;
                    if (r > 0.75) level = 2;
                    if (r > 0.88) level = 3;
                    if (r > 0.95) level = 4;
                    days.push({ date: '', count: level, level: level });
                }
                renderCells(days);
            }

            // Extract GitHub username from profile URL
            const ghUrl = (g.dataset.github || '').trim();
            const match = ghUrl.match(/github\.com\/([\w-]+)/i);
            const username = match ? match[1] : null;

            if (!username) { renderFake(); return; }

            // Update the label
            const lbl = g.previousElementSibling;
            if (lbl && lbl.classList.contains('contrib-label')) {
                lbl.textContent = '// ' + username + ' — contributions last year';
            }

            // Fetch real data from public contributions API (no token needed)
            fetch('https://github-contributions-api.jogruber.de/v4/' + username + '?y=last')
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    if (!data.contributions || !data.contributions.length) { renderFake(); return; }
                    // Take last 26 weeks (182 days)
                    const days = data.contributions.slice(-182);
                    renderCells(days);
                })
                .catch(function() { renderFake(); });
        })();

        // ── Page Loader ──────────────────────────────────────
        (function () {
            // Matrix rain inside loader
            const lc = document.getElementById('loader-matrix');
            const lx = lc.getContext('2d');
            lc.width  = window.innerWidth;
            lc.height = window.innerHeight;
            const lChars = '01{}[];()=><!-/function return const class if else'.split('');
            let lCols = Math.floor(lc.width / 16);
            let lDrops = Array(lCols).fill(1);
            const lDraw = () => {
                lx.fillStyle = 'rgba(10,10,13,0.06)';
                lx.fillRect(0, 0, lc.width, lc.height);
                lx.fillStyle = '#d4a44c';
                lx.font = '12px Courier New';
                lDrops.forEach((y, i) => {
                    lx.fillText(lChars[Math.floor(Math.random() * lChars.length)], i * 16, y * 16);
                    if (y * 16 > lc.height && Math.random() > 0.975) lDrops[i] = 0;
                    lDrops[i]++;
                });
            };
            const lInt = setInterval(lDraw, 50);

            // Terminal animation sequence
            const fill   = document.getElementById('lt-fill');
            const pct    = document.getElementById('lt-pct');
            const sub    = document.getElementById('loader-sub');

            const steps = [
                { id: 'll-1', p: 18,  msg: 'Booting framework',   delay: 300  },
                { id: 'll-2', p: 38,  msg: 'Connecting database',  delay: 750  },
                { id: 'll-3', p: 60,  msg: 'Loading portfolio',    delay: 1150 },
                { id: 'll-4', p: 80,  msg: 'Compiling assets',     delay: 1550 },
                { id: 'll-5', p: 100, msg: 'Ready!',               delay: 1950 },
            ];

            steps.forEach(({ id, p, msg, delay }) => {
                setTimeout(() => {
                    const el = document.getElementById(id);
                    if (el) el.classList.add('lt-show');
                    fill.style.width = p + '%';
                    pct.textContent  = p + '%';
                    if (sub) sub.textContent = msg;
                }, delay);
            });

            // Hide loader after page loads + minimum display time
            const loader   = document.getElementById('page-loader');
            const minWait  = new Promise(r => setTimeout(r, 2400));
            const pageLoad = new Promise(r => {
                if (document.readyState === 'complete') r();
                else window.addEventListener('load', r, { once: true });
            });

            Promise.all([minWait, pageLoad]).then(() => {
                clearInterval(lInt);
                loader.classList.add('loader-hide');
                setTimeout(() => loader.remove(), 1000);
            });
        })();
    </script>
    <script>
        // ── Code Widget Toggle ──────────────────────────
        (function() {
            const widget = document.getElementById('code-widget');
            const closeBtn = document.querySelector('.cw-dot.r');
            const restoreBtn = document.getElementById('cw-restore-btn');
            
            if (!widget || !closeBtn || !restoreBtn) return;

            closeBtn.style.cursor = 'pointer';
            closeBtn.setAttribute('title', 'Close Terminal');

            closeBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                widget.style.opacity = '0';
                widget.style.transform = 'translateY(20px) scale(0.95)';
                setTimeout(() => {
                    widget.style.display = 'none';
                    restoreBtn.style.display = 'flex';
                    setTimeout(() => {
                        restoreBtn.style.opacity = '1';
                        restoreBtn.style.transform = 'scale(1)';
                    }, 50);
                }, 300);
            });

            restoreBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                restoreBtn.style.opacity = '0';
                restoreBtn.style.transform = 'scale(0.8)';
                setTimeout(() => {
                    restoreBtn.style.display = 'none';
                    widget.style.display = 'block';
                    setTimeout(() => {
                        widget.style.opacity = '1';
                        widget.style.transform = 'none';
                    }, 50);
                }, 200);
            });
        })();
    </script>
