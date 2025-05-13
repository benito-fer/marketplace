@extends('layouts.app')

@section('content')
   <!-- <header>
        <h1>Marketplace Álora</h1>
        <p>Productos en la categoría: <strong>{{ $categoria->nombre }}</strong></p>
        <nav>
            <a href="{{ route('home') }}" class="nav-link">Volver al Inicio</a>
        </nav>
    </header> -->
    <div class="container">
        <section class="section active">
            <h2>Productos en {{ $categoria->nombre }}</h2>
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
                                <p>€{{ $producto->precio }}</p>
                            </div>
                            <div class="flip-card-back">
                                <h4>{{ $producto->nombre }}</h4>
                                <p><strong>Precio:</strong> €{{ $producto->precio }}</p>
                                <p><strong>Comerciante:</strong> {{ $producto->user->name ?? '' }}</p>
                                <p><strong>Teléfono:</strong> {{ $producto->contacto->telefono ?? '' }}</p>
                                <p><strong>Email:</strong> {{ $producto->contacto->email_contacto ?? $producto->user->email ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>No hay productos en esta categoría.</p>
                @endforelse
            </div>
        </section>
    </div>
@endsection 