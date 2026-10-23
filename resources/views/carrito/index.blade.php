
@extends('layouts.tienda')

@section('title', 'Mi carrito')

@section('content')

<h1 class="fw-bold mb-2">Tu carrito</h1>
<p class="text-secondary mb-4">
    Revisa tus productos antes de finalizar el pedido.
</p>

@php
    $cart = session('carrito', []);
    $total = 0;
@endphp

<div class="row g-4">

    <div class="col-lg-8">

        @forelse($productos as $p)

            @php
                $cantidad = (int) ($cart[$p->id] ?? 0);
                $precio = (float) $p->precio;
                $total += $precio * $cantidad;

                $foto = $p->imagenes
                    ->sortByDesc('principal')
                    ->first()?->ruta;

                $fotoUrl = null;

                if (is_string($foto) && trim($foto) !== '') {
                    $ruta = trim($foto);

                    $fotoUrl = \Illuminate\Support\Str::startsWith(
                        $ruta,
                        ['https://', 'http://']
                    )
                        ? $ruta
                        : (
                            \Illuminate\Support\Str::startsWith($ruta, 'demo/')
                            ? asset('img/productos/' . basename($ruta))
                            : asset('storage/' . ltrim(
                                preg_replace('#^/?storage/#', '', $ruta),
                                '/'
                            ))
                        );
                }
            @endphp

            <div
                class="panel mb-3 nx-cart-item"
                data-producto="{{ $p->id }}"
                data-precio="{{ $precio }}"
            >

                <div class="nx-cart-line mb-3">

                    @if($fotoUrl)
                        <img
                            class="nx-cart-image"
                            src="{{ $fotoUrl }}"
                            alt="{{ $p->nombre }}"
                            loading="lazy"
                        >
                    @else
                        <div class="nx-cart-image d-flex align-items-center justify-content-center text-muted">
                            Sin foto
                        </div>
                    @endif

                    <div class="flex-grow-1">

                        <a
                            class="fw-bold fs-5"
                            href="{{ route('producto.show', $p) }}"
                        >
                            {{ $p->nombre }}
                        </a>

                        <div class="nx-mini mb-1">
                            Q {{ number_format($precio, 2) }} por unidad
                        </div>

                        <strong class="fs-5 text-primary nx-line-total">
                            Q {{ number_format($precio * $cantidad, 2) }}
                        </strong>

                        @if($cantidad > $p->stock)
                            <div class="text-danger small">
                                La cantidad supera las existencias actuales.
                            </div>
                        @endif

                    </div>

                </div>

                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">

                    <form
                        method="POST"
                        action="{{ route('carrito.update', $p) }}"
                        class="nx-quantity-form"
                    >
                        @csrf

                        <div class="d-flex align-items-center gap-2">

                            <span class="fw-bold small me-2">
                                Cantidad
                            </span>

                            <div class="nx-quantity-control">

                                <button
                                    type="button"
                                    class="nx-qty-btn nx-minus"
                                    aria-label="Disminuir cantidad"
                                >
                                    −
                                </button>

                                <input
                                    type="number"
                                    name="cantidad"
                                    class="nx-qty-input"
                                    value="{{ $cantidad }}"
                                    min="1"
                                    max="{{ max(1, min(99, $p->stock)) }}"
                                    aria-label="Cantidad de {{ $p->nombre }}"
                                    required
                                >

                                <button
                                    type="button"
                                    class="nx-qty-btn nx-plus"
                                    aria-label="Aumentar cantidad"
                                >
                                    +
                                </button>

                            </div>

                            <span
                                class="nx-save-status small text-secondary"
                                aria-live="polite"
                            ></span>

                        </div>
                    </form>

                    <form
                        method="POST"
                        action="{{ route('carrito.remove', $p) }}"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="btn btn-outline-danger btn-sm"
                        >
                            Eliminar
                        </button>
                    </form>

                </div>

            </div>

        @empty

            <div class="panel text-center py-5">
                <h2 class="h4 fw-bold">
                    Tu carrito está vacío
                </h2>

                <p class="text-secondary">
                    Explora el catálogo y agrega tus favoritos.
                </p>

                <a
                    class="btn btn-primary"
                    href="{{ route('tienda.index') }}#catalogo"
                >
                    Explorar productos
                </a>
            </div>

        @endforelse

    </div>

    @if($productos->count())

        <div class="col-lg-4">

            <div class="panel nx-summary">

                <h2 class="h5 fw-bold mb-3">
                    Resumen del pedido
                </h2>

                <hr>

                <div class="d-flex justify-content-between align-items-center">

                    <span>Subtotal</span>

                    <strong
                        id="carrito-total"
                        class="fs-5 text-primary"
                    >
                        Q {{ number_format($total, 2) }}
                    </strong>

                </div>

                <p class="nx-mini mt-3">
                    El costo de envío se confirma por separado
                    según el destino.
                </p>

                <p id="carrito-error"
                   class="small text-danger d-none"
                   role="alert"></p>

                <a
                    id="checkout-btn"
                    class="btn btn-primary w-100 mt-2"
                    href="{{ route('checkout') }}"
                >
                    Continuar compra →
                </a>

                <a
                    class="btn btn-outline-primary w-100 mt-2"
                    href="{{ route('tienda.index') }}#catalogo"
                >
                    Seguir comprando
                </a>

            </div>

        </div>

    @endif

