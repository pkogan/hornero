<?php
/* @var $this ProblemaController */
/* @var $model Problema */

$this->breadcrumbs=array(
	'Problemas'=>array('index'),
	$model->idProblema,
);

$this->menu=array(
	array('label'=>'List Problema', 'url'=>array('index')),
	array('label'=>'Create Problema', 'url'=>array('create')),
	array('label'=>'Update Problema', 'url'=>array('update', 'id'=>$model->idProblema)),
	array('label'=>'Delete Problema', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idProblema),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Problema', 'url'=>array('admin')),
        array('label'=>'Ver Soluciones','url'=>array('/solucion/admin','idProblema'=>$model->idProblema))
);
?>


<h1>View Problema #<?php echo $model->Nombre; ?></h1>
<?php  if($model->Archivo!='')
    echo CHtml::image(Yii::app()->createUrl('/problema/descargar',array('id'=>$model->Archivo)),'detalle',array('height'=>'300px'));?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idProblema',
		'Enunciado',
                'idTipo0.Tipo',
		'idComplejidad0.Complejidad',
		'TiempoEjecucionMax',
	),
)); ?>

<h2>Soluciones</h2>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'solucion-grid',
	'dataProvider'=>$soluciones->search(),
	'filter'=>$soluciones,
	'columns'=>array(
		'idSolucion',
		//'idProblema',
		'ParametrosEntrada',
		'Salida',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); 