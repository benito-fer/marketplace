<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
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
                Log::warning('Intento de creación de producto por usuario no autorizado', [
                    'user_id' => Auth::id(),
                    'user_email' => Auth::user()->email,
                    'ip' => $request->ip()
                ]);
                return redirect()->route('home')->with('error', 'No tienes permiso para crear productos.');
            }

            Log::info('Intento de creación de producto', [
                'user_id' => Auth::id(),
                'user_email' => Auth::user()->email,
                'producto_nombre' => $request->nombre,
                'categoria_id' => $request->categoria_id,
                'ip' => $request->ip()
            ]);

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
                $imagen = $request->file('imagen');
                $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
                $imagen->move(public_path('images/productos'), $nombreImagen);
                $producto->imagen = $nombreImagen;
                
                Log::info('Imagen de producto guardada', [
                    'producto_id' => $producto->id,
                    'nombre_imagen' => $nombreImagen,
                    'tamaño' => $imagen->getSize(),
                    'tipo' => $imagen->getMimeType()
                ]);
            }

            $producto->save();

            $contacto = \App\Models\Contacto::updateOrCreate(
                ['user_id' => Auth::id()],
                [
                    'user_id' => Auth::id(),
                    'telefono' => $request->input('telefono'),
                    'email_contacto' => $request->input('email_contacto', Auth::user()->email)
                ]
            );

            Log::info('Producto creado exitosamente', [
                'producto_id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'stock' => $producto->stock,
                'categoria_id' => $producto->categoria_id,
                'user_id' => $producto->user_id,
                'contacto_id' => $contacto->id,
                'ip' => $request->ip()
            ]);

            return redirect()->route('dashboard')->with('success', 'Producto creado exitosamente.');
        } catch (Exception $e) {
            Log::error('Error al crear producto', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
                'request_data' => $request->except(['imagen', 'password']),
                'ip' => $request->ip(),
                'trace' => $e->getTraceAsString()
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
                ['user_id' => Auth::id()],
                [
                    'user_id' => Auth::id(),
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

    public function destroy(Producto $producto): RedirectResponse|\Illuminate\Http\JsonResponse
    {
        try {
            // Verificar permisos
            if (Auth::user()->rol !== 'comerciante' || $producto->user_id !== Auth::id()) {
                $mensaje = 'No tienes permiso para eliminar este producto.';
                if (request()->wantsJson()) {
                    return response()->json(['success' => false, 'message' => $mensaje], 403);
                }
                return redirect()->route('home')->with('error', $mensaje);
            }

            // Eliminar imagen si existe
            if ($producto->imagen && file_exists(public_path($producto->imagen))) {
                if (!unlink(public_path($producto->imagen))) {
                    Log::warning('No se pudo eliminar la imagen del producto: ' . $producto->imagen);
                }
            }

            // Eliminar el producto
            $producto->delete();

            // Respuesta según el tipo de solicitud
            if (request()->wantsJson()) {
                return response()->json(['success' => true, 'message' => 'Producto eliminado correctamente.']);
            }

            return redirect()->route('dashboard')->with('success', 'Producto eliminado exitosamente.');
        } catch (Exception $e) {
            Log::error('Error al eliminar producto: ' . $e->getMessage(), ['exception' => $e]);

            if (request()->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Error al eliminar el producto.'], 500);
            }

            return redirect()->back()->with('error', 'Error al eliminar el producto. Por favor, intente nuevamente.');
        }
    }

    public function porCategoria($id): View
    {
        try {
            // Validar que la categoría exista
            $categoria = Categoria::findOrFail($id);

            // Obtener productos relacionados
            $productos = Producto::where('categoria_id', $id)
                ->with(['categoria', 'user'])
                ->get();

            // Obtener todas las categorías para el menú
            $categorias = Categoria::all();

            return view('productos.por_categoria', compact('categoria', 'productos', 'categorias'));
        } catch (Exception $e) {
            Log::error('Error al obtener productos por categoría: ' . $e->getMessage(), ['exception' => $e]);
            abort(500, 'Error al cargar los productos de la categoría.');
        }
    }
    
    /**
     * Mostrar todas las categorías disponibles
     */
    public function todasCategorias(): View
    {
        try {
            $categorias = Categoria::all();
            return view('productos.categorias', compact('categorias'));
        } catch (Exception $e) {
            Log::error('Error al obtener todas las categorías: ' . $e->getMessage(), ['exception' => $e]);
            abort(500, 'Error al cargar las categorías.');
        }
    }
    
    /**
     * Mostrar los productos más vistos/destacados
     */
    public function productosMasVistos(): View
    {
        try {
            // Aquí podrías implementar lógica para mostrar los más vistos
            // Por ahora simplemente mostraremos todos los productos
            $productos = Producto::with(['categoria', 'user'])->get();
            return view('productos.mas_vistos', compact('productos'));
        } catch (Exception $e) {
            Log::error('Error al obtener productos más vistos: ' . $e->getMessage(), ['exception' => $e]);
            abort(500, 'Error al cargar los productos destacados.');
        }
    }
}
