<?php
/* @var $this ParcialController */
/* @var $model Parcial */

$this->breadcrumbs=array(
	'Parcials'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Parcial', 'url'=>array('index')),
	array('label'=>'Create Parcial', 'url'=>array('create')),
	array('label'=>'Update Parcial', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Parcial', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Parcial', 'url'=>array('admin')),
);
?>

<h1>View Parcial #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idCuenta',
		'idEquipo',
		'Tiempo',
	),
)); ?>
