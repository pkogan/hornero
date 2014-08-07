<?php
/* @var $this CambioClaveController */
/* @var $model CambioClave */

$this->breadcrumbs=array(
	'Cambio Claves'=>array('index'),
	$model->idCambio,
);

$this->menu=array(
	array('label'=>'List CambioClave', 'url'=>array('index')),
	array('label'=>'Create CambioClave', 'url'=>array('create')),
	array('label'=>'Update CambioClave', 'url'=>array('update', 'id'=>$model->idCambio)),
	array('label'=>'Delete CambioClave', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idCambio),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CambioClave', 'url'=>array('admin')),
);
?>

<h1>View CambioClave #<?php echo $model->idCambio; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idCambio',
		'idUsuario',
		'fecha',
		'token',
		'estado',
	),
)); ?>
