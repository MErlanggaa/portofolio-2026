    </main>

    <footer>
        <div class="wrap">
            <p>&copy; {{ date('Y') }} {{ $profile?->name ?? 'Developer' }}. All rights reserved.</p>
        </div>
    </footer>

    <!-- Lofi Player -->
    <div class="lofi-player" id="lofi-player">
        <div class="lp-disc-wrapper">
            <div class="lp-disc">
                <div class="lp-disc-inner"></div>
            </div>
            <button class="lp-play-btn" id="lp-play-toggle" aria-label="Play/Pause music">
                <i class="fa-solid fa-play" id="lp-play-icon"></i>
            </button>
        </div>
        <div class="lp-info">
            <div class="lp-title">Lofi Radio 🎧</div>
            <div class="lp-status">
                <span id="lp-status-text">Click to play</span>
                <div class="lp-visualizer">
                    <div class="lp-bar"></div>
                    <div class="lp-bar"></div>
                    <div class="lp-bar"></div>
                    <div class="lp-bar"></div>
                </div>
            </div>
        </div>
        <div class="lp-controls">
            <button class="lp-volume-btn" id="lp-volume-toggle" aria-label="Mute/Unmute">
                <i class="fa-solid fa-volume-high" id="lp-volume-icon"></i>
            </button>
            <input type="range" class="lp-volume-slider" id="lp-volume-slider" min="0" max="1" step="0.05" value="0.5">
        </div>
        <audio id="lp-audio" autoplay muted preload="auto">
            <source src="https://streams.fluxfm.de/Chillhop/mp3-128/" type="audio/mpeg">
            <source src="https://streams.somafm.com/groovesalad-128-mp3" type="audio/mpeg">
        </audio>
    </div>

    <!-- Floating Code Widget -->
    <div class="code-widget" id="code-widget">
        <div class="cw-bar">
            <span class="cw-dot r"></span>
            <span class="cw-dot y"></span>
            <span class="cw-dot g"></span>
            <span class="cw-filename">portfolio.php</span>
        </div>
        <div class="cw-body">
            <div class="cw-line"><span class="cw-num">1</span><span><span class="cw-kw">class</span> <span class="cw-fn">Developer</span> {</span></div>
            <div class="cw-line"><span class="cw-num">2</span><span>&nbsp;&nbsp;<span class="cw-kw">public</span> <span class="cw-var">$name</span> <span class="cw-op">=</span> <span class="cw-str">'Erlangga'</span>;</span></div>
            <div class="cw-line"><span class="cw-num">3</span><span>&nbsp;&nbsp;<span class="cw-kw">public</span> <span class="cw-var">$stack</span> <span class="cw-op">=</span> [</span></div>
            <div class="cw-line"><span class="cw-num">4</span><span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="cw-str">'Laravel'</span>,</span></div>
            <div class="cw-line"><span class="cw-num">5</span><span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="cw-str">'React'</span>,</span></div>
            <div class="cw-line"><span class="cw-num">6</span><span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="cw-str">'TypeScript'</span>,</span></div>
            <div class="cw-line" id="cw-typing-line"><span class="cw-num">7</span><span id="cw-typing">&nbsp;&nbsp;&nbsp;&nbsp;<span class="cw-str"></span></span><span class="cw-cursor"></span></div>
        </div>
    </div>

    <!-- Code Widget Restore Button -->
    <button class="cw-restore-btn" id="cw-restore-btn" title="Open Terminal">
        <i class="fa-solid fa-code"></i>
    </button>

    <!-- Matrix Rain Canvas -->
    <canvas id="matrix-canvas"></canvas>
