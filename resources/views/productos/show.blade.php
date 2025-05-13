@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $producto->nombre }}</h1>
    <img src="{{ asset($producto->imagen) }}" alt="Imagen del producto" style="max-width: 300px;">
    <p>{{ $producto->descripcion }}</p>
    <p><strong>Precio:</strong> €{{ $producto->precio }}</p>
    <p><strong>Stock:</strong> {{ $producto->stock }}</p>
    <p><strong>Categoría:</strong> {{ $producto->categoria->nombre ?? 'Sin categoría' }}</p>
</div>

<section class="section" id="productos">
    <h2>Productos en {{ $categoria->nombre }}</h2>
    <div class="product-grid">
        @foreach($categoria->productos as $producto)
            <div class="product-card flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        @if($producto->imagen)
                            <img src="{{ asset($producto->imagen) }}" alt="Imagen del producto">
                        @endif
                        <h3>{{ $producto->nombre }}</h3>
                        <p>{{ $producto->descripcion }}</p>
                        <p>€{{ $producto->precio }}</p>
                    </div>
                    <div class="flip-card-back">
                        <h4>Detalles del Producto</h4>
                        <p><strong>Stock:</strong> {{ $producto->stock }}</p>
                        <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-primary">Ver Producto</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endsection