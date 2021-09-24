# Aprende a crear una API RESTful con Laravel
+ **URL Curso**: https://www.udemy.com/course/crea-una-pasarela-de-pagos-con-laravel-cashier-y-stripe/
+ **URL Repositorio General**: ***

## Antes de iniciar:
1. Crear proyecto en la página de [GitHub](https://github.com) con el nombre: **pasarela_pago**.
    + **Description**: Proyecto para seguir el curso de Crea una pasarela de pagos con Laravel Cashier y Stripe, de Víctor Arana en Udemy
    + **Public**.
2. En la ubicación raíz del proyecto en la terminal de la máquina local:
    + $ git init
    + $ git add .
    + $ git commit -m "Commit 00: Antes de iniciar"
    + $ git branch -M main
    + $ git remote add origin https://github.com/petrix12/apirestful_laravel8.git
    + $ git push -u origin main

## Sección 1: Introducción

### Viedo 01. Introducción
+ **Contenido**: ***.
1. Commit Video 01:
    + $ git add .
    + $ git commit -m "Commit 01: Introducción"
    + $ git push -u origin main

### Viedo 02. Programas necesarios
### Viedo 03. Creación del proyecto
### Viedo 04. Reutilizar la plantilla Jetstream
### Viedo 05. Llenar con datos falsos nuestra bbdd
### Viedo 06. Creando nuestros propios estilos css
### Viedo 07. Mostrar productos y artículos



***

1. Programas requeridos:
    + [XAMPP](https://www.apachefriends.org/es/download.html)
    + [Node Js](https://nodejs.org)
    + [Composer](https://getcomposer.org)
    + [Visual Studio Code](https://code.visualstudio.com/download)
    + [Git](https://git-scm.com/downloads)
    + [MySQL Workbench](https://dev.mysql.com/downloads/workbench)
2. Otra opción podría ser Laragon ya que instala todos los programas mencionados anteriormente:
    + [Laragon](https://laragon.org/download/index.html)
        + Laragon Full (64-bit): Apache 2.4, Nginx, MySQL 5.7, PHP 7.4, Redis, Memcached, Node.js 14, npm, git, bitmana…
3. Instalar el instalador de Laravel:
    + $ composer global require laravel/installer
4. Commit Video 02:
    + $ git add .
    + $ git commit -m "Commit 02: Programas necesarios"
    + $ git push -u origin main


### Viedo 04. Creación del proyecto
+ **URL**: https://codersfree.com/blog/como-generar-un-dominio-local-en-windows-xampp
1. Crear proyecto para la API RESTful:
    + $ laravel new api.codersfree
2. Abrir el archivo: **C:\Windows\System32\drivers\etc\hosts** como administrador y en la parte final del archivo escribir.
	```
	127.0.0.1     api.codersfree.test
	```
3. Guardar y cerrar.
4. Abri el archivo de texto plano de configuración de Apache **C:\xampp\apache\conf\extra\httpd-vhosts.conf**.
5. Ir al final del archivo y anexar lo siguiente:
	+ Si nunca has creado un virtual host agregar:
		```conf
		<VirtualHost *>
			DocumentRoot "C:\xampp\htdocs"
			ServerName localhost
		</VirtualHost>
		```
		+ **Nota**: Esta estructura se agrega una única vez.
	+ Luego agregar:
		```conf
		<VirtualHost *>
			DocumentRoot "C:\xampp\htdocs\cursos\24apirestful\api.codersfree\public"
			ServerName api.codersfree.test
			<Directory "C:\xampp\htdocs\cursos\24apirestful\api.codersfree\public">
				Options All
				AllowOverride All
				Require all granted
			</Directory>
		</VirtualHost>
		```
6. Guardar y cerrar.
7. Reiniciar el servidor Apache.
    + **Nota 1**: ahora podemos ejecutar nuestro proyecto local en el navegador introduciendo la siguiente dirección: http://api.codersfree.test
    + **Nota 2**: En caso de que no funcione el enlace, cambiar en el archivo **C:\xampp\apache\conf\extra\httpd-vhosts.conf** todos los segmentos de código **<VirtualHost \*>** por **<VirtualHost *:80>**.


### Viedo 07. Maquetar la bbdd
1. Crear un nuevo modelo y un nuevo diagrama para el proyecto **api.restful** en MySQL Workbench.
2. Guardar el archivo como **api.codersfree\api.restful.mwb**.
3. Crear la entidad **categories** con los campos:
    + id
    + name
    + slug
4. Crear la entidad **posts** con los campos:
    + id
    + name
    + slug
    + extract
    + body
    + status
5. Crear la entidad **users** con los campos:
    + id
    + name
    + email
    + password
6. Crear la entidad **tags** con los campos:
    + id
    + name
    + slug
7. Generar relación 1:n entre **categories** y **posts**.
8. Generar relación 1:n entre **users** y **posts**.
9. Crear tabla **post_tag** para generar una relación de n:m entre **posts** y **tags**.
10. Generar relación 1:n entre **posts** y **post_tag**.
11. Generar relación 1:m entre **tags** y **post_tag**.
12. Renombrar todas las llaves foráneas para seguir las convenciones de Laravel.
13. Commit Video 07:
    + $ git add .
    + $ git commit -m "Commit 07: Registro de usuarios"
    + $ git push -u origin main



## Repositorios de interes:
+ https://github.com/coders-free/api.codersfree
+ https://github.com/coders-free/cliente1

## Para limpiar configuración y reestablecer el cache:
+ $ php artisan config:clear   
+ $ php artisan config:cache 

## En caso de no permitir compilar algo:
+ $ php artisan clear-compiled
+ $ composer dumpautoload

