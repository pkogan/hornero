hornero
=======

Aplicación Web para Torneos de Programación

Aplicación Basada en YiiFramework
================================

INSTALACIÓN
-----------
###Descargar el framework de https://github.com/yiisoft/yii/releases/download/1.1.14/yii-1.1.14.f0fee9.tar.gz

###Descomprimirlo y copiar la carpeta framwork a una carpeta pública del apache www/framework

###Descargar los fuentes del presente repositorio en www/hornero.


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