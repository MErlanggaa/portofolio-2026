    <!-- ═══════════ LOADING SCREEN ═══════════ -->
    <div id="page-loader">
        <canvas id="loader-matrix"></canvas>
        <div class="loader-scan"></div>

        <div class="loader-logo">
            <span class="lb">&lt;</span>ERL<span class="lb">/&gt;</span>
        </div>

        <div class="loader-terminal">
            <div class="lt-bar">
                <span class="lt-dot r"></span>
                <span class="lt-dot y"></span>
                <span class="lt-dot g"></span>
                <span class="lt-bar-title">portfolio.php — booting</span>
            </div>
            <div class="lt-body">
                <div class="lt-row lt-show">
                    <span class="lt-prompt">$</span>
                    <span class="lt-cmd">php artisan serve --host=portofolio.test</span>
                </div>
                <div class="lt-row" id="ll-1">
                    <span class="lt-out">▸ Booting Laravel application...</span>
                </div>
                <div class="lt-row" id="ll-2">
                    <span class="lt-out">▸ Connecting to database...</span>
                </div>
                <div class="lt-row" id="ll-3">
                    <span class="lt-out">▸ Loading portfolio data...</span>
                </div>
                <div class="lt-row" id="ll-4">
                    <span class="lt-out">▸ Compiling assets &amp; styles...</span>
                </div>
                <div class="lt-row" id="ll-5">
                    <span class="lt-ok">✓ Server ready on https://portofolio.test</span>
                </div>

                <div class="lt-progress-wrap">
                    <span class="lt-pct" id="lt-pct">0%</span>
                    <div class="lt-track">
                        <div class="lt-fill" id="lt-fill"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="loader-bottom">
            <div class="loader-title">Mohon tunggu sebentar<span class="loader-dots"><span>.</span><span>.</span><span>.</span></span></div>
            <div class="loader-sub" id="loader-sub">Initializing portfolio_v1.0</div>
        </div>
    </div>
    <!-- ═══════════════════════════════════════ -->
