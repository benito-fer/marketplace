<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Marketplace Álora - Inicio</title>
    <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
    <header>
        <h1>Marketplace Álora</h1>
        <p>Compras locales, comunidad global</p>
        <div id="usuario-activo" style="margin-top: 10px;">
            @php use Illuminate\Support\Facades\Auth; @endphp
            @if (Auth::check())
                <span>Bienvenido, {{ Auth::user()->name }}</span>
            @endif
        </div>
    </header>

    @if (session('success'))
        <div class="alert alert-success" style="margin: 20px; color: green;">
            {{ session('success') }}
        </div>
    @endif

    <nav>
    <a class="nav-link" data-section="inicio" href="#">Inicio</a>

    <div class="dropdown">
        <a class="nav-link dropdown-toggle" href="#">Productos</a>
        <div class="dropdown-content">
            <a class="nav-link" data-section="productos" href="#">Productos más vistos</a>
            <a class="nav-link" data-section="categorias" href="#">Categorías</a>
        </div>
    </div>

    <!-- Menú dinámico controlado por JS -->
    <a class="nav-link" id="btn-login" data-section="login" href="#">Iniciar sesión</a>
    <a class="nav-link" id="btn-registro" data-section="registro" href="#">Registrarse</a>
    <a class="nav-link" id="btn-cuenta" data-section="mi-cuenta" href="#" style="display: none;">Mi cuenta</a>
    <a class="nav-link" id="btn-logout" href="#" onclick="cerrarCuenta()" style="display: none;">Cerrar sesión</a>
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
    </div>
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


    <section class="section" id="productos">
        <h2>Productos destacados</h2>
        <div class="product-grid">
            <div class="product-card flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="./images/pan.jpeg" alt="Pan artesanal" />
                        <h3>Pan artesanal</h3>
                        <p>Panadería Los Caballos</p>
                        <p>€3.50/Kg</p>
                    </div>
                    <div class="flip-card-back">
                        <h4>Contacto</h4>
                        <p>Tel: 600 123 111</p>
                        <p>Email: info@loscaballos.es</p>
                    </div>
                </div>
            </div>
            <div class="product-card flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="./images/miel.jpeg" alt="Miel local" />
                        <h3>Miel local</h3>
                        <p>Miel La Molina</p>
                        <p>€8.00/Kg</p>
                    </div>
                    <div class="flip-card-back">
                        <h4>Contacto</h4>
                        <p>Tel: 600 123 222</p>
                        <p>Email: contacto@lamolina.es</p>
                    </div>
                </div>
            </div>
            <div class="product-card flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="./images/quesos-tiernos.jpg" alt="Queso de cabra" />
                        <h3>Queso de cabra</h3>
                        <p>El LLano Jaral</p>
                        <p>€7.20/Kg</p>
                    </div>
                    <div class="flip-card-back">
                        <h4>Contacto</h4>
                        <p>Tel: 600 123 333</p>
                        <p>Email: ventas@llanojaral.com</p>
                    </div>
                </div>
            </div>
            <div class="product-card flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="./images/Aceitunas-aloreña.png" alt="Aceitunas Aloreñas" />
                        <h3>Aceitunas Aloreñas</h3>
                        <p>Bravo</p>
                        <p>€6.20/Kg</p>
                    </div>
                    <div class="flip-card-back">
                        <h4>Contacto</h4>
                        <p>Tel: 600 123 444</p>
                        <p>Email: pedidos@aceitunasbravo.es</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="categorias">
        <h2>Categorías</h2>
        <div class="product-grid">
            <div class="product-card flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="./images/pan.jpeg" alt="Alimentación" />
                        <h3>Alimentación</h3>
                        <p>Comida local y productos frescos</p>
                    </div>
                    <div class="flip-card-back">
                        <h4>Explora más</h4>
                        <p>Pan, frutas, embutidos, dulces...</p>
                        <a class="nav-link" data-section="cat-alimentacion" href="#">Ver más</a>
                    </div>
                </div>
            </div>
            <div class="product-card flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="./images/cosmetica.jpeg" alt="Cosmética" />
                        <h3>Cosmética</h3>
                        <p>Bienestar y belleza natural</p>
                    </div>
                    <div class="flip-card-back">
                        <h4>Explora más</h4>
                        <p>Jabones, cremas, aceites...</p>
                        <a class="nav-link" data-section="cat-cosmetica" href="#">Ver más</a>
                    </div>
                </div>
            </div>
            <div class="product-card flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="./images/ropa.jpeg" alt="Ropa" />
                        <h3>Ropa</h3>
                        <p>Moda para todas las estaciones</p>
                    </div>
                    <div class="flip-card-back">
                        <h4>Explora más</h4>
                        <p>Camisas, vestidos, chaquetas...</p>
                        <a class="nav-link" data-section="cat-ropa" href="#">Ver más</a>
                    </div>
                </div>
            </div>
            <div class="product-card flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="./images/zapatos.jpeg" alt="Zapatos" />
                        <h3>Zapatos</h3>
                        <p>Elegancia y comodidad</p>
                    </div>
                    <div class="flip-card-back">
                        <h4>Explora más</h4>
                        <p>Zapatillas, botas, calzado artesanal...</p>
                        <a class="nav-link" data-section="cat-zapatos" href="#">Ver más</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="cat-alimentacion">
        <h2>Productos de Alimentación</h2>
        <div class="product-grid">
            <div class="product-card flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="./images/pan.jpeg" alt="Pan artesanal" />
                        <h3>Pan artesanal</h3>
                        <p>Panadería Los Caballos</p>
                    </div>
                    <div class="flip-card-back">
                        <h4>Contacto</h4>
                        <p>Tel: 600 123 111</p>
                        <p>Email: info@loscaballos.es</p>
                    </div>
                </div>
            </div>
            <div class="product-card flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="./images/miel.jpeg" alt="Miel local" />
                        <h3>Miel local</h3>
                        <p>Miel La Molina</p>
                    </div>
                    <div class="flip-card-back">
                        <h4>Contacto</h4>
                        <p>Tel: 600 123 222</p>
                        <p>Email: contacto@lamolina.es</p>
                    </div>
                </div>
            </div>
            <div class="product-card flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="./images/quesos-tiernos.jpg" alt="Queso de cabra" />
                        <h3>Queso de cabra</h3>
                        <p>El LLano Jaral</p>
                    </div>
                    <div class="flip-card-back">
                        <h4>Contacto</h4>
                        <p>Tel: 600 123 333</p>
                        <p>Email: ventas@llanojaral.com</p>
                    </div>
                </div>
            </div>
            <div class="product-card flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="./images/Aceitunas-aloreña.png" alt="Aceitunas Aloreñas" />
                        <h3>Aceitunas Aloreñas</h3>
                        <p>Bravo</p>
                    </div>
                    <div class="flip-card-back">
                        <h4>Contacto</h4>
                        <p>Tel: 600 123 444</p>
                        <p>Email: pedidos@aceitunasbravo.es</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
   

