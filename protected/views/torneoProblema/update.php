<?php
/* @var $this TorneoProblemaController */
/* @var $model TorneoProblema */

$this->breadcrumbs=array(
	'Torneo Problemas'=>array('index'),
	$model->idTorneoProblema=>array('view','id'=>$model->idTorneoProblema),
	'Update',
);

$this->menu=array(
	array('label'=>'List TorneoProblema', 'url'=>array('index')),
	array('label'=>'Create TorneoProblema', 'url'=>array('create')),
	array('label'=>'View TorneoProblema', 'url'=>array('view', 'id'=>$model->idTorneoProblema)),
	array('label'=>'Manage TorneoProblema', 'url'=>array('admin')),
);
?>

<h1>Update TorneoProblema <?php echo $model->idTorneoProblema; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>