</div>

@endsection


@push('styles')
<style>

    /* CONTROLES DE CANTIDAD */

    .nx-quantity-control {
        display: flex;
        align-items: center;
        border: 1px solid #dce8f5;
        border-radius: 12px;
        overflow: hidden;
        background: white;
    }

    .nx-qty-btn {
        width: 40px;
        height: 42px;
        border: none;
        background: #eef5ff;
        color: #0759b6;
        font-size: 22px;
        font-weight: 700;
        cursor: pointer;
        transition: background .2s;
    }

    .nx-qty-btn:hover:not(:disabled) {
        background: #d6eaff;
    }

    .nx-qty-btn:disabled {
        opacity: .4;
        cursor: not-allowed;
    }

    .nx-qty-input {
        width: 55px;
        height: 42px;
        border: none;
        text-align: center;
        font-weight: 700;
        color: #112946;
        outline-offset: -2px;
        appearance: textfield;
        -moz-appearance: textfield;
    }

    .nx-qty-input::-webkit-inner-spin-button,
    .nx-qty-input::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .nx-cart-item {
        transition: box-shadow .2s ease;
    }

    .nx-cart-item:hover {
        box-shadow: 0 8px 25px rgba(6, 61, 134, .08);
    }

    .nx-save-status {
        font-size: .75rem;
    }

    @media(max-width: 575px) {
        .nx-qty-btn {
            width: 36px;
        }
    }

