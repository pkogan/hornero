<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	'Bandeja'=>array('index'),
	'Actualizar Clave',
);

$this->menu=array(
/*	array('label'=>'List Usuario', 'url'=>array('index')),
	array('label'=>'Create Usuario', 'url'=>array('create')),
	array('label'=>'View Usuario', 'url'=>array('view', 'id'=>$model->idUsuario)),
	array('label'=>'Manage Usuario', 'url'=>array('admin')),*/
);
?>

<h1>Actualizar Clave de Equipo <?php echo CHtml::encode($model->NombreUsuario); ?></h1>

<?php echo $this->renderPartial('_formclave', array('model'=>$model)); ?>
