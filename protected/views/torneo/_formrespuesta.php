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
		<h3>Respuesta: 
                    <?php echo CHtml::textField('Respuesta','',array('size'=>60,'maxlength'=>2000, 'style'=>'font-size:20px', 'autofocus'=>'autofocus')); ?>
                    </h3>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Enviar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->