<?php
/* @var $this TorneoController */
/* @var $model Torneo */

$this->breadcrumbs=array(
	'Torneos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Torneo', 'url'=>array('index')),
	array('label'=>'Manage Torneo', 'url'=>array('admin')),
);
?>

<h1>Create Torneo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>