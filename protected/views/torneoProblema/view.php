<?php
/* @var $this TorneoProblemaController */
/* @var $model TorneoProblema */

$this->breadcrumbs=array(
	'Torneo Problemas'=>array('index'),
	$model->idTorneoProblema,
);

$this->menu=array(
	array('label'=>'List TorneoProblema', 'url'=>array('index')),
	array('label'=>'Create TorneoProblema', 'url'=>array('create')),
	array('label'=>'Update TorneoProblema', 'url'=>array('update', 'id'=>$model->idTorneoProblema)),
	array('label'=>'Delete TorneoProblema', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idTorneoProblema),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TorneoProblema', 'url'=>array('admin')),
);
?>

<h1>View TorneoProblema #<?php echo $model->idTorneoProblema; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idTorneoProblema',
		'idProblema',
		'idTorneo',
		'Orden',
	),
)); ?>
