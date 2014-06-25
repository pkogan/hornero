<?php
/* @var $this SolucionController */
/* @var $model Solucion */

$this->breadcrumbs=array(
	'Solucions'=>array('index'),
	$model->idSolucion=>array('view','id'=>$model->idSolucion),
	'Update',
);

$this->menu=array(
	array('label'=>'List Solucion', 'url'=>array('index')),
	array('label'=>'Create Solucion', 'url'=>array('create')),
	array('label'=>'View Solucion', 'url'=>array('view', 'id'=>$model->idSolucion)),
	array('label'=>'Manage Solucion', 'url'=>array('admin')),
);
?>

<h1>Update Solucion <?php echo $model->idSolucion; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>