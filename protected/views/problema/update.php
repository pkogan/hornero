<?php
/* @var $this ProblemaController */
/* @var $model Problema */

$this->breadcrumbs=array(
	'Problemas'=>array('index'),
	$model->idProblema=>array('view','id'=>$model->idProblema),
	'Update',
);

$this->menu=array(
	array('label'=>'List Problema', 'url'=>array('index')),
	array('label'=>'Create Problema', 'url'=>array('create')),
	array('label'=>'View Problema', 'url'=>array('view', 'id'=>$model->idProblema)),
	array('label'=>'Manage Problema', 'url'=>array('admin')),
);
?>

<h1>Update Problema <?php echo $model->idProblema; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>