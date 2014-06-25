<?php
/* @var $this ParcialController */
/* @var $model Parcial */

$this->breadcrumbs=array(
	'Parcials'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Parcial', 'url'=>array('index')),
	array('label'=>'Manage Parcial', 'url'=>array('admin')),
);
?>

<h1>Create Parcial</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>