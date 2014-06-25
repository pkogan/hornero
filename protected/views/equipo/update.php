<?php
/* @var $this EquipoController */
/* @var $model Equipo */

$this->breadcrumbs=array(
	'Equipos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Equipo', 'url'=>array('index')),
	array('label'=>'Create Equipo', 'url'=>array('create')),
	array('label'=>'View Equipo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Equipo', 'url'=>array('admin')),
);
?>

<h1>Update Equipo <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>