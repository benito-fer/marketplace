<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Marketplace Álora')</title>
    <link rel="stylesheet" href="/css/styles.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div id="notificacion" style="display:none;position:fixed;top:30px;left:50%;transform:translateX(-50%);z-index:9999;min-width:300px;max-width:90vw;padding:16px 24px;border-radius:8px;font-size:1.1rem;text-align:center;box-shadow:0 2px 12px rgba(0,0,0,0.15);"></div>
    <header>
        <h1>Marketplace Álora</h1>
        <p style="margin:0;">@auth Bienvenido/a, {{ Auth::user()->name }} @endauth</p>
    </header>
    <nav>
        <a class="nav-link" href="{{ route('home') }}">Inicio</a>
        <a class="nav-link" href="{{ route('productos.mas_vistos') }}">Productos</a>
        <a class="nav-link" href="{{ route('categorias.todas') }}">Categorías</a>
        @auth
            <a class="nav-link" href="{{ route('perfil') }}">Mi Perfil</a>
            @if(Auth::user()->rol === 'comerciante')
                <a class="nav-link" href="{{ route('productos.create') }}">Crear Producto</a>
                <a class="nav-link" href="{{ route('dashboard') }}">Mi Panel</a>
            @endif
            <a class="nav-link" href="{{ route('logout') }}" id="btn-logout"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @else
            <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
            <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
        @endauth
    </nav>
    <div class="main-layout">
        <aside class="sidebar left">
            <div class="sidebar-widget calendar-widget almanaque">
                <div class="almanaque-header">
                    <span id="almanaque-mes"></span>
                    <span id="almanaque-ano"></span>
                </div>
                <div id="almanaque-dias"></div>
            </div>
        </aside>
        <main class="main-content">
            @yield('content')
        </main>
        <aside class="sidebar right">
            <div class="sidebar-widget weather-widget">
                <h3>El tiempo en Álora</h3>
                <iframe width="260" height="220" src="https://embed.windy.com/embed2.html?lat=36.822&lon=-4.705&detailLat=36.822&detailLon=-4.705&width=260&height=220&zoom=10&level=surface&overlay=wind&product=ecmwf&menu=&message=true&marker=&calendar=now&pressure=&type=map&location=coordinates&detail=&metricWind=default&metricTemp=default&radarRange=-1" frameborder="0" style="border-radius:10px;"></iframe>
            </div>
        </aside>
    </div>
    <footer style="position: fixed; bottom: 0; width: 100%; text-align: center; padding: 9px; background-color: #f8f9fa;">
        <p>&copy; 2025 Marketplace Álora. Todos los derechos reservados.</p>
        <p>Desarrollado por Beni</p>
    </footer>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const btnLogout = document.getElementById('btn-logout');
        if (btnLogout) {
            btnLogout.addEventListener('click', function (e) {
                e.preventDefault();
                fetch("{{ route('logout') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name=\'csrf-token\']').content,
                        "Accept": "application/json"
                    }
                })
                .then(res => res.json())
                .then(data => {
                    window.location.href = "{{ route('home') }}";
                });
            });
        }
    });
    </script>
    <script src="/js/notificaciones.js"></script>
    <script>
    function renderAlmanaque() {
        const meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        const diasSemana = ['L', 'M', 'X', 'J', 'V', 'S', 'D'];
        const now = new Date();
        const mes = now.getMonth();
        const ano = now.getFullYear();
        const diasEnMes = new Date(ano, mes+1, 0).getDate();
        const primerDia = (new Date(ano, mes, 1).getDay() + 6) % 7; // Lunes=0, Domingo=6

        document.getElementById('almanaque-mes').textContent = meses[mes];
        document.getElementById('almanaque-ano').textContent = ano;

        let html = '<div class="almanaque-grid dias-semana">';
        for(let d=0; d<7; d++) {
            html += `<div class="almanaque-dia-header">${diasSemana[d]}</div>`;
        }
        html += '</div>';

        html += '<div class="almanaque-grid">';
        for(let i=0; i<primerDia; i++) html += '<div class="almanaque-dia"></div>';
        for(let d=1; d<=diasEnMes; d++) {
            html += `<div class="almanaque-dia${d===now.getDate()?' hoy':''}">${d}</div>`;
        }
        html += '</div>';

        document.getElementById('almanaque-dias').innerHTML = html;
    }
    document.addEventListener('DOMContentLoaded', renderAlmanaque);
    </script>
</body>
</html>