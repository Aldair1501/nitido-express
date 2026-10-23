
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Administración') | Nítido Xpress</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --nx-blue: #0869cc;
            --nx-dark: #082b60;
            --nx-bg: #f4f7fc;
            --nx-text: #183153;
            --nx-muted: #718096;
            --nx-border: #e1e8f2;
            --nx-sidebar: 255px;
        }

        body {
            background: var(--nx-bg);
            color: var(--nx-text);
            font-family: system-ui, -apple-system, sans-serif;
            margin: 0;
        }

        a {
            text-decoration: none;
        }

        /* MENÚ LATERAL */

        .admin-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: var(--nx-sidebar);
            background: linear-gradient(180deg, #082b60, #061d43);
            color: white;
            z-index: 1040;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .admin-brand {
            padding: 25px 20px;
            border-bottom: 1px solid rgba(255,255,255,.12);
        }

        .admin-logo {
            width: 100%;
            max-width: 180px;
            height: 65px;
            object-fit: contain;
            background: white;
            padding: 5px 12px;
            border-radius: 12px;
        }

        .admin-brand small {
            display: block;
            color: #b8c9e5;
            margin-top: 12px;
            letter-spacing: 1px;
            font-weight: 700;
        }

        .sidebar-caption {
            color: #93aed4;
            text-transform: uppercase;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1px;
            padding: 20px 23px 10px;
        }

        .sidebar-nav {
            padding: 0 12px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 15px;
            margin-bottom: 5px;
            color: #cddcf1;
            font-weight: 600;
            border-radius: 11px;
            transition: background .2s, color .2s;
        }

        .sidebar-link i {
            font-size: 19px;
            width: 23px;
            text-align: center;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            color: white;
            background: #0879e8;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding: 20px 12px;
            border-top: 1px solid rgba(255,255,255,.12);
        }

        /* CONTENIDO PRINCIPAL */

        .admin-main {
            margin-left: var(--nx-sidebar);
            min-height: 100vh;
        }

        .admin-topbar {
            background: white;
            min-height: 78px;
            padding: 16px 30px;
            border-bottom: 1px solid var(--nx-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .topbar-title {
            font-size: 19px;
            font-weight: 800;
            margin: 0;
        }

        .admin-content {
            padding: 30px;
            max-width: 1600px;
            margin: 0 auto;
        }

        .admin-user {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .admin-avatar {
            width: 42px;
            height: 42px;
            border-radius: 13px;
            display: grid;
            place-items: center;
            color: white;
            font-size: 21px;
            background: linear-gradient(135deg, #0869cc, #54b6f5);
        }

        .admin-card {
            background: white;
            border: 1px solid var(--nx-border);
            border-radius: 18px;
            padding: 24px;
            box-shadow: 0 7px 25px rgba(24,49,83,.035);
        }

        .admin-page-title {
            font-size: clamp(24px, 3vw, 31px);
            font-weight: 800;
            letter-spacing: -.7px;
        }

        .admin-muted {
            color: var(--nx-muted);
        }

        .btn-primary {
            background: var(--nx-blue);
            border-color: var(--nx-blue);
        }

        .btn-primary:hover {
            background: #064d9e;
            border-color: #064d9e;
        }

        .btn {
            border-radius: 10px;
            font-weight: 600;
        }

        .admin-footer {
            padding: 16px 30px 25px;
            color: var(--nx-muted);
            font-size: 13px;
        }

        .sidebar-backdrop {
            display: none;
        }

        /* MÓVILES Y TABLETAS */

        @media(max-width: 991px) {
            .admin-sidebar {
                transform: translateX(-100%);
                transition: transform .25s ease;
            }

            .admin-sidebar.open {
                transform: translateX(0);
            }

            .sidebar-backdrop.show {
                display: block;
                position: fixed;
                inset: 0;
                background: rgba(3,18,42,.55);
                z-index: 1035;
            }

            .admin-main {
                margin-left: 0;
            }

            .admin-topbar {
                padding: 14px 18px;
            }

            .admin-content {
                padding: 20px 15px;
            }

            .admin-footer {
                padding: 15px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    <!-- MENÚ LATERAL -->
    <aside class="admin-sidebar" id="adminSidebar">

        <div class="admin-brand">
            <a href="{{ route('admin.index') }}">
                <img
                    src="{{ asset('img/NITIDO.png') }}"
                    alt="Nítido Xpress"
                    class="admin-logo"
                >
            </a>

            <small>PANEL ADMINISTRATIVO</small>
        </div>

        <div class="sidebar-caption">Principal</div>

        <nav class="sidebar-nav" aria-label="Menú de administración">

            <a href="{{ route('admin.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.index') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2"></i>
                Dashboard
            </a>

            <a href="{{ route('admin.products') }}"
               class="sidebar-link {{ request()->routeIs('admin.products') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i>
                Productos
            </a>

            <a href="{{ route('admin.orders') }}"
               class="sidebar-link {{ request()->routeIs('admin.orders') ? 'active' : '' }}">
                <i class="bi bi-bag-check"></i>
                Pedidos
            </a>

        </nav>

        <div class="sidebar-caption">Accesos rápidos</div>

        <nav class="sidebar-nav" aria-label="Accesos rápidos">

            <a href="{{ route('tienda.index') }}"
               class="sidebar-link">
                <i class="bi bi-shop"></i>
                Ver tienda
            </a>

        </nav>

        <div class="sidebar-bottom">
            <div class="small text-white-50 px-3 mb-2">
                Sesión administrativa
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                        class="sidebar-link border-0 w-100 text-start"
                        style="background:transparent">
                    <i class="bi bi-box-arrow-right"></i>
                    Cerrar sesión
                </button>
            </form>
        </div>

    </aside>

    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <!-- PANEL PRINCIPAL -->
    <div class="admin-main">

        <header class="admin-topbar">

            <div class="d-flex align-items-center gap-3">

                <button
                    type="button"
                    id="openSidebar"
                    class="btn btn-outline-primary d-lg-none"
                    aria-label="Abrir menú administrativo"
                    aria-controls="adminSidebar"
                    aria-expanded="false"
                >
                    <i class="bi bi-list fs-5"></i>
                </button>

                <div>
                    <h1 class="topbar-title">
                        @yield('page_title', 'Administración')
                    </h1>
                    <span class="admin-muted small">
                        Nítido Xpress
                    </span>
                </div>

            </div>

            <div class="admin-user">
                <div class="text-end d-none d-sm-block">
                    <div class="fw-bold small">
                        {{ auth()->user()?->nombre ?? auth()->user()?->name ?? 'Administrador' }}
                    </div>
                    <div class="admin-muted small">
                        Administrador
                    </div>
                </div>

                <div class="admin-avatar" aria-hidden="true">
                    <i class="bi bi-person-fill"></i>
                </div>
            </div>

        </header>

        <main class="admin-content">

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

        <footer class="admin-footer">
            © {{ date('Y') }} Nítido Xpress · Administración
        </footer>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('adminSidebar');
            const backdrop = document.getElementById('sidebarBackdrop');
            const trigger = document.getElementById('openSidebar');

            function setOpen(open) {
                sidebar.classList.toggle('open', open);
                backdrop.classList.toggle('show', open);
                trigger.setAttribute('aria-expanded', String(open));
            }

            trigger.addEventListener('click', function () {
                setOpen(!sidebar.classList.contains('open'));
            });

            backdrop.addEventListener('click', function () {
                setOpen(false);
            });

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') {
                    setOpen(false);
                }
            });
        });
    </script>

    @stack('scripts')

</body>
</html>
