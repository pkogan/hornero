<?php
/* @var $this TorneoController */
/* @var $model Torneo */

$this->breadcrumbs=array(
	'Torneos'=>array('index'),
	$model->idTorneo=>array('view','id'=>$model->idTorneo),
	'Update',
);

$this->menu=array(
	array('label'=>'List Torneo', 'url'=>array('index')),
	array('label'=>'Create Torneo', 'url'=>array('create')),
	array('label'=>'View Torneo', 'url'=>array('view', 'id'=>$model->idTorneo)),
	array('label'=>'Manage Torneo', 'url'=>array('admin')),
);
?>

<h1>Update Torneo <?php echo $model->idTorneo; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>