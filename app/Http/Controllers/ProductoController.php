<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    /**
     * Devuelve un listado de productos con su comerciante y categoría.
     */
    public function index()
    {
        $productos = DB::table('productos')
            ->join('usuarios', 'productos.id_comerciante', '=', 'usuarios.id')
            ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
            ->select(
                'productos.id',
                'productos.nombre',
                'productos.descripcion',
                'productos.precio',
                'productos.imagen_url',
                'usuarios.nombre as comerciante',
                'categorias.nombre as categoria'
            )
            ->get();

        return response()->json($productos);
    }
    public function show($id)
{
    $producto = DB::table('productos')
        ->join('usuarios', 'productos.id_comerciante', '=', 'usuarios.id')
        ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
        ->select(
            'productos.id',
            'productos.nombre',
            'productos.descripcion',
            'productos.precio',
            'productos.imagen_url',
            'usuarios.nombre as comerciante',
            'categorias.nombre as categoria'
        )
        ->where('productos.id', $id)
        ->first();

    if (!$producto) {
        return response()->json(['mensaje' => 'Producto no encontrado'], 404);
    }

    return response()->json($producto);
}
public function porCategoria($id)
{
    $productos = DB::table('productos')
        ->join('usuarios', 'productos.id_comerciante', '=', 'usuarios.id')
        ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
        ->select(
            'productos.id',
            'productos.nombre',
            'productos.descripcion',
            'productos.precio',
            'productos.imagen_url',
            'usuarios.nombre as comerciante',
            'categorias.nombre as categoria'
        )
        ->where('productos.id_categoria', $id)
        ->get();

    return response()->json($productos);
}

}

