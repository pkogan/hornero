<?php
/* @var $this TorneoController */
/* @var $model Torneo */


$this->breadcrumbs = array(
    'Torneos' => array('index'),
    $model->Nombre => array('view', 'id' => $model->idTorneo),
    'Asignar Problema',
);

$this->menu = array(
    array('label' => 'Manejar Problemas', 'url' => array('/torneoProblema/admin','id'=>$model->idTorneo)),
);
?>

<h1>Torneo #<?php echo $model->Nombre; ?></h1>
<h2>Buscar Problemas</h2>
<hr/>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'problema-grid',
    'dataProvider' => $problemas->search(),
    'filter' => $problemas,
    'columns' => array(
        'idProblema',
        array('name'=>'Tipo',
            'value'=>'$data->idTipo0->Tipo',
            ),
        array('name'=>'Complejidad',
               'value'=>'$data->idComplejidad0->Complejidad',
            ),
        
        'Nombre',
        'Enunciado',
        array('header' => 'Orden Asignado',
            'value' => '$data->getOrdenAsignado(' . $model->idTorneo . ')',
        ),
        /*
          'TiempoEjecucionMax',
         */
        array(
            'class' => 'CButtonColumn',
            'template' => '{asignar}{delete}',
            'buttons' => array(
                'asignar' => array(
                    'url' => 'Yii::app()->controller->createUrl(\'asignarproblema\', array(\'id\'=>' . $model->idTorneo . ',\'idProblema\'=>$data["idProblema"]))', //url de la acción nueva
                    'options' => array(
                        'ajax' => array(
                            'url' => "js:$(this).attr('href')",
                            'success' => "function(){
                                     $('#problema-grid').yiiGridView('update');
                                     return true;
                                     }",
                        )
                    ),
                ),
                'delete' => array(
                    'url' => 'Yii::app()->controller->createUrl(\'/torneoProblema/delete2\', array(\'idTorneo\'=>' . $model->idTorneo . ',\'idProblema\'=>$data["idProblema"]))', //url de la acción nueva
                    'options' => array(
                        'ajax' => array(
                            'url' => "js:$(this).attr('href')",
                            'success' => "function(){
                                     $('#problema-grid').yiiGridView('update');
                                     return true;
                                     }",
                        )
                    ),
                ),
            )
        ),
    ),
));
?>
