<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
<<<<<<< HEAD
=======
use Illuminate\Http\JsonResponse;
>>>>>>> master

class CategoriaController extends Controller
{
    /**
     * Devuelve un listado de todas las categorías.
     */
<<<<<<< HEAD
    public function index()
    {
        $categorias = DB::table('categorias')->get();
        return response()->json($categorias);
    }
}

=======
    public function index(): JsonResponse
    {
        try {
            $categorias = DB::table('categorias')->get();
            return response()->json($categorias);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener categorías', 'message' => $e->getMessage()], 500);
        }
    }
}
>>>>>>> master
