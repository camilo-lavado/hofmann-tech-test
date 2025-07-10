# Hofmann Tech Test

Prueba técnica desarrollada con Laravel 12 que consume una API externa de Droguería Hofmann.  
Incluye un sistema de edición visual en modal y validaciones.

## Tecnologías utilizadas

- Laravel 12.x
- Bootstrap 5.3 + Bootstrap Icons
- SweetAlert2
- Js (ES6)
- API externa Hofmann (documentada vía Swagger)

## Funcionalidades

- Listado inicial con datos de la API `/ListTableUsers`
- Edición en modal con:
  - Selector desplegable de código desde `/GetUsers`
  - Validaciones de monto y fecha
  - Confirmación visual antes de enviar
  - Envío con `POST /SendUser`
- Mensajes visuales (errores y éxito)
- Recarga automática tras envío

## Estructura relevante

- `routes/web.php`: Definición de rutas (`/`, `POST /send`)
- `app/Http/Controllers/UserController.php`: Lógica de consumo API y validación
- `resources/views/usuarios.blade.php`: Vista principal con tabla y modal
- `public/js/app.js`: Lógica JS del modal y validaciones

## Instrucciones para ejecutar

```bash
git clone https://github.com/camilo-lavado/hofmann-tech-test.git
cd hofmann-tech-test
composer install
php artisan serve
```

Abre [http://127.0.0.1:8000](http://127.0.0.1:8000) en tu navegador.

**No requiere base de datos ni archivo `.env`.**

## Ejemplo visual

| Tabla de usuarios | Modal de edición |
|-------------------|------------------|
| ![Tabla](https://raw.githubusercontent.com/camilo-lavado/hofmann-tech-test/main/public/img/demo1.png) | ![Modal](https://raw.githubusercontent.com/camilo-lavado/hofmann-tech-test/main/public/img/demo2.png) |

---

Desarrollado por [**Camilo Lavado**](https://github.com/camilo-lavado)  
<camilolavado.it@gmail.com>
