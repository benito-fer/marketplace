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
            Log::info('Intento de registro iniciado', [
                'email' => $request->email,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);

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

            Log::info('Registro exitoso', [
                'user_id' => $user->id,
                'email' => $user->email,
                'rol' => $user->rol,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);

            return $this->getRedirectResponse($user, 'Registro exitoso. Redirigiendo...');
        } catch (ValidationException $e) {
            Log::warning('Error de validación en registro', [
                'email' => $request->email,
                'errors' => $e->errors(),
                'ip' => $request->ip()
            ]);

            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            Log::error('Error durante el registro', [
                'error' => $e->getMessage(),
                'email' => $request->email,
                'ip' => $request->ip(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'errors' => ['general' => 'Ocurrió un error inesperado.']
            ], 500);
        }
    }

    public function login(Request $request): JsonResponse
    {
        try {
            Log::info('Intento de inicio de sesión', [
                'email' => $request->email,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);

            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                $user = Auth::user();

                Log::info('Inicio de sesión exitoso', [
                    'user_id' => $user->id,
                    'email' => $user->email,
                    'rol' => $user->rol,
                    'ip' => $request->ip(),
                    'user_agent' => $request->userAgent()
                ]);

                return $this->getRedirectResponse($user, 'Inicio de sesión exitoso. Redirigiendo...');
            }

            Log::warning('Intento de inicio de sesión fallido', [
                'email' => $request->email,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);

            return response()->json([
                'success' => false,
                'errors' => ['email' => 'Credenciales incorrectas']
            ], 401);
        } catch (Exception $e) {
            Log::error('Error durante el inicio de sesión', [
                'error' => $e->getMessage(),
                'email' => $request->email,
                'ip' => $request->ip(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'errors' => ['general' => 'Error al iniciar sesión.']
            ], 500);
        }
    }

    public function logout(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();
            
            Log::info('Cierre de sesión', [
                'user_id' => $user ? $user->id : null,
                'email' => $user ? $user->email : null,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return response()->json([
                'success' => true,
                'message' => 'Sesión cerrada correctamente'
            ]);
        } catch (Exception $e) {
            Log::error('Error durante el cierre de sesión', [
                'error' => $e->getMessage(),
                'ip' => $request->ip(),
                'trace' => $e->getTraceAsString()
            ]);

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
