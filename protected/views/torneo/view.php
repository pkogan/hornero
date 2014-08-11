<?php
/* @var $this TorneoController */
/* @var $model Torneo */

$this->breadcrumbs = array(
    'Torneos' => array('index'),
    $model->idTorneo,
);

$this->menu = array(
    array('label' => 'Listado de Torneos', 'url' => array('index')),
    array('label' => 'Borrar Inscripcion al Torneo',
        'url' =>'#',
        'linkOptions' => array('submit' => array('borrarinscripcion', 'idTorneo' => $model->idTorneo), 'confirm' => 'Está seguro de borrar la Inscripción a este Torneo? Perderá todas sus soluciones.'),
        'visible' => $model->getUsuarioInscripcion()!=FALSE),
    array('label' => 'Create Torneo', 'url' => array('create'), 'visible' => Yii::app()->user->checkAccess('Administrador')),
    array('label' => 'Update Torneo', 'url' => array('update', 'id' => $model->idTorneo), 'visible' => Yii::app()->user->checkAccess('Administrador')),
    array('label' => 'Manejar Problemas', 'url' => array('/torneoProblema/admin', 'id' => $model->idTorneo), 'visible' => Yii::app()->user->checkAccess('Administrador')),
    array('label' => 'Asignar Problemas', 'url' => array('asignarproblema', 'id' => $model->idTorneo), 'visible' => Yii::app()->user->checkAccess('Administrador')),
    array('label' => 'Delete Torneo', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->idTorneo), 'confirm' => 'Are you sure you want to delete this item?'), 'visible' => Yii::app()->user->checkAccess('Administrador')),
    array('label' => 'Manage Torneo', 'url' => array('admin'), 'visible' => Yii::app()->user->checkAccess('Administrador')),
);
?>

<h1>Torneo #<?php echo CHtml::encode($model->Nombre); ?></h1>
<?php if($inscripcion=$model->getUsuarioInscripcion()):?>
<b>Token: <?php echo $inscripcion->Token;?></b><br>
<b>Su posicion es: <?php echo $inscripcion->getPosicion();?></b>
<?php else:?>
<?php echo CHtml::button("Inscribirse en el Torneo", array(
                    'submit' => $this->createUrl('/torneo/inscripcion', array('idTorneo' => $model->idTorneo)),
                    ));?>
    <?php endif;?>
<p><?php echo CHtml::encode($model->Descripcion);?></p>


<?php if ($model->idEstado==2&&$model->idTipo!=3):?>
<h2>Cuenta Regresiva </h2>

<?php
$fecha = new DateTime($model->FechaFin);
 $this->widget('ext.bcountdown.BCountdown', 
              array(
              'style'=>'estado_'.$model->idEstado,
              'id'=>'reloj'.$model->idTorneo,
              'title'=>false,  // Title
              'message'=>false, // message for user
              'isDark'=>true,  // two skin dark and light , by default it light i.e isDark=false
              'year'=>$fecha->format('Y'),
              'month'=>$fecha->format('m'),
              'day'=>$fecha->format('j'),
              'hour'=>$fecha->format('G'),
              'min'=>$fecha->format('i'),
              'sec'=>$fecha->format('s'),
              )
              );
 
          endif;?>

<?php          
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        //'idTorneo',
        //'Nombre',
      //  'Descripcion',
        'FechaInicio',
        'FechaFin',
        'idEstado0.Estado',
    ),
));
?>
<hr/>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'usuarios',
    'summaryText'=>'<h1>Tabla de Posiciones</h1>',
    'dataProvider' => $usuarios->search(),
    'filter'=>$usuarios,
    'columns' => array(
        //'idTwit',
        //'idUsuario0.NombreUsuario',
        array('header'=>'Posición',
            'value'=>'$data->getPosicion()'),
        array('header' => 'Equipo',
              'name'=>'equipo',
            'value' => '$data->idUsuario0->NombreUsuario'
        ),
        array('header' => 'Lenguaje',
            'value' => '$data->idUsuario0->idLenguaje0->Lenguaje'
        ),
        array('header'=>'Puntos',
            'value'=>'$data->Puntos'),
        array('header' => 'Tiempo Ultimo Ejercicio',
            'value' => '$data->TiempoOK'
        ),
        
    ),
));
?>
<?php if ($model->idEstado!=1||Yii::app()->user->checkAccess('Administrador')):?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'problemas',
    'summaryText'=>'<h1>Problemas</h1>',
    'dataProvider' => $problemas->search(),
    'columns' => array(
        //'idTwit',
        'Orden',
        array('name' => 'Problema',
            'value' => '$data->idProblema0->Nombre'
        ),
//        array('name' => 'Enunciado',
//            'value' => '$data->idProblema0->Enunciado'
//        ),
        array('name' => 'Tiempo Máx (ms)',
            'value' => '$data->idProblema0->TiempoEjecucionMax'
        ),
        array('name' => 'Resuelto por',
            'value' => '$data->Resuelto'
        ),
        
        array(
            'class' => 'CButtonColumn',
            'template' => '{ver}',
            'buttons' => array(
                'ver' => array(
                    
                    'url' => 'Yii::app()->controller->createUrl(\'verproblema\', array(\'idTorneo\'=>$data["idTorneo"],\'idProblema\'=>$data["idProblema"]))',
                )
            ),
        ),
    ),
));
?>
<?php endif;?>

<?php if (Yii::app()->user->checkAccess('Administrador')):?>
<hr/>
<h1>Resoluciones</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'grid-resoluciones',
    'dataProvider'=>$resoluciones->search(),
	'filter'=>$resoluciones,
    'columns' => array(
        //'idTwit',
        array('header'=>'Problema',
            'value'=>'$data->idProblema0->Nombre'),
        array('name'=>'NombreEquipo',
            'value'=>'$data->idUsuario0->NombreUsuario'),
        /*array('name' => 'Equipo',
            'value' => '$data->idUsuario0->NombreUsuario'
        ),*/
        'FechaSolicitud',
        array('header' => 'Tiempo Respuesta',
            'value' => '$data->FechaRespuestaOK'
        ),
        'idSolucion0.ParametrosEntrada',
        'Respuesta',
        array('header'=>'Respuesta Correcta',
            'value'=>'$data->idSolucion0->Salida'),
        array('name'=>'Estado',
            'value'=>'$data->idEstado0->Estado'),
        //'idEstado0.Estado'
        
    ),
));
?>

<?php endif; ?>
