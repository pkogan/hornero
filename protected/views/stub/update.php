<?php
/* @var $this StubController */
/* @var $model Stub */

$this->breadcrumbs=array(
	'Stubs'=>array('index'),
	$model->idStubs=>array('view','id'=>$model->idStubs),
	'Update',
);

$this->menu=array(
	array('label'=>'List Stub', 'url'=>array('index')),
	array('label'=>'Create Stub', 'url'=>array('create')),
	array('label'=>'View Stub', 'url'=>array('view', 'id'=>$model->idStubs)),
	array('label'=>'Manage Stub', 'url'=>array('admin')),
);
?>

<h1>Update Stub <?php echo $model->idStubs; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>