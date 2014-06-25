<?php
/* @var $this SolucionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Solucions',
);

$this->menu=array(
	array('label'=>'Create Solucion', 'url'=>array('create')),
	array('label'=>'Manage Solucion', 'url'=>array('admin')),
);
?>

<h1>Solucions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
