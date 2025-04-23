# 🏞️ Marketplace Álora

Marketplace Álora es una plataforma web desarrollada para promover productos locales del municipio de Álora, Málaga. Los comerciantes pueden publicar sus productos, y los usuarios pueden explorarlos organizados por categorías, conocer detalles, contactar directamente con el vendedor y conocer la riqueza artesanal y gastronómica de la región.

## 🌟 Características Principales

- Publicación de productos por comerciantes
- Visualización de productos organizados por categorías
- Búsqueda visual y detallada
- Navegación amigable entre secciones (Inicio, Productos, Categorías, Perfil)
- Autenticación de usuarios (Login / Registro / Logout)
- Contacto directo con el vendedor
- Elementos culturales y gastronómicos representados

## 🛠️ Tecnologías utilizadas

Laravel               - Framework backend PHP (MVC)
Blade                 - Plantillas HTML dinámicas
MySQL                 - Base de datos relacional
HTML / CSS / JS       - Interfaz de usuario
JavaScript            - Funcionalidades dinámicas del frontend
OpenWeatherMap        - API de clima (integrable)
Google Calendar       - API externa para eventos (futuro)

## 📲 Funcionalidades previstas

- Filtro por categoría
- Visualización de productos con imágenes
- Detalles ampliados del producto
- Área de usuario: ver perfil, cerrar sesión
- Comprobación de login para ver botones dinámicamente
- Actualización de imágenes por categoría de forma automática

## 🧪 Instalación para desarrollo

1. Clona el repositorio:
   git clone https://github.com/benito-fer/marketplace.git

2. Accede al directorio:
   cd marketplace

3. Instala dependencias:
   composer install
   npm install && npm run dev

4. Copia y configura el entorno:
   cp .env.example .env
   php artisan key:generate

5. Configura conexión MySQL en el archivo .env

6. Ejecuta migraciones (si están definidas):
   php artisan migrate

7. Inicia el servidor de desarrollo:
   php artisan serve

## 🎯 Objetivo del proyecto

El objetivo principal de Marketplace Álora es digitalizar el comercio local, visibilizando productos típicos del municipio y fomentando la conexión directa entre artesanos/comerciantes y ciudadanos.

## 🙋 Autor del proyecto

Desarrollado por: Beni Fernández
Contacto: ferrobenito28@hotmail.com
Ubicación: Álora, Málaga – España

## 📄 Licencia

Este proyecto es de código abierto bajo la licencia MIT. Uso libre para fines académicos y no comerciales.
