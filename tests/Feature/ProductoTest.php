<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function un_comerciante_puede_crear_un_producto()
    {
        // Crear una categoría para el producto
        $categoria = Categoria::factory()->create();

        // Crear un usuario comerciante
        $user = User::factory()->create(['rol' => 'comerciante']);

        // Simular login y petición de creación de producto
        $response = $this->actingAs($user)->post('/productos', [
            'nombre' => 'Producto de prueba',
            'descripcion' => 'Descripción de prueba',
            'precio' => 10.50,
            'stock' => 5,
            'categoria_id' => $categoria->id,
        ]);

        // Verificar redirección y existencia en la base de datos
        $response->assertRedirect('/dashboard');
        $this->assertDatabaseHas('productos', [
            'nombre' => 'Producto de prueba',
            'user_id' => $user->id,
        ]);
    }
} 