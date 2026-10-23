
@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@push('styles')
<style>
    .nx-stat-card {
        background: white;
        border: 1px solid #e1e8f2;
        border-radius: 18px;
        padding: 23px;
        height: 100%;
        box-shadow: 0 7px 25px rgba(24,49,83,.035);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .nx-stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(24,49,83,.09);
    }

    .nx-stat-icon {
        width: 51px;
        height: 51px;
        border-radius: 15px;
        display: grid;
        place-items: center;
        font-size: 23px;
    }

    .nx-stat-number {
        font-size: 34px;
        font-weight: 800;
        line-height: 1.2;
        margin-top: 15px;
        color: #183153;
    }

    .nx-stat-label {
        color: #718096;
        font-size: 14px;
        font-weight: 600;
    }

    .nx-welcome {
        background: linear-gradient(110deg, #063d86, #0879e8);
        border-radius: 20px;
        padding: 30px;
        color: white;
    }

    .nx-welcome p {
        color: #d9ecff;
    }

    .nx-order-status {
        font-size: 12px;
        font-weight: 700;
        padding: 6px 11px;
        border-radius: 20px;
        display: inline-block;
    }

    .nx-status-pendiente {
        background: #fff4d4;
        color: #996100;
    }

    .nx-status-confirmado {
        background: #e2f1ff;
        color: #0759b6;
    }

    .nx-status-enviado {
        background: #ede8ff;
        color: #6545ad;
    }

    .nx-status-entregado {
        background: #def8e9;
        color: #166a40;
    }

    .nx-status-cancelado {
        background: #ffe5e5;
        color: #a12b2b;
    }

    .nx-admin-table th {
        color: #718096;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .6px;
        white-space: nowrap;
    }

    .nx-admin-table td {
        vertical-align: middle;
    }

    .nx-quick-action {
        display: flex;
        align-items: center;
        gap: 13px;
        border: 1px solid #e1e8f2;
        border-radius: 13px;
        padding: 14px;
        color: #183153;
        font-weight: 700;
        transition: background .2s;
    }

    .nx-quick-action:hover {
        background: #eef5ff;
        color: #0869cc;
    }

    .nx-quick-action i {
        color: #0869cc;
        font-size: 22px;
    }
</style>
@endpush

@section('content')

    <!-- BIENVENIDA -->
    <div class="nx-welcome mb-4">

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

            <div>
                <div class="small fw-bold text-uppercase mb-2">
                    Panel de control
                </div>

                <h2 class="fw-bold mb-2">
                    Bienvenido a Nítido Xpress
                </h2>

                <p class="mb-0">
                    Administra tus productos, revisa pedidos y
                    consulta la actividad de tu tienda.
                </p>
            </div>

            <a href="{{ route('tienda.index') }}"
               class="btn btn-light fw-bold">
                <i class="bi bi-shop me-2"></i>
                Visitar tienda
            </a>

        </div>

    </div>

    <!-- ESTADÍSTICAS -->
    <div class="row g-3 mb-4">

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="nx-stat-card">
                <div class="nx-stat-icon"
                     style="background:#e7f1ff;color:#0869cc">
                    <i class="bi bi-box-seam"></i>
                </div>

                <div class="nx-stat-number">
                    {{ number_format($productos) }}
                </div>

                <div class="nx-stat-label">
                    Productos registrados
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="nx-stat-card">
                <div class="nx-stat-icon"
                     style="background:#e5f8ed;color:#16834a">
                    <i class="bi bi-bag-check"></i>
                </div>

                <div class="nx-stat-number">
                    {{ number_format($pedidos) }}
                </div>

                <div class="nx-stat-label">
                    Pedidos totales
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="nx-stat-card">
                <div class="nx-stat-icon"
                     style="background:#fff3da;color:#bd7900">
                    <i class="bi bi-clock-history"></i>
                </div>

                <div class="nx-stat-number">
                    {{ number_format($pendientes) }}
                </div>

                <div class="nx-stat-label">
                    Pedidos pendientes
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="nx-stat-card">
                <div class="nx-stat-icon"
                     style="background:#ede9ff;color:#7950b5">
                    <i class="bi bi-check-circle"></i>
                </div>

                <div class="nx-stat-number">
                    {{ number_format($activos) }}
                </div>

                <div class="nx-stat-label">
                    Productos activos
                </div>
            </div>
        </div>

    </div>

    <!-- PEDIDOS Y ACCESOS -->
    <div class="row g-4">

        <div class="col-lg-8">
            <div class="admin-card h-100">

                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3">
                    <div>
                        <h3 class="h5 fw-bold mb-1">
                            Pedidos recientes
                        </h3>

                        <p class="admin-muted small mb-0">
                            Últimos movimientos registrados
                        </p>
                    </div>

                    <a href="{{ route('admin.orders') }}"
                       class="btn btn-outline-primary btn-sm">
                        Ver todos
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table nx-admin-table">
                        <thead>
                            <tr>
                                <th>Pedido</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($recientes as $pedido)
                                <tr>
                                    <td class="fw-bold">
                                        #{{ $pedido->id }}
                                    </td>

                                    <td>
                                        {{ $pedido->created_at?->format('d/m/Y H:i') ?? '—' }}
                                    </td>

                                    <td>
                                        <span class="nx-order-status nx-status-{{ $pedido->estado }}">
                                            {{ ucfirst($pedido->estado) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3"
                                        class="text-center text-secondary py-4">
                                        Todavía no hay pedidos registrados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div class="col-lg-4">
            <div class="admin-card h-100">

                <h3 class="h5 fw-bold mb-1">
                    Accesos rápidos
                </h3>

                <p class="admin-muted small mb-3">
                    Gestiona tu tienda desde aquí.
                </p>

                <div class="d-grid gap-2">

                    <a href="{{ route('admin.products') }}"
                       class="nx-quick-action">
                        <i class="bi bi-box-seam"></i>
                        Administrar productos
                        <i class="bi bi-chevron-right ms-auto fs-6"></i>
                    </a>

                    <a href="{{ route('admin.orders') }}"
                       class="nx-quick-action">
                        <i class="bi bi-bag-check"></i>
                        Revisar pedidos
                        <i class="bi bi-chevron-right ms-auto fs-6"></i>
                    </a>

                    <a href="{{ route('tienda.index') }}"
                       class="nx-quick-action">
                        <i class="bi bi-shop"></i>
                        Ver catálogo público
                        <i class="bi bi-chevron-right ms-auto fs-6"></i>
                    </a>

                </div>

            </div>
        </div>

    </div>

@endsection
