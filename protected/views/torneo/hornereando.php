<?php
/* @var $this TorneoController */
/* @var $model TorneoProblema */
/* @var $resoluciones  */


$this->breadcrumbs = array(
    'Torneos' => array('index'),
    $model->idTorneo0->Nombre => array('view','id'=>$model->idTorneo),
    'Problema '.$model->Orden,
);

$this->menu = array(
    array('label' => 'Torneo', 'url' => array('view','id'=>$model->idTorneo)),
);
?>

<h1>Torneo #<?php echo $model->idTorneo0->Nombre; ?></h1>
<b>Su posicion es: <?php echo $model->idTorneo0->getUsuarioInscripcion()->getPosicion();?></b>

<h2>Problema <?php echo $model->idProblema0->Nombre; ?></h2>
<hr/>
<?php  if($model->idProblema0->Archivo!='')
    echo CHtml::image(Yii::app()->createUrl('/problema/descargar',array('id'=>$model->idProblema0->Archivo)),'detalle',array('height'=>'300px','style'=>'float:right','class'=>'imgproblema'));?>

<h3><?php echo $model->idProblema0->Enunciado;?></h3>
<?php if($model->resuelto!=''):?>
<p>Ejercicio resuelto por: <?php echo $model->resuelto ?></p>
<?php else:?>
<p>Ningún equipo ha resuelto el ejercicio</p>
<?php endif;?>
<hr/>
<h3>Parámetros: <b style="color:red"><?php echo $proxy->parametros;?></b></h3>

<hr/>
<?php echo $this->renderPartial('_formrespuesta', array('model'=>$proxy)); ?>
<hr/>

<?php if (count($resoluciones)>0):?>
<h3>Últimas Resoluciones del Equipo <?php echo Yii::app()->user->name?></h3>
<?php 
$i=0;
foreach ($resoluciones as $resolucion) {
    echo $this->renderPartial('_viewrespuesta', array('data'=>$resolucion));
    //if (++$i==3) break;
} ?>
<hr/>
<?php endif;?>
