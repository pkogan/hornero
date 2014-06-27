<?php
require_once './hornero.php';
/*
modificar el token que le corresponde al equipo para el torneo
y el numero de Problema a Trabajar
*/
$token='f053daab9855fe42942624aef382729d';
$problema=3;
$hornero=new Hornero($problema,$token);
$hornero->host='localhost/yii/hornero';
$parametros=$hornero->solicitud();
/*******************************************************************
Resolver el ejercicio tomando los parámetros del array parametros
y asingar la respuesta a la variable respuesta
*/

$x=258;//$parametros[0];258,8162
$y=8162;$parametros[1];
$respuesta= round(3.1415926535898*$y*$y-3.1415926535898*$x*$x,2);//round(pi()*$y*$y-pi()*$x*$x,2);
exit ($respuesta.' '.pi());
/*******************************************************************
Se envía la respuesta al servidor hornero NO TOCAR!!!!*/
$respuesta=$hornero->respuesta($respuesta);

print_r($respuesta);
