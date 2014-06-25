<?php
/* @var $this TorneoProblemaController */
/* @var $model TorneoProblema */

$this->breadcrumbs = array(
    'Torneos' => array('index'),
    $torneo->Nombre => array('view','id'=>$torneo->idTorneo),
    'Manejar Problemas',
);

$this->menu = array(
array('label' => 'Asignar Problemas', 'url' => array('/torneo/asignarproblema', 'id' => $torneo->idTorneo), 'visible' => Yii::app()->user->checkAccess('Administrador')),
);
?>

<h1>Torneo #<?php echo $torneo->Nombre; ?></h1>
<h2>Ordenar Problemas</h2>
<hr/>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'torneo-problema-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'idTorneoProblema',
	'Orden',	
            'idProblema0.Nombre',
		
		array(
			'class'=>'CButtonColumn',
                    'template'=>'{update}{delete}'
		),
	),
)); ?>
