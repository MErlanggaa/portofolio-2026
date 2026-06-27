        <section id="projects">
            <div class="wrap">
                <div class="reveal" style="position:relative;">
                    <div class="commit-badge">
                        <span class="cb-hash">a3f9c12</span>
                        <span class="cb-msg">feat: add new project showcase</span>
                    </div>
                    <div class="sec-kicker">My Work</div>
                    <div class="sec-title">Projects <span class="inline-code-decor">$projects</span></div>
                    <div class="sec-sub">Selected projects I've built or contributed to.</div>
                </div>
                @php
                $projGradients = [
                    'linear-gradient(135deg, #0d1b2a 0%, #1a3a5c 60%, #0a2540 100%)',
                    'linear-gradient(135deg, #1a0533 0%, #2e0a5e 60%, #3d0080 100%)',
                    'linear-gradient(135deg, #0a1f0a 0%, #1a4d1a 60%, #1e5c1e 100%)',
                    'linear-gradient(135deg, #1f0a00 0%, #4d1f00 60%, #6b2d00 100%)',
                    'linear-gradient(135deg, #001525 0%, #002a47 60%, #003a63 100%)',
                    'linear-gradient(135deg, #1a001a 0%, #330033 60%, #4a0050 100%)',
                    'linear-gradient(135deg, #001a1a 0%, #003333 60%, #004747 100%)',
                    'linear-gradient(135deg, #1a1500 0%, #3d3200 60%, #5c4a00 100%)',
                    'linear-gradient(135deg, #0f0f1a 0%, #1a1a3d 60%, #22224d 100%)',
                    'linear-gradient(135deg, #1a0a0a 0%, #3d1515 60%, #5c1e1e 100%)',
                ];
                @endphp
                <div class="proj-grid stagger">
                    @forelse($projects as $p)
                        @php $grad = $projGradients[$loop->index % count($projGradients)]; @endphp
                        <div class="card proj-card">
                            <div class="proj-thumb">
                                @if($p->image)
                                    <img src="{{ asset('storage/' . $p->image) }}" alt="{{ $p->title }}">
                                @else
                                    <div class="no-img" style="--proj-grad: {{ $grad }}">
                                        <div class="proj-thumb-icon">
                                            <span class="proj-thumb-initial">{{ mb_substr($p->title, 0, 2) }}</span>
                                            <i class="fa-solid fa-code"></i>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="proj-body">
                                <div class="proj-title" title="{{ $p->title }}">{{ $p->title }}</div>
                                <div class="proj-desc">{!! $p->description !!}</div>
                                <div class="tags">
                                    @if($p->tech_stack)
                                        @foreach(explode(',', $p->tech_stack) as $t)
                                            <span class="tag">{{ trim($t) }}</span>
                                        @endforeach
                                    @endif
                                    @if($p->api_stack)
                                        @foreach(explode(',', $p->api_stack) as $a)
                                            <span class="tag tag-api"><i class="fa-solid fa-plug"></i>{{ trim($a) }}</span>
                                        @endforeach
                                    @endif
                                </div>
                                @if($p->link)
                                    <a href="{{ $p->link }}" target="_blank" class="proj-link">
                                        View project <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="empty"><i class="fa-solid fa-folder-open"></i>
                            <p>No projects yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
