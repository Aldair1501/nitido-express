# 🛒 Nítido Xpress

Tienda en línea desarrollada con **Laravel 12, PHP, MySQL y Bootstrap**.

## Requisitos
- XAMPP (PHP 8.2 o superior y MySQL)
- Composer
- Git

## Instalación

Clonar el proyecto:

```bash
git clone https://github.com/Aldair1501/nitido-express.git
cd nitido-express
```

Instalar y configurar:

```bash
composer install
copy .env.example .env
php artisan key:generate
```

Crear una base de datos llamada `nitido_express` en phpMyAdmin y configurar las credenciales en `.env`.

Ejecutar:

```bash
php artisan migrate
php artisan db:seed --class=NitidoRolesSeeder
php artisan db:seed --class=ProductosDemoSeeder
php artisan storage:link
php artisan serve
```

Abrir: http://127.0.0.1:8000

## Colaboración

Crear una rama para trabajar:

```bash
git switch -c mejoras-companero
```

Subir los cambios:

```bash
git add .
git commit -m "Mejoras realizadas"
git push -u origin mejoras-companero
```

Crear un **Pull Request** para integrar los cambios.

**Importante:** no subir `.env`, contraseñas ni bases de datos privadas.

**Repositorio:** https://github.com/Aldair1501/nitido-express
