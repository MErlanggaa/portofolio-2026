        {{-- HERO --}}
        <section id="about" style="padding-top:0.5rem;">
            <div class="wrap">
                <div class="hero-grid">

                    {{-- Text --}}
                    <div class="reveal-l">
                        <div class="eyebrow">Portfolio</div>
                        <h1>
                            <span class="hi">Hi, I'm</span>
                            <span class="name">{{ $profile?->name ?? 'Your Name' }}</span>
                        </h1>
                        <div class="hero-role">{{ $profile?->title ?? 'Developer & Creator' }}</div>
                        <div class="hero-bio">
                            @if($profile && $profile->description)
                                {!! $profile->description !!}
                            @else
                                <p>Welcome to my digital space. I craft meaningful experiences on the web and always chase
                                    the next interesting challenge.</p>
                            @endif
                        </div>

                        <div class="hero-actions">
                            <a href="/cv.pdf" download class="btn-cv">
                                <i class="fa-solid fa-download"></i> Download CV
                            </a>
                            <div class="socials">
                                @if($profile)
                                    @if($profile->email)
                                        <a href="mailto:{{ $profile->email }}" class="social-btn" title="Email"><i
                                                class="fa-solid fa-envelope"></i></a>
                                    @endif
                                    @if($profile->phone)
                                        <a href="tel:{{ $profile->phone }}" class="social-btn" title="Phone"><i
                                                class="fa-solid fa-phone"></i></a>
                                    @endif
                                    @if($profile->github)
                                        <a href="{{ $profile->github }}" target="_blank" class="social-btn" title="GitHub"><i
                                                class="fa-brands fa-github"></i></a>
                                    @endif
                                    @if($profile->linkedin)
                                        <a href="{{ $profile->linkedin }}" target="_blank" class="social-btn"
                                            title="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                                    @endif
                                    @if($profile->instagram)
                                        <a href="{{ $profile->instagram }}" target="_blank" class="social-btn"
                                            title="Instagram"><i class="fa-brands fa-instagram"></i></a>
                                    @endif
                                @endif
                        </div>
                        </div>

                        {{-- Tech Stack pills — inside left column --}}
                        <div class="tech-stack-row">
                            <span class="tech-pill tp-github"><i class="fa-brands fa-github"></i> GitHub</span>
                            <span class="tech-pill tp-php"><i class="fa-brands fa-php"></i> PHP</span>
                            <span class="tech-pill tp-react"><i class="fa-brands fa-react"></i> React</span>
                            <span class="tech-pill tp-js"><i class="fa-brands fa-js"></i> TypeScript</span>
                            <span class="tech-pill tp-docker"><i class="fa-brands fa-docker"></i> Docker</span>
                            <span class="tech-pill tp-git"><i class="fa-brands fa-git-alt"></i> Git</span>
                            <span class="tech-pill tp-db"><i class="fa-solid fa-database"></i> MySQL</span>
                            <span class="tech-pill tp-linux"><i class="fa-brands fa-linux"></i> Linux</span>
                        </div>
                        <div class="git-status-bar">
                            <i class="fa-solid fa-code-branch" style="color:#c084fc"></i>
                            <span class="gsb-branch">main</span>
                            <span class="gsb-sep">|</span>
                            <span class="gsb-ok"><i class="fa-solid fa-circle-check"></i> working tree clean</span>
                            <span class="gsb-sep">|</span>
                            <span style="color:var(--accent);font-size:0.62rem;"><i class="fa-solid fa-code-commit"></i> HEAD~47</span>
                        </div>
                    </div>

                    {{-- Right column: contribution graph + lanyard --}}
                    <div class="hero-right-col">
                        <div class="contrib-wrapper">
                            <div class="contrib-label">// contributions &mdash; last 26 weeks</div>
                            <div class="contrib-graph" id="contrib-graph"
                                 data-github="{{ $profile?->github ?? '' }}"></div>
                        </div>

                        {{-- Lanyard --}}
                        <div class="lanyard-scene reveal-r" id="lanyard-scene">
                            <div class="pin" id="lanyard-pin"></div>

                            <div id="lanyard-swing">
                                <div class="id-card">
                                    <div class="id-top"></div>
                                    <div class="id-hole-row">
                                        <div class="id-hole"></div>
                                    </div>
                                    <div class="id-body">
                                        @if($profile && $profile->photo)
                                            <img src="{{ asset('storage/' . $profile->photo) }}" alt="{{ $profile->name }}"
                                                class="id-photo">
                                        @else
                                            <svg class="id-photo" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"
                                                style="background:var(--surface-2);">
                                                <circle cx="50" cy="40" r="17" fill="#3a3a42" />
                                                <path d="M22 80C22 64 35 54 50 54C65 54 78 64 78 80Z" fill="#3a3a42" />
                                            </svg>
                                        @endif
                                        <div class="id-name">{{ $profile?->name ?? 'Your Name' }}</div>
                                        <div class="id-role">{{ $profile?->title ?? 'Developer' }}</div>
                                        <hr class="id-divider">
                                        <div class="id-barcode">
                                            <span style="width:3px"></span><span style="width:5px"></span>
                                            <span style="width:2px"></span><span style="width:7px"></span>
                                            <span style="width:4px"></span><span style="width:2px"></span>
                                            <span style="width:6px"></span><span style="width:3px"></span>
                                            <span style="width:5px"></span><span style="width:4px"></span>
                                            <span style="width:2px"></span><span style="width:8px"></span>
                                            <span style="width:3px"></span><span style="width:5px"></span>
                                            <span style="width:2px"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
