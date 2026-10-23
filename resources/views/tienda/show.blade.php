@extends('layouts.tienda')
@section('title', $producto->nombre)
@section('content')
<a href="{{ route('tienda.index') }}#catalogo" class="d-inline-block mb-4">← Volver al catálogo</a>
@php
    $foto = $producto->imagenes->sortByDesc('principal')->first()?->ruta;
    $fotoUrl = null;
    if (is_string($foto) && trim($foto) !== '') {
        $ruta = trim($foto);
        $fotoUrl = \Illuminate\Support\Str::startsWith($ruta, ['https://','http://']) ? $ruta
            : (\Illuminate\Support\Str::startsWith($ruta,'demo/') ? asset('img/productos/'.basename($ruta))
            : asset('storage/'.ltrim(preg_replace('#^/?storage/#','',$ruta),'/')));
    }
@endphp
<div class="row g-4 align-items-start">
    <div class="col-lg-6">
        <div class="panel text-center">
            @if($fotoUrl)
                <img style="width:100%;max-height:470px;object-fit:contain" src="{{ $fotoUrl }}" alt="{{ $producto->nombre }}" onerror="this.style.display='none'">
            @else
                <div class="py-5 text-muted">Imagen no disponible</div>
            @endif
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel">
            <span class="category-badge mb-3">{{ $producto->categoria?->nombre ?? 'General' }}</span>
            <h1 class="fw-bold mb-3">{{ $producto->nombre }}</h1>
            <div class="price fs-2 mb-3">Q {{ number_format((float)$producto->precio, 2) }}</div>
            <p class="text-secondary">{{ $producto->descripcion }}</p>
            <p class="nx-mini">Código: {{ $producto->sku }}</p>
            @if($producto->stock > 0)
                <p class="stock-ok">Disponible · {{ $producto->stock }} unidades en inventario</p>
                <form method="POST" action="{{ route('carrito.add', $producto) }}">
                    @csrf
                    <label for="cantidad" class="form-label fw-bold">Cantidad</label>
                    <div class="d-flex flex-wrap gap-2">
                        <input id="cantidad" class="form-control" type="number" name="cantidad" min="1" max="{{ min(99, $producto->stock) }}" value="1" style="max-width:110px" required>
                        <button type="submit" class="btn btn-primary flex-grow-1">Agregar al carrito</button>
                    </div>
                </form>
            @else
                <div class="alert alert-secondary">Producto agotado por el momento.</div>
            @endif
            <p class="nx-mini mt-4 mb-0">Los costos de envío se confirmarán al procesar el pedido en Guatemala.</p>
        </div>
    </div>
</div>
@endsection
