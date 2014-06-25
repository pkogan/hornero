<?php
/* @var $this ProblemaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Problemas',
);

$this->menu=array(
	array('label'=>'Create Problema', 'url'=>array('create')),
	array('label'=>'Manage Problema', 'url'=>array('admin')),
);
?>

<h1>Problemas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
