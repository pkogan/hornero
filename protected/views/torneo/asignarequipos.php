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
<h2>Buscar Equipos</h2>
<hr/>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'problema-grid',
	'dataProvider'=>$usuarios->search(),
	'filter'=>$usuarios,
	'columns'=>array(
		'idUsuario',
		'NombreUsuario',
                'Descripcion',
		'idLenguaje0.Lenguaje',
                
		
		/*
		'TiempoEjecucionMax',
		*/
		array(
			'class'=>'CButtonColumn',
                        'template'=>'{asignar}',
                        'buttons'=>array(
                            'asignar'=>array(
                                'url'=>'Yii::app()->controller->createUrl(\'asignarequipos\', array(\'id\'=>'.$model->idTorneo.',\'idUsuario\'=>$data["idUsuario"]))',
                                
                            )
                        )
                    
		),
	),
)); ?>
