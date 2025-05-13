<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class CategoriaController extends Controller
{
    /**
     * Devuelve un listado de todas las categorías.
     */
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
