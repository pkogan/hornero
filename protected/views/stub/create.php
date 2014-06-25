<?php
/* @var $this StubController */
/* @var $model Stub */

$this->breadcrumbs=array(
	'Stubs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Stub', 'url'=>array('index')),
	array('label'=>'Manage Stub', 'url'=>array('admin')),
);
?>

<h1>Create Stub</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>