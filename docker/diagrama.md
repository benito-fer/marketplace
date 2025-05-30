graph TD
    actor[Usuario] --> Registrarse
    actor --> Login
    actor --> "Ver Productos"
    actor --> "Ver Categorías"
    actor --> "Ver Detalles de Producto"
    actor --> "Ver Clima Local"
    actor --> "Ver Calendario Eventos"
    actor --> "Gestionar Perfil"

    subgraph "Gestión de Comerciantes"
        actor_c[Comerciante] --> Registrarse
        actor_c --> Login
        actor_c --> "Publicar Producto"
        actor_c --> "Modificar Producto Propio"
        actor_c --> "Ver Productos Propios"
        actor_c --> "Gestionar Perfil"
    end

    subgraph "Administración del Sistema"
        actor_a[Administrador] --> Login
        actor_a --> "Gestionar Productos"
        actor_a --> "Gestionar Usuarios"
        actor_a --> "Gestionar Categorías"
        actor_a --> "Eliminar Productos"
        actor_a --> "Eliminar Usuarios"
        actor_a --> "Gestionar Perfil"
    end

    Registrarse <--- actor_c
    Registrarse <--- actor_a
    Login <--- actor_c
    Login <--- actor_a

    "Gestionar Productos" .> "Publicar Producto" : <<include>>
    "Gestionar Productos" .> "Modificar Producto Propio" : <<include>>
    "Gestionar Productos" .> "Ver Productos" : <<include>>

    "Gestionar Usuarios" .> "Gestionar Perfil" : <<include>>

    "Publicar Producto" --> "Ver Productos"
    "Modificar Producto Propio" --> "Ver Productos"
    "Gestionar Productos" --> "Ver Productos"

    "Eliminar Productos" .> "Gestionar Productos" : <<extend>>
    "Eliminar Usuarios" .> "Gestionar Usuarios" : <<extend>>