<?php
/* @var $this TorneoController */
/* @var $model TorneoProblema */


$this->breadcrumbs = array(
    'Torneos' => array('index'),
    $model->Nombre => array('view','id'=>$model->idTorneo),
    'Asignar Problema',
);

$this->menu = array(
    array('label' => 'List Torneo', 'url' => array('index')),
);
?>

<h1>Torneo #<?php echo $model->Nombre; ?></h1>
<h2>Buscar Problemas</h2>
<hr/>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'problema-grid',
	'dataProvider'=>$problemas->search(),
	'filter'=>$problemas,
	'columns'=>array(
		'idProblema',
		'idTipo0.Tipo',
		'idComplejidad0.Complejidad',
                'Nombre',
		'Enunciado',
		
		/*
		'TiempoEjecucionMax',
		*/
		array(
			'class'=>'CButtonColumn',
                        'template'=>'{asignar}',
                        'buttons'=>array(
                            'asignar'=>array(
                                'url'=>'Yii::app()->controller->createUrl(\'asignarproblema\', array(\'id\'=>'.$model->idTorneo.',\'idProblema\'=>$data["idProblema"]))',
                                
                            )
                        )
                    
		),
	),
)); ?>
