        <section id="organizations">
            <div class="wrap">
                <div class="reveal" style="position:relative;">
                    <div class="git-log-panel">
                        <div><span class="glp-hash">HEAD</span> → main</div>
                        <div><span class="glp-ok">✓</span> org.records</div>
                        <div><span class="glp-warn">⊕</span> roles.data</div>
                        <div><span class="glp-ok">✓</span> teams.json</div>
                    </div>
                    <div class="commit-badge">
                        <span class="cb-hash">e71b334</span>
                        <span class="cb-msg">feat: add org involvements</span>
                    </div>
                    <div class="sec-kicker">Community</div>
                    <div class="sec-title">Organizations <span class="inline-code-decor">$orgs</span></div>
                    <div class="sec-sub">Roles and involvements in communities and organizations.</div>
                </div>
                <div class="org-grid stagger">
                    @forelse($organizations as $o)
                        <div class="card org-card">
                            <div class="tl-date" style="margin-bottom:.4rem;">
                                {{ $o->start_date->format('M Y') }} —
                                {{ $o->is_current ? 'Present' : ($o->end_date ? $o->end_date->format('M Y') : '') }}
                            </div>
                            <div class="tl-title" style="margin-bottom:.22rem;">{{ $o->role }}</div>
                            <div class="tl-sub" style="color:var(--green);margin-bottom:.75rem;">{{ $o->name }}</div>
                            @if($o->description)
                            <div class="tl-desc">{!! $o->description !!}</div>@endif
                        </div>
                    @empty
                        <div class="empty"><i class="fa-solid fa-users"></i>
                            <p>No organizations yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
