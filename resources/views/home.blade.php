<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MenuCity — Encontre Restaurantes e Cardápios Digitais</title>
    <meta name="description" content="MenuCity: localize restaurantes próximos e visualize cardápios digitais completos. Descubra sabores na sua cidade.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        /* ===== RESET & TOKENS ===== */
        :root {
            --bg-primary: #0f0f12;
            --bg-secondary: #1a1a22;
            --bg-card: #22222e;
            --bg-card-hover: #2a2a38;
            --surface: rgba(255, 255, 255, 0.04);
            --surface-hover: rgba(255, 255, 255, 0.08);
            --border: rgba(255, 255, 255, 0.08);
            --border-hover: rgba(255, 255, 255, 0.15);

            --text-primary: #f1f1f4;
            --text-secondary: #9d9db5;
            --text-muted: #6b6b82;

            --orange-400: #fb923c;
            --orange-500: #f97316;
            --orange-600: #ea580c;
            --amber-400: #fbbf24;
            --amber-500: #f59e0b;
            --red-500: #ef4444;
            --green-400: #4ade80;
            --green-500: #22c55e;
            --emerald-400: #34d399;

            --gradient-brand: linear-gradient(135deg, #f97316, #f59e0b);
            --gradient-hero: linear-gradient(160deg, #1a1020 0%, #0f0f12 30%, #0f1218 70%, #0f0f12 100%);
            --gradient-card: linear-gradient(145deg, rgba(255,255,255,0.05) 0%, rgba(255,255,255,0.01) 100%);

            --shadow-sm: 0 2px 8px rgba(0,0,0,0.3);
            --shadow-md: 0 8px 30px rgba(0,0,0,0.4);
            --shadow-lg: 0 20px 60px rgba(0,0,0,0.5);
            --shadow-glow: 0 0 40px rgba(249,115,22,0.15);

            --radius-sm: 8px;
            --radius-md: 14px;
            --radius-lg: 20px;
            --radius-xl: 28px;
            --radius-full: 999px;

            --transition-fast: 0.15s ease;
            --transition-base: 0.25s ease;
            --transition-slow: 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            line-height: 1.6;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--bg-primary); }
        ::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.12);
            border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.2); }

        /* ===== UTILITIES ===== */
        .container {
            width: min(1200px, 90%);
            margin: 0 auto;
        }

        .section-label {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--orange-500);
            margin-bottom: 0.6rem;
        }

        .section-title {
            font-size: clamp(1.7rem, 4vw, 2.5rem);
            font-weight: 800;
            line-height: 1.15;
            margin-bottom: 0.6rem;
        }

        .section-subtitle {
            font-size: 1.05rem;
            color: var(--text-secondary);
            max-width: 540px;
        }

        /* ===== NAVBAR ===== */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            padding: 1rem 0;
            transition: background var(--transition-base), box-shadow var(--transition-base), padding var(--transition-base);
        }

        .navbar.scrolled {
            background: rgba(15, 15, 18, 0.85);
            backdrop-filter: blur(20px) saturate(1.2);
            -webkit-backdrop-filter: blur(20px) saturate(1.2);
            box-shadow: 0 1px 0 var(--border);
            padding: 0.65rem 0;
        }

        .navbar .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: var(--text-primary);
        }

        .logo-icon {
            width: 38px;
            height: 38px;
            background: var(--gradient-brand);
            border-radius: 10px;
            display: grid;
            place-items: center;
            font-size: 1.15rem;
            box-shadow: 0 4px 15px rgba(249,115,22,0.3);
        }

        .logo-text {
            font-weight: 800;
            font-size: 1.25rem;
            letter-spacing: -0.02em;
        }

        .logo-text span {
            background: var(--gradient-brand);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: color var(--transition-fast);
            position: relative;
        }

        .nav-links a:hover {
            color: var(--text-primary);
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--gradient-brand);
            border-radius: 1px;
            transition: width var(--transition-base);
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .nav-cta {
            padding: 0.5rem 1.2rem;
            background: var(--gradient-brand);
            color: #fff !important;
            border-radius: var(--radius-full);
            font-weight: 600;
            font-size: 0.88rem;
            box-shadow: 0 4px 15px rgba(249,115,22,0.25);
            transition: transform var(--transition-fast), box-shadow var(--transition-fast);
        }

        .nav-cta:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(249,115,22,0.35);
        }

        .nav-cta::after { display: none !important; }

        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--text-primary);
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* ===== HERO ===== */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: var(--gradient-hero);
            position: relative;
            overflow: hidden;
            padding: 6rem 0 4rem;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -30%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(249,115,22,0.08) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 8s ease-in-out infinite;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: -20%;
            left: -5%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(245,158,11,0.06) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 10s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-30px) scale(1.05); }
        }

        .hero .container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .hero-content {
            animation: slideUp 0.8s ease forwards;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0.4rem 1rem;
            background: rgba(249,115,22,0.1);
            border: 1px solid rgba(249,115,22,0.2);
            border-radius: var(--radius-full);
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--orange-400);
            margin-bottom: 1.5rem;
        }

        .hero-badge .pulse {
            width: 8px;
            height: 8px;
            background: var(--green-400);
            border-radius: 50%;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; box-shadow: 0 0 0 0 rgba(74,222,128,0.4); }
            50% { opacity: 0.8; box-shadow: 0 0 0 8px rgba(74,222,128,0); }
        }

        .hero h1 {
            font-size: clamp(2.4rem, 5.5vw, 3.8rem);
            font-weight: 900;
            line-height: 1.08;
            letter-spacing: -0.03em;
            margin-bottom: 1.2rem;
        }

        .hero h1 .gradient {
            background: var(--gradient-brand);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-desc {
            font-size: 1.1rem;
            color: var(--text-secondary);
            line-height: 1.7;
            max-width: 480px;
            margin-bottom: 2rem;
        }

        .hero-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0.85rem 1.8rem;
            font-size: 0.95rem;
            font-weight: 600;
            font-family: inherit;
            border-radius: var(--radius-full);
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: all var(--transition-base);
        }

        .btn-primary {
            background: var(--gradient-brand);
            color: #fff;
            box-shadow: 0 8px 25px rgba(249,115,22,0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(249,115,22,0.4);
        }

        .btn-secondary {
            background: var(--surface);
            color: var(--text-primary);
            border: 1px solid var(--border);
        }

        .btn-secondary:hover {
            background: var(--surface-hover);
            border-color: var(--border-hover);
            transform: translateY(-2px);
        }

        /* Hero Visual (right side) */
        .hero-visual {
            position: relative;
            display: flex;
            justify-content: center;
            animation: slideUp 0.8s 0.2s ease both;
        }

        .hero-phone {
            width: 300px;
            height: 580px;
            background: var(--bg-card);
            border-radius: 36px;
            border: 2px solid var(--border);
            box-shadow: var(--shadow-lg), var(--shadow-glow);
            overflow: hidden;
            position: relative;
        }

        .phone-notch {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 120px;
            height: 28px;
            background: var(--bg-primary);
            border-radius: 0 0 18px 18px;
            z-index: 2;
        }

        .phone-screen {
            padding: 40px 16px 16px;
            height: 100%;
            overflow: hidden;
        }

        .phone-header {
            text-align: center;
            margin-bottom: 16px;
        }

        .phone-header h3 {
            font-size: 1rem;
            font-weight: 700;
        }

        .phone-header p {
            font-size: 0.72rem;
            color: var(--text-muted);
        }

        .phone-search {
            background: rgba(255,255,255,0.05);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 8px 12px;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 16px;
        }

        .phone-search span {
            font-size: 0.78rem;
            color: var(--text-muted);
        }

        .phone-categories {
            display: flex;
            gap: 8px;
            margin-bottom: 16px;
            overflow: hidden;
        }

        .phone-cat {
            flex-shrink: 0;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
            background: rgba(255,255,255,0.05);
            border: 1px solid var(--border);
            color: var(--text-secondary);
        }

        .phone-cat.active {
            background: var(--gradient-brand);
            border-color: transparent;
            color: #fff;
        }

        .phone-restaurant {
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 12px;
            margin-bottom: 10px;
            transition: border-color var(--transition-fast);
        }

        .phone-restaurant:first-of-type {
            border-color: rgba(249,115,22,0.3);
        }

        .phone-rest-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 6px;
        }

        .phone-rest-name {
            font-size: 0.82rem;
            font-weight: 700;
        }

        .phone-rest-rating {
            font-size: 0.72rem;
            color: var(--amber-400);
            font-weight: 600;
        }

        .phone-rest-info {
            font-size: 0.68rem;
            color: var(--text-muted);
        }

        .phone-rest-tags {
            display: flex;
            gap: 5px;
            margin-top: 6px;
        }

        .phone-rest-tag {
            font-size: 0.62rem;
            padding: 2px 7px;
            border-radius: 4px;
            background: rgba(249,115,22,0.1);
            color: var(--orange-400);
            font-weight: 500;
        }

        .phone-rest-tag.open {
            background: rgba(34,197,94,0.1);
            color: var(--green-400);
        }

        /* Stats strip */
        .hero-stats {
            display: flex;
            gap: 2rem;
            margin-top: 2.5rem;
            padding-top: 2rem;
            border-top: 1px solid var(--border);
        }

        .stat-item {
            text-align: left;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 800;
            background: var(--gradient-brand);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-label {
            font-size: 0.8rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* ===== CATEGORIES ===== */
        .categories {
            padding: 5rem 0;
            position: relative;
        }

        .categories-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .categories-header .section-subtitle {
            margin: 0 auto;
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1rem;
        }

        .category-card {
            background: var(--gradient-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 1.4rem;
            text-align: center;
            cursor: pointer;
            transition: all var(--transition-base);
            position: relative;
            overflow: hidden;
        }

        .category-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(249,115,22,0.08), transparent);
            opacity: 0;
            transition: opacity var(--transition-base);
        }

        .category-card:hover::before {
            opacity: 1;
        }

        .category-card:hover {
            border-color: rgba(249,115,22,0.3);
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(249,115,22,0.1);
        }

        .category-card.active {
            border-color: rgba(249,115,22,0.5);
            background: rgba(249,115,22,0.06);
        }

        .category-icon {
            font-size: 2.2rem;
            margin-bottom: 0.6rem;
            display: block;
            position: relative;
            z-index: 1;
        }

        .category-name {
            font-weight: 600;
            font-size: 0.92rem;
            margin-bottom: 0.3rem;
            position: relative;
            z-index: 1;
        }

        .category-count {
            font-size: 0.78rem;
            color: var(--text-muted);
            position: relative;
            z-index: 1;
        }

        /* ===== RESTAURANTS ===== */
        .restaurants {
            padding: 3rem 0 5rem;
        }

        .restaurants-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .search-bar {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-full);
            padding: 0.55rem 1.2rem;
            min-width: 280px;
            transition: border-color var(--transition-base), box-shadow var(--transition-base);
        }

        .search-bar:focus-within {
            border-color: rgba(249,115,22,0.4);
            box-shadow: 0 0 0 3px rgba(249,115,22,0.1);
        }

        .search-bar svg {
            flex-shrink: 0;
            color: var(--text-muted);
        }

        .search-bar input {
            border: none;
            background: none;
            color: var(--text-primary);
            font-size: 0.9rem;
            font-family: inherit;
            outline: none;
            width: 100%;
        }

        .search-bar input::placeholder {
            color: var(--text-muted);
        }

        .restaurants-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 1.2rem;
        }

        .restaurant-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
            cursor: pointer;
            transition: all var(--transition-slow);
            position: relative;
        }

        .restaurant-card:hover {
            border-color: var(--border-hover);
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
        }

        .restaurant-image {
            height: 180px;
            position: relative;
            overflow: hidden;
        }

        .restaurant-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform var(--transition-slow);
        }

        .restaurant-card:hover .restaurant-image img {
            transform: scale(1.05);
        }

        .restaurant-image-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.5) 0%, transparent 50%);
        }

        .restaurant-status {
            position: absolute;
            top: 12px;
            right: 12px;
            padding: 4px 12px;
            border-radius: var(--radius-full);
            font-size: 0.72rem;
            font-weight: 600;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .restaurant-status.open {
            background: rgba(34,197,94,0.2);
            color: var(--green-400);
            border: 1px solid rgba(34,197,94,0.3);
        }

        .restaurant-status.closed {
            background: rgba(239,68,68,0.2);
            color: var(--red-500);
            border: 1px solid rgba(239,68,68,0.3);
        }

        .restaurant-body {
            padding: 1.2rem;
        }

        .restaurant-category {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--orange-400);
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 0.3rem;
        }

        .restaurant-name {
            font-size: 1.15rem;
            font-weight: 700;
            margin-bottom: 0.4rem;
        }

        .restaurant-address {
            font-size: 0.85rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 5px;
            margin-bottom: 0.8rem;
        }

        .restaurant-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 0.8rem;
            border-top: 1px solid var(--border);
        }

        .restaurant-rating {
            display: flex;
            align-items: center;
            gap: 5px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .rating-star {
            color: var(--amber-400);
        }

        .restaurant-action {
            font-size: 0.82rem;
            color: var(--orange-400);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 4px;
            transition: gap var(--transition-fast);
        }

        .restaurant-card:hover .restaurant-action {
            gap: 8px;
        }

        /* ===== MENU MODAL ===== */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            z-index: 2000;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            opacity: 0;
            visibility: hidden;
            transition: all var(--transition-base);
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal {
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            border-radius: var(--radius-xl);
            width: min(580px, 100%);
            max-height: 85vh;
            overflow-y: auto;
            transform: translateY(20px) scale(0.97);
            transition: transform var(--transition-slow);
            box-shadow: var(--shadow-lg);
        }

        .modal-overlay.active .modal {
            transform: translateY(0) scale(1);
        }

        .modal-header {
            padding: 1.5rem 1.5rem 0;
            display: flex;
            justify-content: space-between;
            align-items: start;
        }

        .modal-close {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1px solid var(--border);
            background: var(--surface);
            color: var(--text-secondary);
            font-size: 1.1rem;
            cursor: pointer;
            display: grid;
            place-items: center;
            transition: all var(--transition-fast);
            flex-shrink: 0;
        }

        .modal-close:hover {
            background: var(--surface-hover);
            border-color: var(--border-hover);
            color: var(--text-primary);
        }

        .modal-restaurant-name {
            font-size: 1.4rem;
            font-weight: 800;
            margin-bottom: 0.2rem;
        }

        .modal-restaurant-category {
            font-size: 0.85rem;
            color: var(--orange-400);
            font-weight: 500;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .menu-section-title {
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--text-muted);
            margin-bottom: 0.8rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid var(--border);
        }

        .menu-item {
            display: flex;
            justify-content: space-between;
            align-items: start;
            padding: 0.9rem 0;
            border-bottom: 1px solid var(--border);
            gap: 1rem;
        }

        .menu-item:last-child {
            border-bottom: none;
        }

        .menu-item-info {
            flex: 1;
        }

        .menu-item-name {
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 0.2rem;
        }

        .menu-item-desc {
            font-size: 0.82rem;
            color: var(--text-muted);
            line-height: 1.5;
        }

        .menu-item-price {
            font-weight: 700;
            font-size: 1rem;
            color: var(--orange-400);
            white-space: nowrap;
        }

        .menu-empty {
            text-align: center;
            padding: 2rem;
            color: var(--text-muted);
        }

        /* ===== API STATUS BAR ===== */
        .api-section {
            padding: 4rem 0;
            background: var(--bg-secondary);
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }

        .api-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .api-header .section-subtitle {
            margin: 0 auto;
        }

        .api-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1rem;
        }

        .api-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 1.3rem;
            transition: all var(--transition-base);
        }

        .api-card:hover {
            border-color: var(--border-hover);
            transform: translateY(-2px);
        }

        .api-method {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 5px;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            background: rgba(34,197,94,0.12);
            color: var(--green-400);
            margin-bottom: 0.5rem;
        }

        .api-route {
            font-family: 'SF Mono', 'Fira Code', monospace;
            font-size: 0.92rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.35rem;
        }

        .api-desc {
            font-size: 0.82rem;
            color: var(--text-muted);
        }

        .api-status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 6px;
            animation: pulse 2s ease-in-out infinite;
        }

        .api-status-dot.online { background: var(--green-400); }
        .api-status-dot.offline { background: var(--red-500); animation: none; }

        /* ===== ABOUT SECTION ===== */
        .about {
            padding: 5rem 0;
        }

        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
        }

        .about-features {
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
        }

        .feature-item {
            display: flex;
            gap: 1rem;
            align-items: start;
        }

        .feature-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            font-size: 1.2rem;
            flex-shrink: 0;
            background: rgba(249,115,22,0.08);
            border: 1px solid rgba(249,115,22,0.15);
        }

        .feature-text h3 {
            font-size: 0.95rem;
            font-weight: 700;
            margin-bottom: 0.2rem;
        }

        .feature-text p {
            font-size: 0.85rem;
            color: var(--text-muted);
            line-height: 1.55;
        }

        /* ===== FOOTER ===== */
        .footer {
            padding: 3rem 0;
            border-top: 1px solid var(--border);
        }

        .footer .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .footer-text {
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .footer-tech {
            display: flex;
            gap: 0.6rem;
            flex-wrap: wrap;
        }

        .footer-tag {
            padding: 4px 12px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-full);
            font-size: 0.75rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        /* ===== LOADING ===== */
        .skeleton {
            background: linear-gradient(90deg, var(--bg-card) 0%, var(--bg-card-hover) 50%, var(--bg-card) 100%);
            background-size: 200% 100%;
            animation: shimmer 1.5s ease-in-out infinite;
            border-radius: var(--radius-md);
        }

        @keyframes shimmer {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        .no-results {
            grid-column: 1 / -1;
            text-align: center;
            padding: 4rem 2rem;
            color: var(--text-muted);
        }

        .no-results .icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .no-results p {
            font-size: 1rem;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .hero .container {
                grid-template-columns: 1fr;
                gap: 2.5rem;
                text-align: center;
            }

            .hero-desc { margin: 0 auto 2rem; }
            .hero-actions { justify-content: center; }
            .hero-stats { justify-content: center; }
            .hero-visual { order: -1; }
            .hero-phone { width: 240px; height: 460px; }

            .nav-links { display: none; }
            .mobile-toggle { display: block; }

            .restaurants-header {
                flex-direction: column;
                align-items: stretch;
            }

            .search-bar { min-width: unset; }

            .restaurants-grid {
                grid-template-columns: 1fr;
            }

            .about-grid {
                grid-template-columns: 1fr;
            }

            .categories-grid {
                grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            }
        }
    </style>
</head>
<body>

    <!-- ===== NAVBAR ===== -->
    <nav class="navbar" id="navbar">
        <div class="container">
            <a href="#" class="logo">
                <div class="logo-icon">📍</div>
                <div class="logo-text">Menu<span>City</span></div>
            </a>
            <ul class="nav-links">
                <li><a href="#categorias">Categorias</a></li>
                <li><a href="#restaurantes">Restaurantes</a></li>
                <li><a href="#api">API</a></li>
                <li><a href="#sobre">Sobre</a></li>
                <li><a href="#api" class="nav-cta">Testar API</a></li>
            </ul>
            <button class="mobile-toggle" id="mobileToggle" aria-label="Menu">☰</button>
        </div>
    </nav>

    <!-- ===== HERO ===== -->
    <section class="hero" id="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-badge">
                    <span class="pulse"></span>
                    API Online — v1.0.0
                </div>
                <h1>
                    Descubra sabores.<br>
                    Explore <span class="gradient">cardápios.</span>
                </h1>
                <p class="hero-desc">
                    Encontre restaurantes próximos e visualize cardápios digitais completos.
                    Tudo em um só lugar, direto do seu celular.
                </p>
                <div class="hero-actions">
                    <a href="#restaurantes" class="btn btn-primary">
                        🔍 Explorar Restaurantes
                    </a>
                    <a href="#api" class="btn btn-secondary">
                        { } Ver Endpoints
                    </a>
                </div>
                <div class="hero-stats">
                    <div class="stat-item">
                        <div class="stat-value" id="statRestaurantes">—</div>
                        <div class="stat-label">Restaurantes</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value" id="statCategorias">—</div>
                        <div class="stat-label">Categorias</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value" id="statCardapios">—</div>
                        <div class="stat-label">Cardápios</div>
                    </div>
                </div>
            </div>

            <div class="hero-visual">
                <div class="hero-phone">
                    <div class="phone-notch"></div>
                    <div class="phone-screen">
                        <div class="phone-header">
                            <h3>📍 MenuCity</h3>
                            <p>Sua cidade, seus sabores</p>
                        </div>
                        <div class="phone-search">
                            <span>🔍</span>
                            <span>Buscar restaurante...</span>
                        </div>
                        <div class="phone-categories">
                            <div class="phone-cat active">🍽️ Todos</div>
                            <div class="phone-cat">🇧🇷 Brasileira</div>
                            <div class="phone-cat">🇯🇵 Japonesa</div>
                            <div class="phone-cat">🍕 Pizza</div>
                        </div>
                        <div class="phone-restaurant">
                            <div class="phone-rest-header">
                                <div class="phone-rest-name">Sabor da Terra</div>
                                <div class="phone-rest-rating">⭐ 4.7</div>
                            </div>
                            <div class="phone-rest-info">Rua das Flores, 123 — Centro</div>
                            <div class="phone-rest-tags">
                                <span class="phone-rest-tag">Brasileira</span>
                                <span class="phone-rest-tag open">● Aberto</span>
                            </div>
                        </div>
                        <div class="phone-restaurant">
                            <div class="phone-rest-header">
                                <div class="phone-rest-name">Tokyo Sushi</div>
                                <div class="phone-rest-rating">⭐ 4.5</div>
                            </div>
                            <div class="phone-rest-info">Av. Paulista, 456</div>
                            <div class="phone-rest-tags">
                                <span class="phone-rest-tag">Japonesa</span>
                            </div>
                        </div>
                        <div class="phone-restaurant">
                            <div class="phone-rest-header">
                                <div class="phone-rest-name">Bella Massa</div>
                                <div class="phone-rest-rating">⭐ 4.8</div>
                            </div>
                            <div class="phone-rest-info">Rua Augusta, 789</div>
                            <div class="phone-rest-tags">
                                <span class="phone-rest-tag">Italiana</span>
                                <span class="phone-rest-tag open">● Aberto</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== CATEGORIAS ===== -->
    <section class="categories" id="categorias">
        <div class="container">
            <div class="categories-header">
                <div class="section-label">🍴 Explore por tipo</div>
                <h2 class="section-title">Categorias de Culinária</h2>
                <p class="section-subtitle">Filtre os restaurantes pelo estilo de comida que você está procurando.</p>
            </div>
            <div class="categories-grid" id="categoriesGrid">
                <!-- Preenchido via JS -->
            </div>
        </div>
    </section>

    <!-- ===== RESTAURANTES ===== -->
    <section class="restaurants" id="restaurantes">
        <div class="container">
            <div class="restaurants-header">
                <div>
                    <div class="section-label">📍 Perto de você</div>
                    <h2 class="section-title">Restaurantes</h2>
                </div>
                <div class="search-bar">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                    <input type="text" id="searchInput" placeholder="Buscar por nome ou categoria...">
                </div>
            </div>
            <div class="restaurants-grid" id="restaurantsGrid">
                <!-- Preenchido via JS -->
            </div>
        </div>
    </section>

    <!-- ===== API SECTION ===== -->
    <section class="api-section" id="api">
        <div class="container">
            <div class="api-header">
                <div class="section-label">⚡ REST API</div>
                <h2 class="section-title">Endpoints Disponíveis</h2>
                <p class="section-subtitle">Todos os endpoints retornam JSON e estão prontos para consumo pelo aplicativo mobile.</p>
            </div>
            <div class="api-grid" id="apiGrid">
                <div class="api-card">
                    <div class="api-method">GET</div>
                    <div class="api-route">
                        <span class="api-status-dot" id="apiDot"></span>
                        /api/status
                    </div>
                    <div class="api-desc">Saúde e informações gerais da API</div>
                </div>
                <div class="api-card">
                    <div class="api-method">GET</div>
                    <div class="api-route">/api/restaurantes</div>
                    <div class="api-desc">Lista de restaurantes com localização e avaliação</div>
                </div>
                <div class="api-card">
                    <div class="api-method">GET</div>
                    <div class="api-route">/api/cardapios</div>
                    <div class="api-desc">Cardápios digitais dos restaurantes</div>
                </div>
                <div class="api-card">
                    <div class="api-method">GET</div>
                    <div class="api-route">/api/categorias</div>
                    <div class="api-desc">Categorias de culinária disponíveis</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== SOBRE ===== -->
    <section class="about" id="sobre">
        <div class="container">
            <div class="about-grid">
                <div>
                    <div class="section-label">📝 Sobre o projeto</div>
                    <h2 class="section-title">MenuCity — TCC</h2>
                    <p class="section-subtitle" style="margin-bottom: 1.5rem;">
                        Sistema online composto por aplicação web e aplicativo mobile, destinado à consulta de restaurantes e visualização de cardápios digitais.
                    </p>
                </div>
                <div class="about-features">
                    <div class="feature-item">
                        <div class="feature-icon">📍</div>
                        <div class="feature-text">
                            <h3>Localização em tempo real</h3>
                            <p>Encontre restaurantes próximos usando coordenadas de GPS e visualize-os no mapa.</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">📱</div>
                        <div class="feature-text">
                            <h3>Cardápio Digital</h3>
                            <p>Consulte pratos, bebidas e preços sem precisar ir presencialmente ao restaurante.</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">🔍</div>
                        <div class="feature-text">
                            <h3>Busca Inteligente</h3>
                            <p>Filtre por categoria, nome ou avaliação para encontrar exatamente o que procura.</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">⚡</div>
                        <div class="feature-text">
                            <h3>API REST</h3>
                            <p>Backend Laravel com endpoints JSON prontos para integração com apps mobile e web.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== FOOTER ===== -->
    <footer class="footer">
        <div class="container">
            <div class="footer-text">
                MenuCity © 2026 — Projeto de TCC
            </div>
            <div class="footer-tech">
                <span class="footer-tag">Laravel 12</span>
                <span class="footer-tag">PHP 8+</span>
                <span class="footer-tag">SQLite</span>
                <span class="footer-tag">REST API</span>
                <span class="footer-tag">Render</span>
            </div>
        </div>
    </footer>

    <!-- ===== MODAL ===== -->
    <div class="modal-overlay" id="menuModal">
        <div class="modal">
            <div class="modal-header">
                <div>
                    <div class="modal-restaurant-name" id="modalName"></div>
                    <div class="modal-restaurant-category" id="modalCategory"></div>
                </div>
                <button class="modal-close" id="modalClose">✕</button>
            </div>
            <div class="modal-body" id="modalBody">
                <!-- Itens do cardápio preenchidos via JS -->
            </div>
        </div>
    </div>

    <script>
    (function() {
        'use strict';

        // ===== STATE =====
        let restaurantes = [];
        let categorias = [];
        let cardapios = [];
        let activeCategory = null;

        // ===== IMAGES — placeholder covers based on category =====
        const categoryImages = {
            'Comida Brasileira': 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=600&h=360&fit=crop',
            'Comida Japonesa':   'https://images.unsplash.com/photo-1579871494447-9811cf80d66c?w=600&h=360&fit=crop',
            'Comida Italiana':   'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=600&h=360&fit=crop',
            'default':           'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=600&h=360&fit=crop',
        };

        function getImage(categoria) {
            return categoryImages[categoria] || categoryImages['default'];
        }

        // ===== FETCH DATA =====
        async function loadData() {
            try {
                const [resRest, resCat, resCard, resStatus] = await Promise.all([
                    fetch('/api/restaurantes').then(r => r.json()),
                    fetch('/api/categorias').then(r => r.json()),
                    fetch('/api/cardapios').then(r => r.json()),
                    fetch('/api/status').then(r => r.json()),
                ]);

                restaurantes = resRest.dados || [];
                categorias = resCat.dados || [];
                cardapios = resCard.dados || [];

                // Update stats
                document.getElementById('statRestaurantes').textContent = restaurantes.length;
                document.getElementById('statCategorias').textContent = categorias.length;
                document.getElementById('statCardapios').textContent = cardapios.length;

                // API status dot
                const dot = document.getElementById('apiDot');
                if (resStatus.status === 'online') {
                    dot.classList.add('online');
                } else {
                    dot.classList.add('offline');
                }

                renderCategories();
                renderRestaurants();
            } catch (err) {
                console.error('Erro ao carregar dados da API:', err);
                const dot = document.getElementById('apiDot');
                dot.classList.add('offline');
            }
        }

        // ===== RENDER CATEGORIES =====
        function renderCategories() {
            const grid = document.getElementById('categoriesGrid');

            // "All" card
            let html = `
                <div class="category-card ${activeCategory === null ? 'active' : ''}" data-category="all">
                    <span class="category-icon">🍽️</span>
                    <div class="category-name">Todas</div>
                    <div class="category-count">${restaurantes.length} restaurantes</div>
                </div>
            `;

            categorias.forEach(cat => {
                const isActive = activeCategory === cat.nome;
                html += `
                    <div class="category-card ${isActive ? 'active' : ''}" data-category="${cat.nome}">
                        <span class="category-icon">${cat.icone}</span>
                        <div class="category-name">${cat.nome}</div>
                        <div class="category-count">${cat.total_restaurantes} restaurantes</div>
                    </div>
                `;
            });

            grid.innerHTML = html;

            // Event listeners
            grid.querySelectorAll('.category-card').forEach(card => {
                card.addEventListener('click', () => {
                    const cat = card.dataset.category;
                    activeCategory = cat === 'all' ? null : cat;
                    renderCategories();
                    renderRestaurants();

                    // Scroll to restaurants
                    document.getElementById('restaurantes').scrollIntoView({ behavior: 'smooth', block: 'start' });
                });
            });
        }

        // ===== RENDER RESTAURANTS =====
        function renderRestaurants() {
            const grid = document.getElementById('restaurantsGrid');
            const search = document.getElementById('searchInput').value.toLowerCase().trim();

            let filtered = restaurantes;

            // Filter by category
            if (activeCategory) {
                filtered = filtered.filter(r => r.categoria === activeCategory);
            }

            // Filter by search
            if (search) {
                filtered = filtered.filter(r =>
                    r.nome.toLowerCase().includes(search) ||
                    r.categoria.toLowerCase().includes(search) ||
                    r.endereco.toLowerCase().includes(search)
                );
            }

            if (filtered.length === 0) {
                grid.innerHTML = `
                    <div class="no-results">
                        <div class="icon">🔍</div>
                        <p>Nenhum restaurante encontrado.</p>
                    </div>
                `;
                return;
            }

            grid.innerHTML = filtered.map(r => `
                <article class="restaurant-card" data-id="${r.id}">
                    <div class="restaurant-image">
                        <img src="${getImage(r.categoria)}" alt="${r.nome}" loading="lazy">
                        <div class="restaurant-image-overlay"></div>
                        <span class="restaurant-status ${r.aberto ? 'open' : 'closed'}">
                            ${r.aberto ? '● Aberto' : '● Fechado'}
                        </span>
                    </div>
                    <div class="restaurant-body">
                        <div class="restaurant-category">${r.categoria}</div>
                        <div class="restaurant-name">${r.nome}</div>
                        <div class="restaurant-address">
                            <span>📍</span> ${r.endereco}
                        </div>
                        <div class="restaurant-footer">
                            <div class="restaurant-rating">
                                <span class="rating-star">⭐</span>
                                ${r.avaliacao.toFixed(1)}
                            </div>
                            <div class="restaurant-action">
                                Ver Cardápio <span>→</span>
                            </div>
                        </div>
                    </div>
                </article>
            `).join('');

            // Click to open menu modal
            grid.querySelectorAll('.restaurant-card').forEach(card => {
                card.addEventListener('click', () => {
                    const id = parseInt(card.dataset.id);
                    openMenuModal(id);
                });
            });
        }

        // ===== MENU MODAL =====
        function openMenuModal(restauranteId) {
            const rest = restaurantes.find(r => r.id === restauranteId);
            const cardapio = cardapios.find(c => c.restaurante_id === restauranteId);

            if (!rest) return;

            document.getElementById('modalName').textContent = rest.nome;
            document.getElementById('modalCategory').textContent = rest.categoria;

            const body = document.getElementById('modalBody');

            if (!cardapio || !cardapio.itens || cardapio.itens.length === 0) {
                body.innerHTML = `
                    <div class="menu-empty">
                        <p>📋 Cardápio ainda não disponível para este restaurante.</p>
                    </div>
                `;
            } else {
                // Group items by category
                const groups = {};
                cardapio.itens.forEach(item => {
                    const cat = item.categoria || 'Outros';
                    if (!groups[cat]) groups[cat] = [];
                    groups[cat].push(item);
                });

                let html = '';
                for (const [cat, items] of Object.entries(groups)) {
                    html += `<div class="menu-section-title">${cat}</div>`;
                    items.forEach(item => {
                        html += `
                            <div class="menu-item">
                                <div class="menu-item-info">
                                    <div class="menu-item-name">${item.nome}</div>
                                    <div class="menu-item-desc">${item.descricao}</div>
                                </div>
                                <div class="menu-item-price">R$ ${item.preco.toFixed(2).replace('.', ',')}</div>
                            </div>
                        `;
                    });
                }

                body.innerHTML = html;
            }

            document.getElementById('menuModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('menuModal').classList.remove('active');
            document.body.style.overflow = '';
        }

        // ===== EVENT LISTENERS =====
        document.getElementById('modalClose').addEventListener('click', closeModal);
        document.getElementById('menuModal').addEventListener('click', (e) => {
            if (e.target === e.currentTarget) closeModal();
        });
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeModal();
        });

        // Search
        document.getElementById('searchInput').addEventListener('input', renderRestaurants);

        // Navbar scroll effect
        let ticking = false;
        window.addEventListener('scroll', () => {
            if (!ticking) {
                requestAnimationFrame(() => {
                    const navbar = document.getElementById('navbar');
                    if (window.scrollY > 40) {
                        navbar.classList.add('scrolled');
                    } else {
                        navbar.classList.remove('scrolled');
                    }
                    ticking = false;
                });
                ticking = true;
            }
        });

        // Mobile menu toggle
        document.getElementById('mobileToggle').addEventListener('click', () => {
            const links = document.querySelector('.nav-links');
            links.style.display = links.style.display === 'flex' ? 'none' : 'flex';
            links.style.flexDirection = 'column';
            links.style.position = 'absolute';
            links.style.top = '100%';
            links.style.left = '0';
            links.style.right = '0';
            links.style.background = 'rgba(15,15,18,0.95)';
            links.style.backdropFilter = 'blur(20px)';
            links.style.padding = '1rem 5%';
            links.style.borderBottom = '1px solid var(--border)';
        });

        // Show skeletons initially
        function showSkeletons() {
            const catGrid = document.getElementById('categoriesGrid');
            const restGrid = document.getElementById('restaurantsGrid');

            catGrid.innerHTML = Array(5).fill('').map(() =>
                `<div class="skeleton" style="height:120px;"></div>`
            ).join('');

            restGrid.innerHTML = Array(3).fill('').map(() =>
                `<div class="skeleton" style="height:320px;"></div>`
            ).join('');
        }

        // ===== INIT =====
        showSkeletons();
        loadData();
    })();
    </script>
</body>
</html>
