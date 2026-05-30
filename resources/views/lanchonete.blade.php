<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Burguer Street — Lanchonete Artesanal</title>
    <meta name="description" content="Burguer Street: hambúrgueres artesanais, hot dogs, porções e milkshakes. Peça pelo cardápio digital!">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@700;800;900&display=swap" rel="stylesheet">
    <style>
        /* ══════════ TOKENS ══════════ */
        :root {
            --bg:          #0c0a09;
            --bg-warm:     #1c1917;
            --bg-card:     #231f1c;
            --surface:     rgba(255,255,255,0.04);
            --surface-h:   rgba(255,255,255,0.08);
            --border:      rgba(255,255,255,0.07);
            --border-h:    rgba(255,255,255,0.14);

            --text:        #fafaf9;
            --text-sub:    #a8a29e;
            --text-muted:  #78716c;

            --brand:       #f97316;
            --brand-light: #fb923c;
            --brand-dark:  #ea580c;
            --yellow:      #facc15;
            --red:         #ef4444;
            --green:       #22c55e;

            --glow: 0 0 60px rgba(249,115,22,0.12);
            --r-sm:  8px;
            --r-md: 14px;
            --r-lg: 22px;
            --r-xl: 32px;
            --r-full: 999px;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.6;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: var(--bg); }
        ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 3px; }

        .container { width: min(1140px, 90%); margin: 0 auto; }

        img { display: block; max-width: 100%; }

        /* ══════════ NAV ══════════ */
        .nav {
            position: fixed; top: 0; left: 0; width: 100%; z-index: 100;
            padding: 1rem 0;
            transition: background .3s, padding .3s, box-shadow .3s;
        }
        .nav.scrolled {
            background: rgba(12,10,9,0.88);
            backdrop-filter: blur(18px) saturate(1.3);
            -webkit-backdrop-filter: blur(18px) saturate(1.3);
            padding: .6rem 0;
            box-shadow: 0 1px 0 var(--border);
        }
        .nav .container { display: flex; align-items: center; justify-content: space-between; }

        .nav-logo {
            text-decoration: none; color: var(--text);
            display: flex; align-items: center; gap: 10px;
        }
        .nav-logo-dot {
            width: 36px; height: 36px; border-radius: 10px;
            background: linear-gradient(135deg, var(--brand), var(--yellow));
            display: grid; place-items: center; font-size: 1.05rem;
            box-shadow: 0 4px 14px rgba(249,115,22,.3);
        }
        .nav-logo-name { font-weight: 800; font-size: 1.15rem; letter-spacing: -.02em; }
        .nav-logo-name em {
            font-style: normal;
            background: linear-gradient(135deg, var(--brand), var(--yellow));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-links { list-style: none; display: flex; align-items: center; gap: 1.8rem; }
        .nav-links a {
            color: var(--text-sub); text-decoration: none; font-size: .88rem; font-weight: 500;
            transition: color .2s; position: relative;
        }
        .nav-links a:hover { color: var(--text); }
        .nav-links a::after {
            content:''; position: absolute; bottom: -4px; left: 0;
            width: 0; height: 2px; border-radius: 1px;
            background: linear-gradient(90deg, var(--brand), var(--yellow));
            transition: width .25s;
        }
        .nav-links a:hover::after { width: 100%; }

        .nav-cta {
            padding: .5rem 1.3rem; border-radius: var(--r-full);
            background: linear-gradient(135deg, var(--brand), var(--brand-dark));
            color: #fff !important; font-weight: 600; font-size: .86rem;
            box-shadow: 0 4px 14px rgba(249,115,22,.28);
            transition: transform .15s, box-shadow .15s;
        }
        .nav-cta:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(249,115,22,.4); }
        .nav-cta::after { display: none !important; }

        .nav-mobile { display: none; background: none; border: none; color: var(--text); font-size: 1.5rem; cursor: pointer; }

        /* ══════════ HERO ══════════ */
        .hero {
            min-height: 100vh; display: flex; align-items: center;
            position: relative; overflow: hidden; padding: 7rem 0 5rem;
        }
        .hero::before {
            content:''; position: absolute; inset: 0;
            background:
                radial-gradient(ellipse 70% 60% at 70% 40%, rgba(249,115,22,.10) 0%, transparent 70%),
                radial-gradient(ellipse 50% 50% at 20% 80%, rgba(250,204,21,.06) 0%, transparent 70%);
            pointer-events: none;
        }

        .hero .container { display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: center; position: relative; z-index: 1; }

        .hero-content { animation: fadeUp .8s ease both; }
        @keyframes fadeUp { from { opacity:0; transform: translateY(28px); } to { opacity:1; transform: translateY(0); } }

        .hero-tag {
            display: inline-flex; align-items: center; gap: 8px;
            padding: .35rem .9rem; border-radius: var(--r-full);
            background: rgba(249,115,22,.1); border: 1px solid rgba(249,115,22,.2);
            font-size: .78rem; font-weight: 600; color: var(--brand-light);
            margin-bottom: 1.4rem;
        }
        .hero-tag .dot { width: 7px; height: 7px; border-radius: 50%; background: var(--green); animation: blink 2s ease-in-out infinite; }
        @keyframes blink { 0%,100%{ opacity:1; } 50%{ opacity:.4; } }

        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.6rem, 5.5vw, 4rem);
            font-weight: 900; line-height: 1.05; letter-spacing: -.02em;
            margin-bottom: 1.2rem;
        }
        .hero h1 .hl {
            background: linear-gradient(135deg, var(--brand), var(--yellow));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }

        .hero-desc { font-size: 1.08rem; color: var(--text-sub); max-width: 440px; margin-bottom: 2rem; line-height: 1.7; }

        .hero-btns { display: flex; gap: 1rem; flex-wrap: wrap; }
        .btn {
            display: inline-flex; align-items: center; gap: 8px;
            padding: .85rem 1.8rem; font-size: .95rem; font-weight: 600;
            font-family: inherit; border-radius: var(--r-full); border: none;
            cursor: pointer; text-decoration: none; transition: all .25s;
        }
        .btn-brand {
            background: linear-gradient(135deg, var(--brand), var(--brand-dark));
            color: #fff; box-shadow: 0 8px 24px rgba(249,115,22,.3);
        }
        .btn-brand:hover { transform: translateY(-2px); box-shadow: 0 12px 32px rgba(249,115,22,.4); }
        .btn-ghost { background: var(--surface); color: var(--text); border: 1px solid var(--border); }
        .btn-ghost:hover { background: var(--surface-h); border-color: var(--border-h); transform: translateY(-2px); }

        /* Hero image side */
        .hero-visual { position: relative; display: flex; justify-content: center; animation: fadeUp .8s .25s ease both; }

        .hero-img-wrapper {
            width: 420px; height: 420px; border-radius: 50%;
            background: radial-gradient(circle, rgba(249,115,22,.12) 0%, transparent 70%);
            display: grid; place-items: center; position: relative;
        }
        .hero-img-wrapper::before {
            content:''; position: absolute; inset: -8px;
            border-radius: 50%; border: 2px dashed rgba(249,115,22,.15);
            animation: spin 40s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        .hero-burger-img {
            width: 320px; height: 320px; border-radius: 50%; object-fit: cover;
            box-shadow: 0 20px 60px rgba(0,0,0,.5), var(--glow);
            animation: floaty 4s ease-in-out infinite;
        }
        @keyframes floaty { 0%,100%{ transform: translateY(0); } 50%{ transform: translateY(-14px); } }

        /* Floating badges */
        .float-badge {
            position: absolute; padding: .5rem .9rem; border-radius: var(--r-md);
            background: rgba(28,25,23,.85); backdrop-filter: blur(12px);
            border: 1px solid var(--border); font-size: .78rem; font-weight: 600;
            display: flex; align-items: center; gap: 6px;
            animation: fadeUp .8s .5s ease both;
        }
        .float-badge.top-right { top: 30px; right: -10px; }
        .float-badge.bottom-left { bottom: 40px; left: -20px; }
        .float-badge .val { color: var(--yellow); }

        .hero-stats {
            display: flex; gap: 2.5rem; margin-top: 2.5rem;
            padding-top: 2rem; border-top: 1px solid var(--border);
        }
        .hero-stat-val {
            font-size: 1.6rem; font-weight: 800;
            background: linear-gradient(135deg, var(--brand), var(--yellow));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }
        .hero-stat-lbl { font-size: .78rem; color: var(--text-muted); font-weight: 500; }

        /* ══════════ MARQUEE ══════════ */
        .marquee-strip {
            padding: 1rem 0; border-top: 1px solid var(--border); border-bottom: 1px solid var(--border);
            overflow: hidden; position: relative;
            background: var(--bg-warm);
        }
        .marquee-track {
            display: flex; width: max-content;
            animation: marquee 30s linear infinite;
        }
        @keyframes marquee { to { transform: translateX(-50%); } }
        .marquee-item {
            flex-shrink: 0; padding: 0 2rem;
            font-size: .85rem; font-weight: 600; color: var(--text-muted);
            text-transform: uppercase; letter-spacing: .06em;
            display: flex; align-items: center; gap: 8px;
        }
        .marquee-item .sep { color: var(--brand); }

        /* ══════════ SECTION COMMON ══════════ */
        .section-label {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: .76rem; font-weight: 700; letter-spacing: .08em;
            text-transform: uppercase; color: var(--brand);
            margin-bottom: .6rem;
        }
        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.8rem, 4vw, 2.6rem);
            font-weight: 800; line-height: 1.12; margin-bottom: .5rem;
        }
        .section-desc { font-size: 1rem; color: var(--text-sub); max-width: 500px; }

        /* ══════════ MENU ══════════ */
        .menu-section { padding: 5rem 0; }
        .menu-header { text-align: center; margin-bottom: 2rem; }
        .menu-header .section-desc { margin: 0 auto; }

        /* Category tabs */
        .menu-tabs {
            display: flex; justify-content: center; gap: .6rem; flex-wrap: wrap;
            margin-bottom: 2.5rem;
        }
        .menu-tab {
            padding: .5rem 1.2rem; border-radius: var(--r-full);
            background: var(--surface); border: 1px solid var(--border);
            color: var(--text-sub); font-size: .85rem; font-weight: 600;
            cursor: pointer; transition: all .2s; font-family: inherit;
        }
        .menu-tab:hover { background: var(--surface-h); border-color: var(--border-h); color: var(--text); }
        .menu-tab.active {
            background: linear-gradient(135deg, var(--brand), var(--brand-dark));
            border-color: transparent; color: #fff;
            box-shadow: 0 4px 14px rgba(249,115,22,.25);
        }

        /* Menu grid */
        .menu-grid {
            display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.2rem;
        }

        .menu-card {
            background: var(--bg-card); border: 1px solid var(--border);
            border-radius: var(--r-lg); overflow: hidden;
            display: flex; transition: all .35s cubic-bezier(.16,1,.3,1);
            cursor: pointer; position: relative;
        }
        .menu-card:hover {
            border-color: var(--border-h); transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(0,0,0,.3);
        }

        .menu-card-img {
            width: 130px; min-height: 130px; flex-shrink: 0; overflow: hidden;
        }
        .menu-card-img img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform .4s;
        }
        .menu-card:hover .menu-card-img img { transform: scale(1.08); }

        .menu-card-body { padding: 1rem 1.1rem; flex: 1; display: flex; flex-direction: column; }
        .menu-card-cat {
            font-size: .68rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: .05em; color: var(--brand-light); margin-bottom: .25rem;
        }
        .menu-card-name { font-size: 1rem; font-weight: 700; margin-bottom: .25rem; }
        .menu-card-desc { font-size: .8rem; color: var(--text-muted); line-height: 1.5; flex: 1; }
        .menu-card-footer { display: flex; justify-content: space-between; align-items: center; margin-top: .7rem; padding-top: .6rem; border-top: 1px solid var(--border); }
        .menu-card-price { font-size: 1.1rem; font-weight: 800; color: var(--brand); }
        .menu-card-badge {
            padding: 3px 10px; border-radius: var(--r-full);
            font-size: .68rem; font-weight: 700;
            background: rgba(249,115,22,.1); color: var(--brand-light);
            border: 1px solid rgba(249,115,22,.15);
        }
        .menu-card-badge.popular { background: rgba(250,204,21,.1); color: var(--yellow); border-color: rgba(250,204,21,.15); }

        /* ══════════ ABOUT / INFO ══════════ */
        .info-section { padding: 5rem 0; background: var(--bg-warm); border-top: 1px solid var(--border); border-bottom: 1px solid var(--border); }
        .info-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem; margin-top: 2.5rem; }

        .info-card {
            background: var(--bg-card); border: 1px solid var(--border);
            border-radius: var(--r-lg); padding: 1.5rem;
            text-align: center; transition: all .3s;
        }
        .info-card:hover { border-color: rgba(249,115,22,.25); transform: translateY(-3px); box-shadow: 0 8px 25px rgba(0,0,0,.25); }
        .info-card-icon { font-size: 2rem; margin-bottom: .7rem; }
        .info-card h3 { font-size: 1rem; font-weight: 700; margin-bottom: .3rem; }
        .info-card p { font-size: .85rem; color: var(--text-muted); }

        /* ══════════ TESTIMONIALS ══════════ */
        .reviews-section { padding: 5rem 0; }
        .reviews-header { text-align: center; margin-bottom: 2.5rem; }
        .reviews-header .section-desc { margin: 0 auto; }

        .reviews-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.2rem; }

        .review-card {
            background: var(--bg-card); border: 1px solid var(--border);
            border-radius: var(--r-lg); padding: 1.5rem;
            transition: all .3s;
        }
        .review-card:hover { border-color: var(--border-h); transform: translateY(-2px); }
        .review-stars { color: var(--yellow); font-size: .9rem; letter-spacing: 2px; margin-bottom: .7rem; }
        .review-text { font-size: .92rem; color: var(--text-sub); line-height: 1.6; margin-bottom: 1rem; font-style: italic; }
        .review-author { display: flex; align-items: center; gap: .7rem; }
        .review-avatar {
            width: 40px; height: 40px; border-radius: 50%;
            background: linear-gradient(135deg, var(--brand), var(--yellow));
            display: grid; place-items: center; font-size: .85rem; font-weight: 700; color: #fff;
        }
        .review-name { font-size: .88rem; font-weight: 600; }
        .review-date { font-size: .75rem; color: var(--text-muted); }

        /* ══════════ CTA ══════════ */
        .cta-section {
            padding: 5rem 0; text-align: center; position: relative; overflow: hidden;
        }
        .cta-section::before {
            content:''; position: absolute; inset: 0;
            background: radial-gradient(ellipse 60% 80% at 50% 50%, rgba(249,115,22,.08) 0%, transparent 70%);
        }
        .cta-content { position: relative; z-index: 1; }
        .cta-content h2 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.8rem, 4vw, 2.8rem); font-weight: 900;
            margin-bottom: .8rem;
        }
        .cta-content p { color: var(--text-sub); font-size: 1.05rem; margin-bottom: 2rem; max-width: 480px; margin-left: auto; margin-right: auto; }

        /* ══════════ FOOTER ══════════ */
        .footer {
            padding: 2.5rem 0; border-top: 1px solid var(--border);
        }
        .footer .container { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; }
        .footer-copy { font-size: .82rem; color: var(--text-muted); }
        .footer-links { display: flex; gap: 1.5rem; }
        .footer-links a { color: var(--text-muted); text-decoration: none; font-size: .82rem; transition: color .2s; }
        .footer-links a:hover { color: var(--text); }
        .footer-powered { font-size: .75rem; color: var(--text-muted); }
        .footer-powered a { color: var(--brand-light); text-decoration: none; }

        /* ══════════ RESPONSIVE ══════════ */
        @media (max-width: 768px) {
            .hero .container { grid-template-columns: 1fr; text-content: center; }
            .hero-content { text-align: center; }
            .hero-desc { margin: 0 auto 2rem; }
            .hero-btns { justify-content: center; }
            .hero-stats { justify-content: center; }
            .hero-visual { order: -1; }
            .hero-img-wrapper { width: 280px; height: 280px; }
            .hero-burger-img { width: 220px; height: 220px; }
            .float-badge { display: none; }
            .nav-links { display: none; }
            .nav-mobile { display: block; }
            .menu-grid { grid-template-columns: 1fr; }
            .menu-card-img { width: 110px; min-height: 110px; }
        }
    </style>
