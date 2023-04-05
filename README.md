# Estructura del proyecto

## Carpetas
1. classes = guarda toda la programacion para el envio de correos
2. controllers = se programa toda la logica de la pagina para despues llamar a las vistas
3. includes = manda a llamar la conexion de la bd y las funciones que se usaran para el sistema
4. models = logica de datos
    4.1 ActiveRecord es la clase padre
    4.2 Los demas archivos representan una entidad de la base de datos
5. public = todo lo que el usuario vera en el deployment
    5.1 index.php es el routing
6. src = imagenes, js y estilos scss

## Archivos
1. Composer = herramientas para php (variables de entorno y enviar correos)
2. Gulp = Pre-procesador scss/js tambien para comprimir imagenes
3. Package = Dependencias de SASS
4. Router = comprueba rutas y rederiza a la vista

## ¿Como empezar a trabajar por primera vez con el proyecto?
1. En la computadora que se valla a trabajar instalar lo siguiente:
    * Xampp
    * Node JS
    * Composer
2. Clonar el repositorio de git o descomprimir la carpeta con el proyecto
3. Instalar las dependecias de npm con el siguiente comando: `npm install`
4. Instalar las dependecias de composer con el siguiente comando: `composer update`

## Comandos de Gulp
1. Ejecutar en la terminal gulp para compilar scss y js: `npx gulp dev`
2. Ejecutar en la terminal gulp para convertir y comprimir imagenes: `npx gulp conversor`

## Comandos de PHP
1. Ejecutar en la terminal: `cd public`
2. Ejecutar en la terminal gulp para abir un server local: `php -S localhost:3000`
    * No recuerdo bien si es necesario instalar una extension en vs code, lo que si es que en la configuracion de vs code le tienes que indicar la carpeta xampp/php

## Cosas a tener en cuenta para el deplyoment
1. Revisar que las variables de entorno includes/.env
2. Agregar el archivo Procfile
3. Agregar el archivo public/.htaccess
4. Agregar el archivo .gitignore