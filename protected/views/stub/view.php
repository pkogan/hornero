<?php
/* @var $this StubController */
/* @var $model Stub */

$this->breadcrumbs=array(
	'Stubs'=>array('index'),
	$model->idStubs,
);

$this->menu=array(
	array('label'=>'List Stub', 'url'=>array('index')),
	array('label'=>'Create Stub', 'url'=>array('create')),
	array('label'=>'Update Stub', 'url'=>array('update', 'id'=>$model->idStubs)),
	array('label'=>'Delete Stub', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idStubs),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Stub', 'url'=>array('admin')),
);
?>

<h1>View Stub #<?php echo $model->idStubs; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idStubs',
		'idLenguaje',
		'Descripcion',
		'Archivo',
	),
)); ?>
