@extends('layouts.tienda')
@section('title', 'Inicio')
@push('styles')
<style>
.promo-layout{display:grid;grid-template-columns:minmax(0,2fr) minmax(0,1fr);gap:18px}.main-promo{border-radius:24px;overflow:hidden;min-height:435px;position:relative;background:#08488f}.main-promo .carousel,.main-promo .carousel-inner,.main-promo .carousel-item{height:100%}.slide-visual{height:435px;background-size:cover;background-position:center;position:relative;display:flex;align-items:center}.slide-visual:before{content:"";position:absolute;inset:0;background:linear-gradient(90deg,rgba(12,27,42,.84) 0%,rgba(12,27,42,.43) 55%,transparent 100%)}.slide-content{position:relative;color:white;padding:56px 64px;max-width:560px}.slide-content small{font-weight:800;text-transform:uppercase;letter-spacing:2px}.slide-content h1{font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:clamp(2rem,3.2vw,3.25rem);line-height:1.12;letter-spacing:-1.4px;margin:15px 0}.slide-content p{max-width:380px;color:#f0f4f9}.promo-cta{display:inline-block;background:#bfeaff;border-radius:12px;padding:12px 22px;color:#202638;font-weight:800}.promo-cta:hover{background:#e3f6ff;color:#202638}.side-promos{display:grid;grid-template-rows:1fr 1fr;gap:18px}.side-promo{border-radius:24px;overflow:hidden;position:relative;background-size:cover;background-position:center;min-height:206px;display:flex;align-items:center;padding:28px;color:#fff}.side-promo:before{content:"";position:absolute;inset:0;background:linear-gradient(90deg,#1e2334c9,transparent)}.side-promo > div{position:relative;max-width:65%}.side-promo h3{font-size:1.5rem;font-weight:800;letter-spacing:-.5px}.side-promo a{display:inline-flex;border-radius:10px;background:#fff;color:#212738;font-size:.85rem;font-weight:800;padding:8px 12px}.side-promo a:hover{background:#bfeaff}.trust-strip{background:#fff;border-radius:18px;padding:21px 24px;border:1px solid #e9ebf0}.trust-item{font-weight:700}.trust-item small{display:block;font-weight:400;color:#767d8e}.filter-card{padding:20px}.carousel-control-prev,.carousel-control-next{width:50px}.carousel-control-prev-icon,.carousel-control-next-icon{background-color:#24334a;border-radius:50%;background-size:55%;width:42px;height:42px}.carousel-indicators [data-bs-target]{width:9px;height:9px;border-radius:50%;border:0}.visual-label{background:#ffffff2b;border:1px solid #ffffff65;border-radius:50px;padding:6px 12px}.feature-card{height:100%}@media(max-width:992px){.promo-layout{grid-template-columns:1fr}.side-promos{grid-template-columns:1fr 1fr;grid-template-rows:1fr}.slide-content{padding:40px 54px}}@media(max-width:576px){.slide-visual{height:350px}.main-promo{min-height:350px}.slide-content{padding:36px}.side-promos{grid-template-columns:1fr}.side-promo{min-height:155px}.side-promo>div{max-width:85%}.trust-strip{gap:20px}.slide-content h1{font-size:2rem}}
</style>
@endpush
@section('content')
<section class="promo-layout mb-4 enter-up" aria-label="Promociones de Nítido Xpress">
    <div class="main-promo">
        <div id="promosNitido" class="carousel slide carousel-fade h-100" data-bs-ride="carousel" data-bs-interval="5500" data-bs-pause="hover">
            <div class="carousel-indicators"><button type="button" data-bs-target="#promosNitido" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Promoción 1"></button><button type="button" data-bs-target="#promosNitido" data-bs-slide-to="1" aria-label="Promoción 2"></button><button type="button" data-bs-target="#promosNitido" data-bs-slide-to="2" aria-label="Promoción 3"></button></div>
            <div class="carousel-inner">
                <div class="carousel-item active"><div class="slide-visual" style="background-image:url('https://images.unsplash.com/photo-1498049794561-7780e7231661?auto=format&fit=crop&w=1400&q=85')"><div class="slide-content"><small class="visual-label">Novedades en catálogo</small><h1>Encuentra lo que necesitas. En un solo lugar.</h1><p>Productos para tu día a día, con precios claros en quetzales.</p><a class="promo-cta" href="#catalogo">Explorar productos →</a></div></div></div>
                <div class="carousel-item"><div class="slide-visual" style="background-image:url('https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=1400&q=85')"><div class="slide-content"><small class="visual-label">Compra en línea</small><h1>Descubre nuestra selección de tecnología.</h1><p>Explora el catálogo y verifica la disponibilidad de cada artículo.</p><a class="promo-cta" href="#catalogo">Ver catálogo →</a></div></div></div>
                <div class="carousel-item"><div class="slide-visual" style="background-image:url('https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&w=1400&q=85')"><div class="slide-content"><small class="visual-label">Nítido Xpress Guatemala</small><h1>Tu próxima compra empieza aquí.</h1><p>Busca por categoría y encuentra artículos disponibles en segundos.</p><a class="promo-cta" href="#catalogo">Comprar ahora →</a></div></div></div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#promosNitido" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Anterior</span></button><button class="carousel-control-next" type="button" data-bs-target="#promosNitido" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Siguiente</span></button>
        </div>
    </div>
    <div class="side-promos">
        <div class="side-promo" style="background-image:url('https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=950&q=85')"><div><h3>Accesorios para todos los días</h3><a href="#catalogo">Ver productos →</a></div></div>
        <div class="side-promo" style="background-image:url('https://images.unsplash.com/photo-1503602642458-232111445657?auto=format&fit=crop&w=950&q=85')"><div><h3>Explora nuevas categorías</h3><a href="#catalogo">Descubrir →</a></div></div>
    </div>
</section>
<section class="trust-strip row g-3 mx-0 mb-5 fade-delay-1 enter-up" id="beneficios"><div class="col-md-4 trust-item">✓ Catálogo en línea<small>Busca y compara artículos</small></div><div class="col-md-4 trust-item">✓ Precios en quetzales<small>Información clara en cada producto</small></div><div class="col-md-4 trust-item">✓ Pedidos desde tu cuenta<small>Consulta el estado de tus compras</small></div></section>
<section id="catalogo"><div class="d-flex flex-wrap align-items-end justify-content-between gap-3 mb-4"><div><h2 class="section-title mb-1">Explora nuestros productos</h2><p class="section-subtitle mb-0">Encuentra artículos disponibles para comprar en Guatemala.</p></div><span class="badge text-bg-light border px-3 py-2">{{ $productos->total() }} productos</span></div>
    <div class="filter-card mb-4"><form method="GET" action="{{ route('tienda.index') }}"><div class="row g-3 align-items-end"><div class="col-md-5"><label class="form-label fw-bold" for="buscar">¿Qué estás buscando?</label><input id="buscar" name="buscar" type="search" class="form-control" value="{{ request('buscar') }}" placeholder="Buscar por nombre o descripción"></div><div class="col-md-4"><label class="form-label fw-bold" for="categoria">Categoría</label><select id="categoria" name="categoria" class="form-select"><option value="">Todas las categorías</option>@foreach($categorias as $categoria)<option value="{{ $categoria->id }}" @selected(request('categoria') == $categoria->id)>{{ $categoria->nombre }}</option>@endforeach</select></div><div class="col-md-3 d-grid"><button class="btn btn-primary" type="submit">Buscar productos</button></div></div></form></div>
    <div class="row g-4">
        @forelse($productos as $producto)
            @php
                $imagen = $producto->imagenes?->first()?->ruta ?? ($producto->imagen ?? null);
                $urlImagen = null;
                if (is_string($imagen) && trim($imagen) !== '') {
                    $ruta = trim($imagen);
                    $urlImagen = \Illuminate\Support\Str::startsWith($ruta, ['https://','http://'])
                        ? $ruta
                        : (\Illuminate\Support\Str::startsWith($ruta, 'demo/')
                            ? asset('img/productos/'.basename($ruta))
                            : asset('storage/'.ltrim(preg_replace('#^/?storage/#', '', $ruta), '/')));
                }
            @endphp
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <article class="product-card d-flex flex-column">
                    <a href="{{ route('producto.show', $producto) }}" class="product-image-wrap" aria-label="Ver {{ $producto->nombre }}">
                        @if($urlImagen)
                            <img class="product-image" src="{{ $urlImagen }}" alt="{{ $producto->nombre }}" loading="lazy" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                            <div class="product-placeholder" style="display:none">Imagen no disponible</div>
                        @else
                            <div class="product-placeholder">Imagen no disponible</div>
                        @endif
                    </a>
                    <div class="p-3 d-flex flex-column flex-grow-1">
                        <span class="align-self-start category-badge">{{ $producto->categoria?->nombre ?? 'General' }}</span>
                        <h3 class="product-title"><a href="{{ route('producto.show', $producto) }}">{{ $producto->nombre }}</a></h3>
                        <p class="product-description">{{ \Illuminate\Support\Str::limit($producto->descripcion ?? '', 75) }}</p>
                        <div class="mt-auto">
                            <div class="price mb-1">Q {{ number_format((float)$producto->precio, 2) }}</div>
                            <div class="mb-3">
                                @if($producto->stock > 0)
                                    <span class="stock-ok">● Disponible</span>
                                @else
                                    <span class="stock-out">● Agotado</span>
                                @endif
                            </div>
                            <div class="product-actions">
                                @if($producto->stock > 0)
                                  
                                
<form
    method="POST"
    action="{{ route('carrito.add', $producto) }}"
    class="form-agregar-carrito"
>
    @csrf

    <input type="hidden" name="cantidad" value="1">

    <button type="submit" class="btn btn-primary w-100">
        + Agregar al carrito
    </button>
</form>


                                @else
                                    <button type="button" class="btn btn-secondary" disabled>Agotado</button>
                                @endif
                                <a class="btn btn-outline-primary" href="{{ route('producto.show', $producto) }}" aria-label="Ver detalles de {{ $producto->nombre }}">Ver</a>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        @empty
            <div class="col-12"><div class="panel text-center py-5"><h4>No encontramos productos</h4><p class="text-muted mb-0">Prueba otra búsqueda o categoría.</p></div></div>
        @endforelse
    </div>
    <div class="mt-5">{{ $productos->links('pagination::bootstrap-5') }}</div>
</section>


@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const formularios = document.querySelectorAll('.form-agregar-carrito');

    console.log('Formularios del carrito encontrados:', formularios.length);

    formularios.forEach(function (formulario) {

        formulario.addEventListener('submit', async function (evento) {

            // Evitar recargar la página
            evento.preventDefault();

            const boton = formulario.querySelector('button[type="submit"]');

            if (!boton || boton.disabled) return;

            const textoOriginal = boton.innerHTML;

            boton.disabled = true;
            boton.textContent = 'Agregando...';

            try {
                const respuesta = await fetch(formulario.action, {
                    method: 'POST',
                    body: new FormData(formulario),
                    credentials: 'same-origin',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const datos = await respuesta.json();

                if (!respuesta.ok || datos.success !== true) {
                    throw new Error(
                        datos.message || 'No se pudo agregar el producto.'
                    );
                }

                // Actualizar contador de carrito
                const contador = document.getElementById('contador-carrito');

                if (contador) {
                    contador.textContent = datos.cantidadCarrito;
                }

                // Mostrar confirmación
                boton.textContent = '✓ Agregado al carrito';

            } catch (error) {

                console.error('Error al agregar:', error);

                boton.textContent = 'Error al agregar';

                alert(error.message);

            } finally {

                setTimeout(function () {
                    boton.innerHTML = textoOriginal;
                    boton.disabled = false;
                }, 1500);

            }

        });

    });

});
</script>
@endpush
