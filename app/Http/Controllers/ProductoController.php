<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Exception;

class ProductoController extends Controller
{
    public function index(): View
    {
        $productos = Producto::with(['categoria', 'user'])->get();
        $categorias = Categoria::all();
        $categoriasPorNombre = $categorias->keyBy('nombre');
        return view('index', compact('productos', 'categorias', 'categoriasPorNombre'));
    }

    public function dashboard(): View|RedirectResponse
    {
        if (Auth::user()->rol !== 'comerciante') {
            return redirect()->route('home')->with('error', 'No tienes permiso para acceder al dashboard.');
        }

        $productos = Producto::where('user_id', Auth::id())->with('categoria')->get();
        return view('dashboard', compact('productos'));
    }

    public function create(): View|RedirectResponse
    {
        if (Auth::user()->rol !== 'comerciante') {
            return redirect()->route('home')->with('error', 'No tienes permiso para crear productos.');
        }

        $categorias = Categoria::all();
        return view('productos.create', compact('categorias'));
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            if (Auth::user()->rol !== 'comerciante') {
                return redirect()->route('home')->with('error', 'No tienes permiso para crear productos.');
            }

        $validatedData = $request->validate([
                'nombre' => 'required|string|max:255',
                'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'categoria_id' => 'required|exists:categorias,id',
                'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'telefono' => 'required|string|max:255',
                'email_contacto' => 'required|email|max:255',
        ]);

            $producto = new Producto($validatedData);
            $producto->user_id = Auth::id();

            if ($request->hasFile('imagen')) {
                try {
                    $imagen = $request->file('imagen');
                    $nombreImagen = time() . '_' . uniqid() . '.' . $imagen->getClientOriginalExtension();
                    $rutaImagen = 'img/productos/' . $nombreImagen;
                    
                    // Asegurarse de que el directorio existe
                    if (!file_exists(public_path('img/productos'))) {
                        mkdir(public_path('img/productos'), 0755, true);
                    }
                    
                    // Mover la imagen
                    $imagen->move(public_path('img/productos'), $nombreImagen);
                    
                    // Verificar que la imagen se movió correctamente
                    if (file_exists(public_path($rutaImagen))) {
                        $producto->imagen = $rutaImagen;
                        Log::info('Imagen guardada exitosamente en: ' . $rutaImagen);
                    } else {
                        Log::error('Error al mover la imagen: No se encontró el archivo después de moverlo');
                        throw new Exception('Error al guardar la imagen');
                    }
                } catch (Exception $e) {
                    Log::error('Error al procesar la imagen: ' . $e->getMessage());
                    return redirect()->back()->with('error', 'Error al procesar la imagen. Por favor, intente nuevamente.');
                }
            }

        $producto->save();
            \Log::info('Antes de guardar contacto', [
                'producto_id' => $producto->id,
                'telefono' => $request->input('telefono'),
                'email_contacto' => $request->input('email_contacto')
            ]);

            $contacto = \App\Models\Contacto::updateOrCreate(
                ['producto_id' => $producto->id],
                [
                    'telefono' => $request->input('telefono'),
                    'email_contacto' => $request->input('email_contacto', Auth::user()->email)
                ]
            );

            \Log::info('Después de guardar contacto', [
                'contacto' => $contacto
            ]);

            Log::info('Producto creado exitosamente', ['producto_id' => $producto->id]);

            return redirect()->route('dashboard')->with('success', 'Producto creado exitosamente.');
        } catch (Exception $e) {
            Log::error('Error al crear producto: ' . $e->getMessage(), [
                'exception' => $e,
                'request_data' => $request->except(['imagen'])
            ]);
            return redirect()->back()->with('error', 'Error al crear el producto. Por favor, intente nuevamente.');
        }
    }

    public function edit(Producto $producto): View|RedirectResponse
    {
        if (Auth::user()->rol !== 'comerciante' || $producto->user_id !== Auth::id()) {
            return redirect()->route('home')->with('error', 'No tienes permiso para editar este producto.');
        }

        $categorias = Categoria::all();
        return view('productos.edit', compact('producto', 'categorias'));
    }

    public function update(Request $request, Producto $producto): RedirectResponse
    {
        try {
            if (Auth::user()->rol !== 'comerciante' || $producto->user_id !== Auth::id()) {
                return redirect()->route('home')->with('error', 'No tienes permiso para editar este producto.');
            }

        $validatedData = $request->validate([
                'nombre' => 'required|string|max:255',
                'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'categoria_id' => 'required|exists:categorias,id',
                'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'telefono' => 'nullable|string|max:255',
                'direccion' => 'nullable|string|max:255',
            ]);

            if ($request->hasFile('imagen')) {
                // Eliminar imagen anterior si existe
                if ($producto->imagen && file_exists(public_path($producto->imagen))) {
                    unlink(public_path($producto->imagen));
                }

                $imagen = $request->file('imagen');
                $nombreImagen = time() . '.' . $imagen->getClientOriginalExtension();
                $imagen->move(public_path('img/productos'), $nombreImagen);
                $validatedData['imagen'] = 'img/productos/' . $nombreImagen;
            }

            // Actualizar producto
        $producto->update($validatedData);

            \Log::info('Antes de guardar contacto (update)', [
                'producto_id' => $producto->id,
                'telefono' => $request->input('telefono'),
                'email_contacto' => $request->input('email_contacto')
            ]);

            $contacto = \App\Models\Contacto::updateOrCreate(
                ['producto_id' => $producto->id],
                [
                    'telefono' => $request->input('telefono'),
                    'email_contacto' => $request->input('email_contacto', Auth::user()->email)
                ]
            );

            \Log::info('Después de guardar contacto (update)', [
                'contacto' => $contacto
            ]);

            return redirect()->route('dashboard')->with('success', 'Producto y datos de contacto actualizados exitosamente.');
        } catch (Exception $e) {
            Log::error('Error al actualizar producto: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->with('error', 'Error al actualizar el producto. Por favor, intente nuevamente.');
        }
    }

    public function destroy(Producto $producto): \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
    {
        try {
            if (Auth::user()->rol !== 'comerciante' || $producto->user_id !== Auth::id()) {
                $mensaje = 'No tienes permiso para eliminar este producto.';
                if (request()->wantsJson()) {
                    return response()->json(['success' => false, 'message' => $mensaje], 403);
                }
                return redirect()->route('home')->with('error', $mensaje);
            }

            // Eliminar imagen si existe
            if ($producto->imagen && file_exists(public_path($producto->imagen))) {
                unlink(public_path($producto->imagen));
            }

        $producto->delete();

            if (request()->wantsJson()) {
                return response()->json(['success' => true, 'message' => 'Producto eliminado correctamente.']);
            }

            return redirect()->route('dashboard')->with('success', 'Producto eliminado exitosamente.');
        } catch (Exception $e) {
            \Log::error('Error al eliminar producto: ' . $e->getMessage(), ['exception' => $e]);
            if (request()->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Error al eliminar el producto.'], 500);
            }
            return redirect()->back()->with('error', 'Error al eliminar el producto. Por favor, intente nuevamente.');
    }
    }

    public function porCategoria($id)
    {
        $categoria = Categoria::findOrFail($id);
        $productos = Producto::where('categoria_id', $id)->with(['categoria', 'user', 'contacto'])->get();
        $categorias = Categoria::all();
        return view('productos.por_categoria', compact('categoria', 'productos', 'categorias'));
    }
}