<!-- Sección de Login (actualizada) -->
<section class="section" id="login">
    <div class="auth-container fade-in">
        <h2>Iniciar sesión</h2>
        <form id="formLogin" class="auth-form">
            <div class="form-group">
                <label for="loginEmail">Correo electrónico</label>
                <input type="email" id="loginEmail" name="email" autocomplete="email" placeholder="ejemplo@correo.com" required>
            </div>
            <div class="form-group">
                <label for="loginPassword">Contraseña</label>
                <input type="password" id="loginPassword" name="password" autocomplete="current-password" placeholder="********" required>
            </div>
            <button type="submit" class="btn-primary">Entrar</button>
        </form>
    </div>
</section>

<section class="section" id="registro">
    <div class="auth-container fade-in">
        <h2>Registrarse</h2>
        <form id="formRegistro" class="auth-form">
            <div class="form-group">
                <label for="registerName">Nombre completo</label>
                <input type="text" id="registerName" name="name" autocomplete="name" placeholder="Juan Pérez" required>
            </div>
            <div class="form-group">
                <label for="registerEmail">Correo electrónico</label>
                <input type="email" id="registerEmail" name="email" autocomplete="email" placeholder="ejemplo@correo.com" required>
            </div>
            <div class="form-group">
                <label for="registerPassword">Contraseña</label>
                <input type="password" id="registerPassword" name="password" autocomplete="new-password" placeholder="********" required>
            </div>
            <div class="form-group">
                <label for="registerPasswordConfirm">Confirmar contraseña</label>
                <input type="password" id="registerPasswordConfirm" name="password_confirmation" autocomplete="new-password" placeholder="********" required>
            </div>
            <button type="submit" class="btn-primary">Registrarse</button>
        </form>
    </div>
</section>

<section class="section" id="mi-cuenta">
    <div class="content" style="max-width: 500px; margin: auto; text-align: center;">
        <h2>Mi Cuenta</h2>
        <p><strong>Nombre:</strong> <span id="cuenta-nombre"></span></p>
        <p><strong>Email:</strong> <span id="cuenta-email"></span></p>
        <p><strong>Tipo de usuario:</strong> <span id="cuenta-tipo"></span></p>
        <button onclick="cerrarCuenta()" style="margin-top: 1rem;">Cerrar</button>
    </div>
