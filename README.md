<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://latinad.com/static/media/latinad.c0f35902.svg" width="400" alt="Laravel Logo"></a></p>



# Instalación del proyecto

Clonar el repositorio

```
git clone https://github.com/andresmza/latinad.git

cd latinad/
```

Instalar las dependencias del proyecto

```
composer install
```

Crear archivo de variables de entorno basadas en el archivo de ejemplo

```
cp .env.example .env
```

Editar las configuraciones necesarias para conexión con la base de datos (previamente creada)

```
nano .env
```

```
DB_CONNECTION=mysql
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

Generar la key de la aplicación

```
php artisan key:generate
```

Instalación de Laravel Passport

```
php artisan passport:install
```

Configurar los permisos de almacenamiento necesarios

```
sudo chmod 777 -R storage/
```

Ejecutar migraciones y seeders

```
php artisan migrate --seed
```