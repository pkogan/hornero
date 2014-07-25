<?php
/* @var $this SolucionController */
/* @var $model Solucion */
/* @var $problema Problema*/

$this->breadcrumbs=array(
	'Problemas'=>array('/problema/admin'),
        $problema->Nombre=>array('/problema/view','id'=>$problema->idProblema),
	'Crear Solucion',
);

/*$this->menu=array(
	array('label'=>'List Solucion', 'url'=>array('index')),
	array('label'=>'Manage Solucion', 'url'=>array('admin')),
);*/
?>

<h1>Crear Solución</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>