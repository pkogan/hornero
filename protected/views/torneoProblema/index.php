<?php
/* @var $this TorneoProblemaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Torneo Problemas',
);

$this->menu=array(
	array('label'=>'Create TorneoProblema', 'url'=>array('create')),
	array('label'=>'Manage TorneoProblema', 'url'=>array('admin')),
);
?>

<h1>Torneo Problemas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