</head>
<body>

    <!-- NAV -->
    <nav class="nav" id="navbar">
        <div class="container">
            <a href="#" class="nav-logo">
                <div class="nav-logo-dot">🍔</div>
                <div class="nav-logo-name">Burguer<em>Street</em></div>
            </a>
            <ul class="nav-links">
                <li><a href="#cardapio">Cardápio</a></li>
                <li><a href="#sobre">Sobre</a></li>
                <li><a href="#avaliacoes">Avaliações</a></li>
                <li><a href="#cardapio" class="nav-cta">🔥 Pedir Agora</a></li>
            </ul>
            <button class="nav-mobile" id="navMobile" aria-label="Menu">☰</button>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-tag">
                    <span class="dot"></span>
                    Aberto agora — até 23h
                </div>
                <h1>Hambúrguer<br>artesanal de <span class="hl">verdade.</span></h1>
                <p class="hero-desc">
                    Pão brioche quentinho, carne 180g na brasa, queijo derretido e molhos autorais.
                    O melhor smash burguer da cidade!
                </p>
                <div class="hero-btns">
                    <a href="#cardapio" class="btn btn-brand">🔥 Ver Cardápio</a>
                    <a href="#sobre" class="btn btn-ghost">📍 Localização</a>
                </div>
                <div class="hero-stats">
                    <div>
                        <div class="hero-stat-val">4.9</div>
                        <div class="hero-stat-lbl">Avaliação</div>
                    </div>
                    <div>
                        <div class="hero-stat-val">2k+</div>
                        <div class="hero-stat-lbl">Pedidos/mês</div>
                    </div>
                    <div>
                        <div class="hero-stat-val">30'</div>
                        <div class="hero-stat-lbl">Tempo médio</div>
                    </div>
                </div>
            </div>

            <div class="hero-visual">
                <div class="hero-img-wrapper">
                    <img class="hero-burger-img"
                         src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=500&h=500&fit=crop"
                         alt="Hambúrguer artesanal suculento">
                    <div class="float-badge top-right">
                        ⭐ <span class="val">Mais vendido</span>
                    </div>
                    <div class="float-badge bottom-left">
                        🔥 <span class="val">+ 120 hoje</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- MARQUEE -->
    <div class="marquee-strip">
        <div class="marquee-track">
            <span class="marquee-item">🍔 Smash Burguer <span class="sep">✦</span></span>
            <span class="marquee-item">🌭 Hot Dog Especial <span class="sep">✦</span></span>
            <span class="marquee-item">🍟 Batata Rústica <span class="sep">✦</span></span>
            <span class="marquee-item">🧀 Onion Rings <span class="sep">✦</span></span>
            <span class="marquee-item">🥤 Milkshake Artesanal <span class="sep">✦</span></span>
            <span class="marquee-item">🍗 Nuggets Crocantes <span class="sep">✦</span></span>
            <span class="marquee-item">🥓 Bacon Crispy <span class="sep">✦</span></span>
            <span class="marquee-item">🍔 Smash Burguer <span class="sep">✦</span></span>
            <span class="marquee-item">🌭 Hot Dog Especial <span class="sep">✦</span></span>
            <span class="marquee-item">🍟 Batata Rústica <span class="sep">✦</span></span>
            <span class="marquee-item">🧀 Onion Rings <span class="sep">✦</span></span>
            <span class="marquee-item">🥤 Milkshake Artesanal <span class="sep">✦</span></span>
            <span class="marquee-item">🍗 Nuggets Crocantes <span class="sep">✦</span></span>
            <span class="marquee-item">🥓 Bacon Crispy <span class="sep">✦</span></span>
        </div>
    </div>

    <!-- CARDÁPIO -->
    <section class="menu-section" id="cardapio">
        <div class="container">
            <div class="menu-header">
                <div class="section-label">🍽️ Nosso Cardápio</div>
                <h2 class="section-title">Feito com amor (e fogo)</h2>
                <p class="section-desc">Ingredientes frescos, receitas artesanais e aquele sabor que só a gente tem.</p>
            </div>

            <div class="menu-tabs" id="menuTabs">
                <button class="menu-tab active" data-cat="todos">🍽️ Todos</button>
                <button class="menu-tab" data-cat="burguers">🍔 Burguers</button>
                <button class="menu-tab" data-cat="hotdogs">🌭 Hot Dogs</button>
                <button class="menu-tab" data-cat="porcoes">🍟 Porções</button>
                <button class="menu-tab" data-cat="bebidas">🥤 Bebidas</button>
                <button class="menu-tab" data-cat="sobremesas">🍦 Sobremesas</button>
            </div>

            <div class="menu-grid" id="menuGrid"></div>
        </div>
    </section>

    <!-- INFO -->
    <section class="info-section" id="sobre">
        <div class="container">
            <div style="text-align:center;">
                <div class="section-label">📍 Sobre nós</div>
                <h2 class="section-title">Mais que uma lanchonete</h2>
                <p class="section-desc" style="margin: 0 auto;">Desde 2022 servindo os melhores hambúrgueres artesanais da cidade com ingredientes selecionados.</p>
            </div>
            <div class="info-grid">
                <div class="info-card">
                    <div class="info-card-icon">📍</div>
                    <h3>Localização</h3>
                    <p>Rua das Flores, 456 — Centro<br>São Paulo, SP</p>
                </div>
                <div class="info-card">
                    <div class="info-card-icon">🕐</div>
                    <h3>Horário</h3>
                    <p>Ter a Dom: 18h – 23h<br>Segunda: Fechado</p>
                </div>
                <div class="info-card">
                    <div class="info-card-icon">📞</div>
                    <h3>Contato</h3>
                    <p>(11) 99999-0000<br>@burguerstreet</p>
                </div>
                <div class="info-card">
                    <div class="info-card-icon">🛵</div>
                    <h3>Delivery</h3>
                    <p>iFood • Rappi • Uber Eats<br>Frete grátis até 3km</p>
                </div>
            </div>
        </div>
    </section>

    <!-- AVALIAÇÕES -->
    <section class="reviews-section" id="avaliacoes">
        <div class="container">
            <div class="reviews-header">
                <div class="section-label">⭐ Avaliações</div>
                <h2 class="section-title">O que dizem os clientes</h2>
                <p class="section-desc">Mais de 500 avaliações 5 estrelas. Confira o que estão falando!</p>
            </div>
            <div class="reviews-grid">
                <div class="review-card">
                    <div class="review-stars">★★★★★</div>
                    <div class="review-text">"Melhor smash burguer que já comi! Carne suculenta, pão macio e o molho da casa é incrível. Voltarei com certeza!"</div>
                    <div class="review-author">
                        <div class="review-avatar">MC</div>
                        <div>
                            <div class="review-name">Marina Costa</div>
                            <div class="review-date">Há 3 dias</div>
                        </div>
                    </div>
                </div>
                <div class="review-card">
                    <div class="review-stars">★★★★★</div>
                    <div class="review-text">"Pedi o combo família no delivery e chegou tudo quentinho em 25 minutos. Os onion rings estavam perfeitamente crocantes!"</div>
                    <div class="review-author">
                        <div class="review-avatar">RF</div>
                        <div>
                            <div class="review-name">Rafael Ferreira</div>
                            <div class="review-date">Há 1 semana</div>
                        </div>
                    </div>
                </div>
                <div class="review-card">
                    <div class="review-stars">★★★★★</div>
                    <div class="review-text">"O milkshake de Nutella é surreal! Ambiente super aconchegante e o atendimento é nota 10. Minha lanchonete favorita."</div>
                    <div class="review-author">
                        <div class="review-avatar">JS</div>
                        <div>
                            <div class="review-name">Julia Santos</div>
                            <div class="review-date">Há 2 semanas</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>Bateu a <span style="background: linear-gradient(135deg, var(--brand), var(--yellow)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">fome?</span></h2>
                <p>Explore nosso cardápio completo e peça agora pelo delivery ou venha nos visitar!</p>
                <a href="#cardapio" class="btn btn-brand">🍔 Ver Cardápio Completo</a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">
            <div class="footer-copy">© 2026 BurguerStreet — Todos os direitos reservados</div>
            <div class="footer-links">
                <a href="#cardapio">Cardápio</a>
                <a href="#sobre">Sobre</a>
                <a href="#avaliacoes">Avaliações</a>
            </div>
            <div class="footer-powered">
                Powered by <a href="/">MenuCity</a>
            </div>
        </div>
    </footer>

    <script>
    (function() {
        'use strict';

        // ===== MENU DATA =====
        const itens = [
            // Burguers
            { id: 1,  nome: 'Smash Classic',        desc: 'Pão brioche, 2x carne 90g, queijo cheddar, cebola caramelizada e molho da casa.',          preco: 28.90, cat: 'burguers',    img: 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=300&h=300&fit=crop', badge: 'Mais Vendido', badgeType: 'popular' },
            { id: 2,  nome: 'Bacon Lovers',          desc: 'Pão australiano, carne 180g, bacon crispy, cheddar, alface e maionese defumada.',          preco: 34.90, cat: 'burguers',    img: 'https://images.unsplash.com/photo-1553979459-d2229ba7433b?w=300&h=300&fit=crop', badge: '🔥 Picante' },
            { id: 3,  nome: 'Duplo Cheddar',         desc: 'Pão brioche, 2x carne 120g, duplo cheddar derretido, picles e ketchup artesanal.',         preco: 36.90, cat: 'burguers',    img: 'https://images.unsplash.com/photo-1572802419224-296b0aeee0d9?w=300&h=300&fit=crop', badge: 'Novidade' },
            { id: 4,  nome: 'Veggie Burguer',        desc: 'Pão integral, hambúrguer de grão-de-bico, rúcula, tomate seco e molho tahine.',            preco: 29.90, cat: 'burguers',    img: 'https://images.unsplash.com/photo-1525059696034-4967a8e1dca2?w=300&h=300&fit=crop', badge: '🌱 Vegano' },
            // Hot Dogs
            { id: 5,  nome: 'Hot Dog Tradicional',   desc: 'Pão de hot dog, salsicha defumada, mostarda, ketchup, batata palha e milho.',              preco: 18.90, cat: 'hotdogs',     img: 'https://images.unsplash.com/photo-1612392062126-2f5b0ced0bce?w=300&h=300&fit=crop' },
            { id: 6,  nome: 'Hot Dog Texano',        desc: 'Pão tostado, linguiça artesanal, chili com carne, cheddar e jalapeño.',                    preco: 24.90, cat: 'hotdogs',     img: 'https://images.unsplash.com/photo-1619740455993-9d701c9c42ad?w=300&h=300&fit=crop', badge: '🔥 Picante' },
            // Porções
            { id: 7,  nome: 'Batata Rústica',        desc: 'Batatas cortadas com casca, temperadas e fritas até ficarem crocantes. Servidas com molho.', preco: 22.90, cat: 'porcoes', img: 'https://images.unsplash.com/photo-1573080496219-bb080dd4f877?w=300&h=300&fit=crop' },
            { id: 8,  nome: 'Onion Rings',           desc: 'Anéis de cebola empanados em farinha panko, crocantes por fora e macios por dentro.',       preco: 19.90, cat: 'porcoes',     img: 'https://images.unsplash.com/photo-1639024471283-03518883512d?w=300&h=300&fit=crop', badge: 'Mais Vendido', badgeType: 'popular' },
            { id: 9,  nome: 'Nuggets Artesanais',    desc: '10 nuggets de frango feitos à mão com tempero especial. Acompanha 2 molhos.',               preco: 24.90, cat: 'porcoes',     img: 'https://images.unsplash.com/photo-1562967914-608f82629710?w=300&h=300&fit=crop' },
            // Bebidas
            { id: 10, nome: 'Milkshake Nutella',     desc: 'Milkshake cremoso de Nutella com chantilly, calda de chocolate e wafer.',                   preco: 19.90, cat: 'bebidas',     img: 'https://images.unsplash.com/photo-1572490122747-3968b75cc699?w=300&h=300&fit=crop', badge: 'Mais Vendido', badgeType: 'popular' },
            { id: 11, nome: 'Suco Natural Laranja',  desc: 'Suco de laranja 100% natural, sem açúcar. Copo 400ml.',                                    preco: 10.90, cat: 'bebidas',     img: 'https://images.unsplash.com/photo-1621506289937-a8e4df240d0b?w=300&h=300&fit=crop' },
            { id: 12, nome: 'Refrigerante Lata',     desc: 'Coca-Cola, Guaraná Antarctica ou Fanta Laranja. 350ml.',                                   preco: 7.90,  cat: 'bebidas',     img: 'https://images.unsplash.com/photo-1629203851122-3726ecdf080e?w=300&h=300&fit=crop' },
            // Sobremesas
            { id: 13, nome: 'Brownie com Sorvete',   desc: 'Brownie quentinho de chocolate belga com uma bola de sorvete de creme e calda.',            preco: 22.90, cat: 'sobremesas',  img: 'https://images.unsplash.com/photo-1564355808539-22fda35bed7e?w=300&h=300&fit=crop' },
            { id: 14, nome: 'Churros Recheados',     desc: '3 churros artesanais recheados com doce de leite e cobertura de chocolate.',                preco: 16.90, cat: 'sobremesas',  img: 'https://images.unsplash.com/photo-1624371414361-e670cc55b8e2?w=300&h=300&fit=crop' },
        ];

        let activeTab = 'todos';

        // ===== RENDER MENU =====
        function renderMenu() {
            const grid = document.getElementById('menuGrid');
            const filtered = activeTab === 'todos' ? itens : itens.filter(i => i.cat === activeTab);

            grid.innerHTML = filtered.map(item => `
                <div class="menu-card">
                    <div class="menu-card-img">
                        <img src="${item.img}" alt="${item.nome}" loading="lazy">
                    </div>
                    <div class="menu-card-body">
                        <div class="menu-card-cat">${catLabel(item.cat)}</div>
                        <div class="menu-card-name">${item.nome}</div>
                        <div class="menu-card-desc">${item.desc}</div>
                        <div class="menu-card-footer">
                            <div class="menu-card-price">R$ ${item.preco.toFixed(2).replace('.', ',')}</div>
                            ${item.badge ? `<span class="menu-card-badge ${item.badgeType || ''}">${item.badge}</span>` : ''}
                        </div>
                    </div>
                </div>
            `).join('');
        }

        function catLabel(cat) {
            const map = { burguers:'Burguer', hotdogs:'Hot Dog', porcoes:'Porção', bebidas:'Bebida', sobremesas:'Sobremesa' };
            return map[cat] || cat;
        }

        // ===== TABS =====
        document.getElementById('menuTabs').addEventListener('click', (e) => {
            const tab = e.target.closest('.menu-tab');
            if (!tab) return;
            activeTab = tab.dataset.cat;
            document.querySelectorAll('.menu-tab').forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            renderMenu();
        });

        // ===== NAVBAR SCROLL =====
        let ticking = false;
        window.addEventListener('scroll', () => {
            if (!ticking) {
                requestAnimationFrame(() => {
                    document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 40);
                    ticking = false;
                });
                ticking = true;
            }
        });

        // ===== MOBILE NAV =====
        document.getElementById('navMobile').addEventListener('click', () => {
            const links = document.querySelector('.nav-links');
            const visible = links.style.display === 'flex';
            links.style.display = visible ? 'none' : 'flex';
            if (!visible) {
                links.style.flexDirection = 'column';
                links.style.position = 'absolute';
                links.style.top = '100%';
                links.style.left = '0';
                links.style.right = '0';
                links.style.background = 'rgba(12,10,9,.95)';
                links.style.backdropFilter = 'blur(20px)';
                links.style.padding = '1rem 5%';
                links.style.borderBottom = '1px solid var(--border)';
            }
        });

        // ===== SCROLL REVEAL =====
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.menu-card, .info-card, .review-card').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity .5s ease, transform .5s ease';
            observer.observe(el);
        });

        // ===== INIT =====
        renderMenu();

        // Re-observe after render
        setTimeout(() => {
            document.querySelectorAll('.menu-card').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                el.style.transition = 'opacity .5s ease, transform .5s ease';
                observer.observe(el);
            });
        }, 100);

    })();
    </script>
</body>
</html>
