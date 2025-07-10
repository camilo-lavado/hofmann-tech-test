# Hofmann Tech Test

Prueba técnica desarrollada con Laravel 12 que consume una API externa de Droguería Hofmann.  
Incluye un sistema de edición visual en modal y validaciones integradas.

---

## Tecnologías utilizadas

- Laravel 12.x
- Bootstrap 5.3 + Bootstrap Icons
- SweetAlert2
- JavaScript (ES6)
- API externa Hofmann (documentada vía Swagger)

---

## Funcionalidades

- **Listado dinámico** desde la API `/ListTableUsers`
- **Edición visual** mediante modal Bootstrap:
  - Selector desplegable de código (`/GetUsers`)
  - Validación de monto y fecha
  - Confirmación visual antes de enviar
  - Envío con `POST /SendUser`
- Mensajes visuales personalizados (éxito y error)
- Recarga automática posterior al envío

---

## Estructura relevante del proyecto

| Archivo / Carpeta                          | Descripción |
|-------------------------------------------|-------------|
| `routes/web.php`                           | Define las rutas `/` y `POST /send` |
| `app/Http/Controllers/UserController.php`  | Controlador principal con lógica de consumo API |
| `resources/views/usuarios.blade.php`       | Vista principal con tabla y modal |
| `public/js/app.js`                         | Lógica JS del modal y validaciones |

---

## Instrucciones de instalación y ejecución

```bash
git clone https://github.com/camilo-lavado/hofmann-tech-test.git
cd hofmann-tech-test
composer install
cp .env.example .env
```

Reemplazar el contenido del archivo `.env` por lo siguiente:

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

APP_LOCALE=es
APP_FALLBACK_LOCALE=es
APP_FAKER_LOCALE=es_CL

APP_MAINTENANCE_DRIVER=file

PHP_CLI_SERVER_WORKERS=4
BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_LEVEL=debug

DB_CONNECTION=null

SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

CACHE_STORE=array
QUEUE_CONNECTION=sync

REDIS_CLIENT=null

MAIL_MAILER=log
MAIL_HOST=localhost
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"
```

Luego ejecutar:

```bash
php artisan key:generate
php artisan serve
```

Abrir en el navegador: [http://127.0.0.1:8000](http://127.0.0.1:8000)

> Este proyecto **no requiere base de datos** para su funcionamiento.

---

## Capturas de pantalla

| Vista de tabla de usuarios | Modal de edición |
|----------------------------|------------------|
| ![Tabla](https://raw.githubusercontent.com/camilo-lavado/hofmann-tech-test/main/public/img/demo1.png) | ![Modal](https://raw.githubusercontent.com/camilo-lavado/hofmann-tech-test/main/public/img/demo2.png) |

---

## Autor

Desarrollado por [**Camilo Lavado**](https://github.com/camilo-lavado)  
Contacto: <camilolavado.it@gmail.com>
