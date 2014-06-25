<?php
/* @var $this ParcialController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Parcials',
);

$this->menu=array(
	array('label'=>'Create Parcial', 'url'=>array('create')),
	array('label'=>'Manage Parcial', 'url'=>array('admin')),
);
?>

<h1>Parcials</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
