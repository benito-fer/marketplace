<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    /**
     * Devuelve un listado de todas las categorías.
     */
    public function index()
    {
        $categorias = DB::table('categorias')->get();
        return response()->json($categorias);
    }
}

