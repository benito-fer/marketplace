<h1>Bienvenido a la tienda</h1>

@if (session('error'))
    <div style="color:red">{{ session('error') }}</div>
@endif
@if (session('success'))
    <div style="color:green">{{ session('success') }}</div>
@endif

<!-- Formularios eliminados para evitar login/registro tradicional aquí -->
