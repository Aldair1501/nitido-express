
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0759b6">

    <title>@yield('title', 'Nítido Xpress') | Guatemala</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --brand: #0869cc;
            --brand-dark: #063d86;
            --ink: #112946;
            --muted: #66788e;
            --line: #dce8f5;
            --base: #f5f9fe;
            --radius: 22px;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 180px;
        }

        body {
            margin: 0;
            background: var(--base);
            color: var(--ink);
            font-family: 'DM Sans', sans-serif;
        }

        a {
            text-decoration: none;
        }

        /* BARRA DE NAVEGACIÓN FIJA */

        .header-sticky {
            position: sticky;
            top: 0;
            width: 100%;
            z-index: 1050;
            box-shadow: 0 4px 18px rgba(0, 30, 80, 0.15);
        }

        .site-top {
            background: linear-gradient(105deg, #062f73, #0879e8);
            color: #fff;
        }

        /* LOGOTIPO */

        .logo-nitido {
            width: 200px;
            height: 75px;
            object-fit: contain;
            display: block;
            transition: transform .25s ease;
        }

        .navbar-brand:has(.logo-nitido) {
            background: #fff;
            padding: 5px 12px;
            border-radius: 12px;
        }

        .logo-nitido:hover {
            transform: scale(1.04);
        }

        /* BUSCADOR */

        .header-search {
            height: 48px;
            border: 0;
            border-radius: 30px;
            padding: 0 21px;
            background: #fff;
        }

        .header-search:focus {
            box-shadow: 0 0 0 4px rgba(111, 208, 255, .3);
        }

        /* ACCIONES DEL ENCABEZADO */

        .head-action {
            color: white;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-weight: 700;
            white-space: nowrap;
        }

        .head-action:hover {
            color: #a5e5ff;
        }

        .head-action svg {
            width: 23px;
            height: 23px;
        }

        .small-count {
            background: white;
            color: #07346e;
            border-radius: 10px;
            padding: 2px 7px;
            font-size: .75rem;
        }

        /* MENÚ SECUNDARIO */

        .subnav {
            background: #082a60;
            color: white;
        }

        .subnav a {
            color: white;
            opacity: .96;
            font-weight: 700;
            font-size: .9rem;
            padding: 12px 0;
            display: inline-block;
        }

        .subnav a:hover {
            color: #8cdeff;
            opacity: 1;
        }

        .store-main {
            min-height: 55vh;
        }

        /* PANELES Y FORMULARIOS */

        .panel,
        .filter-card,
        .info-card,
        .feature-card {
            background: white;
            border: 1px solid var(--line);
            border-radius: var(--radius);
            padding: 24px;
        }

        /* BOTONES */

        .btn-primary {
            background: var(--brand);
            border-color: var(--brand);
            font-weight: 700;
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background: var(--brand-dark);
            border-color: var(--brand-dark);
        }

        .btn-outline-primary {
            color: #0759b6;
            border-color: #0879e8;
        }

        .btn-outline-primary:hover {
            background: #0759b6;
            border-color: #0759b6;
            color: white;
        }

        /* BANNERS */

        .hero {
            border-radius: var(--radius);
            overflow: hidden;
        }

        /* CATÁLOGO */

        .section-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.7rem;
            font-weight: 800;
            letter-spacing: -.6px;
        }

        .section-subtitle {
            color: var(--muted);
        }

        /* TARJETAS DE PRODUCTOS */

        .product-card {
            background: white;
            border: 1px solid var(--line);
            border-radius: 19px;
            overflow: hidden;
            height: 100%;
            transition: transform .24s ease, box-shadow .24s ease;
            animation: enterUp .5s both;
        }

        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 38px rgba(6, 61, 134, .13);
        }

        .product-image-wrap {
            height: 214px;
            background: #fafafb;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 15px;
            transition: transform .45s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.07);
        }

        .product-placeholder {
            color: #7a8190;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            height: 100%;
            width: 100%;
            padding: 16px;
        }

        .product-title {
            font-size: 1.04rem;
            font-weight: 800;
            min-height: 43px;
            margin-top: 11px;
        }

        .product-description {
            font-size: .88rem;
            color: var(--muted);
            min-height: 40px;
        }

        .category-badge {
            background: #e9f4ff;
            color: #0759b6;
            padding: 5px 10px;
            border-radius: 12px;
            font-size: .73rem;
            font-weight: 800;
            display: inline-block;
        }

        .price {
            font-size: 1.3rem;
            font-weight: 800;
            color: #063d86;
        }

        .stock-ok {
            color: #1b8559;
            font-weight: 700;
            font-size: .84rem;
        }

        .stock-out {
            color: #b83737;
            font-weight: 700;
            font-size: .84rem;
        }

        .product-actions {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 8px;
        }

        .product-actions .btn {
            border-radius: 11px;
            padding: 11px 13px;
            font-weight: 700;
        }

        .product-card .product-title a {
            color: var(--ink);
        }

        .product-card .product-title a:hover {
            color: var(--brand);
        }

        .product-card a:focus-visible,
        .product-card button:focus-visible {
            outline: 3px solid #73c9ff;
            outline-offset: 3px;
        }

        /* CARRITO */

        .nx-mini {
            font-size: .8rem;
            color: var(--muted);
        }

        .nx-cart-line {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .nx-cart-image {
            width: 100px;
            height: 100px;
            object-fit: contain;
            background: #f5f8fd;
            border-radius: 15px;
            padding: 10px;
        }

        .nx-summary {
            position: sticky;
            top: 185px;
        }

        /* FOOTER */

        .footer {
            background: #06234d;
            color: #cdd3df;
            margin-top: 75px;
            padding: 45px 0;
        }

        .footer a {
            color: #e7ebf2;
        }

        .footer-title {
            color: white;
            font-size: 1.1rem;
            font-weight: 800;
        }

        /* ANIMACIONES */

        .enter-up {
            animation: enterUp .65s both;
        }

        @keyframes enterUp {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-delay-1 {
            animation-delay: .08s;
        }

        .fade-delay-2 {
            animation-delay: .16s;
        }

        .fade-delay-3 {
            animation-delay: .24s;
        }

        /* RESPONSIVE */

        .navbar-toggler {
            border-color: #ffffff80;
        }

        .navbar-toggler-icon {
            filter: brightness(0) invert(1);
        }

        @media (max-width: 767px) {
            html {
                scroll-padding-top: 150px;
            }

            .logo-nitido {
                width: 150px;
                height: 55px;
            }

            .header-search {
                height: 44px;
            }

            .product-image-wrap {
                height: 180px;
            }

            .subnav {
                overflow-x: auto;
                white-space: nowrap;
            }

            .subnav .container {
                gap: 22px !important;
            }

            .site-top .navbar-collapse {
                padding-top: 12px;
            }

            .head-action {
                font-size: .85rem;
            }

            .nx-cart-line {
                align-items: flex-start;
            }

            .nx-cart-image {
                width: 78px;
                height: 78px;
            }

            .nx-summary {
                position: static;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation: none !important;
                transition: none !important;
                scroll-behavior: auto !important;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

<header class="header-sticky">

    <nav class="navbar navbar-expand-lg site-top py-3">
        <div class="container gap-3">

            <!-- LOGOTIPO -->
            <a
                class="navbar-brand d-flex align-items-center"
                href="{{ route('tienda.index') }}"
            >
                <img
                    src="{{ asset('img/NITIDO.png') }}"
                    alt="Nítido Xpress"
                    class="logo-nitido"
                >
            </a>

            <!-- BOTÓN MÓVIL -->
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#siteMenu"
                aria-label="Abrir menú"
                aria-controls="siteMenu"
                aria-expanded="false"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse gap-3" id="siteMenu">

                <!-- BUSCADOR -->
                <form
                    class="flex-grow-1"
                    method="GET"
                    action="{{ route('tienda.index') }}"
                    role="search"
                >
                    <input
                        class="form-control header-search"
                        name="buscar"
                        type="search"
                        value="{{ request('buscar') }}"
                        placeholder="Buscar productos en Nítido Xpress"
                        aria-label="Buscar productos"
                    >
                </form>

                <!-- ACCIONES -->
                <div class="d-flex align-items-center gap-3 flex-wrap">

                    <a
                        class="head-action"
                        href="{{ route('tienda.index') }}#catalogo"
                    >
                        Catálogo
                    </a>

                    <a
                        class="head-action"
                        href="{{ route('carrito.index') }}"
                        aria-label="Ver carrito"
                    >
                        <svg viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="1.8"
                             aria-hidden="true">
                            <circle cx="9" cy="21" r="1"/>
                            <circle cx="20" cy="21" r="1"/>
                            <path d="M1 1h4l2 14h14l2-10H6"/>
                        </svg>

                        Carrito

                     <span class="small-count" id="contador-carrito">
                        {{ array_sum(session('carrito', [])) }}
                    </span>
                    </a>

                    @auth
                        <a
                            class="head-action"
                            href="{{ route('pedidos.index') }}"
                        >
                            Mis pedidos
                        </a>

                        @if(auth()->user()->rol?->nombre === 'administrador')
                            <a
                                class="head-action"
                                href="{{ route('admin.index') }}"
                            >
                                Administración
                            </a>
                        @endif

                        <form
                            action="{{ route('logout') }}"
                            method="POST"
                        >
                            @csrf

                            <button
                                class="btn btn-sm btn-light fw-bold"
                                type="submit"
                            >
                                Salir
                            </button>
                        </form>
                    @else
                        <a
                            class="head-action"
                            href="{{ route('login') }}"
                        >
                            Mi cuenta
                        </a>

                        <a
                            class="btn btn-light btn-sm fw-bold rounded-pill px-3"
                            href="{{ route('register') }}"
                        >
                            Registrarme
                        </a>
                    @endauth

                </div>
            </div>
        </div>
    </nav>

    <!-- MENÚ DE CATEGORÍAS -->
    <div class="subnav">
        <div class="container d-flex gap-4 align-items-center">

            <a href="{{ route('tienda.index') }}#catalogo">
                Todas las categorías
            </a>

            <a href="{{ route('tienda.index') }}#catalogo">
                Lo más reciente
            </a>

            <a href="{{ route('tienda.index') }}#beneficios">
                Cómo comprar
            </a>

            <span class="ms-auto small d-none d-lg-block">
                Compra en Guatemala · Precios en quetzales (Q)
            </span>

        </div>
    </div>

</header>

<!-- CONTENIDO PRINCIPAL -->
<main class="store-main container py-4 py-lg-5">

    @if(session('ok'))
        <div class="alert alert-success">
            {{ session('ok') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Revisa la información:</strong>

            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')

</main>

<!-- PIE DE PÁGINA -->
<footer class="footer">

    <div class="container">
        <div class="row g-4">

            <div class="col-md-6">
                <div class="footer-title mb-2">
                    Nítido Xpress
                </div>

                <p>
                    Explora nuestro catálogo y realiza tus pedidos en línea.
                    Precios en quetzales, Guatemala.
                </p>
            </div>

            <div class="col-md-3">
                <div class="footer-title mb-2">
                    Tienda
                </div>

                <a href="{{ route('tienda.index') }}#catalogo">
                    Productos
                </a>
            </div>

            <div class="col-md-3">
                <div class="footer-title mb-2">
                    Mi cuenta
                </div>

                <a href="{{ route('login') }}">
                    Iniciar sesión
                </a>
            </div>

        </div>

        <hr class="border-secondary mt-4">

        <small>
            © {{ date('Y') }} Nítido Xpress · Guatemala
        </small>
    </div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')

</body>
</html>
