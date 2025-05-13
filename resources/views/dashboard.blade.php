<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Marketplace Álora - Panel de Control</title>
    <link rel="stylesheet" href="css/styles.css" />
    <style>
        #notificacion {
            display:none;position:fixed;top:30px;left:50%;transform:translateX(-50%);z-index:9999;min-width:300px;max-width:90vw;padding:16px 24px;border-radius:8px;font-size:1.1rem;text-align:center;box-shadow:0 2px 12px rgba(0,0,0,0.15);
        }
    </style>
</head>

<body>
    <div id="notificacion"></div>
    <header>
        <h1>Marketplace Álora</h1>
        <p>Panel de Control</p>
        <div id="usuario-activo" style="margin-top: 10px;">
            @php use Illuminate\Support\Facades\Auth; @endphp
            @if (Auth::check())
                <span>Bienvenido/a, {{ Auth::user()->name }}</span>
            @endif
        </div>
    </header>

    <nav>
        <a href="{{ route('home') }}" class="nav-link">Volver al Inicio</a>
        <a href="{{ route('productos.create') }}" class="nav-link">Crear Producto</a>
        <a href="{{ route('dashboard') }}" class="nav-link">Mi Panel</a>
    </nav>

<div class="container">
    @if(session('success'))
            <div id="success-message" style="color: green; padding: 10px; border: 1px solid green; margin-bottom: 10px;">
                {{ session('success') }}
            </div>
            <script>
                setTimeout(() => {
                    const successMessage = document.getElementById('success-message');
                    if (successMessage) {
                        successMessage.style.display = 'none';
                    }
                }, 5000);
            </script>
    @endif

        <section class="section active">
            <h2>Mis Productos</h2>

    @if($productos->count())
                <div class="product-grid">
                @foreach($productos as $producto)
                    <div class="product-card flip-card" id="producto-{{ $producto->id }}">
                        <div class="flip-card-inner">
                            <div class="flip-card-front">
                                @if($producto->imagen)
                                    <img src="{{ asset($producto->imagen) }}" alt="Imagen del producto" style="max-width: 120px; display:block; margin:0 auto 10px;">
                                @endif
                                <h3>{{ $producto->nombre }}</h3>
                                <p>Precio: {{ $producto->precio }}€</p>
                            </div>
                            <div class="flip-card-back">
                                <h4>Acciones</h4>
                                <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning">Modificar</a>
                                <button class="btn btn-danger btn-eliminar-producto" data-id="{{ $producto->id }}">Eliminar</button>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
    @else
                <p>No tienes productos registrados todavía.</p>
    @endif
        </section>
</div>
<script>
function mostrarNotificacion(mensaje, tipo = 'success') {
    const noti = document.getElementById('notificacion');
    noti.textContent = mensaje;
    noti.style.backgroundColor = tipo === 'success' ? '#4caf50' : '#f44336';
    noti.style.color = '#fff';
    noti.style.display = 'block';
    noti.style.opacity = '1';
    setTimeout(() => {
        noti.style.transition = 'opacity 0.5s';
        noti.style.opacity = '0';
        setTimeout(() => { noti.style.display = 'none'; noti.style.transition = ''; }, 500);
    }, 3500);
}

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-eliminar-producto').forEach(btn => {
        btn.addEventListener('click', function () {
            if (!confirm('¿Estás seguro de que deseas eliminar este producto?')) return;
            const id = this.getAttribute('data-id');
            fetch(`/productos/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    _token: document.querySelector('meta[name="csrf-token"]').content
                })
            })
            .then(res => {
                if (!res.ok) throw new Error('No se pudo eliminar el producto');
                return res.json();
            })
            .then(data => {
                document.getElementById('producto-' + id).remove();
                mostrarNotificacion('Producto eliminado correctamente', 'success');
            })
            .catch(err => {
                mostrarNotificacion('Error al eliminar el producto', 'error');
            });
        });
    });
});
</script>
</body>
</html>
