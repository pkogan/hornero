<?php
/* @var $this CuentaController */
/* @var $model Cuenta */

$this->breadcrumbs=array(
	'Cuentas'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Cuenta', 'url'=>array('index')),
	array('label'=>'Create Cuenta', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#cuenta-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Cuentas</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cuenta-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
                'idTorneo',
		'Nombre',
		'Inicio',
		'Fin',
		'Tiempo',
		array(
			'class'=>'CButtonColumn',

            'template' => '{iniciar}{view}{update}{delete}',
            'buttons' => array(
                'iniciar' => array(
                    'url' => 'Yii::app()->controller->createUrl(\'iniciar\', array(\'id\'=> $data["id"]))', //url de la acción nueva
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
		
	),
)))); ?>
