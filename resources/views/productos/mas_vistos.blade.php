@extends('layouts.app')

@section('title', 'Marketplace Álora - Productos Destacados')

@section('content')
<div class="container">
    <section class="section active">
        <h2>Productos Destacados</h2>
        <p>Descubre los productos más populares en nuestro marketplace.</p>
        
        <div class="product-grid">
            @forelse($productos as $producto)
                <div class="product-card flip-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            @if($producto->imagen)
                                <img src="{{ asset($producto->imagen) }}" alt="Imagen del producto">
                            @endif
                            <h3>{{ $producto->nombre }}</h3>
                            <p>{{ $producto->descripcion }}</p>
                            <p class="precio">€{{ number_format($producto->precio, 2) }}</p>
                        </div>
                        <div class="flip-card-back">
                            <h4>{{ $producto->nombre }}</h4>
                            <p><strong>Precio:</strong> €{{ number_format($producto->precio, 2) }}</p>
                            <p><strong>Categoría:</strong> {{ $producto->categoria->nombre ?? 'Sin categoría' }}</p>
                            <p><strong>Comerciante:</strong> {{ $producto->user->name ?? '' }}</p>
                            <p><strong>Teléfono:</strong> {{ $producto->contacto->telefono ?? '' }}</p>
                            <p><strong>Email:</strong> {{ $producto->contacto->email_contacto ?? $producto->user->email ?? '' }}</p>
                            <a href="{{ route('categoria.productos', ['id' => $producto->categoria->id]) }}" class="btn btn-primary btn-sm" style="margin-top: 0.7rem; font-size: 0.95rem; padding: 0.5rem 1.1rem; min-width: unset; width: auto;">
                                Ver más de esta categoría
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p>No hay productos disponibles.</p>
            @endforelse
        </div>
    </section>
</div>
@endsection 