</style>
@endpush


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {

    const moneda = new Intl.NumberFormat('es-GT', {
        style: 'currency',
        currency: 'GTQ',
        minimumFractionDigits: 2
    });

    const checkoutBtn = document.getElementById('checkout-btn');
    const errorBox = document.getElementById('carrito-error');

    // Obtener todos los artículos del carrito.
    const items = document.querySelectorAll('.nx-cart-item');

    let solicitudesPendientes = 0;

    function formatear(valor) {
        return moneda.format(valor).replace('GTQ', 'Q').trim();
    }

    function bloquearCheckout() {
        if (!checkoutBtn) return;

        checkoutBtn.classList.toggle(
            'disabled',
            solicitudesPendientes > 0
        );

        checkoutBtn.setAttribute(
            'aria-disabled',
            solicitudesPendientes > 0 ? 'true' : 'false'
        );
    }

    function recalcularTotal() {

        let total = 0;

        items.forEach(item => {

            const precio = Number(item.dataset.precio);
            const input = item.querySelector('.nx-qty-input');
            const cantidad = Number(input.value) || 1;

            const subtotal = precio * cantidad;
            total += subtotal;

            item.querySelector('.nx-line-total').textContent =
                formatear(subtotal);
        });

        const totalElemento = document.getElementById('carrito-total');

        if (totalElemento) {
            totalElemento.textContent = formatear(total);
        }
    }

    items.forEach(item => {

        const form = item.querySelector('.nx-quantity-form');
        const input = item.querySelector('.nx-qty-input');
        const menos = item.querySelector('.nx-minus');
        const mas = item.querySelector('.nx-plus');
        const estado = item.querySelector('.nx-save-status');

        let temporizador = null;
        let guardando = false;
        let guardarDespues = false;
        let ultimaCantidadGuardada = Number(input.value);

        function limitarCantidad() {
            const min = Number(input.min) || 1;
            const max = Number(input.max) || 99;

            let cantidad = Number(input.value);

            if (!Number.isFinite(cantidad)) {
                cantidad = min;
            }

            cantidad = Math.round(cantidad);
            cantidad = Math.max(min, Math.min(max, cantidad));

            input.value = cantidad;

            menos.disabled = cantidad <= min;
            mas.disabled = cantidad >= max;

            return cantidad;
        }

        async function guardarCantidad() {

            if (guardando) {
                guardarDespues = true;
                return;
            }

            const cantidad = limitarCantidad();

            if (cantidad === ultimaCantidadGuardada) {
                return;
            }

            guardando = true;
            solicitudesPendientes++;
            bloquearCheckout();

            estado.textContent = 'Guardando...';

            try {

                const datos = new FormData(form);

                const respuesta = await fetch(form.action, {
                    method: 'POST',
                    body: datos,
                    credentials: 'same-origin',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (!respuesta.ok) {
                    throw new Error('No se pudo guardar la cantidad.');
                }

                const tipo = respuesta.headers.get('content-type') || '';

                if (!tipo.includes('application/json')) {
                    throw new Error('Respuesta inesperada del servidor.');
                }

                const resultado = await respuesta.json();

                if (resultado.success !== true) {
                    throw new Error(
                        resultado.message || 'No se pudo actualizar.'
                    );
                }

                ultimaCantidadGuardada = cantidad;

                estado.textContent = 'Guardado';

                if (errorBox) {
                    errorBox.classList.add('d-none');
                }

            } catch (error) {

                estado.textContent = 'Error al guardar';

                if (errorBox) {
                    errorBox.textContent =
                        'No se pudo guardar un cambio. Actualiza la página antes de comprar.';
                    errorBox.classList.remove('d-none');
                }

                if (checkoutBtn) {
                    checkoutBtn.classList.add('disabled');
                    checkoutBtn.setAttribute('aria-disabled', 'true');
                }

            } finally {

                guardando = false;
                solicitudesPendientes--;

                if (guardarDespues) {
                    guardarDespues = false;
                    guardarCantidad();
                } else if (Number(input.value) !== ultimaCantidadGuardada) {
                    guardarCantidad();
                } else if (!errorBox || errorBox.classList.contains('d-none')) {
                    bloquearCheckout();
                }
            }
        }

        function actualizar() {
            limitarCantidad();
            recalcularTotal();

            clearTimeout(temporizador);
            temporizador = setTimeout(guardarCantidad, 350);
        }

        menos.addEventListener('click', () => {
            input.value = Number(input.value) - 1;
            actualizar();
        });

        mas.addEventListener('click', () => {
            input.value = Number(input.value) + 1;
            actualizar();
        });

        input.addEventListener('change', actualizar);

        form.addEventListener('submit', event => {
            event.preventDefault();
            actualizar();
        });

        limitarCantidad();
    });

    if (checkoutBtn) {
        checkoutBtn.addEventListener('click', event => {
            const hayError =
                errorBox && !errorBox.classList.contains('d-none');

            if (solicitudesPendientes > 0 || hayError) {
                event.preventDefault();
            }
        });
    }

    recalcularTotal();

});
</script>
@endpush
