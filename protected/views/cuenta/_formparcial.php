<?php
/* @var $this ParcialController */
/* @var $model Parcial */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'parcial-form',
	'enableAjaxValidation'=>false,
)); ?>


		<?php echo $form->hiddenField($model,'idCuenta'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'idEquipo0.Equipo'); ?>
		<?php echo $form->dropDownList($model,'idEquipo',CHtml::listData(Equipo::model()->findAll(array('order' => 'Equipo')),'id','Equipo'),array('prompt'=>'Seleccionar...'));//$form->textField($model,'idEquipo'); ?>
		<?php echo $form->error($model,'idEquipo'); ?>
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Entrega' : 'Entrega'); ?>
	</div>

	

<?php $this->endWidget(); ?>

</div><!-- form -->