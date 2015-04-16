hornero http://hornero.fi.uncoma.edu.ar
=======================================
Aplicación Web para Torneos de Programación
"Se puede programar/competir con cualquier lenguaje" java, python, php, c, c++, pascal, javascript, c#, ciao-prolog, visual basic, perl, bash, lisp, ruby, smalltalk, PSeInt, ..... cualquier lenguaje.
"Puede jugar el que quiera. Está abierto a cualquier programador, de cualquier lugar del mundo, sin límite ni de edad ni de título"

Aplicación Basada en YiiFramework
================================

INSTALACIÓN
-----------

1. Descargar el framework de https://github.com/yiisoft/yii/releases/download/1.1.14/yii-1.1.14.f0fee9.tar.gz
2. Descomprimirlo y copiar la carpeta framwork a una carpeta pública del apache www/framework
3. Descargar los fuentes del presente repositorio en www/hornero.


BASE DE DATOS
-------------

Crear una Base de datos en base al archivo que esta en la carpeta protected/data del proyecto.
 
Editar el archivo `protected/config/main.php` 

```php
'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=hornero',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'pass',
            'charset' => 'utf8',
        ),
```
Y listo.  A jugar.
