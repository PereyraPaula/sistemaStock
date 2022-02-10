# Sistema de stock
Practica proyecto Vue-Cli / Laravel - 3er Año

## Tabla de contenidos
  - [Introducción](#introducción)
  - [Descargar con git](#descargar-con-git)
  - [Instalación](#instalación)
  
## Introducción
Este es el backend construido con Laravel. El codigo de la parte de front se encuentra [aqui](https://github.com/PaulaP12/sistema_Stock).

## Descargar con git
Si git no está instalado en su computadora, instale el apropiado para su sistema operativo desde este [enlace](https://git-scm.com/downloads)

Abra la pantalla del terminal, pegue el código a continuación y ejecútelo.
`git clone https://github.com/PaulaP12/sistemaStock.git`

## Instalación
**Nota**: Compruebe si está dentro del proyecto: `cd sistemaStock/`

* Cambie el nombre del archivo llamado .env.example en el archivo del proyecto a .env.
* Guarde la información de su base de datos en el lugar apropiado del archivo .env.
* Ingrese el archivo del proyecto desde la terminal y pegue los siguientes códigos respectivamente.

~~~
composer install
php artisan key:generate
php artisan migrate
php artisan serve
~~~