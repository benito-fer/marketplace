# Manual de Usuario: Marketplace Álora

## 1. Descripción del Producto y Servicio

**Marketplace Álora** es una plataforma web diseñada para promover y digitalizar el comercio local del municipio de Álora, Málaga. Su propósito principal es visibilizar productos artesanales y gastronómicos típicos de la región, facilitando la conexión directa entre comerciantes y usuarios. La plataforma permite a los comerciantes publicar sus productos, organizados por categorías, y a los usuarios explorarlos, conocer detalles y contactar directamente con los vendedores. Está dirigida a comerciantes locales, artesanos, y ciudadanos interesados en productos auténticos de Álora.

## 2. Instrucciones de Instalación o Ejecución

### Requisitos Previos
- **Software**:
  - PHP >= 8.1
  - Composer (gestor de dependencias de PHP)
  - Node.js y npm (para compilar assets)
  - MySQL >= 5.7
  - Servidor web (Apache/Nginx) o servidor de desarrollo integrado de PHP
- **Hardware**:
  - Mínimo 2GB de RAM
  - 1GB de espacio en disco

### Opción 1: Instalación Tradicional
1. **Clonar el Repositorio**:
   ```bash
   git clone https://github.com/benito-fer/marketplace.git
   cd marketplace
   ```
2. **Instalar Dependencias**:
   ```bash
   composer install
   npm install && npm run dev
   ```
3. **Configurar el Entorno**:
   - Copiar el archivo de ejemplo de entorno:
     ```bash
     cp .env.example .env
     ```
   - Generar la clave de la aplicación:
     ```bash
     php artisan key:generate
     ```
   - Configurar la conexión a la base de datos MySQL en el archivo `.env`.
4. **Ejecutar Migraciones**:
   ```bash
   php artisan migrate
   ```
5. **Iniciar el Servidor de Desarrollo**:
   ```bash
   php artisan serve
   ```
   La aplicación estará disponible en `http://localhost:8000`.

### Opción 2: Instalación con Docker

#### Requisitos Previos
- Docker
- Docker Compose

#### Pasos de Instalación con Docker
1. **Clonar el Repositorio**:
   ```bash
   git clone https://github.com/benito-fer/marketplace.git
   cd marketplace
   ```

2. **Configurar Variables de Entorno**:
   - Copiar el archivo de ejemplo de entorno:
     ```bash
     cp .env.example .env
     ```
   - Configurar las variables de entorno en el archivo `.env`, especialmente las relacionadas con la base de datos:
     ```
     DB_CONNECTION=mysql
     DB_HOST=db
     DB_PORT=3306
     DB_DATABASE=marketplace
     DB_USERNAME=marketplace
     DB_PASSWORD=tu_contraseña
     ```

3. **Construir e Iniciar los Contenedores**:
   ```bash
   docker-compose up -d
   ```

4. **Instalar Dependencias y Configurar la Aplicación**:
   ```bash
   docker-compose exec app composer install
   docker-compose exec app php artisan key:generate
   docker-compose exec app php artisan migrate
   docker-compose exec app npm install && npm run dev
   ```

5. **Acceder a la Aplicación**:
   - La aplicación estará disponible en `http://localhost:8000`
   - phpMyAdmin estará disponible en `http://localhost:8080`

#### Comandos Docker Útiles
- **Ver logs de los contenedores**:
  ```bash
  docker-compose logs -f
  ```
- **Detener los contenedores**:
  ```bash
  docker-compose down
  ```
- **Reiniciar los contenedores**:
  ```bash
  docker-compose restart
  ```

## 3. Acceso y Funcionalidades Principales

### Acceso a la Aplicación
- Abre tu navegador y visita `http://localhost:8000` (o la URL configurada en tu servidor).
- Navega por las secciones principales: Inicio, Productos, Categorías y Perfil.

### Funcionalidades Principales
- **Publicación de Productos**: Los comerciantes pueden publicar productos con imágenes, descripciones y precios.
- **Visualización de Productos**: Los usuarios pueden explorar productos organizados por categorías.
- **Búsqueda y Filtrado**: Búsqueda visual y detallada de productos.
- **Autenticación**: Registro, inicio de sesión y cierre de sesión de usuarios.
- **Contacto Directo**: Comunicación directa con el vendedor.
- **Panel de Control**: Gestión de productos publicados (modificar, eliminar).

## 4. Interfaz de Usuario

### Navegación General
- **Inicio**: Página principal con resumen de productos destacados.
- **Productos**: Lista de productos disponibles, organizados por categorías.
- **Categorías**: Navegación por categorías de productos.
- **Perfil**: Gestión de la cuenta de usuario y productos publicados.

### Caso de Ejemplo: Publicar un Producto
1. Inicia sesión en tu cuenta.
2. Navega a "Crear Producto" desde el panel de control.
3. Completa el formulario con los detalles del producto (nombre, precio, descripción, imagen).
4. Guarda el producto. Ahora aparecerá en la lista de productos y podrás gestionarlo desde tu panel.

---

Este manual proporciona una guía básica para utilizar Marketplace Álora. Para más detalles, consulta la documentación completa del proyecto o contacta al autor: Beni Fernández (ferrobenito28@hotmail.com). 