<?php
/* @var $this AyudaController */

$this->breadcrumbs=array(
	'Ayuda',
);
?>
<h1>Manual Paso a Paso</h1>

<p>
    <b>Primero</b>.  <?php echo CHtml::button("Registrarse",array(
                          'submit'=>$this->createUrl('/usuario/registro',array()),
));?> o <?php echo CHtml::button("Login",array(
                          'submit'=>$this->createUrl('/site/login',array()),
));?>
        <?php if(!Yii::app()->user->isGuest){
            echo 'Ya cumplió este paso';
        }?>
</p>

<p>
    <b>Segundo</b>.  <?php echo CHtml::button("Incribirse en algún torneo",array(
                          'submit'=>$this->createUrl('/torneo',array()),
));?>
        <?php if(!is_null($usuario) and count($usuario->torneoUsuarios)>0){
            echo 'Ya cumplió este paso.  Y esta inscripto en los torneos:';
            
            foreach ($usuario->torneoUsuarios as $torneo) {
                echo '<br>Torneo '.$torneo->idTorneo0->Nombre.' token: '.$torneo->Token;
            }
            
        }
        ?>
</p>

<p>
	<b>Tercero</b>. <?php echo CHtml::button("Descargar Stubs de tu lenguaje preferido",array(
                          'submit'=>$this->createUrl('/ayuda/stubs',array()),
));?>
        
</p>

<p>
    <b>Cuarto</b>. Copiar el token que tiene asignado para el torneo
    y pegarlo en el stub donde indequen los comentarios de los fuentes descargados.
    Resolver cada ejercicio del torneo modificando en el stub el número de problema
    y la resolución del mismo.</p>
</p>    
    Gana el equipo que resuelve mas problemas.  En caso de empate en cantidad de ejercicios resueltos,
    se desempata por el menor tiempo de resolución del último ejercicio resuelto.
</p>
<hr/>
<h1>Ayudar al Hornero</h1>
<p>Si queres participar del desarrollo del hornero podes descargar los fuentes y
    subir modificaciones a los stubs o a la aplicación en: 
    <a href="https://github.com/pkogan/hornero">https://github.com/pkogan/hornero</a></p>
<p>Otra forma de ayudar es creando nuevos Problemas con sus respectivas soluciones para
    mejorar la base de datos de ejercicios.</p>
<hr/>
<h1>Instalá tu propio Hornero</h1>
<p>Descargar los fuentes de:: 
    <a href="https://github.com/pkogan/hornero">https://github.com/pkogan/hornero</a>,
y seguir las intrucciones del readme.  Esta solución es la recomendada para lugares sin de conectividad.</p>
