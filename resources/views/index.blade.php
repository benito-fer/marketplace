@extends('layouts.app')

@section('title', 'Marketplace Álora - Inicio')

@section('content')
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

    function activarSeccionPorHash() {
        const hash = window.location.hash || '#inicio';
        document.querySelectorAll('.section').forEach(section => section.classList.remove('active'));
        const section = document.querySelector(hash);
        if (section) {
            section.classList.add('active');
            section.scrollIntoView({ behavior: 'smooth' });
        } else {
            // Si el hash no corresponde a ninguna sección, mostrar inicio
            document.getElementById('inicio').classList.add('active');
        }
    }
    document.addEventListener('DOMContentLoaded', activarSeccionPorHash);
    window.addEventListener('hashchange', activarSeccionPorHash);
</script>
    <section class="section active" id="inicio">
        <div class="hero">
            <img alt="Castillo de Álora" class="hero-image" src="./images/castillo-de-alora.jpg" />
            <div class="hero-text">
                <h2>Bienvenidos a Álora</h2>
                <p>Álora, conocido como "El Balcón del Guadalhorce", es un pintoresco pueblo malagueño famoso por su castillo árabe, sus empinadas calles y su rica cultura.</p>
                <p>La historia de Álora se remonta a la prehistoria en el Hoyo del Conde, a poco más de un kilómetro de la localidad...</p>
                <h2 style="text-align:center; margin-top: 2rem;">Fiestas y eventos destacados de Álora</h2>
                <ul class="tradition-list">
                    <li class="tradition-item">
                        <img alt="Feria de Álora" class="tradition-image" src="./images/feriaalora.jpeg" />
                        <div class="tradition-text">
                            <h3>La Feria de Álora</h3>
                            <p>Celebración anual que llena las calles de música, baile y gastronomía local durante varios días.</p>
                        </div>
                    </li>
                    <li class="tradition-item">
                        <img alt="Cruces de mayo" class="tradition-image" src="./images/crucesmayo.jpeg" />
                        <div class="tradition-text">
                            <h3>Cruces de mayo</h3>
                            <p>Festival de Verdiales celebrado el primer domingo de mayo en la Ermita de las Tres Cruces, con degustaciones y música tradicional.</p>
                        </div>
                    </li>
                    <li class="tradition-item">
                        <img alt="Día de la sopa perota" class="tradition-image" src="./images/sopaperota.jpeg" />
                        <div class="tradition-text">
                            <h3>El día de la sopa perota</h3>
                            <p>Fiesta popular dedicada a este plato típico de Álora, donde se reparte sopa gratis a los asistentes.</p>
                        </div>
                    </li>
                    <li class="tradition-item">
                        <img alt="Pan artesanal" class="tradition-image" src="./images/dulces.jpeg" />
                        <div class="tradition-text">
                            <h3>Elaboración artesanal de pan y dulces</h3>
                            <p>Tradición centenaria que mantiene vivos los hornos de leña y recetas de repostería transmitidas por generaciones.</p>
                        </div>
                    </li>
                    <li class="tradition-item">
                        <img alt="Semana Santa" class="tradition-image" src="./images/semanasanta.jpeg" />
                        <div class="tradition-text">
                            <h3>Semana Santa aloreña</h3>
                            <p>Conocida por "La Despedía", un momento único donde los portadores arrodillan los tronos en una emotiva ceremonia.</p>
                        </div>
                    </li>
                </ul>
                <p class="destacado">En nuestro marketplace podrás encontrar productos típicos elaborados por los artesanos y comerciantes de este maravilloso pueblo.</p>
            </div>
        </div>
    </section>
@endsection



