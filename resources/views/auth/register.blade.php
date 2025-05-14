@extends('layouts.app')

@section('title', 'Marketplace Álora - Registrarse')

@section('content')
<div class="container">
    <div class="auth-container">
        <h2>Crear Cuenta</h2>
        
        <div id="register-errors" class="alert alert-danger" style="display: none; color: red; margin-bottom: 20px;"></div>
        
        <form id="register-form" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" id="name" name="name" required>
            </div>
            
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
            
            <div class="form-group">
                <label for="rol">Tipo de Cuenta</label>
                <select id="rol" name="rol" required>
                    <option value="cliente">Cliente</option>
                    <option value="comerciante">Comerciante</option>
                </select>
            </div>
            
            <button type="submit" class="btn-primary">Registrarse</button>
        </form>
        
        <div style="margin-top: 20px; text-align: center;">
            ¿Ya tienes cuenta? <a href="{{ route('login') }}">Iniciar Sesión</a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const registerForm = document.getElementById('register-form');
    const registerErrors = document.getElementById('register-errors');
    
    registerForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Clear previous errors
        registerErrors.style.display = 'none';
        registerErrors.textContent = '';
        
        const formData = new FormData(registerForm);
        
        fetch("{{ route('register') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                mostrarNotificacion(data.message);
                setTimeout(() => {
                    window.location.href = data.redirect;
                }, 1000);
            } else {
                // Display errors
                registerErrors.style.display = 'block';
                
                if (data.errors) {
                    const errorMessages = Object.values(data.errors).flat();
                    errorMessages.forEach(message => {
                        registerErrors.textContent += message + ' ';
                    });
                } else if (data.error) {
                    registerErrors.textContent = data.error;
                } else {
                    registerErrors.textContent = 'Error al registrarse. Inténtalo de nuevo.';
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            registerErrors.style.display = 'block';
            registerErrors.textContent = 'Error al comunicarse con el servidor. Inténtalo de nuevo.';
        });
    });
});
</script>
@endsection 