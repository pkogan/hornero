<?php
/* @var $this ProblemaController */
/* @var $model Problema */

$this->breadcrumbs=array(
	'Problemas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Problema', 'url'=>array('index')),
	array('label'=>'Manage Problema', 'url'=>array('admin')),
);
?>

<h1>Create Problema</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>