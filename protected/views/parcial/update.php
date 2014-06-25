<?php
/* @var $this ParcialController */
/* @var $model Parcial */

$this->breadcrumbs=array(
	'Parcials'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Parcial', 'url'=>array('index')),
	array('label'=>'Create Parcial', 'url'=>array('create')),
	array('label'=>'View Parcial', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Parcial', 'url'=>array('admin')),
);
?>

<h1>Update Parcial <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>