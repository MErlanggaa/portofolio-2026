<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profile?->name ?? 'Portfolio' }}</title>
    <meta name="description" content="Portfolio of {{ $profile?->name ?? 'Developer' }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --bg: #0c0c0f;
            --surface: #141418;
            --surface-2: #1c1c22;
            --border: rgba(255, 255, 255, 0.07);
            --accent: #d4a44c;
            --accent-dim: rgba(212, 164, 76, 0.12);
            --accent-2: #b87333;
            --green: #4e9b70;
            --text: #edece8;
            --muted: #7a7670;
            --light: #b8b4ab;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 5rem; /* offset for sticky header */
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            overflow-x: hidden;
            line-height: 1.7;
        }

        body::after {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='200' height='200'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3C/filter%3E%3Crect width='200' height='200' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 9999;
        }

        .blob {
            position: fixed;
            border-radius: 50%;
            filter: blur(140px);
            opacity: 0.09;
            z-index: 0;
            pointer-events: none;
        }

        .blob-1 {
            width: 550px;
            height: 550px;
            top: -80px;
            left: -120px;
            background: var(--accent);
        }

        .blob-2 {
            width: 450px;
            height: 450px;
            bottom: 0;
            right: -80px;
            background: var(--green);
        }

        .wrap {
            max-width: 1120px;
            margin: 0 auto;
            padding: 0 1.75rem;
            position: relative;
            z-index: 1;
        }

        /* ── NAV ── */
        header {
            position: sticky;
            top: 0;
            z-index: 200;
            backdrop-filter: blur(22px);
            background: rgba(12, 12, 15, 0.82);
            border-bottom: 1px solid var(--border);
        }

        nav {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 4rem;
            gap: 0.25rem;
        }

        .nav-links {
            display: flex;
            gap: 0.15rem;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav-links a {
            color: var(--muted);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            padding: 0.4rem 1rem;
            border-radius: 7px;
            transition: all 0.2s;
            white-space: nowrap;
            letter-spacing: 0.2px;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: var(--text);
            background: rgba(255, 255, 255, 0.05);
        }

        .nav-links a.active {
            color: var(--accent);
        }

        /* ── SCROLL REVEAL ── */
        .reveal,
        .reveal-l,
        .reveal-r {
            opacity: 0;
            transition: opacity 0.72s cubic-bezier(.22, 1, .36, 1), transform 0.72s cubic-bezier(.22, 1, .36, 1);
        }

        .reveal {
            transform: translateY(28px);
        }

        .reveal-l {
            transform: translateX(-32px);
        }

        .reveal-r {
            transform: translateX(32px);
        }

        .reveal.vis,
        .reveal-l.vis,
        .reveal-r.vis {
            opacity: 1;
            transform: none;
        }

        .stagger>* {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity .6s cubic-bezier(.22, 1, .36, 1), transform .6s cubic-bezier(.22, 1, .36, 1);
        }

        .stagger.vis>*:nth-child(1) {
            opacity: 1;
            transform: none;
            transition-delay: .04s;
        }

        .stagger.vis>*:nth-child(2) {
            opacity: 1;
            transform: none;
            transition-delay: .11s;
        }

        .stagger.vis>*:nth-child(3) {
            opacity: 1;
            transform: none;
            transition-delay: .18s;
        }

        .stagger.vis>*:nth-child(4) {
            opacity: 1;
            transform: none;
            transition-delay: .25s;
        }

        .stagger.vis>*:nth-child(5) {
            opacity: 1;
            transform: none;
            transition-delay: .32s;
        }

        .stagger.vis>*:nth-child(6) {
            opacity: 1;
            transform: none;
            transition-delay: .39s;
        }

        /* ── HERO ── */
        #about {
            min-height: 82vh;
            display: flex;
            align-items: center;
            padding: 3rem 0 4rem;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1fr 0.75fr;
            gap: 5rem;
            align-items: start;
        }

        .hero-right-col {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.5rem;
            padding-top: 1rem;
        }

        .contrib-wrapper {
            align-self: flex-end;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--accent);
            margin-bottom: 1.5rem;
        }

        .eyebrow::before {
            content: '';
            width: 22px;
            height: 2px;
            background: var(--accent);
        }

        h1 {
            font-family: 'Syne', sans-serif;
            font-size: 3rem;
            font-weight: 800;
            line-height: 1.08;
            letter-spacing: -1.5px;
            margin-bottom: 1rem;
        }

        h1 .hi {
            color: var(--light);
            font-weight: 300;
            font-size: 1.1rem;
            display: block;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 0.4rem;
            opacity: 0.7;
        }

        h1 .name {
            color: var(--accent);
            font-size: clamp(1.5rem, 2.8vw, 2.2rem);
            display: block;
            line-height: 1.1;
        }

        /* ── MATRIX CANVAS ── */
        #matrix-canvas {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            pointer-events: none;
            z-index: 0;
            opacity: 0.025;
        }

        /* ── SECTION CODE COMMENT ── */
        .sec-code-comment {
            font-family: 'Courier New', monospace;
            font-size: 0.72rem;
            color: rgba(212, 164, 76, 0.35);
            margin-bottom: 0.5rem;
            letter-spacing: 0.5px;
        }

        /* ── CODE RAIN LINES (decorative) ── */
        .code-rain-decor {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            font-family: 'Courier New', monospace;
            font-size: 0.6rem;
            color: rgba(212,164,76,0.06);
            line-height: 1.4;
            pointer-events: none;
            user-select: none;
            white-space: pre;
            letter-spacing: 2px;
        }

        /* ── TERMINAL BADGE ── */
        .terminal-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-family: 'Courier New', monospace;
            font-size: 0.72rem;
            background: rgba(0,0,0,0.4);
            border: 1px solid var(--border);
            border-radius: 6px;
            padding: 0.25rem 0.65rem;
            color: var(--green);
            margin-bottom: 1.2rem;
        }
        .terminal-badge::before {
            content: '>';
            color: var(--accent);
            font-weight: 700;
        }

        /* ── SECTION DIVIDER RULE ── */
        .code-divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
            opacity: 0.3;
        }
        .code-divider span {
            font-family: 'Courier New', monospace;
            font-size: 0.65rem;
            color: var(--accent);
            white-space: nowrap;
        }
        .code-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        /* ── CURSOR GLOW ── */
        .cursor-glow {
            pointer-events: none;
            position: fixed;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(212,164,76,0.07) 0%, transparent 70%);
            transform: translate(-50%, -50%);
            z-index: 9998;
            transition: opacity 0.3s;
        }

        /* ── TILT CARD ── */
        .tilt-card {
            transform-style: preserve-3d;
            transition: transform 0.1s ease-out, box-shadow 0.1s ease-out;
            will-change: transform;
        }

        /* ── RIPPLE ── */
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(212, 164, 76, 0.25);
            transform: scale(0);
            animation: ripple-anim 0.6s linear;
            pointer-events: none;
        }
        @keyframes ripple-anim {
            to { transform: scale(4); opacity: 0; }
        }

        /* ── FLOATING CODE WIDGET ── */
        .code-widget {
            position: fixed;
            right: 2rem;
            bottom: 2rem;
            z-index: 998;
            width: 280px;
            background: rgba(12,12,15,0.88);
            backdrop-filter: blur(16px);
            border: 1px solid var(--border);
            border-radius: 12px;
            font-family: 'JetBrains Mono', 'Fira Code', 'Courier New', monospace;
            font-size: 0.72rem;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        .code-widget:hover {
            border-color: rgba(212,164,76,0.25);
            box-shadow: 0 14px 40px rgba(0,0,0,0.7), 0 0 15px rgba(212,164,76,0.08);
        }
        .cw-restore-btn {
            position: fixed;
            right: 2rem;
            bottom: 2rem;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: rgba(20, 20, 24, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid var(--border);
            color: var(--accent);
            display: none;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 997;
            box-shadow: 0 6px 20px rgba(0,0,0,0.4);
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            opacity: 0;
            transform: scale(0.8);
        }
        .cw-restore-btn:hover {
            border-color: var(--accent);
            transform: scale(1.08) rotate(15deg);
            color: var(--text);
            box-shadow: 0 8px 24px rgba(212,164,76,0.18);
        }
        .cw-bar {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.5rem 0.75rem;
            background: rgba(255,255,255,0.03);
            border-bottom: 1px solid var(--border);
        }
        .cw-dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            transition: transform 0.15s ease;
        }
        .cw-dot.r {
            background: #ff5f57;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 7px;
            color: rgba(0,0,0,0.7);
            font-family: Arial, sans-serif;
            font-weight: 800;
        }
        .cw-dot.r::before {
            content: '×';
            opacity: 0;
            transition: opacity 0.15s ease;
            position: relative;
            top: -0.5px;
        }
        .cw-bar:hover .cw-dot.r::before {
            opacity: 1;
        }
        .cw-dot.y { background: #febc2e; }
        .cw-dot.g { background: #28c840; }
        .cw-filename {
            margin-left: auto;
            color: var(--muted);
            font-size: 0.65rem;
        }
        .cw-body {
            padding: 0.75rem;
            line-height: 1.8;
        }
        .cw-line { display: flex; gap: 0.5rem; }
        .cw-num { color: rgba(255,255,255,0.2); min-width: 1.2rem; text-align: right; }
        .cw-kw  { color: #c084fc; }
        .cw-fn  { color: #60a5fa; }
        .cw-str { color: var(--accent); }
        .cw-op  { color: var(--muted); }
        .cw-var { color: #86efac; }
        .cw-cursor {
            display: inline-block;
            width: 2px; height: 0.9em;
            background: var(--accent);
            vertical-align: middle;
            animation: blink 1s step-end infinite;
        }
        @keyframes blink { 50% { opacity: 0; } }

        .hero-role {
            font-size: 1.05rem;
            color: var(--light);
            font-weight: 400;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.65rem;
        }

        .hero-role::before {
            content: '';
            width: 26px;
            height: 1px;
            background: var(--border);
        }

        .hero-bio {
            color: var(--muted);
            font-size: 0.98rem;
            max-width: 88%;
            margin-bottom: 2.25rem;
        }

        .hero-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 2.25rem;
        }

        .btn-cv {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            padding: 0.65rem 1.4rem;
            background: var(--accent);
            color: #0c0c0f;
            border-radius: 9px;
            font-size: 0.88rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.22s;
            letter-spacing: 0.2px;
        }

        .btn-cv:hover {
            background: #e8b96a;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(212, 164, 76, 0.3);
        }

        .btn-cv i {
            font-size: 0.8rem;
        }

        .socials {
            display: flex;
            gap: 0.6rem;
        }

        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 9px;
            background: var(--surface);
            border: 1px solid var(--border);
            color: var(--muted);
            font-size: 0.95rem;
            text-decoration: none;
            transition: all 0.2s;
        }

        .social-btn:hover {
            color: var(--accent);
            border-color: rgba(212, 164, 76, 0.35);
            background: var(--accent-dim);
            transform: translateY(-3px);
        }

        /* ── LANYARD (canvas physics) ── */
        .lanyard-scene {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: grab;
            user-select: none;
            -webkit-user-select: none;
            height: 490px;
            touch-action: none;
        }
        .lanyard-scene:active { cursor: grabbing; }

        /* pin at very top */
        .pin {
            position: relative;
            z-index: 5;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: radial-gradient(circle at 35% 35%, #bbb, #555);
            border: 3px solid #333;
            box-shadow: 0 3px 10px rgba(0,0,0,0.6), 0 1px 3px rgba(255,255,255,0.12) inset;
            flex-shrink: 0;
        }

        /* canvas draws the rope */
        #lanyard-canvas {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            pointer-events: none;
        }

        /* card wrapper — absolutely positioned by JS */
        #lanyard-swing {
            position: absolute;
            display: flex;
            flex-direction: column;
            align-items: center;
            transform-origin: top center;
            will-change: transform;
        }

        .cord { display: none; }
        #lanyard-rope-svg { display: none; }

        .id-card {
            width: 210px;
            background: var(--surface);
            border: 1px solid rgba(255, 255, 255, 0.09);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 20px 55px rgba(0, 0, 0, 0.6), 0 0 0 1px rgba(255, 255, 255, 0.03) inset;
        }

        .id-top {
            height: 9px;
            background: linear-gradient(90deg, var(--accent) 0%, var(--accent-2) 100%);
        }

        .id-hole-row {
            display: flex;
            justify-content: center;
            margin-top: -5px;
        }

        .id-hole {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: var(--bg);
            border: 2px solid rgba(255, 255, 255, 0.12);
        }

        .id-body {
            padding: 1.1rem 1.1rem 1.4rem;
            text-align: center;
        }

        .id-photo {
            width: 110px;
            height: 110px;
            border-radius: 11px;
            object-fit: cover;
            background: var(--surface-2);
            display: block;
            margin: 0.5rem auto 0.9rem;
        }

        .id-name {
            font-family: 'Syne', sans-serif;
            font-size: 0.88rem;
            font-weight: 800;
            color: var(--text);
            margin-bottom: 0.2rem;
            line-height: 1.25;
        }

        .id-role {
            font-size: 0.67rem;
            font-weight: 600;
            color: var(--accent);
            text-transform: uppercase;
            letter-spacing: 1.2px;
            margin-bottom: 0.9rem;
        }

        .id-divider {
            border: none;
            border-top: 1px dashed rgba(255, 255, 255, 0.08);
            margin: 0 0 0.75rem;
        }

        .id-barcode {
            display: flex;
            justify-content: center;
            gap: 2px;
        }

        .id-barcode span {
            display: block;
            height: 24px;
            background: var(--muted);
            border-radius: 1px;
            opacity: 0.35;
        }

        /* ── SECTIONS ── */
        section {
            padding: 4.5rem 0;
        }

        .sec-kicker {
            font-family: 'Syne', sans-serif;
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2.2px;
            color: var(--accent);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.55rem;
        }

        .sec-kicker::before {
            content: '';
            width: 14px;
            height: 2px;
            background: var(--accent);
        }

        .sec-title {
            font-family: 'Syne', sans-serif;
            font-size: clamp(1.6rem, 5.5vw, 2.4rem);
            font-weight: 800;
            letter-spacing: -0.4px;
            margin-bottom: 0.65rem;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.6rem;
        }

        .sec-sub {
            color: var(--muted);
            font-size: 0.94rem;
            max-width: 500px;
            margin-bottom: 3.5rem;
        }

        /* ── CARD ── */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 13px;
            padding: 1.75rem;
            transition: border-color .22s, transform .28s, box-shadow .28s;
        }

        .card:hover {
            border-color: rgba(212, 164, 76, 0.18);
            transform: translateY(-5px);
            box-shadow: 0 18px 38px rgba(0, 0, 0, 0.35);
        }

        /* ── SKILLS ── */
        .skills-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
            gap: 1.6rem;
        }

        .sg-title {
            font-family: 'Syne', sans-serif;
            font-size: 0.95rem;
            font-weight: 700;
            margin-bottom: 1.35rem;
            padding-bottom: 0.55rem;
            border-bottom: 1px solid var(--border);
            color: var(--text);
        }

        .skill {
            margin-bottom: 1rem;
        }

        .skill-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.86rem;
            font-weight: 500;
            margin-bottom: 0.38rem;
        }

        .skill-pct {
            color: var(--muted);
            font-weight: 400;
        }

        .skill-track {
            height: 4px;
            background: var(--surface-2);
            border-radius: 99px;
            overflow: hidden;
        }

        .skill-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--accent), var(--accent-2));
            border-radius: 99px;
            width: 0;
            transition: width 1.1s cubic-bezier(.22, 1, .36, 1);
        }

        /* ── TIMELINE ── */
        .timeline-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
        }

        .tl-head {
            font-family: 'Syne', sans-serif;
            font-size: 1.4rem;
            font-weight: 800;
            margin-bottom: 2.25rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding-bottom: 0.65rem;
            border-bottom: 1px solid var(--border);
        }

        .tl-head i {
            color: var(--accent);
            font-size: 1rem;
        }

        .timeline {
            position: relative;
            padding-left: 1.85rem;
            border-left: 1px solid var(--border);
            margin-left: 0.4rem;
        }

        .tl-item {
            position: relative;
            margin-bottom: 2.5rem;
        }

        .tl-item::before {
            content: '';
            position: absolute;
            left: calc(-1.85rem - 5px);
            top: 0.4rem;
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: var(--accent);
            box-shadow: 0 0 0 3px rgba(212, 164, 76, 0.14);
            transition: box-shadow .22s;
        }

        .tl-item:hover::before {
            box-shadow: 0 0 0 6px rgba(212, 164, 76, 0.18);
        }

        .tl-date {
            font-size: 0.73rem;
            font-weight: 700;
            color: var(--accent);
            text-transform: uppercase;
            letter-spacing: .8px;
            margin-bottom: .28rem;
        }

        .tl-title {
            font-family: 'Syne', sans-serif;
            font-size: 1.05rem;
            font-weight: 700;
            margin-bottom: .22rem;
        }

        .tl-sub {
            font-size: .85rem;
            color: var(--light);
            font-weight: 500;
            margin-bottom: .7rem;
        }

        .tl-desc {
            font-size: .88rem;
            color: var(--muted);
            line-height: 1.55;
        }

        /* ── PROJECTS ── */
        .proj-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.6rem;
        }

        .proj-card {
            display: flex;
            flex-direction: column;
            overflow: hidden;
            padding: 0;
        }

        .proj-thumb {
            aspect-ratio: 16/9;
            overflow: hidden;
            background: var(--surface-2);
            border-bottom: 1px solid var(--border);
        }

        .proj-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s ease;
        }

        .proj-card:hover .proj-thumb img {
            transform: scale(1.06);
        }

        .proj-thumb .no-img {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .proj-thumb .no-img::before {
            content: '';
            position: absolute;
            inset: 0;
            background: var(--proj-grad);
            opacity: 0.85;
        }

        .proj-thumb .no-img i {
            font-size: 2rem;
            color: rgba(255,255,255,0.1);
            position: relative;
            z-index: 1;
        }

        .proj-thumb .no-img .proj-thumb-icon {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
        }

        .proj-thumb .no-img .proj-thumb-initial {
            font-family: 'Syne', sans-serif;
            font-size: 1.8rem;
            font-weight: 800;
            color: rgba(255,255,255,0.15);
            letter-spacing: -1px;
            line-height: 1;
        }

        .proj-body {
            padding: 1.6rem;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .proj-title {
            font-family: 'Syne', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: .55rem;
            transition: color .22s;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .proj-card:hover .proj-title {
            color: var(--accent);
        }

        .proj-desc {
            font-size: .88rem;
            color: var(--muted);
            margin-bottom: 1.35rem;
            flex: 1;
            line-height: 1.55;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .tags {
            display: flex;
            flex-wrap: wrap;
            gap: .38rem;
            margin-bottom: 1.35rem;
        }

        .tag {
            font-size: .71rem;
            font-weight: 600;
            padding: .18rem .6rem;
            border-radius: 99px;
            background: var(--accent-dim);
            color: var(--accent);
            border: 1px solid rgba(212, 164, 76, 0.16);
        }

        /* ── API TAG (red) ── */
        .tag-api {
            background: rgba(239, 68, 68, 0.1);
            color: #f87171;
            border-color: rgba(239, 68, 68, 0.22);
        }
        .tag-api i {
            font-size: .65rem;
            margin-right: 2px;
        }

        .proj-link {
            display: inline-flex;
            align-items: center;
            gap: .38rem;
            font-size: .83rem;
            font-weight: 600;
            color: var(--light);
            text-decoration: none;
            transition: color .2s;
        }

        .proj-link i {
            font-size: .73rem;
            transition: transform .2s;
        }

        .proj-link:hover {
            color: var(--accent);
        }

        .proj-link:hover i {
            transform: translate(2px, -2px);
        }

        /* ── ORGS ── */
        .org-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.6rem;
        }

        .org-card {
            border-top: 2px solid var(--green);
        }

        /* ── EMPTY ── */
        .empty {
            grid-column: 1/-1;
            text-align: center;
            color: var(--muted);
            padding: 3.5rem 0;
            font-size: .88rem;
        }

        .empty i {
            font-size: 1.75rem;
            margin-bottom: .55rem;
            display: block;
            opacity: .2;
        }

        /* ── FOOTER ── */
        footer {
            border-top: 1px solid var(--border);
            padding: 2rem 0;
            text-align: center;
            color: var(--muted);
            font-size: 0.8rem;
            margin-top: 5rem;
            letter-spacing: 0.3px;
        }

        /* scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg);
        }

        ::-webkit-scrollbar-thumb {
            background: #222226;
            border-radius: 3px;
        }

        /* ── RESPONSIVE ── */
        @media(max-width:900px) {
            .hero-grid {
                grid-template-columns: 1fr;
                gap: 3.5rem;
                text-align: center;
            }

            .lanyard-scene {
                order: -1;
            }

            .hero-right-col {
                align-items: center;
                padding-top: 1.5rem;
            }

            .tech-stack-row {
                justify-content: center;
            }

            .contrib-wrapper {
                align-self: center;
                margin-top: 1.5rem;
                max-width: 100%;
                overflow-x: auto;
                padding-bottom: 0.5rem;
                scrollbar-width: none;
            }
            .contrib-wrapper::-webkit-scrollbar {
                display: none;
            }

            .socials,
            .hero-actions {
                justify-content: center;
            }

            .hero-bio {
                max-width: 100%;
            }

            .timeline-grid {
                grid-template-columns: 1fr;
                gap: 3.5rem;
            }

            .proj-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            }
            .skills-grid {
                grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            }
            .org-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            }

            h1 {
                font-size: 3.25rem;
            }

            /* Code Widget floats cleanly above the centered lofi player on mobile/tablet */
            .code-widget {
                right: 1rem !important;
                bottom: 4.8rem !important;
                width: calc(100% - 2rem) !important;
                max-width: 300px !important;
                z-index: 998;
            }
            .cw-restore-btn {
                right: 1rem !important;
                bottom: 4.8rem !important;
            }

            /* Make the lofi-player much more compact on mobile/tablet by hiding volume and reducing padding */
            .lofi-player {
                bottom: 1rem;
                left: 50% !important;
                transform: translateX(-50%) !important;
                width: auto !important;
                max-width: fit-content !important;
                padding: 0.3rem 0.75rem 0.3rem 0.3rem !important;
                gap: 0.5rem !important;
                border-radius: 99px !important;
            }
            .lofi-player:hover {
                transform: translateX(-50%) scale(1.02) !important;
            }
            .lp-controls {
                display: none !important; /* hide volume controls on mobile */
            }

            /* Add safe space to footer so copyright text can be scrolled completely above floating widgets */
            footer {
                padding-bottom: 9.5rem !important;
            }
        }

        @media(max-width:768px) {
            header .wrap {
                padding: 0;
                position: relative;
            }
            header .wrap::after {
                content: '';
                position: absolute;
                top: 0;
                right: 0;
                height: 100%;
                width: 40px;
                background: linear-gradient(to right, transparent, rgba(12, 12, 15, 0.95));
                pointer-events: none;
                z-index: 10;
            }
            header .wrap::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                height: 100%;
                width: 40px;
                background: linear-gradient(to left, transparent, rgba(12, 12, 15, 0.95));
                pointer-events: none;
                z-index: 10;
            }
            nav {
                justify-content: flex-start;
                overflow-x: auto;
                scrollbar-width: none; /* Firefox */
                -ms-overflow-style: none;  /* IE and Edge */
                padding: 0 2rem;
            }
            nav::-webkit-scrollbar {
                display: none; /* Chrome, Safari, Opera */
            }
            .nav-links {
                flex-wrap: nowrap;
                gap: 0.2rem;
                margin: 0;
                padding: 0;
            }
            .nav-links a {
                padding: 0.4rem 0.8rem;
                font-size: 0.8rem;
            }
        }

        @media(max-width:560px) {
            h1 {
                font-size: 2.5rem;
                letter-spacing: -1.2px;
            }

            section {
                padding: 3.5rem 0;
            }

            .proj-grid,
            .skills-grid,
            .org-grid {
                grid-template-columns: 1fr !important;
                gap: 1.2rem;
            }

            .card {
                padding: 1.25rem;
            }
        }

        /* ── LOFI PLAYER ── */
        .lofi-player {
            position: fixed;
            bottom: 2rem;
            left: 2rem;
            z-index: 999;
            background: rgba(20, 20, 24, 0.75);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--border);
            border-radius: 30px;
            padding: 0.5rem 1rem 0.5rem 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.4);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        
        .lofi-player:hover {
            border-color: rgba(212, 164, 76, 0.3);
            box-shadow: 0 12px 40px rgba(0,0,0,0.6), 0 0 15px rgba(212, 164, 76, 0.1);
        }

        .lp-disc-wrapper {
            position: relative;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .lp-disc {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: #111;
            border: 2px solid var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s;
            animation: spin 6s linear infinite;
            animation-play-state: paused;
            cursor: pointer;
        }

        .lp-disc-inner {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--bg);
            border: 1px solid var(--accent-dim);
        }

        .lofi-player.playing .lp-disc {
            animation-play-state: running;
        }

        .lp-play-btn {
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            border-radius: 50%;
            border: none;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            transition: opacity 0.2s;
            font-size: 0.9rem;
        }

        .lp-disc-wrapper:hover .lp-play-btn,
        .lp-play-btn:focus {
            opacity: 1;
        }

        .lp-info {
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-width: 0;
            max-width: 140px;
        }

        .lp-title {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--text);
            letter-spacing: 0.5px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .lp-artist {
            font-size: 0.62rem;
            color: var(--accent);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 0.1rem;
        }

        .lp-status {
            font-size: 0.65rem;
            color: var(--muted);
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }

        .lp-visualizer {
            display: flex;
            align-items: flex-end;
            gap: 2px;
            height: 12px;
            width: 20px;
        }

        .lp-bar {
            width: 3px;
            height: 3px;
            background: var(--accent);
            border-radius: 1px;
            transition: height 0.15s ease;
        }

        .lofi-player.playing .lp-bar {
            animation: bounce 0.8s ease infinite alternate;
        }

        .lofi-player.playing .lp-bar:nth-child(2) {
            animation-delay: 0.15s;
            animation-duration: 0.6s;
        }
        .lofi-player.playing .lp-bar:nth-child(3) {
            animation-delay: 0.3s;
            animation-duration: 0.9s;
        }
        .lofi-player.playing .lp-bar:nth-child(4) {
            animation-delay: 0.45s;
            animation-duration: 0.7s;
        }

        .lp-controls {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            border-left: 1px solid var(--border);
            padding-left: 0.75rem;
            margin-left: 0.25rem;
        }

        .lp-nav-btn {
            background: none;
            border: none;
            color: var(--muted);
            cursor: pointer;
            font-size: 0.75rem;
            padding: 0.2rem;
            transition: color 0.2s;
            display: flex;
            align-items: center;
        }

        .lp-nav-btn:hover {
            color: var(--accent);
        }

        .lp-volume-btn {
            background: none;
            border: none;
            color: var(--muted);
            cursor: pointer;
            font-size: 0.8rem;
            transition: color 0.2s;
            display: flex;
            align-items: center;
        }

        .lp-volume-btn:hover {
            color: var(--text);
        }

        .lp-volume-slider {
            width: 0;
            opacity: 0;
            height: 4px;
            -webkit-appearance: none;
            background: var(--surface-2);
            border-radius: 99px;
            outline: none;
            transition: width 0.3s cubic-bezier(0.25, 0.8, 0.25, 1), opacity 0.3s;
            cursor: pointer;
        }

        .lp-volume-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--accent);
            cursor: pointer;
            transition: transform 0.1s;
        }

        .lp-volume-slider::-webkit-slider-thumb:hover {
            transform: scale(1.3);
        }

        .lp-controls:hover .lp-volume-slider,
        .lp-volume-slider:active,
        .lp-volume-slider:focus {
            width: 60px;
            opacity: 1;
        }

        @keyframes spin {
            100% { transform: rotate(360deg); }
        }

        @keyframes bounce {
            0% { height: 3px; }
            100% { height: 12px; }
        }

        @media(max-width: 560px) {
            .lofi-player {
                bottom: 1rem;
                left: 1rem;
            }
        }

        /* ── SECTION SPACING OVERRIDES ── */
        #projects {
            padding-bottom: 1rem;
        }
        #organizations {
            padding-top: 1rem;
        }

        /* ── FLOATING COMMIT BADGE ── */
        .commit-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-family: 'Courier New', monospace;
            font-size: 0.68rem;
            background: rgba(30,30,38,0.8);
            border: 1px solid rgba(212,164,76,0.18);
            border-radius: 6px;
            padding: 0.2rem 0.6rem;
            color: var(--muted);
            margin-bottom: 0.6rem;
        }
        .commit-badge .cb-hash { color: var(--accent); }
        .commit-badge .cb-msg  { color: var(--light); }

        /* ── DECORATIVE INLINE CODE ── */
        .inline-code-decor {
            display: inline-block;
            font-family: 'Courier New', monospace;
            font-size: 0.7rem;
            background: rgba(0,0,0,0.35);
            border: 1px solid var(--border);
            border-radius: 4px;
            padding: 0.1rem 0.4rem;
            color: #c084fc;
            vertical-align: middle;
            margin-left: 0.4rem;
        }

        /* ── FLOATING GIT LOG PANEL ── */
        .git-log-panel {
            position: absolute;
            left: -170px;
            top: 30px;
            width: 160px;
            background: rgba(12,12,15,0.9);
            border: 1px solid rgba(212,164,76,0.12);
            border-radius: 8px;
            font-family: 'Courier New', monospace;
            font-size: 0.6rem;
            padding: 0.5rem 0.6rem;
            line-height: 1.8;
            pointer-events: none;
            color: var(--muted);
            backdrop-filter: blur(8px);
            display: none;
        }
        @media(min-width: 1200px) { .git-log-panel { display: block; } }
        .glp-hash { color: #facc15; }
        .glp-ok   { color: #4ade80; }
        .glp-warn { color: var(--accent); }

        /* ── TECH STACK PILLS ── */
        .tech-stack-row {
            display: flex;
            flex-wrap: wrap;
            gap: 0.4rem;
            margin-top: 1.4rem;
            margin-bottom: 0.7rem;
        }
        .tech-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.28rem;
            font-size: 0.68rem;
            font-weight: 600;
            padding: 0.22rem 0.65rem;
            border-radius: 99px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            color: var(--muted);
            transition: all 0.18s;
            letter-spacing: 0.2px;
        }
        .tech-pill i { font-size: 0.72rem; }
        .tech-pill:hover {
            background: rgba(255,255,255,0.08);
            border-color: rgba(212,164,76,0.25);
            color: var(--text);
            transform: translateY(-1px);
        }
        .tp-php    { color: #9b9fe8; }
        .tp-js     { color: #f0d04e; }
        .tp-react  { color: #61dafb; }
        .tp-docker { color: #4a9edd; }
        .tp-git    { color: #f34f29; }
        .tp-db     { color: #4f9edb; }
        .tp-linux  { color: #ccc; }
        .tp-github { color: #e0e0e0; }

        /* ── GIT STATUS BAR ── */
        .git-status-bar {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-family: 'Courier New', monospace;
            font-size: 0.66rem;
            color: var(--muted);
            background: rgba(0,0,0,0.28);
            border: 1px solid var(--border);
            border-radius: 6px;
            padding: 0.28rem 0.7rem;
            margin-bottom: 1rem;
        }
        .gsb-branch { color: #c084fc; font-weight: 600; }
        .gsb-branch i { margin-right: 0.15rem; }
        .gsb-sep { opacity: 0.25; }
        .gsb-ok { color: #4ade80; }
        .gsb-ok i { margin-right: 0.15rem; }

        /* ── CONTRIBUTION GRAPH ── */
        .contrib-wrapper {
            margin-top: 1.1rem;
        }
        .contrib-label {
            font-family: 'Courier New', monospace;
            font-size: 0.6rem;
            color: rgba(212,164,76,0.3);
            margin-bottom: 0.45rem;
            letter-spacing: 0.5px;
        }
        .contrib-graph {
            display: flex;
            gap: 3px;
        }
        .contrib-col {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }
        .contrib-cell {
            width: 10px;
            height: 10px;
            border-radius: 2px;
            background: rgba(255,255,255,0.04);
            transition: background 0.1s;
        }
        .contrib-cell:hover { background: rgba(212,164,76,0.5) !important; }
        .contrib-cell.l1 { background: rgba(0,109,50,0.5); }
        .contrib-cell.l2 { background: rgba(0,109,50,0.75); }
        .contrib-cell.l3 { background: rgba(38,166,65,0.85); }
        .contrib-cell.l4 { background: #39d353; }

        /* ── DEPS PANEL (package.json / composer.json) ── */
        .deps-panel {
            float: right;
            width: 195px;
            margin: 0 0 1.2rem 1.5rem;
            background: rgba(10,10,14,0.9);
            border: 1px solid rgba(212,164,76,0.14);
            border-radius: 10px;
            overflow: hidden;
            font-family: 'Courier New', monospace;
            font-size: 0.63rem;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.4);
            display: none;
        }
        @media(min-width: 1100px) { .deps-panel { display: block; } }
        .dp-header {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 7px 10px;
            background: rgba(255,255,255,0.025);
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .dp-dot { width: 9px; height: 9px; border-radius: 50%; }
        .dp-dot.r { background: #ff5f57; }
        .dp-dot.y { background: #febc2e; }
        .dp-dot.g { background: #28c840; }
        .dp-title { margin-left: auto; color: rgba(255,255,255,0.22); font-size: 0.6rem; }
        .dp-body { padding: 0.55rem 0.7rem; line-height: 1.9; }
        .dp-row { display: flex; justify-content: space-between; gap: 0.3rem; }
        .dp-key { color: #d4a44c; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 110px; }
        .dp-val { color: #86efac; white-space: nowrap; }
        .dp-obj { color: rgba(255,255,255,0.2); }


        /* ═══════════════════════════════════════════
           LOADING SCREEN
        ══════════════════════════════════════════ */
        #page-loader {
            position: fixed;
            inset: 0;
            z-index: 999999;
            background: #0a0a0d;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            transition: opacity 0.9s cubic-bezier(0.4, 0, 0.2, 1),
                        visibility 0.9s cubic-bezier(0.4, 0, 0.2, 1);
        }
        #page-loader.loader-hide {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        /* Matrix canvas inside loader */
        #loader-matrix {
            position: absolute;
            inset: 0;
            opacity: 0.07;
            pointer-events: none;
        }

        /* Scan line */
        .loader-scan {
            position: absolute;
            left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg,
                transparent 0%,
                rgba(212,164,76,0.5) 30%,
                rgba(212,164,76,0.9) 50%,
                rgba(212,164,76,0.5) 70%,
                transparent 100%);
            animation: loaderScan 3s linear infinite;
            pointer-events: none;
        }
        @keyframes loaderScan {
            0%   { top: -2px; opacity: 0; }
            5%   { opacity: 1; }
            95%  { opacity: 1; }
            100% { top: 100%; opacity: 0; }
        }

        /* Logo */
        .loader-logo {
            font-family: 'Syne', sans-serif;
            font-size: 2.8rem;
            font-weight: 800;
            color: var(--accent);
            margin-bottom: 2.5rem;
            position: relative;
            z-index: 1;
            letter-spacing: -1px;
            animation: logoPulse 2s ease-in-out infinite;
        }
        .loader-logo .lb { color: rgba(255,255,255,0.18); font-weight: 300; }
        @keyframes logoPulse {
            0%, 100% { text-shadow: 0 0 20px rgba(212,164,76,0.3); }
            50%       { text-shadow: 0 0 40px rgba(212,164,76,0.6), 0 0 80px rgba(212,164,76,0.2); }
        }

        /* Terminal window */
        .loader-terminal {
            position: relative;
            z-index: 1;
            width: min(540px, 90vw);
            background: rgba(14,14,18,0.96);
            border: 1px solid rgba(212,164,76,0.2);
            border-radius: 14px;
            overflow: hidden;
            box-shadow:
                0 30px 80px rgba(0,0,0,0.85),
                0 0 0 1px rgba(255,255,255,0.03),
                0 0 60px rgba(212,164,76,0.04) inset;
        }

        .lt-bar {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 10px 14px;
            background: rgba(255,255,255,0.025);
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .lt-dot { width: 11px; height: 11px; border-radius: 50%; }
        .lt-dot.r { background: #ff5f57; }
        .lt-dot.y { background: #febc2e; }
        .lt-dot.g { background: #28c840; }
        .lt-bar-title {
            margin: 0 auto;
            font-family: 'Courier New', monospace;
            font-size: 0.68rem;
            color: rgba(255,255,255,0.25);
            letter-spacing: 0.5px;
        }

        .lt-body {
            padding: 1.25rem 1.5rem 1.5rem;
            font-family: 'Courier New', monospace;
            font-size: 0.8rem;
            line-height: 1.9;
        }

        .lt-row {
            display: flex;
            gap: 0.6rem;
            opacity: 0;
            transform: translateX(-8px);
            transition: opacity 0.35s ease, transform 0.35s ease;
        }
        .lt-row.lt-show {
            opacity: 1;
            transform: none;
        }
        .lt-prompt  { color: var(--accent); user-select: none; }
        .lt-cmd     { color: #86efac; }
        .lt-grey    { color: rgba(255,255,255,0.22); }
        .lt-out     { color: var(--muted); padding-left: 1.1rem; }
        .lt-ok      { color: #4ade80; }
        .lt-warn    { color: var(--accent); }

        /* Progress */
        .lt-progress-wrap {
            margin-top: 1.1rem;
            position: relative;
            padding-bottom: 0.1rem;
        }
        .lt-pct {
            position: absolute;
            right: 0;
            top: -1.4rem;
            font-family: 'Courier New', monospace;
            font-size: 0.68rem;
            color: var(--accent);
            transition: 0.4s;
        }
        .lt-track {
            height: 4px;
            background: rgba(255,255,255,0.05);
            border-radius: 99px;
            overflow: hidden;
        }
        .lt-fill {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, #b87333, #d4a44c, #f0c060);
            border-radius: 99px;
            box-shadow: 0 0 12px rgba(212,164,76,0.55);
            transition: width 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Status text below terminal */
        .loader-bottom {
            position: relative;
            z-index: 1;
            text-align: center;
            margin-top: 2rem;
        }
        .loader-title {
            font-family: 'Syne', sans-serif;
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--text);
            letter-spacing: 0.3px;
        }
        .loader-sub {
            font-family: 'Courier New', monospace;
            font-size: 0.73rem;
            color: var(--muted);
            margin-top: 0.35rem;
        }
        .loader-dots span {
            display: inline-block;
            animation: dotBounce 1.2s ease-in-out infinite;
        }
        .loader-dots span:nth-child(2) { animation-delay: 0.2s; }
        .loader-dots span:nth-child(3) { animation-delay: 0.4s; }
        @keyframes dotBounce {
            0%, 80%, 100% { opacity: 0.2; transform: translateY(0); }
            40%            { opacity: 1;   transform: translateY(-3px); }
        }
    </style>
</head>

<body>

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

    <div class="cursor-glow" id="cursor-glow"></div>
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <header>
        <div class="wrap">
            <nav>
                <ul class="nav-links">
                    <li><a href="#about">About</a></li>
                    <li><a href="#skills">Skills</a></li>
                    <li><a href="#experience">Experience</a></li>
                    <li><a href="#projects">Projects</a></li>
                    <li><a href="#organizations">Organizations</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>

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


        {{-- SKILLS --}}
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

        {{-- EXPERIENCE & EDUCATION --}}
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

        {{-- PROJECTS --}}
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

        {{-- ORGANIZATIONS --}}
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
            <div class="lp-title">Japanese Lofi Cafe</div>
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
        <audio id="lp-audio" preload="none">
            <source src="https://listen.moe/stream" type="audio/mpeg">
            <source src="https://streams.fluxfm.de/Chillhop/mp3-128/" type="audio/mpeg">
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
                const r = scene.getBoundingClientRect();
                canvas.width  = r.width;
                canvas.height = r.height;
            }
            resizeCanvas();
            window.addEventListener('resize', resizeCanvas);

            function getPinCenter() {
                const pr = pinEl.getBoundingClientRect();
                const sr = scene.getBoundingClientRect();
                return {
                    x: pr.left + pr.width  / 2 - sr.left,
                    y: pr.top  + pr.height / 2 - sr.top,
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

                // Draw rope on canvas
                drawRope(pin.x, pin.y, cardX, cardY);

                // Position the card — place it so its top-center aligns with cardX,cardY
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

        let isPlaying  = false;
        let lastVolume = 0.5;

        audio.volume   = lastVolume;
        volSlider.value = lastVolume;

        function startPlaying() {
            player.classList.add('playing');
            playIcon.className     = 'fa-solid fa-pause';
            statusText.textContent = 'Playing 🎵';
            isPlaying = true;
        }

        function stopPlaying() {
            audio.pause();
            player.classList.remove('playing');
            playIcon.className     = 'fa-solid fa-play';
            statusText.textContent = 'Paused';
            isPlaying = false;
        }

        function togglePlay() {
            if (isPlaying) {
                stopPlaying();
            } else {
                statusText.textContent = 'Loading…';
                audio.load();
                audio.play()
                    .then(() => startPlaying())
                    .catch(err => {
                        console.warn('Autoplay blocked:', err);
                        statusText.textContent = 'Click to play';
                    });
            }
        }

        // Autoplay on first user interaction
        const autoEvents = ['click','keydown','touchstart','mousedown','pointerdown','scroll'];
        const tryAutoplay = () => {
            if (!isPlaying) {
                audio.load();
                audio.play().then(() => startPlaying()).catch(() => {});
            }
            autoEvents.forEach(e => document.removeEventListener(e, tryAutoplay));
        };
        autoEvents.forEach(e => document.addEventListener(e, tryAutoplay, { once: true, passive: true }));

        playToggle.addEventListener('click', togglePlay);
        document.querySelector('.lp-disc').addEventListener('click', togglePlay);

        volSlider.addEventListener('input', e => {
            const v = parseFloat(e.target.value);
            audio.volume = v;
            if (v === 0)      volIcon.className = 'fa-solid fa-volume-xmark';
            else if (v < 0.5) volIcon.className = 'fa-solid fa-volume-low';
            else               volIcon.className = 'fa-solid fa-volume-high';
            if (v > 0) lastVolume = v;
        });

        volToggle.addEventListener('click', () => {
            if (audio.volume > 0) {
                lastVolume      = audio.volume;
                audio.volume    = 0;
                volSlider.value = 0;
                volIcon.className = 'fa-solid fa-volume-xmark';
            } else {
                audio.volume    = lastVolume;
                volSlider.value = lastVolume;
                volIcon.className = lastVolume < 0.5 ? 'fa-solid fa-volume-low' : 'fa-solid fa-volume-high';
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
</body>
</html>