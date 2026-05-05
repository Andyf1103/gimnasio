# Spasso Gym

Sistema web de gestion para gimnasio construido con Laravel. La aplicacion centraliza el trabajo administrativo y operativo del negocio: control de usuarios, membresias, ventas, productos, empleados, roles y permisos.

## Resumen

Spasso Gym esta pensado para dos perfiles principales:

- `Administrador`: configura el sistema, gestiona empleados, roles, permisos, reportes y todos los modulos del negocio.
- `Empleado`: opera el dia a dia segun los permisos asignados a su rol.

El sistema incluye autenticacion por guard, control de acceso por roles y permisos, y menu lateral dinamico para mostrar solo los modulos que realmente puede usar cada usuario.

## Funcionalidades

- Inicio de sesion unificado para administradores y empleados.
- Dashboard independiente para admin y empleado.
- Gestion de usuarios/clientes.
- Registro y seguimiento de membresias.
- Renovacion y pagos parciales de membresias.
- Control fisico de usuarios.
- Gestion de planes.
- Gestion de productos y stock.
- Registro de ventas.
- Gestion de metodos de pago.
- Administracion de empleados.
- Asignacion de roles y permisos por modulo.
- Sidebar dinamico basado en permisos.
- Reportes para el area administrativa.

## Permisos y visibilidad

La aplicacion usa `spatie/laravel-permission` para controlar acceso por guard:

- Guard `admin` para administradores.
- Guard `employee` para empleados.

Comportamiento esperado:

- Si un rol no tiene permisos de un modulo, ese modulo no se muestra en el sidebar.
- Si un usuario intenta entrar a una ruta sin permiso, el sistema bloquea el acceso.
- Los roles de empleados se administran desde el panel de administracion.

## Stack Tecnologico

- PHP 8.2
- Laravel 11
- MySQL o MariaDB
- Laravel AdminLTE
- Spatie Laravel Permission
- DomPDF
- Vite
- Bootstrap
- Tailwind CSS
- Alpine.js

## Estructura Funcional

### Modulos principales

- `Usuarios`: registro, consulta, edicion y eliminacion de clientes.
- `Membresias`: alta, edicion, renovacion, pagos y consulta de estado.
- `Control de usuarios`: seguimiento fisico como peso, talla y avances.
- `Planes`: configuracion de planes comerciales.
- `Productos`: inventario y precios.
- `Ventas`: ventas de productos y trazabilidad de movimientos.
- `Metodos de pago`: administracion de medios de cobro.
- `Empleados`: alta y mantenimiento del personal.
- `Roles y permisos`: control granular por modulo para empleados.
- `Reportes`: informacion consolidada para administracion.

## Instalacion

### 1. Clonar el repositorio

```bash
git clone https://github.com/Andyf1103/gimnasio.git
cd gimnasio
```

### 2. Instalar dependencias

```bash
composer install
npm install
```

### 3. Configurar variables de entorno

```bash
cp .env.example .env
php artisan key:generate
```

Configura en `.env` los valores de base de datos, correo y demas servicios necesarios.

### 4. Ejecutar migraciones y seeders

```bash
php artisan migrate --seed
```

### 5. Crear enlace de almacenamiento

```bash
php artisan storage:link
```

### 6. Levantar el proyecto

```bash
php artisan serve
npm run dev
```

## Credenciales de prueba

Despues de correr los seeders base, el sistema crea usuarios de acceso inicial:

### Administrador

- Usuario: `cristiansanabria@gmail.com`
- Contrasena: `Cristian.2026*`

### Empleado

- Usuario: `recepcion@gimnasio.local`
- Contrasena: `Recep.2026*`
- Rol inicial: `Recepcionista`

## Flujo de trabajo recomendado

1. Ingresar como administrador.
2. Revisar o crear roles de empleados.
3. Asignar permisos por modulo.
4. Crear empleados y asociarles un rol.
5. Validar que cada empleado solo vea en el sidebar los modulos autorizados.

## Comandos utiles

```bash
php artisan test
php artisan optimize:clear
php artisan route:list
```

Compilacion de frontend:

```bash
npm run dev
npm run build
```

## Calidad y pruebas

El proyecto incluye pruebas automatizadas para validar comportamiento base del sistema, incluyendo acceso de empleados y generacion del menu segun permisos.

## Estado actual del proyecto

El sistema ya incorpora:

- control de acceso por guard,
- rutas protegidas por permisos,
- roles de empleados separados del guard de administracion,
- menu dinamico segun permisos,
- seeders base para admin, empleado y permisos.

## Proximos pasos sugeridos

- agregar mas pruebas de integracion por modulo,
- documentar flujos de caja y reportes,
- mejorar manejo de errores y mensajes de autorizacion,
- incorporar CI para pruebas automaticas en cada push.

## Contribucion

Si vas a colaborar en el proyecto:

- crea una rama por cambio,
- ejecuta pruebas antes de subir cambios,
- documenta nuevas variables, modulos o credenciales de desarrollo,
- evita mezclar cambios funcionales con refactors no relacionados.

## Licencia

Este proyecto se distribuye bajo la licencia MIT.
