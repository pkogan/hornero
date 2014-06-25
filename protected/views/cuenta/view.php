<?php
/* @var $this CuentaController */
/* @var $model Cuenta */

$this->breadcrumbs = array(
    'Cuentas' => array('index'),
    $model->id,
);

$this->menu = array(
    //array('label' => 'List Cuenta', 'url' => array('index')),
    array('label' => 'Iniciar', 'url' => array('iniciar', 'id' => $model->id)),
    //array('label' => 'Create Cuenta', 'url' => array('create')),
    array('label' => 'Actualizar', 'url' => array('update', 'id' => $model->id)),
    //array('label' => 'Delete Cuenta', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    //array('label' => 'Manage Cuenta', 'url' => array('admin')),
);
?>
<?php  if($model->Archivo!='')
    echo CHtml::image(Yii::app()->createUrl('cuenta/descargar',array('id'=>$model->Archivo)),'detalle',array('height'=>'150px','style'=>'float:right'));?>
<h1><?php echo $model->Nombre; ?></h1>

<div style="background-color: #FFFFFF">
<hr/>
    <?php
/*$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'Inicio',
        'Fin',
        'Tiempo',
    ),
));*/
$fecha = new DateTime($model->Fin);

$this->widget('ext.bcountdown.BCountdown', array(
    'title' => 'Torneo Inicial', // Title
    'message' => false, // message for user
    'isDark' => false, // two skin dark and light , by default it light i.e isDark=false
    'year' => $fecha->format('Y'),
    'month' => $fecha->format('m'),
    'day' => $fecha->format('j'),
    'hour' => $fecha->format('G'),
    'min' => $fecha->format('i'),
    'sec' => $fecha->format('s'),
        )
);

?>
    
<br/>
</div>
<hr/>
<?php $this->renderPartial('_formparcial', array('model' => $modelnuevoParcial)) ?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'parcial-grid',
    'dataProvider' => $modelParcial->search(),
    //'filter'=>$modelParcial,
    'columns' => array(
        'idEquipo0.Equipo',
        'Tiempo',
        
         array(
            'class' => 'CButtonColumn',
            'template' => '{borrar}',
            'buttons' => array(
                'borrar' => array(
                                'url' => 'Yii::app()->controller->createUrl(\'deleteParcial\', array(\'id\'=>$data["id"]))',
                ),
            ),
        ),
        
    ),
));
?>
