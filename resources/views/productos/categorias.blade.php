@extends('layouts.app')

@section('title', 'Marketplace Álora - Todas las Categorías')

@section('content')
<div class="container">
    <section class="section active">
        <h2>Todas las Categorías</h2>
        <p>Explora todas las categorías disponibles en nuestro marketplace.</p>
        
        <div class="grid">
            @forelse($categorias as $categoria)
                <div class="categoria-card">
                    <span class="categoria-icon">
                        @php
                            $icono = strtolower($categoria->nombre);
                            $iconosDisponibles = [
                                'alimentación' => 'alimentación.png',
                                'cosmética' => 'cosmética.png',
                                'ropa' => 'ropa.png',
                                'zapatos' => 'zapatos.png',
                                'hogar' => 'hogar.png',
                                'deportes' => 'deportes.png',
                                'electrónica' => 'electrónica.png',
                            ];
                            $iconoFile = $iconosDisponibles[$icono] ?? 'default.png';
                        @endphp
                        <img src="{{ asset('images/categorias/' . $iconoFile) }}" alt="{{ $categoria->nombre }}" style="width:56px; height:56px; object-fit:contain;">
                    </span>
                    <h3>{{ $categoria->nombre }}</h3>
                    <div class="categoria-info">
                        <p>{{ $categoria->descripcion }}</p>
                        <a href="{{ route('categoria.productos', ['id' => $categoria->id]) }}" class="btn-primary" style="display: inline-block; margin-top: 1rem; text-decoration: none;">
                            Ver Productos
                        </a>
                    </div>
                </div>
            @empty
                <p>No hay categorías disponibles.</p>
            @endforelse
        </div>
    </section>
</div>
@endsection 