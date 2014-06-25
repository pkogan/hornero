<?php
/* @var $this SolucionController */
/* @var $model Solucion */

$this->breadcrumbs=array(
	'Solucions'=>array('index'),
	$model->idSolucion,
);

$this->menu=array(
	array('label'=>'List Solucion', 'url'=>array('index')),
	array('label'=>'Create Solucion', 'url'=>array('create')),
	array('label'=>'Update Solucion', 'url'=>array('update', 'id'=>$model->idSolucion)),
	array('label'=>'Delete Solucion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idSolucion),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Solucion', 'url'=>array('admin')),
);
?>

<h1>View Solucion #<?php echo $model->idSolucion; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idSolucion',
		'idProblema',
		'ParametrosEntrada',
		'Salida',
	),
)); ?>
