<h1>Torneos que estoy inscripto</h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'torneos',
    'dataProvider' => $torneos,
    'columns' => array(
        //'idTwit',
        array('header'=>'Torneo',
            'value'=>'$data->idTorneo0->Nombre'),
        array('header'=>'Estado',
            'value'=>'$data->idTorneo0->idEstado0->Estado'),
        /*'idTorneo0.FechaInicio',
        'idTornoe0.FechaFin',*/
        array('header'=>'Detalle',
            'value'=>'$data->idTorneo0->Descripcion'),
        'Token',
        array(
            'class' => 'CButtonColumn',
            'template' => "{view}{actualizar_token}",
            'buttons' => array(
                'view' => array(
                    'url' => 'Yii::app()->controller->createUrl(\'/torneo/view\', array(\'id\'=>$data["idTorneo"]))',
                ),
                'actualizar_token' => array(
                    'url' => 'Yii::app()->controller->createUrl(\'/torneo/actualizartoken\', array(\'idTorneo\'=>$data["idTorneo"]))',
                ),
            ),
        ),
    ),
));
?>
