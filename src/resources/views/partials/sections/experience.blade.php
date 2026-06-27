        <section id="experience">
            <div class="wrap">
                <div class="timeline-grid">
                    <div class="reveal-l">
                        <h2 class="tl-head"><i class="fa-solid fa-briefcase"></i> Experience</h2>
                        <div class="timeline">
                            @forelse($experiences as $e)
                                <div class="tl-item">
                                    <div class="tl-date">
                                        {{ $e->start_date->format('M Y') }} —
                                        {{ $e->is_current ? 'Present' : ($e->end_date ? $e->end_date->format('M Y') : '') }}
                                    </div>
                                    <div class="tl-title">{{ $e->role }}</div>
                                    <div class="tl-sub">{{ $e->company }}</div>
                                    @if($e->description)
                                    <div class="tl-desc">{!! $e->description !!}</div>@endif
                                </div>
                            @empty
                                <p style="color:var(--muted);font-size:.85rem;">No experience listed yet.</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="reveal-r" id="education">
                        <h2 class="tl-head"><i class="fa-solid fa-graduation-cap"></i> Education</h2>
                        <div class="timeline">
                            @forelse($education as $edu)
                                <div class="tl-item">
                                    <div class="tl-date">
                                        {{ $edu->start_date->format('Y') }} —
                                        {{ $edu->is_current ? 'Present' : ($edu->end_date ? $edu->end_date->format('Y') : '') }}
                                    </div>
                                    <div class="tl-title">{{ $edu->degree }} — {{ $edu->major }}</div>
                                    <div class="tl-sub">{{ $edu->institution }}</div>
                                    @if($edu->description)
                                    <div class="tl-desc">{!! $edu->description !!}</div>@endif
                                </div>
                            @empty
                                <p style="color:var(--muted);font-size:.85rem;">No education listed yet.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>
