<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
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

            return $this->getRedirectResponse($user, 'Registro exitoso. Redirigiendo...');
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            Log::error('Error during registration: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json([
                'success' => false,
                'errors' => ['general' => 'Ocurrió un error inesperado.']
            ], 500);
        }
    }

    public function login(Request $request): JsonResponse
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                $user = Auth::user();

                return $this->getRedirectResponse($user, 'Inicio de sesión exitoso. Redirigiendo...');
            }

            return response()->json([
                'success' => false,
                'errors' => ['email' => 'Credenciales incorrectas']
            ], 401);
        } catch (Exception $e) {
            Log::error('Error during login: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json([
                'success' => false,
                'errors' => ['general' => 'Error al iniciar sesión.']
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
        } catch (Exception $e) {
            Log::error('Error during logout: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json([
                'success' => false,
                'message' => 'Error al cerrar sesión'
            ], 500);
        }
    }

    public function perfil()
    {
        $user = Auth::user();
        return view('perfil', compact('user'));
    }

    public function actualizarPerfil(Request $request)
    {
        try {
            $user = Auth::user();
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $user->id,
                'telefono' => 'nullable|string|max:255',
                'direccion' => 'nullable|string|max:255',
            ]);
            $user->update($validated);
            return redirect()->route('perfil')->with('success', 'Perfil actualizado correctamente.');
        } catch (ValidationException $e) {
            return redirect()->route('perfil')->withErrors($e->errors());
        } catch (Exception $e) {
            Log::error('Error al actualizar perfil: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->route('perfil')->with('error', 'Ocurrió un error al actualizar el perfil.');
        }
    }

    /**
     * Generate a redirect response based on the user's role.
     */
    private function getRedirectResponse(User $user, string $message): JsonResponse
    {
        $redirect = $user->rol === 'comerciante' ? route('dashboard') : route('home');
        return response()->json([
            'success' => true,
            'message' => $message,
            'redirect' => $redirect,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'rol' => $user->rol,
            ]
        ], 200);
    }
}
