<?php
/* @var $this StubController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Stubs',
);

$this->menu=array(
	array('label'=>'Create Stub', 'url'=>array('create')),
	array('label'=>'Manage Stub', 'url'=>array('admin')),
);
?>

<h1>Stubs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
