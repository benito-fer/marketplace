<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Exception;
<<<<<<< HEAD

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Usuario registrado exitosamente',
                'user' => $user
            ]);
=======
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return redirect()->route('home');
    }

    public function showRegisterForm()
    {
        return view('index');
    }

    public function register(Request $request): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'rol' => 'required|in:cliente,comerciante',
            ]);

            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'rol' => $validatedData['rol'],
            ]);

            Auth::login($user);

            if ($user->rol === 'comerciante') {
                return response()->json([
                    'success' => true,
                    'message' => 'Comerciante registrado. Redirigiendo...',
                    'redirect' => route('dashboard'),
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'rol' => $user->rol,
                    ]
                ], 200);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => 'Cliente registrado. Redirigiendo...',
                    'redirect' => route('home'),
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'rol' => $user->rol,
                    ]
                ], 200);
            }

>>>>>>> master
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
<<<<<<< HEAD
            return response()->json([
                'success' => false,
                'errors' => ['general' => 'Ocurrió un error inesperado.']
=======
            Log::error('Error during registration: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json([
                'success' => false,
                'errors' => ['general' => 'Ocurrió un error inesperado.'],
                'message' => $e->getMessage()
>>>>>>> master
            ], 500);
        }
    }

<<<<<<< HEAD
    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');
=======
    public function login(Request $request): JsonResponse
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
>>>>>>> master

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                $user = Auth::user();

<<<<<<< HEAD
                return response()->json([
                    'success' => true,
                    'message' => 'Inicio de sesión exitoso',
                    'user' => $user
                ]);
=======
                if ($user->rol === 'comerciante') {
                    return response()->json([
                        'success' => true,
                        'message' => 'Inicio de sesión exitoso. Redirigiendo...',
                        'redirect' => route('dashboard'),
                        'user' => [
                            'id' => $user->id,
                            'name' => $user->name,
                            'email' => $user->email,
                            'rol' => $user->rol,
                        ]
                    ], 200);
                } else {
                    return response()->json([
                        'success' => true,
                        'message' => 'Inicio de sesión exitoso. Redirigiendo...',
                        'redirect' => route('home'),
                        'user' => [
                            'id' => $user->id,
                            'name' => $user->name,
                            'email' => $user->email,
                            'rol' => $user->rol,
                        ]
                    ], 200);
                }
>>>>>>> master
            }

            return response()->json([
                'success' => false,
                'errors' => ['email' => 'Credenciales incorrectas']
<<<<<<< HEAD
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'errors' => ['general' => 'Error en el servidor.']
            ], 500);
        }
    }
}
=======
            ], 401);
        } catch (\Exception $e) {
            Log::error('Error during login: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json([
                'success' => false,
                'errors' => ['general' => 'Error al iniciar sesión.'],
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request): JsonResponse
    {
        try {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

            return response()->json([
                'success' => true,
                'message' => 'Sesión cerrada correctamente'
            ]);
        } catch (\Exception $e) {
            Log::error('Error during logout: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json([
                'success' => false,
                'message' => 'Error al cerrar sesión'
            ], 500);
}
    }

    public function perfil()
{
        $user = auth()->user();
        return view('perfil', compact('user'));
}

    public function actualizarPerfil(Request $request)
    {
        $user = auth()->user();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefono' => 'nullable|string|max:255',
            'direccion' => 'nullable|string|max:255',
        ]);
        $user->update($validated);
        return redirect()->route('perfil')->with('success', 'Perfil actualizado correctamente.');
}
}
>>>>>>> master
