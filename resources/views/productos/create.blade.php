<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Marketplace Álora - Crear Producto</title>
    <link rel="stylesheet" href="/css/styles.css" />
</head>

<body>
    <header>
        <h1>Marketplace Álora</h1>
        <p>Crear Nuevo Producto</p>
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
        @if(session('error'))
            <div id="error-message" style="color: red; padding: 10px; border: 1px solid red; margin-bottom: 10px;">
                {{ session('error') }}
            </div>
            <script>
                setTimeout(() => {
                    const errorMessage = document.getElementById('error-message');
                    if (errorMessage) {
                        errorMessage.style.display = 'none';
                    }
                }, 5000);
            </script>
        @endif
        <section class="section active">
            <h2>Crear Nuevo Producto</h2>
            <div class="product-form-wrapper">
                <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data" class="product-form">
        @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre del Producto</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="precio">Precio (€)</label>
                        <input type="number" step="0.01" name="precio" id="precio" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" name="stock" id="stock" class="form-control" required>
        </div>
                    <div class="form-group">
                        <label for="categoria_id">Categoría</label>
                        <select name="categoria_id" id="categoria_id" class="form-control" required>
                            <option value="">Seleccione una categoría</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
        </div>
                    <div class="form-group">
                        <label for="imagen">Imagen del Producto</label>
                        <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*">
                        <small class="form-text text-muted">Formatos permitidos: JPG, JPEG, PNG, GIF. Tamaño máximo: 2MB</small>
        </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono de contacto</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono') }}">
                    </div>
                    <div class="form-group">
                        <label for="email_contacto">Email de contacto</label>
                        <input type="email" name="email_contacto" id="email_contacto" class="form-control" value="{{ old('email_contacto', Auth::user()->email) }}">
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Crear Producto</button>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
        </section>
    </div>

    <style>
        body {
            background: #f4f6f8;
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 80vh;
            padding-top: 40px;
        }
        .product-form-wrapper {
            width: 100%;
            max-width: 540px;
        }
        .product-form {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            padding: 32px 40px;
            width: 100%;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        .form-control {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }
        .form-actions {
            margin-top: 30px;
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .btn-primary {
            background-color: #007bff;
            color: white;
            font-weight: 600;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-secondary {
            background-color: #6c757d;
            color: white;
            text-decoration: none;
        }
        .btn-secondary:hover {
            background-color: #545b62;
        }
        .form-text {
            font-size: 14px;
            color: #6c757d;
            margin-top: 5px;
        }
        header {
            margin-bottom: 0;
        }
        nav {
            margin-bottom: 0;
        }
        h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 24px;
        }
    </style>
</body>
</html>

