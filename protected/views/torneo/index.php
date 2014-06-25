<?php
/* @var $this TorneoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Torneos',
);

$this->menu=array(
	array('label'=>'Create Torneo', 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('Administrador')),
	array('label'=>'Manage Torneo', 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('Administrador')),
);

?>

<h1>Torneos diponibles para jugar</h1>
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
<?php 