</section>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Navegación entre secciones
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelectorAll('.section').forEach(section => section.classList.remove('active'));
            const sectionId = this.getAttribute('data-section');
            if (sectionId) {
                document.getElementById(sectionId).classList.add('active');
            }
            document.querySelectorAll('.nav-link').forEach(navLink => navLink.style.backgroundColor = '');
            this.style.backgroundColor = '#4CAF50';
        });
    });

    // Formulario de login
    const formLogin = document.getElementById("formLogin");
    if (formLogin) {
        formLogin.addEventListener("submit", function (e) {
            e.preventDefault();
            const email = this.email.value;
            const password = this.password.value;
            fetch("http://127.0.0.1:8000/login", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ email, password })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    localStorage.setItem("usuario", JSON.stringify(data.user));
                    alert(data.message);
                    location.href = "/";
                } else {
                    const errores = Object.values(data.errors).flat().join("\n");
                    alert("❌ " + errores);
                }
            });
        });
    }

    // Formulario de registro
    const formRegistro = document.getElementById("formRegistro");
    if (formRegistro) {
        formRegistro.addEventListener("submit", function (e) {
            e.preventDefault();
            const name = this.name.value;
            const email = this.email.value;
            const password = this.password.value;
            const password_confirmation = this.password_confirmation.value;
            fetch("http://127.0.0.1:8000/registro", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ name, email, password, password_confirmation })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    location.href = "/";
                } else {
                    const errores = Object.values(data.errors).join("\n");
                    alert("❌ " + errores);
                }
            });
        });
    }

    // Mostrar cuenta si el usuario está guardado
    const usuarioGuardado = localStorage.getItem("usuario");
    if (usuarioGuardado) {
        const user = JSON.parse(usuarioGuardado);
        document.getElementById("cuenta-nombre").textContent = user.name;
        document.getElementById("cuenta-email").textContent = user.email;
        document.getElementById("cuenta-tipo").textContent = user.tipo ?? "Cliente";

        document.querySelectorAll('.section').forEach(section => section.classList.remove('active'));
        document.getElementById("mi-cuenta").classList.add('active');
    }

    // Botón de acceso a cuenta desde menú
    const btnCuenta = document.getElementById("btn-cuenta");
    if (btnCuenta) {
        btnCuenta.addEventListener("click", () => {
            const usuario = JSON.parse(localStorage.getItem("usuario"));
            if (usuario) {
                document.getElementById("cuenta-nombre").textContent = usuario.name;
                document.getElementById("cuenta-email").textContent = usuario.email || "";
                document.getElementById("cuenta-tipo").textContent = usuario.tipo_usuario || "Usuario";
                document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
                document.getElementById("mi-cuenta").classList.add('active');
            } else {
                alert("No hay un usuario activo");
            }
        });
    }
    const usuario = localStorage.getItem("usuario");
    if (usuario) {
        document.getElementById("btn-login").style.display = "none";
        document.getElementById("btn-registro").style.display = "none";
        document.getElementById("btn-logout").style.display = "inline-block";
        const user = JSON.parse(usuario);
document.getElementById("btn-cuenta").textContent = `Hola, ${user.name}`;
document.getElementById("btn-cuenta").style.display = "inline-block";

    } else {
        document.getElementById("btn-login").style.display = "inline-block";
        document.getElementById("btn-registro").style.display = "inline-block";
        document.getElementById("btn-cuenta").style.display = "none";
        document.getElementById("btn-logout").style.display = "none";
    }

});

// ✅ Cierre de sesión
function cerrarCuenta() {
    fetch("http://127.0.0.1:8000/logout", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(() => {
        // Elimina usuario del localStorage
        localStorage.removeItem("usuario");
        alert("Sesión cerrada correctamente");

        // Oculta Mi cuenta y Cerrar sesión
        document.getElementById("btn-cuenta").style.display = "none";
        document.getElementById("btn-logout").style.display = "none";

        // Muestra Iniciar sesión y Registrarse
        document.getElementById("btn-login").style.display = "inline-block";
        document.getElementById("btn-registro").style.display = "inline-block";

        // Muestra la sección de login
        document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
        document.getElementById("login").classList.add('active');
    })
    .catch(error => {
        console.error("Error al cerrar sesión:", error);
        alert("No se pudo cerrar sesión correctamente.");
    });
}


</script>





<footer style="position: fixed; bottom: 0; width: 100%; text-align: center; padding: 10px; background-color: #f8f9fa;">
        <p>&copy; 2025 Marketplace Álora. Todos los derechos reservados.</p>
        <p>Desarrollado por Beni</p>
    </footer>
</body>

</html>




