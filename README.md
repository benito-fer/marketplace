# 🏪 Marketplace Álora

Marketplace Álora es una aplicación web desarrollada para impulsar el comercio local del municipio de Álora. Permite a los comerciantes publicar y gestionar productos, y a los residentes acceder fácilmente a las ofertas locales desde cualquier dispositivo. Está desarrollada como parte del módulo de **Proyecto Integrado** en el ciclo **2º DAM** por **Benito Fernández Mendoza**.

---

## 📌 Descripción general

En un contexto donde los pequeños negocios tienen dificultades para competir con grandes plataformas de comercio electrónico, Marketplace Álora ofrece una **solución digital accesible y adaptada a las necesidades reales del entorno rural/local**.

Esta plataforma no incluye un sistema de pagos integrado, sino que actúa como un escaparate para que los comerciantes muestren sus productos de forma ordenada y actualizada, con funcionalidades complementarias como calendario de eventos y clima local.

---

## 🎯 Objetivos del proyecto

- Fomentar el comercio local digitalizado en pueblos pequeños.
- Facilitar la gestión de productos y usuarios para comerciantes y administradores.
- Proveer una experiencia moderna y responsiva a los usuarios.
- Integrar APIs útiles para el contexto local (clima y calendario).

---

## 🛠️ Tecnologías utilizadas

| Componente      | Tecnología              |
|----------------|--------------------------|
| Frontend       | React.js                 |
| Backend        | PHP con Laravel          |
| Base de datos  | MySQL                    |
| Contenerización| Docker                   |
| APIs externas  | OpenWeatherMap, Google Calendar |
| Control de versiones | GitHub              |
| Despliegue     | Heroku o AWS             |

---

## 🧩 Funcionalidades principales

- Registro y login para usuarios, comerciantes y administradores.
- Publicación y gestión de productos por parte de los comerciantes.
- Visualización de productos por categorías.
- Panel de administrador para control de usuarios y pedidos.
- Visualización del clima local (API OpenWeatherMap).
- Calendario de eventos locales (API Google Calendar).
- Interfaz responsiva adaptada a móviles y ordenadores.

---

## 🗂️ Estructura del proyecto

| Carpeta       | Contenido                                                                      |
|---------------|---------------------------------------------------------------------------------|
| `/backend`    | Código Laravel: controladores, modelos, rutas y lógica del backend.            |
| `/frontend`   | Código React.js: componentes de interfaz, vistas y gestión de estado.          |
| `/database`   | Scripts de creación de base de datos MySQL y diagrama entidad-relación (ER).   |
| `/docker`     | Archivos de configuración para contenerización y despliegue con Docker.        |
| `/docs`       | Documentación técnica, funcional y manual de usuario.                          |
