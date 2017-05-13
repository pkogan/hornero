<?php
/* @var $this TorneoController */
/* @var $model ProxyHornero */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'respuesta-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="row">
		<?php echo CHtml::hiddenField('TokenSolicitud',$model->tokenSolicitud,array()); ?>
            <h3>Opciones:<br> 
                    <?php
                    //foreach ($model->opciones as $opcion) {
                     //$radio=array($opcion=>$opcion);
                     //echo CHtml::radioButton('Respuesta','',$radio,array( 'autofocus'=>'autofocus')). $opcion; 
                 //} 
                    echo CHtml::radioButtonList('Respuesta','',$model->opciones,array( 'autofocus'=>'autofocus')); 
                    ?>
                    </h3>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Enviar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->