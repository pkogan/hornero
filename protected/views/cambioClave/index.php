<?php
/* @var $this CambioClaveController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cambio Claves',
);

$this->menu=array(
	array('label'=>'Create CambioClave', 'url'=>array('create')),
	array('label'=>'Manage CambioClave', 'url'=>array('admin')),
);
?>

<h1>Cambio Claves</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
