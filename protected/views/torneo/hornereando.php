<?php
/* @var $this TorneoController */
/* @var $model TorneoProblema */


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
<h3>Parámetros: <?php echo $proxy->parametros;?></h3>
<hr/>
<?php echo $this->renderPartial('_formrespuesta', array('model'=>$proxy)); ?>


<h1>Resoluciones del Equipo <?php echo Yii::app()->user->name?></h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'usuarios',
    'dataProvider' => $resoluciones,
    'columns' => array(
        //'idTwit',
        //'idUsuario0.NombreUsuario',
        array('header' => 'Equipo',
            'value' => '$data->idUsuario0->NombreUsuario'
        ),
        array('header'=>'Problema',
               'value'=>'isset($data->idTorneoProblema0->Orden)?$data->idTorneoProblema0->Orden:""'),
        
        array('header'=>'Fecha Solicitud',
               'value'=>'$data->FechaSolicitudOK'),
        //'FechaSolicitud',
        array('name' => 'Tiempo Respuesta',
            'value' => '$data->FechaRespuestaOK'
        ),
        'idSolucion0.ParametrosEntrada',
        array('header'=>'Respuesta Enviada',
            'value'=>'$data->Respuesta'),
        array('header'=>'Respuesta Correcta',
            'value'=>'isset($data->idSolucion0->Salida)?$data->idSolucion0->Salida:""'),
        'idEstado0.Estado'
        
    ),
));
?>
