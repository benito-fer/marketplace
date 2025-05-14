@extends('layouts.app')

@section('title', 'Marketplace Álora - Iniciar Sesión')

@section('content')
<div class="container">
    <div class="auth-container">
        <h2>Iniciar Sesión</h2>
        
        <div id="login-errors" class="alert alert-danger" style="display: none; color: red; margin-bottom: 20px;"></div>
        
        <form id="login-form" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" class="btn-primary">Iniciar Sesión</button>
        </form>
        
        <div style="margin-top: 20px; text-align: center;">
            ¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate</a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('login-form');
    const loginErrors = document.getElementById('login-errors');
    
    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Clear previous errors
        loginErrors.style.display = 'none';
        loginErrors.textContent = '';
        
        const formData = new FormData(loginForm);
        
        fetch("{{ route('login.post') }}", {
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
                loginErrors.style.display = 'block';
                
                if (data.errors) {
                    const errorMessages = Object.values(data.errors).flat();
                    errorMessages.forEach(message => {
                        loginErrors.textContent += message + ' ';
                    });
                } else if (data.error) {
                    loginErrors.textContent = data.error;
                } else {
                    loginErrors.textContent = 'Error al iniciar sesión. Inténtalo de nuevo.';
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            loginErrors.style.display = 'block';
            loginErrors.textContent = 'Error al comunicarse con el servidor. Inténtalo de nuevo.';
        });
    });
});
</script>
@endsection 