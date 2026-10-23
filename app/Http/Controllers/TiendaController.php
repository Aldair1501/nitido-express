<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
    // Página principal de la tienda
    public function index(Request $request)
    {
        // Obtener categorías activas
        $categorias = Categoria::where('activa', true)
            ->orderBy('nombre')
            ->get();

        // Consultar los productos activos
        $query = Producto::with([
            'categoria',
            'imagenes' => function ($q) {
                $q->orderByDesc('principal')
                  ->orderBy('orden');
            }
        ])->where('activo', true);

        // FILTRO 1: Buscar por nombre, descripción o SKU
        if ($request->filled('buscar')) {

            $buscar = mb_substr(
                trim($request->input('buscar')),
                0,
                100
            );

            $query->where(function ($q) use ($buscar) {
                $q->where('nombre', 'LIKE', "%{$buscar}%")
                  ->orWhere('descripcion', 'LIKE', "%{$buscar}%")
                  ->orWhere('sku', 'LIKE', "%{$buscar}%");
            });
        }

        // FILTRO 2: Buscar por ID de categoría
        if ($request->filled('categoria')) {

            $categoriaId = $request->input('categoria');

            $query->where(
                'categoria_id',
                $categoriaId
            );
        }

        // Obtener resultados paginados
        $productos = $query
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();

        return view('tienda.index', compact(
            'categorias',
            'productos'
        ));
    }

    // Mostrar detalle de un producto
    public function show(Producto $producto)
    {
        abort_unless($producto->activo, 404);

        $producto->load([
            'categoria',
            'imagenes'
        ]);

        return view('tienda.show', compact('producto'));
    }
}
