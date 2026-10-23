<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductosDemoSeeder extends Seeder
{
    public function run(): void
    {
        $catalogo = [
            'Tecnología' => [
                ['Mouse inalámbrico', 89.00, 21, 'MOU-001', 'mouse.svg'],
                ['Audífonos Bluetooth', 179.00, 14, 'AUD-001', 'audifonos.svg'],
                ['Teclado mecánico', 299.00, 9, 'TEC-001', 'teclado.svg'],
                ['Bocina portátil', 225.00, 11, 'BOC-001', 'bocina.svg'],
            ],
            'Accesorios' => [
                ['Mochila urbana', 235.00, 13, 'MOC-001', 'mochila.svg'],
                ['Termo de acero', 95.00, 28, 'TER-001', 'termo.svg'],
                ['Reloj deportivo', 260.00, 7, 'REL-001', 'reloj.svg'],
                ['Gorra clásica', 75.00, 25, 'GOR-001', 'gorra.svg'],
            ],
            'Hogar' => [
                ['Lámpara LED', 115.00, 17, 'LAM-001', 'lampara.svg'],
                ['Organizador de escritorio', 69.00, 30, 'ORG-001', 'organizador.svg'],
                ['Taza de cerámica', 49.00, 20, 'TAZ-001', 'taza.svg'],
                ['Planta decorativa', 89.00, 8, 'PLA-001', 'planta.svg'],
            ],
        ];
        foreach ($catalogo as $categoriaNombre => $articulos) {
            $slugCategoria = Str::slug($categoriaNombre);
            DB::table('categorias')->updateOrInsert(['slug' => $slugCategoria], [
                'nombre' => $categoriaNombre, 'descripcion' => 'Selección de productos de '.$categoriaNombre,
                'activa' => true, 'updated_at' => now(),
            ]);
            $categoriaId = DB::table('categorias')->where('slug', $slugCategoria)->value('id');
            foreach ($articulos as [$nombre, $precio, $stock, $sku, $foto]) {
                $slug = Str::slug($nombre);
                // Los registros existentes conservan su precio y stock; evita sobrescribir datos reales.
                if (!DB::table('productos')->where('sku', $sku)->exists()) {
                    $id = DB::table('productos')->insertGetId([
                        'categoria_id' => $categoriaId, 'sku' => $sku, 'nombre' => $nombre,
                        'slug' => $slug, 'descripcion' => 'Calidad y buen precio para tus compras en Guatemala.',
                        'precio' => $precio, 'stock' => $stock, 'activo' => true,
                        'created_at' => now(), 'updated_at' => now(),
                    ]);
                    DB::table('producto_imagenes')->insert([
                        'producto_id' => $id, 'ruta' => 'demo/'.$foto, 'principal' => true,
                        'orden' => 0, 'created_at' => now(), 'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
