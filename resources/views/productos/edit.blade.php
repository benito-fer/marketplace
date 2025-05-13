@extends('layouts.app')

@section('title', 'Editar producto')

@section('content')
<div class="container" style="max-width: 600px; margin: 40px auto;">
    <div class="card" style="padding: 2.5rem 2rem; border-radius: 14px; box-shadow: 0 4px 24px rgba(0,0,0,0.08); background: #fff;">
        <h2 style="text-align:center; margin-bottom: 2rem;">Editar producto</h2>
        <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <div class="form-group" style="margin-bottom: 1.5rem;">
            <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre', $producto->nombre) }}" class="form-control" required>
        </div>
            <div class="form-group" style="margin-bottom: 1.5rem;">
            <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" required style="min-height: 80px;">{{ old('descripcion', $producto->descripcion) }}</textarea>
            </div>
            <div class="row" style="display: flex; gap: 1rem;">
                <div class="form-group" style="flex:1; margin-bottom: 1.5rem;">
                    <label for="precio" class="form-label">Precio (€)</label>
                    <input type="number" step="0.01" name="precio" value="{{ old('precio', $producto->precio) }}" class="form-control" required>
                </div>
                <div class="form-group" style="flex:1; margin-bottom: 1.5rem;">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" name="stock" value="{{ old('stock', $producto->stock) }}" class="form-control" required>
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label for="categoria_id" class="form-label">Categoría</label>
                <select name="categoria_id" class="form-control" required>
                    <option value="">Seleccione una categoría</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}" @if(old('categoria_id', $producto->categoria_id) == $categoria->id) selected @endif>{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label for="imagen" class="form-label">Imagen del producto</label>
                @if($producto->imagen)
                    <div style="margin-bottom:10px;">
                        <img src="{{ asset($producto->imagen) }}" alt="Imagen actual" style="max-width: 120px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                    </div>
                @endif
                <input type="file" name="imagen" class="form-control">
                <small class="form-text text-muted">Deja vacío para mantener la imagen actual.</small>
            </div>
            <hr style="margin: 2rem 0;">
            <h4 style="margin-bottom: 1.2rem;">Datos de contacto del comerciante</h4>
            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label for="telefono" class="form-label">Teléfono de contacto</label>
                <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $producto->contacto->telefono ?? '') }}">
        </div>
            <div class="form-group" style="margin-bottom: 2rem;">
                <label for="email_contacto" class="form-label">Email de contacto</label>
                <input type="email" name="email_contacto" class="form-control" value="{{ old('email_contacto', $producto->contacto->email_contacto ?? Auth::user()->email) }}">
        </div>
            <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                <button type="submit" class="btn btn-success" style="padding: 0.7rem 2.2rem;">Actualizar</button>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary" style="padding: 0.7rem 2.2rem;">Cancelar</a>
        </div>
    </form>
    </div>
</div>
@endsection

