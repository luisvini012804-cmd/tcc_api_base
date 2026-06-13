<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="MenuCity — API REST para localização de restaurantes e visualização de cardápios digitais. Projeto de TCC.">
    <title>MenuCity — API de Restaurantes e Cardápios Digitais</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        /* ===== Reset & Base ===== */
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --color-bg: #0a0a0f;
            --color-bg-card: rgba(255, 255, 255, 0.04);
            --color-bg-card-hover: rgba(255, 255, 255, 0.07);
            --color-surface: #111118;
            --color-border: rgba(255, 255, 255, 0.08);
            --color-border-hover: rgba(255, 255, 255, 0.15);
            --color-text: #e4e4e7;
            --color-text-muted: #8b8b9e;
            --color-text-heading: #fafafa;
            --color-accent: #6d5cff;
            --color-accent-light: #8b7dff;
            --color-accent-glow: rgba(109, 92, 255, 0.25);
            --color-secondary: #00d4aa;
            --color-secondary-glow: rgba(0, 212, 170, 0.2);
            --color-warm: #ff6b6b;
            --color-amber: #f5a623;
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 20px;
            --radius-xl: 28px;
            --shadow-glow: 0 0 60px rgba(109, 92, 255, 0.08);
            --transition-base: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-bounce: 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--color-bg);
            color: var(--color-text);
            line-height: 1.7;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* ===== Noise Overlay ===== */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 0;
        }

        /* ===== Layout ===== */
        .container {
            max-width: 1120px;
            margin: 0 auto;
            padding: 0 24px;
            position: relative;
            z-index: 1;
        }

        section {
            padding: 100px 0;
        }

        /* ===== Typography ===== */
        h1, h2, h3 {
            color: var(--color-text-heading);
            letter-spacing: -0.03em;
        }

        /* ===== Navbar ===== */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            padding: 16px 0;
            background: rgba(10, 10, 15, 0.7);
            backdrop-filter: blur(20px) saturate(1.4);
            -webkit-backdrop-filter: blur(20px) saturate(1.4);
            border-bottom: 1px solid var(--color-border);
            transition: var(--transition-base);
        }

        .navbar .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            font-weight: 800;
            font-size: 1.25rem;
            color: var(--color-text-heading);
        }

        .navbar-brand .brand-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--color-accent), var(--color-secondary));
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        .navbar-links {
            display: flex;
            gap: 32px;
            list-style: none;
        }

        .navbar-links a {
            text-decoration: none;
            color: var(--color-text-muted);
            font-size: 0.875rem;
            font-weight: 500;
            transition: color var(--transition-base);
            position: relative;
        }

        .navbar-links a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--color-accent);
            border-radius: 1px;
            transition: width var(--transition-base);
        }

        .navbar-links a:hover {
            color: var(--color-text-heading);
        }

        .navbar-links a:hover::after {
            width: 100%;
        }

        /* ===== Hero Section ===== */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            padding-top: 80px;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -200px;
            left: 50%;
            transform: translateX(-50%);
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, var(--color-accent-glow) 0%, transparent 70%);
            pointer-events: none;
            animation: heroGlow 8s ease-in-out infinite alternate;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: -100px;
            right: -200px;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, var(--color-secondary-glow) 0%, transparent 70%);
            pointer-events: none;
            animation: heroGlow 10s ease-in-out infinite alternate-reverse;
        }

        @keyframes heroGlow {
            0% { opacity: 0.5; transform: translateX(-50%) scale(1); }
            100% { opacity: 1; transform: translateX(-50%) scale(1.15); }
        }

        .hero-content {
            text-align: center;
            max-width: 780px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 16px;
            background: var(--color-bg-card);
            border: 1px solid var(--color-border);
            border-radius: 100px;
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--color-text-muted);
            margin-bottom: 32px;
            animation: fadeInUp 0.6s ease-out;
        }

        .hero-badge .badge-dot {
            width: 6px;
            height: 6px;
            background: var(--color-secondary);
            border-radius: 50%;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(0.8); }
        }

        .hero h1 {
            font-size: clamp(2.5rem, 6vw, 4.2rem);
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 24px;
            animation: fadeInUp 0.6s ease-out 0.1s both;
        }

        .hero h1 .gradient-text {
            background: linear-gradient(135deg, var(--color-accent-light), var(--color-secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-description {
            font-size: 1.15rem;
            color: var(--color-text-muted);
            max-width: 560px;
            margin: 0 auto 40px;
            line-height: 1.8;
            animation: fadeInUp 0.6s ease-out 0.2s both;
        }

        .hero-actions {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
            animation: fadeInUp 0.6s ease-out 0.3s both;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ===== Buttons ===== */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 28px;
            border-radius: var(--radius-md);
            font-size: 0.9rem;
            font-weight: 600;
            font-family: inherit;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: all var(--transition-base);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--color-accent), #5a48e0);
            color: #fff;
            box-shadow: 0 4px 24px var(--color-accent-glow);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 32px rgba(109, 92, 255, 0.35);
        }

        .btn-outline {
            background: transparent;
            color: var(--color-text);
            border: 1px solid var(--color-border);
        }

        .btn-outline:hover {
            border-color: var(--color-border-hover);
            background: var(--color-bg-card);
            transform: translateY(-2px);
        }

        /* ===== Section Headers ===== */
        .section-header {
            text-align: center;
            max-width: 600px;
            margin: 0 auto 64px;
        }

        .section-label {
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--color-accent-light);
            margin-bottom: 12px;
        }

        .section-header h2 {
            font-size: clamp(1.75rem, 3.5vw, 2.5rem);
            font-weight: 800;
            margin-bottom: 16px;
            line-height: 1.2;
        }

        .section-header p {
            color: var(--color-text-muted);
            font-size: 1.05rem;
        }

        /* ===== Problema Section ===== */
        .problema {
            background: var(--color-surface);
            border-top: 1px solid var(--color-border);
            border-bottom: 1px solid var(--color-border);
        }

        .problema-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 64px;
            align-items: center;
        }

        .problema-text h2 {
            font-size: clamp(1.5rem, 3vw, 2.2rem);
            font-weight: 800;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .problema-text p {
            color: var(--color-text-muted);
            font-size: 1.05rem;
            margin-bottom: 16px;
        }

        .problema-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-top: 32px;
        }

        .stat-card {
            padding: 20px;
            background: var(--color-bg-card);
            border: 1px solid var(--color-border);
            border-radius: var(--radius-md);
            text-align: center;
            transition: all var(--transition-base);
        }

        .stat-card:hover {
            border-color: var(--color-border-hover);
            background: var(--color-bg-card-hover);
            transform: translateY(-2px);
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--color-accent-light), var(--color-secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-label {
            font-size: 0.8rem;
            color: var(--color-text-muted);
            margin-top: 4px;
        }

        .problema-visual {
            position: relative;
        }

        .problema-illustration {
            width: 100%;
            aspect-ratio: 1;
            background: linear-gradient(135deg, rgba(109, 92, 255, 0.08), rgba(0, 212, 170, 0.06));
            border: 1px solid var(--color-border);
            border-radius: var(--radius-xl);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 6rem;
            position: relative;
            overflow: hidden;
        }

        .problema-illustration::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 30% 30%, var(--color-accent-glow) 0%, transparent 50%);
        }

        .float-emoji {
            position: absolute;
            font-size: 2.5rem;
            animation: float 6s ease-in-out infinite;
        }

        .float-emoji:nth-child(1) { top: 15%; left: 20%; animation-delay: 0s; }
        .float-emoji:nth-child(2) { top: 25%; right: 18%; animation-delay: 1.5s; }
        .float-emoji:nth-child(3) { bottom: 20%; left: 25%; animation-delay: 3s; }
        .float-emoji:nth-child(4) { bottom: 30%; right: 22%; animation-delay: 4.5s; }
        .float-emoji:nth-child(5) { top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 4rem; animation-delay: 0.5s; }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }

        /* ===== Público-Alvo ===== */
        .publico-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .publico-card {
            padding: 36px 28px;
            background: var(--color-bg-card);
            border: 1px solid var(--color-border);
            border-radius: var(--radius-lg);
            text-align: center;
            transition: all var(--transition-base);
            position: relative;
            overflow: hidden;
        }

        .publico-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--color-accent), var(--color-secondary));
            opacity: 0;
            transition: opacity var(--transition-base);
        }

        .publico-card:hover {
            border-color: var(--color-border-hover);
            background: var(--color-bg-card-hover);
            transform: translateY(-6px);
            box-shadow: var(--shadow-glow);
        }

        .publico-card:hover::before {
            opacity: 1;
        }

        .publico-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 20px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
        }

        .publico-card:nth-child(1) .publico-icon {
            background: rgba(109, 92, 255, 0.12);
        }
        .publico-card:nth-child(2) .publico-icon {
            background: rgba(0, 212, 170, 0.12);
        }
        .publico-card:nth-child(3) .publico-icon {
            background: rgba(245, 166, 35, 0.12);
        }

        .publico-card h3 {
            font-size: 1.15rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .publico-card p {
            font-size: 0.9rem;
            color: var(--color-text-muted);
            line-height: 1.6;
        }

        /* ===== Funcionalidades ===== */
        .funcionalidades {
            background: var(--color-surface);
            border-top: 1px solid var(--color-border);
            border-bottom: 1px solid var(--color-border);
        }

        .funcionalidades-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 28px;
        }

        .func-card {
            padding: 40px 28px;
            background: var(--color-bg-card);
            border: 1px solid var(--color-border);
            border-radius: var(--radius-lg);
            transition: all var(--transition-base);
            position: relative;
            overflow: hidden;
        }

        .func-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--color-accent), var(--color-secondary));
            transition: width var(--transition-base);
        }

        .func-card:hover {
            border-color: var(--color-border-hover);
            background: var(--color-bg-card-hover);
            transform: translateY(-4px);
        }

        .func-card:hover::after {
            width: 60%;
        }

        .func-number {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--color-accent-light);
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .func-icon {
            font-size: 2.5rem;
            margin-bottom: 20px;
            display: block;
        }

        .func-card h3 {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .func-card p {
            color: var(--color-text-muted);
            font-size: 0.9rem;
            line-height: 1.7;
        }

        /* ===== Endpoints Section ===== */
        .endpoints-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            max-width: 900px;
            margin: 0 auto;
        }

        .endpoint-card {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 24px;
            background: var(--color-bg-card);
            border: 1px solid var(--color-border);
            border-radius: var(--radius-md);
            text-decoration: none;
            color: inherit;
            transition: all var(--transition-base);
            group: endpoint;
        }

        .endpoint-card:hover {
            border-color: var(--color-accent);
            background: var(--color-bg-card-hover);
            transform: translateX(4px);
            box-shadow: -4px 0 0 var(--color-accent);
        }

        .endpoint-method {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            background: rgba(0, 212, 170, 0.12);
            color: var(--color-secondary);
            flex-shrink: 0;
        }

        .endpoint-info {
            flex: 1;
            min-width: 0;
        }

        .endpoint-path {
            font-family: 'SF Mono', 'Fira Code', monospace;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--color-text-heading);
            margin-bottom: 4px;
        }

        .endpoint-desc {
            font-size: 0.8rem;
            color: var(--color-text-muted);
        }

        .endpoint-arrow {
            font-size: 1.1rem;
            color: var(--color-text-muted);
            transition: all var(--transition-base);
            flex-shrink: 0;
        }

        .endpoint-card:hover .endpoint-arrow {
            color: var(--color-accent);
            transform: translateX(4px);
        }

        .endpoints-note {
            text-align: center;
            margin-top: 32px;
            padding: 16px 24px;
            background: var(--color-bg-card);
            border: 1px solid var(--color-border);
            border-radius: var(--radius-md);
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
        }

        .endpoints-note code {
            background: rgba(109, 92, 255, 0.12);
            color: var(--color-accent-light);
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .endpoints-note p {
            font-size: 0.85rem;
            color: var(--color-text-muted);
        }

        /* ===== Footer ===== */
        footer {
            padding: 48px 0;
            border-top: 1px solid var(--color-border);
            text-align: center;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 12px;
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--color-text-heading);
        }

        .footer-brand .brand-icon {
            width: 28px;
            height: 28px;
            background: linear-gradient(135deg, var(--color-accent), var(--color-secondary));
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
        }

        footer p {
            font-size: 0.8rem;
            color: var(--color-text-muted);
        }

        footer .footer-tech {
            margin-top: 16px;
            display: flex;
            gap: 24px;
            justify-content: center;
            flex-wrap: wrap;
        }

        footer .footer-tech span {
            font-size: 0.75rem;
            padding: 4px 12px;
            background: var(--color-bg-card);
            border: 1px solid var(--color-border);
            border-radius: 100px;
            color: var(--color-text-muted);
        }

        /* ===== Scroll Animations ===== */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.7s ease-out, transform 0.7s ease-out;
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ===== Mobile Menu Toggle ===== */
        .menu-toggle {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            flex-direction: column;
            gap: 5px;
        }

        .menu-toggle span {
            display: block;
            width: 22px;
            height: 2px;
            background: var(--color-text);
            border-radius: 2px;
            transition: var(--transition-base);
        }

        /* ===== Responsivo ===== */
        @media (max-width: 900px) {
            .problema-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .problema-visual {
                order: -1;
            }

            .problema-illustration {
                max-width: 300px;
                margin: 0 auto;
            }

            .publico-cards,
            .funcionalidades-grid {
                grid-template-columns: 1fr;
                max-width: 480px;
                margin: 0 auto;
            }

            .endpoints-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            section {
                padding: 64px 0;
            }

            .navbar-links {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                flex-direction: column;
                background: rgba(10, 10, 15, 0.95);
                backdrop-filter: blur(20px);
                padding: 24px;
                gap: 20px;
                border-bottom: 1px solid var(--color-border);
            }

            .navbar-links.active {
                display: flex;
            }

            .menu-toggle {
                display: flex;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .hero-description {
                font-size: 1rem;
            }

            .problema-stats {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    {{-- ===== Navbar ===== --}}
    <nav class="navbar" id="navbar" role="navigation" aria-label="Navegação principal">
        <div class="container">
            <a href="#" class="navbar-brand" id="nav-brand">
                <span class="brand-icon" aria-hidden="true">🍽️</span>
                MenuCity
            </a>

            <button class="menu-toggle" id="menu-toggle" aria-label="Abrir menu" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <ul class="navbar-links" id="navbar-links" role="menubar">
                <li role="none"><a href="#problema" role="menuitem">O Problema</a></li>
                <li role="none"><a href="#publico" role="menuitem">Público-Alvo</a></li>
                <li role="none"><a href="#funcionalidades" role="menuitem">Funcionalidades</a></li>
                <li role="none"><a href="#endpoints" role="menuitem">Endpoints</a></li>
            </ul>
        </div>
    </nav>

    {{-- ===== Hero ===== --}}
    <header class="hero" id="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-badge">
                    <span class="badge-dot" aria-hidden="true"></span>
                    Projeto de TCC — API REST publicada no Render
                </div>

                <h1>
                    Encontre restaurantes.<br>
                    Explore <span class="gradient-text">cardápios digitais</span>.
                </h1>

                <p class="hero-description">
                    MenuCity é uma API RESTful que conecta usuários a restaurantes próximos,
                    permitindo a consulta de cardápios digitais, categorias culinárias e
                    informações de geolocalização em tempo real.
                </p>

                <div class="hero-actions">
                    <a href="#endpoints" class="btn btn-primary" id="btn-ver-endpoints">
                        🚀 Ver Endpoints
                    </a>
                    <a href="#funcionalidades" class="btn btn-outline" id="btn-conhecer-projeto">
                        Conhecer o Projeto →
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main>
        {{-- ===== O Problema ===== --}}
        <section class="problema" id="problema">
            <div class="container">
                <div class="problema-grid reveal">
                    <div class="problema-text">
                        <p class="section-label">O Problema</p>
                        <h2>Informações de restaurantes espalhadas e desatualizadas</h2>
                        <p>
                            Consumidores enfrentam dificuldade para encontrar restaurantes próximos
                            e consultar cardápios atualizados. Muitos estabelecimentos ainda não
                            possuem presença digital eficiente, resultando em experiências
                            fragmentadas para quem busca uma refeição.
                        </p>
                        <p>
                            O MenuCity resolve isso ao centralizar dados de restaurantes, cardápios
                            e categorias em uma API única, padronizada e de fácil integração.
                        </p>

                        <div class="problema-stats">
                            <div class="stat-card">
                                <div class="stat-value">72%</div>
                                <div class="stat-label">buscam cardápio online antes de ir</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-value">4+</div>
                                <div class="stat-label">endpoints RESTful disponíveis</div>
                            </div>
                        </div>
                    </div>

                    <div class="problema-visual" aria-hidden="true">
                        <div class="problema-illustration">
                            <span class="float-emoji">🍕</span>
                            <span class="float-emoji">🍣</span>
                            <span class="float-emoji">🥗</span>
                            <span class="float-emoji">☕</span>
                            <span class="float-emoji">📍</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ===== Público-Alvo ===== --}}
        <section id="publico">
            <div class="container">
                <div class="section-header reveal">
                    <p class="section-label">Público-Alvo</p>
                    <h2>Para quem o MenuCity foi pensado</h2>
                    <p>Uma API que atende diferentes perfis de uso no ecossistema de alimentação fora do lar.</p>
                </div>

                <div class="publico-cards reveal">
                    <article class="publico-card" id="publico-consumidores">
                        <div class="publico-icon" aria-hidden="true">👤</div>
                        <h3>Consumidores</h3>
                        <p>
                            Pessoas que desejam encontrar restaurantes próximos, comparar
                            opções de cardápio e descobrir novos sabores na cidade.
                        </p>
                    </article>

                    <article class="publico-card" id="publico-desenvolvedores">
                        <div class="publico-icon" aria-hidden="true">💻</div>
                        <h3>Desenvolvedores</h3>
                        <p>
                            Profissionais e estudantes que precisam integrar dados
                            de restaurantes e cardápios em aplicações web ou mobile.
                        </p>
                    </article>

                    <article class="publico-card" id="publico-restaurantes">
                        <div class="publico-icon" aria-hidden="true">🏪</div>
                        <h3>Restaurantes</h3>
                        <p>
                            Estabelecimentos que buscam ampliar sua presença digital
                            e disponibilizar cardápios atualizados para mais clientes.
                        </p>
                    </article>
                </div>
            </div>
        </section>

        {{-- ===== Funcionalidades ===== --}}
        <section class="funcionalidades" id="funcionalidades">
            <div class="container">
                <div class="section-header reveal">
                    <p class="section-label">Funcionalidades</p>
                    <h2>O que a API oferece</h2>
                    <p>Três pilares principais que sustentam a experiência do MenuCity.</p>
                </div>

                <div class="funcionalidades-grid reveal">
                    <article class="func-card" id="func-geolocalizacao">
                        <span class="func-number">01</span>
                        <span class="func-icon" aria-hidden="true">📍</span>
                        <h3>Localização de Restaurantes</h3>
                        <p>
                            Consulta de restaurantes cadastrados com dados de endereço,
                            coordenadas geográficas (latitude/longitude), categoria culinária
                            e status de funcionamento.
                        </p>
                    </article>

                    <article class="func-card" id="func-cardapios">
                        <span class="func-number">02</span>
                        <span class="func-icon" aria-hidden="true">📋</span>
                        <h3>Cardápios Digitais</h3>
                        <p>
                            Acesso a cardápios completos por restaurante, incluindo nome do
                            prato, descrição, preço e categoria — tudo em formato JSON
                            padronizado.
                        </p>
                    </article>

                    <article class="func-card" id="func-categorias">
                        <span class="func-number">03</span>
                        <span class="func-icon" aria-hidden="true">🏷️</span>
                        <h3>Categorias Culinárias</h3>
                        <p>
                            Filtro por tipo de culinária — brasileira, japonesa, italiana,
                            fast food, pizzaria — com contagem de restaurantes por
                            categoria.
                        </p>
                    </article>
                </div>
            </div>
        </section>

        {{-- ===== Endpoints da API ===== --}}
        <section id="endpoints">
            <div class="container">
                <div class="section-header reveal">
                    <p class="section-label">Endpoints da API</p>
                    <h2>Explore a API em tempo real</h2>
                    <p>Clique em qualquer endpoint para ver a resposta JSON diretamente no navegador.</p>
                </div>

                <div class="endpoints-grid reveal">
                    <a href="/api/status" target="_blank" rel="noopener" class="endpoint-card" id="endpoint-status">
                        <span class="endpoint-method">GET</span>
                        <div class="endpoint-info">
                            <div class="endpoint-path">/api/status</div>
                            <div class="endpoint-desc">Saúde e informações gerais da API</div>
                        </div>
                        <span class="endpoint-arrow" aria-hidden="true">→</span>
                    </a>

                    <a href="/api/restaurantes" target="_blank" rel="noopener" class="endpoint-card" id="endpoint-restaurantes">
                        <span class="endpoint-method">GET</span>
                        <div class="endpoint-info">
                            <div class="endpoint-path">/api/restaurantes</div>
                            <div class="endpoint-desc">Lista de restaurantes cadastrados</div>
                        </div>
                        <span class="endpoint-arrow" aria-hidden="true">→</span>
                    </a>

                    <a href="/api/cardapios" target="_blank" rel="noopener" class="endpoint-card" id="endpoint-cardapios">
                        <span class="endpoint-method">GET</span>
                        <div class="endpoint-info">
                            <div class="endpoint-path">/api/cardapios</div>
                            <div class="endpoint-desc">Cardápios digitais dos restaurantes</div>
                        </div>
                        <span class="endpoint-arrow" aria-hidden="true">→</span>
                    </a>

                    <a href="/api/categorias" target="_blank" rel="noopener" class="endpoint-card" id="endpoint-categorias">
                        <span class="endpoint-method">GET</span>
                        <div class="endpoint-info">
                            <div class="endpoint-path">/api/categorias</div>
                            <div class="endpoint-desc">Categorias de culinária disponíveis</div>
                        </div>
                        <span class="endpoint-arrow" aria-hidden="true">→</span>
                    </a>
                </div>

                <div class="endpoints-note reveal">
                    <p>
                        Base URL da API: <code>{{ url('/api') }}</code> — Todos os endpoints retornam <code>application/json</code>
                    </p>
                </div>
            </div>
        </section>
    </main>

    {{-- ===== Footer ===== --}}
    <footer id="footer">
        <div class="container">
            <div class="footer-brand">
                <span class="brand-icon" aria-hidden="true">🍽️</span>
                MenuCity
            </div>
            <p>Trabalho de Conclusão de Curso — {{ date('Y') }}</p>
            <div class="footer-tech">
                <span>Laravel</span>
                <span>PHP</span>
                <span>API REST</span>
                <span>Render</span>
            </div>
        </div>
    </footer>

    {{-- ===== Scripts ===== --}}
    <script>
        // Mobile menu toggle
        const menuToggle = document.getElementById('menu-toggle');
        const navbarLinks = document.getElementById('navbar-links');

        menuToggle.addEventListener('click', () => {
            const isOpen = navbarLinks.classList.toggle('active');
            menuToggle.setAttribute('aria-expanded', isOpen);
        });

        // Close menu on link click (mobile)
        navbarLinks.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                navbarLinks.classList.remove('active');
                menuToggle.setAttribute('aria-expanded', 'false');
            });
        });

        // Scroll reveal animation
        const revealElements = document.querySelectorAll('.reveal');

        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.15,
            rootMargin: '0px 0px -40px 0px'
        });

        revealElements.forEach(el => revealObserver.observe(el));

        // Navbar scroll effect
        let lastScrollY = 0;
        const navbar = document.getElementById('navbar');

        window.addEventListener('scroll', () => {
            const scrollY = window.scrollY;
            if (scrollY > 60) {
                navbar.style.borderBottomColor = 'rgba(255, 255, 255, 0.12)';
            } else {
                navbar.style.borderBottomColor = 'rgba(255, 255, 255, 0.08)';
            }
            lastScrollY = scrollY;
        }, { passive: true });
    </script>

</body>
</html>
