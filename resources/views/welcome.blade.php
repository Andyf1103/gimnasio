<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spasso Gym — Sucre, Bolivia</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,700;1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --gold: #c9a84c;
            --gold-light: #f0c040;
            --gold-dim: #c9a84c33;
            --dark: #0a0a0a;
            --dark2: #111111;
            --dark3: #1a1a1a;
            --border: #222222;
            --text: #e8e6e0;
            --muted: #666;
            --white: #fff;
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--dark);
            color: var(--text);
            overflow-x: hidden;
        }

        /* ── NAV ── */
        nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 5vw;
            height: 70px;
            background: rgba(10,10,10,0.92);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .nav-logo img {
            height: 42px;
            width: 42px;
            object-fit: contain;
            border-radius: 8px;
        }

        .nav-logo-text {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px;
            letter-spacing: 3px;
            color: var(--white);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 26px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 32px;
            list-style: none;
        }

        .nav-links a {
            font-size: 13px;
            font-weight: 500;
            color: var(--muted);
            text-decoration: none;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: color .2s;
        }

        .nav-links a:hover { color: var(--gold-light); }

        .nav-cta {
            background: var(--gold-light);
            color: #0a0a0a !important;
            padding: 8px 20px;
            border-radius: 6px;
            font-weight: 700 !important;
        }

        .nav-cta:hover {
            background: var(--gold) !important;
            color: #0a0a0a !important;
        }

        .login-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: transparent;
            color: var(--gold-light);
            border: 1px solid var(--gold);
            padding: 9px 18px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            text-decoration: none;
            transition: all .2s;
            white-space: nowrap;
        }

        .login-btn:hover {
            background: var(--gold-light);
            color: #0a0a0a;
            transform: translateY(-1px);
        }

        /* ── HERO ── */
        .hero {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 120px 5vw 80px;
            position: relative;
            overflow: hidden;
        }

        .hero-bg {
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse 60% 50% at 50% 0%, #c9a84c18 0%, transparent 70%),
                radial-gradient(ellipse 40% 60% at 80% 80%, #c9a84c0a 0%, transparent 60%);
        }

        .hero-grid {
            position: absolute; inset: 0; opacity: .04;
            background-image:
                linear-gradient(var(--border) 1px, transparent 1px),
                linear-gradient(90deg, var(--border) 1px, transparent 1px);
            background-size: 60px 60px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 1px solid var(--gold-dim);
            background: var(--gold-dim);
            color: var(--gold-light);
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 28px;
            animation: fadeUp .8s ease both;
            position: relative; z-index: 2;
        }

        .hero-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(64px, 10vw, 130px);
            letter-spacing: 6px;
            line-height: .95;
            color: var(--white);
            animation: fadeUp .8s .1s ease both;
            position: relative; z-index: 2;
        }

        .hero-title span { color: var(--gold-light); }

        /* ── SUBTÍTULO HERO: blanco con sombra luminosa ── */
        .hero-sub {
            font-size: clamp(15px, 1.6vw, 18px);
            color: #ffffff;
            max-width: 540px;
            line-height: 1.75;
            margin-top: 24px;
            font-weight: 400;
            text-shadow: 0 0 40px rgba(255,255,255,0.18);
            animation: fadeUp .8s .2s ease both;
            position: relative; z-index: 2;
        }

        .hero-actions {
            display: flex;
            gap: 14px;
            margin-top: 40px;
            flex-wrap: wrap;
            justify-content: center;
            animation: fadeUp .8s .3s ease both;
            position: relative; z-index: 2;
        }

        .btn-primary {
            background: var(--gold-light);
            color: #0a0a0a;
            padding: 14px 32px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 14px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            text-decoration: none;
            transition: all .2s;
            border: none;
            cursor: pointer;
        }

        .btn-primary:hover {
            background: var(--gold);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px #c9a84c33;
        }

        .btn-outline {
            border: 1px solid var(--border);
            color: var(--text);
            padding: 14px 32px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 14px;
            letter-spacing: 1px;
            text-transform: uppercase;
            text-decoration: none;
            transition: all .2s;
            background: transparent;
        }

        .btn-outline:hover {
            border-color: var(--gold);
            color: var(--gold-light);
        }

        .hero-stats {
            display: flex;
            gap: 48px;
            margin-top: 64px;
            animation: fadeUp .8s .4s ease both;
            position: relative; z-index: 2;
        }

        .stat { text-align: center; }

        .stat-num {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 42px;
            color: var(--gold-light);
            letter-spacing: 2px;
            line-height: 1;
        }

        .stat-label {
            font-size: 11px;
            color: var(--muted);
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-top: 4px;
        }

        .stat-sep { width: 1px; background: var(--border); }

        /* ── SECTIONS BASE ── */
        section { padding: 100px 5vw; }

        .section-label {
            display: inline-block;
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--gold-light);
            margin-bottom: 16px;
        }

        .section-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(36px, 5vw, 56px);
            letter-spacing: 3px;
            color: var(--white);
            line-height: 1.1;
            margin-bottom: 20px;
        }

        /* ── DESCRIPCIONES: blanco claro ── */
        .section-desc {
            font-size: 15px;
            color: #d0cdc7;
            max-width: 600px;
            line-height: 1.7;
            font-weight: 400;
        }

        /* ── ENCABEZADOS DE SECCIÓN: centrados ── */
        section > .reveal:first-child {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        section > .reveal:first-child .section-desc {
            text-align: center;
        }

        /* ── SERVICIOS ── */
        #servicios { background: var(--dark2); }

        .servicios-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin-top: 56px;
        }

        @media (min-width: 900px) {
            .servicios-grid { grid-template-columns: repeat(4, 1fr); }
        }

        .servicio-card {
            background: var(--dark3);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 28px 24px;
            transition: all .25s;
            position: relative;
            overflow: hidden;
        }

        .servicio-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: var(--gold-light);
            transform: scaleX(0);
            transition: transform .25s;
            transform-origin: left;
        }

        .servicio-card:hover { border-color: #333; transform: translateY(-4px); }
        .servicio-card:hover::before { transform: scaleX(1); }

        .servicio-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: var(--gold-dim);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
        }

        .servicio-icon i { color: var(--gold-light); font-size: 18px; }
        .servicio-name { font-size: 15px; font-weight: 600; color: var(--white); margin-bottom: 6px; }
        /* descripciones de servicio: más claras */
        .servicio-desc { font-size: 13px; color: #c0bdb8; line-height: 1.5; }

        /* ── PLANES ── */
        #planes { background: var(--dark); }

        .plan-tabs {
            display: flex;
            gap: 8px;
            margin: 40px auto 32px;
            background: var(--dark2);
            padding: 4px;
            border-radius: 10px;
            width: fit-content;
        }

        .plan-tab {
            padding: 8px 20px;
            border-radius: 7px;
            border: none;
            background: transparent;
            color: var(--muted);
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all .2s;
            letter-spacing: .5px;
        }

        .plan-tab.active { background: var(--gold-light); color: #0a0a0a; }

        /* ── PLANES GRID: flex centrado ── */
        .plans-grid {
            display: none;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .plans-grid.active { display: flex; }
        .plans-grid .plan-card { flex: 1 1 260px; max-width: 360px; }

        .plan-card {
            background: var(--dark2);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 28px;
            position: relative;
            overflow: hidden;
            transition: all .25s;
        }

        .plan-card.featured {
            border-color: var(--gold);
            background: linear-gradient(135deg, #1a1500 0%, var(--dark2) 60%);
        }

        .plan-card:hover { transform: translateY(-3px); border-color: #333; }
        .plan-card.featured:hover { border-color: var(--gold-light); }

        .plan-badge {
            display: inline-block;
            background: var(--gold-light);
            color: #0a0a0a;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 3px 10px;
            border-radius: 20px;
            margin-bottom: 16px;
        }

        .plan-name { font-size: 16px; font-weight: 600; color: var(--white); margin-bottom: 6px; }

        .plan-price {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 48px;
            color: var(--gold-light);
            letter-spacing: 2px;
            line-height: 1;
            margin: 12px 0 4px;
        }

        .plan-price span {
            font-size: 18px;
            color: var(--muted);
            font-family: 'DM Sans', sans-serif;
            font-weight: 300;
        }

        .plan-includes {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        /* items de plan: más claros */
        .plan-item {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            font-size: 13px;
            color: #c8c5bf;
            line-height: 1.4;
        }

        .plan-item i { color: var(--gold-light); font-size: 11px; margin-top: 3px; flex-shrink: 0; }

        .plan-extra {
            margin-top: 8px;
            font-size: 12px;
            color: var(--muted);
            font-style: italic;
        }

        /* ── HORARIOS ── */
        #horarios { background: var(--dark2); }

        .horarios-wrap {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 48px;
            margin-top: 56px;
            align-items: start;
        }

        .horario-list { display: flex; flex-direction: column; gap: 12px; }

        .horario-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--dark3);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 16px 20px;
        }

        .horario-dia { font-size: 14px; font-weight: 500; color: var(--white); }

        .horario-hora { font-size: 13px; color: var(--gold-light); font-weight: 500; }

        .horario-hora small {
            display: block;
            font-size: 11px;
            color: #aaa;
            font-weight: 400;
            margin-top: 2px;
            text-align: right;
        }

        .ubicacion-card {
            background: var(--dark3);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 32px;
            height: 100%;
        }

        .ubicacion-icon {
            width: 52px; height: 52px;
            border-radius: 12px;
            background: var(--gold-dim);
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 20px;
        }

        .ubicacion-icon i { color: var(--gold-light); font-size: 22px; }
        .ubicacion-title { font-size: 18px; font-weight: 600; color: var(--white); margin-bottom: 12px; }
        .ubicacion-addr { font-size: 14px; color: #c0bdb8; line-height: 1.6; margin-bottom: 24px; }
        .ubicacion-addr strong { color: var(--text); }
        .ubicacion-social { display: flex; gap: 10px; flex-wrap: wrap; }

        /* ── CONTACTO ── */
        #contacto { background: var(--dark); }

        .contacto-wrap {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 64px;
            margin-top: 56px;
            align-items: start;
        }

        .contacto-info { display: flex; flex-direction: column; gap: 20px; }

        .contacto-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            background: var(--dark2);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px;
        }

        .contacto-item-icon {
            width: 40px; height: 40px;
            border-radius: 10px;
            background: var(--gold-dim);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .contacto-item-icon i { color: var(--gold-light); font-size: 16px; }
        /* labels de contacto: más visibles */
        .contacto-item-label { font-size: 11px; color: #999; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 4px; }
        .contacto-item-val { font-size: 14px; color: var(--white); font-weight: 500; }
        .contacto-item-val a { color: var(--gold-light); text-decoration: none; }
        .contacto-item-val a:hover { text-decoration: underline; }

        .contact-form {
            background: var(--dark2);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 32px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .form-title { font-size: 18px; font-weight: 600; color: var(--white); margin-bottom: 4px; }
        .form-sub { font-size: 13px; color: #bbb; margin-bottom: 8px; }
        .form-group { display: flex; flex-direction: column; gap: 6px; }
        .form-label { font-size: 11px; color: #aaa; letter-spacing: 1px; text-transform: uppercase; }

        .form-input {
            background: var(--dark3);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 12px 14px;
            color: var(--white);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            outline: none;
            transition: border-color .2s;
        }

        .form-input:focus { border-color: var(--gold); }
        .form-input::placeholder { color: #3a3a3a; }
        textarea.form-input { resize: vertical; min-height: 100px; }

        .form-btn {
            border: none;
            border-radius: 8px;
            padding: 13px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all .2s;
            margin-top: 4px;
            width: 100%;
        }

        .form-btn-wa { background: #25D366; color: #fff; }
        .form-btn-wa:hover { background: #1ebe5a; transform: translateY(-1px); }
        .form-btn-fb { background: #1877F2; color: #fff; }
        .form-btn-fb:hover { background: #145dca; transform: translateY(-1px); }
        .form-btns { display: flex; flex-direction: column; gap: 10px; margin-top: 4px; }

        /* ── FOOTER ── */
        footer {
            background: var(--dark2);
            border-top: 1px solid var(--border);
            padding: 40px 5vw;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }

        .footer-brand { font-family: 'Bebas Neue', sans-serif; font-size: 20px; letter-spacing: 3px; color: var(--white); }
        .footer-brand span { color: var(--gold-light); }
        .footer-copy { font-size: 12px; color: var(--muted); }
        .footer-social { display: flex; gap: 12px; }

        .social-btn {
            width: 36px; height: 36px;
            border-radius: 8px;
            border: 1px solid var(--border);
            background: transparent;
            display: flex; align-items: center; justify-content: center;
            color: var(--muted);
            font-size: 15px;
            text-decoration: none;
            transition: all .2s;
        }

        .social-btn:hover { border-color: var(--gold); color: var(--gold-light); }

        /* ── FLOATING CONTACT ── */
        .float-contact {
            position: fixed;
            right: 20px;
            bottom: 30px;
            z-index: 999;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 12px;
        }

        .float-menu {
            display: flex;
            flex-direction: column;
            gap: 10px;
            align-items: flex-end;
            opacity: 0;
            pointer-events: none;
            transform: translateY(12px);
            transition: opacity .25s ease, transform .25s ease;
        }

        .float-menu.open {
            opacity: 1;
            pointer-events: all;
            transform: translateY(0);
        }

        .float-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 18px 10px 14px;
            border-radius: 50px;
            text-decoration: none;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 600;
            color: #fff;
            box-shadow: 0 4px 18px rgba(0,0,0,0.45);
            transition: transform .2s, box-shadow .2s;
            white-space: nowrap;
        }

        .float-btn:hover { transform: translateX(-5px); box-shadow: 0 6px 26px rgba(0,0,0,0.55); }
        .float-btn i { font-size: 18px; flex-shrink: 0; }
        .float-btn.wa  { background: #25D366; }
        .float-btn.fb  { background: #1877F2; }
        .float-btn.ig  { background: linear-gradient(135deg,#f58529,#dd2a7b,#8134af); }

        .float-toggle {
            width: 56px; height: 56px;
            border-radius: 50%;
            background: var(--gold-light);
            border: none;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 20px rgba(201,168,76,0.5);
            transition: all .3s;
            color: #0a0a0a;
            font-size: 20px;
            flex-shrink: 0;
        }

        .float-toggle:hover { background: var(--gold); transform: scale(1.08); }
        .float-toggle.active { background: #2a2a2a; color: #fff; box-shadow: 0 4px 16px rgba(0,0,0,0.4); }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity .6s ease, transform .6s ease;
        }

        .reveal.visible { opacity: 1; transform: translateY(0); }

        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
            nav { padding: 0 4vw; }
            .nav-logo-text { font-size: 18px; letter-spacing: 2px; }
            .nav-logo img { height: 38px; width: 38px; }
            .nav-links { display: none; }
            .login-btn { padding: 8px 13px; font-size: 12px; }
            .hero-stats { gap: 24px; }
            .horarios-wrap { grid-template-columns: 1fr; }
            .contacto-wrap { grid-template-columns: 1fr; }
            .plan-tabs { flex-wrap: wrap; }
            .float-btn-label { display: none; }
            .float-btn { padding: 13px; border-radius: 50%; }
            .float-btn i { font-size: 20px; }
        }

        @media (max-width: 480px) {
            .hero-actions { flex-direction: column; width: 100%; }
            .btn-primary, .btn-outline { width: 100%; text-align: center; }
            .hero-stats { flex-direction: column; gap: 20px; }
            .stat-sep { display: none; }
        }
    </style>
</head>

<body>

    <!-- NAV -->
    <nav>
        <a href="#" class="nav-logo">
            <img src="{{ asset('img/logo.png') }}" alt="Logo Spasso Gym">
            <span class="nav-logo-text">SPASSO GYM</span>
        </a>

        <div class="nav-actions">
            <ul class="nav-links">
                <li><a href="#servicios">Servicios</a></li>
                <li><a href="#planes">Planes</a></li>
                <li><a href="#horarios">Horarios</a></li>
                <li><a href="#contacto" class="nav-cta">Contáctanos</a></li>
            </ul>

            <a href="{{ url('/login') }}" class="login-btn">
                <i class="fas fa-user-lock"></i>
                Ingresar
            </a>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero">
        <div class="hero-bg"></div>
        <div class="hero-grid"></div>

        <div class="hero-badge">
            <i class="fas fa-dumbbell"></i> Sucre, Bolivia
        </div>

        <h1 class="hero-title">
            SPASSO<br>
            <span>GYM</span>
        </h1>

        <p class="hero-sub">
            Tu espacio para entrenar, mejorar y sentirte bien. Máquinas de musculación, cardio, sauna y más, todo en un solo lugar en Sucre.
        </p>

        <div class="hero-actions">
            <a href="#planes" class="btn-primary">
                <i class="fas fa-tag"></i> Ver Planes
            </a>

            <a href="#contacto" class="btn-outline">
                <i class="fas fa-envelope"></i> Contáctanos
            </a>
        </div>

        <div class="hero-stats">
            <div class="stat">
                <div class="stat-num">5+</div>
                <div class="stat-label">Planes disponibles</div>
            </div>

            <div class="stat-sep"></div>

            <div class="stat">
                <div class="stat-num">16h</div>
                <div class="stat-label">Horario diario</div>
            </div>

            <div class="stat-sep"></div>

            <div class="stat">
                <div class="stat-num">100%</div>
                <div class="stat-label">Equipado</div>
            </div>
        </div>
    </section>

    <!-- SERVICIOS -->
    <section id="servicios">
        <div class="reveal">
            <span class="section-label">Lo que ofrecemos</span>
            <h2 class="section-title">TODO LO QUE<br>NECESITAS</h2>
            <p class="section-desc">
                Un gimnasio completo con todo el equipamiento y servicios para que alcances tus objetivos.
            </p>
        </div>

        <div class="servicios-grid reveal">
            <div class="servicio-card">
                <div class="servicio-icon"><i class="fas fa-dumbbell"></i></div>
                <div class="servicio-name">Musculación</div>
                <div class="servicio-desc">Máquinas de musculación completas para todos los grupos musculares.</div>
            </div>

            <div class="servicio-card">
                <div class="servicio-icon"><i class="fas fa-running"></i></div>
                <div class="servicio-name">Cardio</div>
                <div class="servicio-desc">Equipos de cardio modernos: trotadoras, bicicletas y más.</div>
            </div>

            <div class="servicio-card">
                <div class="servicio-icon"><i class="fas fa-hot-tub"></i></div>
                <div class="servicio-name">Sauna</div>
                <div class="servicio-desc">Sauna incluido en varios planes. Relájate después de tu entrenamiento.</div>
            </div>

            <div class="servicio-card">
                <div class="servicio-icon"><i class="fas fa-user-graduate"></i></div>
                <div class="servicio-name">Instructores</div>
                <div class="servicio-desc">Personal capacitado para guiarte en tu rutina y alcanzar tus metas.</div>
            </div>

            <div class="servicio-card">
                <div class="servicio-icon"><i class="fas fa-camera"></i></div>
                <div class="servicio-name">Seguridad</div>
                <div class="servicio-desc">Cámaras de seguridad para tus vehículos y motocicletas.</div>
            </div>

            <div class="servicio-card">
                <div class="servicio-icon"><i class="fas fa-lock"></i></div>
                <div class="servicio-name">Vestuarios</div>
                <div class="servicio-desc">Cambiadores y casilleros disponibles para todos los socios.</div>
            </div>

            <div class="servicio-card">
                <div class="servicio-icon"><i class="fas fa-flask"></i></div>
                <div class="servicio-name">Suplementos</div>
                <div class="servicio-desc">Suplementos deportivos a excelentes precios disponibles en el local.</div>
            </div>
        </div>
    </section>

    <!-- PLANES -->
    <section id="planes">
        <div class="reveal">
            <span class="section-label">Precios y planes</span>
            <h2 class="section-title">ELIGE TU<br>PLAN</h2>
            <p class="section-desc">
                Planes flexibles para cada estilo de vida. Desde sesiones individuales hasta membresías anuales.
            </p>
        </div>

        <div class="plan-tabs reveal">
            <button type="button" class="plan-tab active" onclick="showPlan('mensual', this)">Mensual</button>
            <button type="button" class="plan-tab" onclick="showPlan('mediomes', this)">Medio Mes</button>
            <button type="button" class="plan-tab" onclick="showPlan('semanal', this)">3x Semana</button>
            <button type="button" class="plan-tab" onclick="showPlan('sesion', this)">Sesión</button>
            <button type="button" class="plan-tab" onclick="showPlan('oro', this)">Socio Oro</button>
        </div>

        <div class="plans-grid active" id="plan-mensual">
            <div class="plan-card">
                <div class="plan-name">Cardio + Máquinas + Sauna</div>
                <div class="plan-price">230<span> Bs/mes</span></div>
                <div class="plan-includes">
                    <div class="plan-item"><i class="fas fa-check"></i>Cardio completo</div>
                    <div class="plan-item"><i class="fas fa-check"></i>Máquinas de musculación</div>
                    <div class="plan-item"><i class="fas fa-check"></i>2 saunas viernes</div>
                </div>
            </div>

            <div class="plan-card featured">
                <div class="plan-badge">Más popular</div>
                <div class="plan-name">Cardio + Máquinas</div>
                <div class="plan-price">200<span> Bs/mes</span></div>
                <div class="plan-includes">
                    <div class="plan-item"><i class="fas fa-check"></i>Cardio completo</div>
                    <div class="plan-item"><i class="fas fa-check"></i>Máquinas de musculación</div>
                </div>
            </div>

            <div class="plan-card">
                <div class="plan-name">Solo Musculación</div>
                <div class="plan-price">150<span> Bs/mes</span></div>
                <div class="plan-includes">
                    <div class="plan-item"><i class="fas fa-check"></i>Máquinas de musculación</div>
                </div>
            </div>

            <div class="plan-card">
                <div class="plan-name">Musculación + Sauna</div>
                <div class="plan-price">180<span> Bs/mes</span></div>
                <div class="plan-includes">
                    <div class="plan-item"><i class="fas fa-check"></i>Máquinas de musculación</div>
                    <div class="plan-item"><i class="fas fa-check"></i>3 veces sauna</div>
                </div>
            </div>
        </div>

        <div class="plans-grid" id="plan-mediomes">
            <div class="plan-card">
                <div class="plan-name">Cardio + Máquinas + Sauna</div>
                <div class="plan-price">120<span> Bs</span></div>
                <div class="plan-includes">
                    <div class="plan-item"><i class="fas fa-check"></i>Cardio completo</div>
                    <div class="plan-item"><i class="fas fa-check"></i>Máquinas de musculación</div>
                    <div class="plan-item"><i class="fas fa-check"></i>1 sauna viernes</div>
                </div>
            </div>

            <div class="plan-card featured">
                <div class="plan-badge">Recomendado</div>
                <div class="plan-name">Cardio + Máquinas</div>
                <div class="plan-price">110<span> Bs</span></div>
                <div class="plan-includes">
                    <div class="plan-item"><i class="fas fa-check"></i>Cardio completo</div>
                    <div class="plan-item"><i class="fas fa-check"></i>Máquinas de musculación</div>
                </div>
            </div>

            <div class="plan-card">
                <div class="plan-name">Solo Musculación</div>
                <div class="plan-price">80<span> Bs</span></div>
                <div class="plan-includes">
                    <div class="plan-item"><i class="fas fa-check"></i>Máquinas de musculación</div>
                </div>
            </div>
        </div>

        <div class="plans-grid" id="plan-semanal">
            <div class="plan-card featured">
                <div class="plan-badge">Con trotadora</div>
                <div class="plan-name">Musculación + Trotadora + Sauna</div>
                <div class="plan-price">120<span> Bs</span></div>
                <div class="plan-includes">
                    <div class="plan-item"><i class="fas fa-check"></i>Máquinas de musculación</div>
                    <div class="plan-item"><i class="fas fa-check"></i>Trotadora</div>
                    <div class="plan-item"><i class="fas fa-check"></i>1 sauna incluido</div>
                    <div class="plan-item"><i class="fas fa-check"></i>3 veces por semana</div>
                </div>
            </div>

            <div class="plan-card">
                <div class="plan-name">Solo Musculación</div>
                <div class="plan-price">90<span> Bs</span></div>
                <div class="plan-includes">
                    <div class="plan-item"><i class="fas fa-check"></i>Máquinas de musculación</div>
                    <div class="plan-item"><i class="fas fa-check"></i>Sin trotadora</div>
                    <div class="plan-item"><i class="fas fa-check"></i>3 veces por semana</div>
                </div>
            </div>
        </div>

        <div class="plans-grid" id="plan-sesion">
            <div class="plan-card featured">
                <div class="plan-name">Caminadora + Musculación</div>
                <div class="plan-price">20<span> Bs</span></div>
                <div class="plan-includes">
                    <div class="plan-item"><i class="fas fa-check"></i>Caminadora</div>
                    <div class="plan-item"><i class="fas fa-check"></i>Máquinas de musculación</div>
                    <div class="plan-item"><i class="fas fa-check"></i>Sesión por día</div>
                </div>
            </div>

            <div class="plan-card">
                <div class="plan-name">Solo Musculación</div>
                <div class="plan-price">15<span> Bs</span></div>
                <div class="plan-includes">
                    <div class="plan-item"><i class="fas fa-check"></i>Máquinas de musculación</div>
                    <div class="plan-item"><i class="fas fa-check"></i>Sesión por día</div>
                </div>
            </div>
        </div>

        <div class="plans-grid" id="plan-oro">
            <div class="plan-card featured">
                <div class="plan-badge">⭐ Membresía Premium</div>
                <div class="plan-name">Socio de Oro — Anual</div>
                <div class="plan-price">150<span> Bs/mes</span></div>
                <p class="plan-extra">+ Matrícula anual: 650 Bs</p>
                <div class="plan-includes">
                    <div class="plan-item"><i class="fas fa-check"></i>Máquinas de musculación</div>
                    <div class="plan-item"><i class="fas fa-check"></i>Equipos de cardio</div>
                    <div class="plan-item"><i class="fas fa-check"></i>Sauna libre incluido</div>
                    <div class="plan-item"><i class="fas fa-check"></i>Acceso todo el año</div>
                    <div class="plan-item"><i class="fas fa-check"></i>Beneficios exclusivos de socio</div>
                </div>
            </div>
        </div>
    </section>

    <!-- HORARIOS -->
    <section id="horarios">
        <div class="reveal">
            <span class="section-label">Horarios de atención</span>
            <h2 class="section-title">SIEMPRE<br>ABIERTOS</h2>
            <p class="section-desc">Encuentra el momento perfecto para tu entrenamiento.</p>
        </div>

        <div class="horarios-wrap reveal">
            <div class="horario-list">
                <div class="horario-item">
                    <div class="horario-dia">
                        <i class="fas fa-calendar-week" style="color:var(--gold-light);margin-right:10px"></i>
                        Lunes a Viernes
                    </div>
                    <div class="horario-hora">06:00 — 22:00</div>
                </div>

                <div class="horario-item">
                    <div class="horario-dia">
                        <i class="fas fa-calendar-day" style="color:var(--gold-light);margin-right:10px"></i>
                        Sábado
                    </div>
                    <div class="horario-hora">
                        07:00 — 12:00
                        <small>y 14:30 — 20:00</small>
                    </div>
                </div>

                <div class="horario-item">
                    <div class="horario-dia">
                        <i class="fas fa-star" style="color:var(--gold-light);margin-right:10px"></i>
                        Feriados
                    </div>
                    <div class="horario-hora">14:30 — 20:00</div>
                </div>
            </div>

            <div class="ubicacion-card">
                <div class="ubicacion-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>

                <div class="ubicacion-title">¿Dónde estamos?</div>

                <div class="ubicacion-addr">
                    <strong>Nestor Galindo, Esq. Av. Canadá</strong><br>
                    Sucre, Bolivia
                </div>

                <div class="ubicacion-social">
                    <a href="https://www.facebook.com/SpazioSaunaClub" target="_blank" class="btn-outline" style="display:inline-flex;align-items:center;gap:8px;font-size:13px;padding:10px 20px">
                        <i class="fab fa-facebook"></i> Facebook
                    </a>

                    <a href="https://www.instagram.com/spassosaunaclub?igsh=ZWF6Y2s1cWMyZGcw" target="_blank" class="btn-outline" style="display:inline-flex;align-items:center;gap:8px;font-size:13px;padding:10px 20px">
                        <i class="fab fa-instagram"></i> Instagram
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTACTO -->
    <section id="contacto">
        <div class="reveal">
            <span class="section-label">Contacto</span>
            <h2 class="section-title">¿LISTO PARA<br>EMPEZAR?</h2>
            <p class="section-desc">
                Escríbenos y te respondemos a la brevedad. También puedes visitarnos directamente.
            </p>
        </div>

        <div class="contacto-wrap reveal">
            <div class="contacto-info">
                <div class="contacto-item">
                    <div class="contacto-item-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <div class="contacto-item-label">Dirección</div>
                        <div class="contacto-item-val">
                            Sucre, Departamento de Chuquisaca<br>Bolivia
                        </div>
                    </div>
                </div>

                <div class="contacto-item">
                    <div class="contacto-item-icon"><i class="fab fa-whatsapp"></i></div>
                    <div>
                        <div class="contacto-item-label">WhatsApp</div>
                        <div class="contacto-item-val">
                            <a href="https://wa.me/59176692963" target="_blank">+591 766 92963</a>
                        </div>
                    </div>
                </div>

                <div class="contacto-item">
                    <div class="contacto-item-icon"><i class="fas fa-envelope"></i></div>
                    <div>
                        <div class="contacto-item-label">Correo electrónico</div>
                        <div class="contacto-item-val">
                            <a href="mailto:spaziosaunaclub@gmail.com">spaziosaunaclub@gmail.com</a>
                        </div>
                    </div>
                </div>

                <div class="contacto-item">
                    <div class="contacto-item-icon"><i class="fab fa-facebook"></i></div>
                    <div>
                        <div class="contacto-item-label">Facebook</div>
                        <div class="contacto-item-val">
                            <a href="https://www.facebook.com/SpazioSaunaClub" target="_blank">
                                SpazioSaunaClub <i class="fas fa-external-link-alt" style="font-size:10px"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="contacto-item">
                    <div class="contacto-item-icon"><i class="fab fa-instagram"></i></div>
                    <div>
                        <div class="contacto-item-label">Instagram</div>
                        <div class="contacto-item-val">
                            <a href="https://www.instagram.com/spassosaunaclub?igsh=ZWF6Y2s1cWMyZGcw" target="_blank">
                                @spassosaunaclub <i class="fas fa-external-link-alt" style="font-size:10px"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="contacto-item">
                    <div class="contacto-item-icon"><i class="fas fa-clock"></i></div>
                    <div>
                        <div class="contacto-item-label">Horario de atención</div>
                        <div class="contacto-item-val">
                            Lun–Vie: 06:00 a 22:00<br>
                            Sáb: 07:00–12:00 y 14:30–20:00
                        </div>
                    </div>
                </div>
            </div>

            <div class="contact-form">
                <div class="form-title">Contáctanos</div>
                <div class="form-sub">Elige cómo prefieres escribirnos — te respondemos a la brevedad.</div>

                <div class="form-group">
                    <label class="form-label" for="f-nombre">Nombre completo</label>
                    <input type="text" class="form-input" placeholder="Tu nombre" id="f-nombre">
                </div>

                <div class="form-group">
                    <label class="form-label" for="f-tel">Teléfono o WhatsApp</label>
                    <input type="text" class="form-input" placeholder="Tu número" id="f-tel">
                </div>

                <div class="form-group">
                    <label class="form-label" for="f-plan">¿En qué plan estás interesado?</label>
                    <select class="form-input" id="f-plan" style="cursor:pointer">
                        <option value="">Seleccionar...</option>
                        <option>Mensual — Cardio + Máquinas + Sauna 230 Bs</option>
                        <option>Mensual — Cardio + Máquinas 200 Bs</option>
                        <option>Mensual — Musculación 150 Bs</option>
                        <option>Mensual — Musculación + Sauna 180 Bs</option>
                        <option>Medio Mes</option>
                        <option>3 veces por semana</option>
                        <option>Sesión individual</option>
                        <option>Socio de Oro Anual</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="f-msg">Mensaje opcional</label>
                    <textarea class="form-input" placeholder="¿Alguna pregunta?" id="f-msg"></textarea>
                </div>

                <div class="form-btns">
                    <button type="button" class="form-btn form-btn-wa" onclick="contactarWA()">
                        <i class="fab fa-whatsapp" style="margin-right:8px"></i>
                        Contactar por WhatsApp
                    </button>

                    <a href="https://www.facebook.com/SpazioSaunaClub" target="_blank" style="text-decoration:none">
                        <button type="button" class="form-btn form-btn-fb">
                            <i class="fab fa-facebook" style="margin-right:8px"></i>
                            Contactar por Facebook
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- FLOATING CONTACT -->
    <div class="float-contact">
        <div class="float-menu" id="floatMenu">
            <a href="https://www.instagram.com/spassosaunaclub?igsh=ZWF6Y2s1cWMyZGcw" target="_blank" class="float-btn ig">
                <i class="fab fa-instagram"></i>
                <span class="float-btn-label">Instagram</span>
            </a>
            <a href="https://www.facebook.com/SpazioSaunaClub" target="_blank" class="float-btn fb">
                <i class="fab fa-facebook-f"></i>
                <span class="float-btn-label">Facebook</span>
            </a>
            <a href="https://wa.me/59176692963" target="_blank" class="float-btn wa">
                <i class="fab fa-whatsapp"></i>
                <span class="float-btn-label">WhatsApp</span>
            </a>
        </div>
        <button class="float-toggle" id="floatToggle" onclick="toggleFloat()" title="Contáctanos">
            <i class="fas fa-comment-dots" id="floatIcon"></i>
        </button>
    </div>

    <!-- FOOTER -->
    <footer>
        <div class="footer-brand">SPASSO <span>GYM</span></div>

        <div class="footer-copy">© 2026 Spasso Gym — Sucre, Chuquisaca, Bolivia</div>

        <div class="footer-social">
            <a href="https://www.facebook.com/SpazioSaunaClub" target="_blank" class="social-btn" title="Facebook">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://www.instagram.com/spassosaunaclub?igsh=ZWF6Y2s1cWMyZGcw" target="_blank" class="social-btn" title="Instagram">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="https://wa.me/59176692963" target="_blank" class="social-btn" title="WhatsApp">
                <i class="fab fa-whatsapp"></i>
            </a>
            <a href="mailto:spaziosaunaclub@gmail.com" class="social-btn" title="Email">
                <i class="fas fa-envelope"></i>
            </a>
        </div>
    </footer>

    <script>
        function toggleFloat() {
            const menu   = document.getElementById('floatMenu');
            const toggle = document.getElementById('floatToggle');
            const icon   = document.getElementById('floatIcon');
            const open   = menu.classList.toggle('open');
            toggle.classList.toggle('active', open);
            icon.className = open ? 'fas fa-times' : 'fas fa-comment-dots';
        }

        function showPlan(id, btn) {
            document.querySelectorAll('.plans-grid').forEach(function(grid) {
                grid.classList.remove('active');
            });
            document.querySelectorAll('.plan-tab').forEach(function(tab) {
                tab.classList.remove('active');
            });
            document.getElementById('plan-' + id).classList.add('active');
            btn.classList.add('active');
        }

        function contactarWA() {
            const nombre = document.getElementById('f-nombre').value || 'Sin nombre';
            const tel    = document.getElementById('f-tel').value || 'No indicado';
            const plan   = document.getElementById('f-plan').value || 'Sin seleccionar';
            const msg    = document.getElementById('f-msg').value || '';
            const texto  = `Hola Spasso Gym! 👋\n\n*Nombre:* ${nombre}\n*Teléfono:* ${tel}\n*Plan de interés:* ${plan}${msg ? '\n*Mensaje:* ' + msg : ''}`;
            window.open('https://wa.me/59176692963?text=' + encodeURIComponent(texto), '_blank');
        }

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.reveal').forEach(function(element) {
            observer.observe(element);
        });
    </script>

</body>
</html>
