<?php
/* @var $this CambioClaveController */
/* @var $model CambioClave */

$this->breadcrumbs=array(
	'Cambio Claves'=>array('index'),
	$model->idCambio=>array('view','id'=>$model->idCambio),
	'Update',
);

$this->menu=array(
	array('label'=>'List CambioClave', 'url'=>array('index')),
	array('label'=>'Create CambioClave', 'url'=>array('create')),
	array('label'=>'View CambioClave', 'url'=>array('view', 'id'=>$model->idCambio)),
	array('label'=>'Manage CambioClave', 'url'=>array('admin')),
);
?>

<h1>Update CambioClave <?php echo $model->idCambio; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>