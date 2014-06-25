<?php
/* @var $this SolucionController */
/* @var $model Solucion */

$this->breadcrumbs=array(
	'Solucions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Solucion', 'url'=>array('index')),
	array('label'=>'Manage Solucion', 'url'=>array('admin')),
);
?>

<h1>Create Solucion</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>