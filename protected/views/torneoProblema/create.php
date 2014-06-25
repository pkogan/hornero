<?php
/* @var $this TorneoProblemaController */
/* @var $model TorneoProblema */

$this->breadcrumbs=array(
	'Torneo Problemas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TorneoProblema', 'url'=>array('index')),
	array('label'=>'Manage TorneoProblema', 'url'=>array('admin')),
);
?>

<h1>Create TorneoProblema</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>