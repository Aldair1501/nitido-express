<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    // Mostrar carrito
    public function index(Request $request)
    {
        $ids = array_keys(
            $request->session()->get('carrito', [])
        );

        $productos = Producto::with('imagenes')
            ->whereIn('id', $ids)
            ->where('activo', true)
            ->get();

        return view('carrito.index', compact('productos'));
    }

    // Agregar producto al carrito
   public function add(Request $request, Producto $producto)
{
    $datos = $request->validate([
        'cantidad' => 'nullable|integer|min:1|max:99',
    ]);

    abort_unless(
        $producto->activo && $producto->stock > 0,
        404
    );

    $carrito = $request->session()->get('carrito', []);

    $cantidadActual = (int) ($carrito[$producto->id] ?? 0);
    $cantidadNueva = (int) ($datos['cantidad'] ?? 1);

    $cantidadFinal = min(
        $cantidadActual + $cantidadNueva,
        $producto->stock,
        99
    );

    $carrito[$producto->id] = $cantidadFinal;

    $request->session()->put('carrito', $carrito);

    if ($request->expectsJson()) {
        return response()->json([
            'success' => true,
            'message' => 'Producto agregado al carrito.',
            'cantidadCarrito' => array_sum($carrito),
        ]);
    }

    return back()->with(
        'ok',
        'Producto agregado al carrito.'
    );
}

    // Actualizar cantidad automáticamente
    public function update(Request $request, Producto $producto)
    {
        $datos = $request->validate([
            'cantidad' => 'required|integer|min:1|max:99',
        ]);

        $cantidad = (int) $datos['cantidad'];

        $carrito = $request->session()->get('carrito', []);

        // Verificar que exista en el carrito
        if (!array_key_exists($producto->id, $carrito)) {

            $mensaje = 'El producto no está en el carrito.';

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $mensaje,
                ], 404);
            }

            return back()->withErrors([
                'carrito' => $mensaje,
            ]);
        }

        // Verificar disponibilidad y stock
        if (!$producto->activo || $cantidad > $producto->stock) {

            $mensaje = 'No hay suficientes existencias disponibles.';

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $mensaje,
                ], 422);
            }

            return back()->withErrors([
                'cantidad' => $mensaje,
            ]);
        }

        // Guardar nueva cantidad
        $carrito[$producto->id] = $cantidad;

        $request->session()->put('carrito', $carrito);

        // Respuesta para JavaScript
        if ($request->expectsJson()) {

            $total = 0;

            $productosCarrito = Producto::whereIn(
                'id',
                array_keys($carrito)
            )->where('activo', true)->get();

            foreach ($productosCarrito as $p) {
                $total += (float) $p->precio
                    * (int) ($carrito[$p->id] ?? 0);
            }

            return response()->json([
                'success' => true,
                'message' => 'Cantidad actualizada.',
                'cantidad' => $cantidad,
                'subtotal' => round(
                    (float) $producto->precio * $cantidad,
                    2
                ),
                'total' => round($total, 2),
            ]);
        }

        // Respuesta para formulario tradicional
        return back()->with(
            'ok',
            'Cantidad actualizada.'
        );
    }

    // Eliminar producto del carrito
    public function remove(Request $request, Producto $producto)
    {
        $carrito = $request->session()->get('carrito', []);

        unset($carrito[$producto->id]);

        $request->session()->put('carrito', $carrito);

        return back()->with(
            'ok',
            'Producto eliminado del carrito.'
        );
    }
}
