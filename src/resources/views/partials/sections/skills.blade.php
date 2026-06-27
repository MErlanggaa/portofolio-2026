        <section id="skills">
            <div class="wrap">
                <div class="reveal">
                    <div class="sec-kicker">Expertise</div>
                    <div class="sec-title">Skills</div>
                    <div class="sec-sub">Technologies and tools I work with on a daily basis.</div>
                </div>
                @php $groupedSkills = $skills->groupBy('category'); @endphp

                {{-- Decorative package.json panel --}}
                <div class="deps-panel">
                    <div class="dp-header">
                        <span class="dp-dot r"></span>
                        <span class="dp-dot y"></span>
                        <span class="dp-dot g"></span>
                        <span class="dp-title">composer.json</span>
                    </div>
                    <div class="dp-body">
                        <div class="dp-row"><span class="dp-obj">{</span></div>
                        <div class="dp-row"><span class="dp-key">&nbsp;&nbsp;"laravel/framework"</span><span class="dp-val">"^11.0"</span></div>
                        <div class="dp-row"><span class="dp-key">&nbsp;&nbsp;"php"</span><span class="dp-val">"^8.2"</span></div>
                        <div class="dp-row"><span class="dp-key">&nbsp;&nbsp;"inertiajs/inertia"</span><span class="dp-val">"^1.0"</span></div>
                        <div class="dp-row"><span class="dp-key">&nbsp;&nbsp;"react"</span><span class="dp-val">"^18.0"</span></div>
                        <div class="dp-row"><span class="dp-key">&nbsp;&nbsp;"typescript"</span><span class="dp-val">"^5.0"</span></div>
                        <div class="dp-row"><span class="dp-obj">}</span></div>
                    </div>
                </div>

                <div class="skills-grid stagger">
                    @forelse($groupedSkills as $cat => $items)
                        <div class="card">
                            <div class="sg-title">{{ $cat }}</div>
                            @foreach($items as $skill)
                                <div class="skill">
                                    <div class="skill-row">
                                        <span>{{ $skill->name }}</span>
                                        <span class="skill-pct">{{ $skill->proficiency }}%</span>
                                    </div>
                                    <div class="skill-track">
                                        <div class="skill-fill" data-width="{{ $skill->proficiency }}"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @empty
                        <div class="empty"><i class="fa-solid fa-bolt"></i>
                            <p>No skills yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
