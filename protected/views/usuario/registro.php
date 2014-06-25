<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	'Registro',
);

?>

<h1>Registro de Usuario</h1>

<?php echo $this->renderPartial('_formregistro', array('model'=>$model)); ?>