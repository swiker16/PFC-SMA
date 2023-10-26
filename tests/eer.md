
# PFC-SMA

- [Caracteristicas](#caracteristicas)
  - [Descripcion](#descripcion)
- [Estructura](#estructura)
- [PreRequisitos](#prerequisitos)
  - [XAMPP](#xampp)
  - [Composer](#composer)
- [Instalacion](#instalacion)
  - [Base de Datos](#bbdd)
  - [PHPUnit](#phpunit)

## Caracteristicas

### Descripcion

Este proyecto de grado tiene como objetivo desarrollar un sistema de reservas de cine en línea que revolucione la forma en que los cinéfilos seleccionan películas, asientos y horarios de proyección. Nuestra plataforma se convertirá en una solución líder en la industria, permitiendo una experiencia de usuario excepcional y una gestión eficiente de las reservas.

## Estructura

```http
pfc-sma/           # Directorio raíz del proyecto
├── assets/             # Recursos estáticos como CSS, JavaScript, imágenes
│   ├── css/            # Archivos CSS
│   ├── js/             # Archivos JavaScript
│   ├── img/            # Imágenes
│
├── includes/           # Archivos PHP reutilizables y funciones
│   ├── config.php      # Archivo de configuración
│   ├── db.php          # Conexión a la base de datos
│   ├── functions.php   # Funciones auxiliares
│
├── templates/          # Plantillas de vistas
│   ├── header.php      # Encabezado HTML
│   ├── footer.php      # Pie de página HTML
│
├── views/              # Páginas específicas del sitio
│   ├── home.php        # Página de inicio
│   ├── products.php    # Página de productos
│   ├── contact.php     # Página de contacto
│
├── models/             # Clases y scripts para interactuar con la base de datos
│   ├── user.php        # Modelo de usuario
│   ├── product.php     # Modelo de producto
│
├── tests/              # Test unitarios
│   ├── homeTests.php    # Controlador de la página de inicio
│
├── vendor/             # Dependencias de terceros
│
├── index.php           # Página de inicio del sitio
├── about.php           # Ejemplo de una página adicional
├── contact.php         # Ejemplo de una página adicional
├── .gitignore          # Archivo para ignorar archivos/directorios en Git


```

## PreRequisitos

Antes de empezar a trabajar en este proyecto debemos de instalar unas herramientas que nos permitira trabajar en este proyecto.

### XAMPP

Xampp es un servidor web local multiplataforma que permite la creación y prueba de páginas web u otros elementos de programación, con esta herramienta nuestro proyecto se podra ver, en el siguiente enlace se podra descargar XAMPP.

https://www.apachefriends.org/download.html


### Composer

Composer es un sistema de gestión de paquetes para programar en PHP el cual provee los formatos estándar necesarios para manejar dependencias y librerías de PHP. Esta herramienta nos permitira instalar PHPUnit para posteriormente hacer test unitarios, en el siguiente enlace podremos descargar esta herramienta.

https://getcomposer.org/download/
## Instalacion

### XAMPP 

Para inicializar XAMPP en el buscador excribimo xampp y nos saldria un panel de control, para poder trabajar en la carpeta donde tengamos instalado XAMPP nos tenemos que dirigir a la de htdocs y borrar su contenido, para posteriormente clonar el proyecto en esa carpeta.

Por ultimo, en el panel de control le damos a star a los servicios Apache y MySQL.

### Base de datos

Para crear la base de datos nos tenemos que dirigir a la siguiente URL: 

http://localhost/phpmyadmin/index.php

Una vez aqui en la pestaña sql tenemos que ejecutar lo siguiente:

```SQL
CREATE DATABASE ....

```

### PHPUnit

Dentro de nuestro proyecto abrimos una terminal y tenemos que ejecutar el siguiente comando:

```bash
  composer require --dev phpunit/phpunit

```

Ya tendriamos en nuestro proyecto instalado la dependencia PHPUnit en la carpeta vendor y esto es para ejecutar los test unitarios, con el siguiente comando ejecutamos los test unitarios del proyecto:

```bash
  ./vendor/bin/phpunit tests

```