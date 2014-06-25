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

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'idCuenta'); ?>
		<?php echo $form->textField($model,'idCuenta'); ?>
		<?php echo $form->error($model,'idCuenta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idEquipo'); ?>
		<?php echo $form->dropDownList($model,'idEquipo',CHtml::listData(Equipo::model()->findAll(array('order' => 'Equipo')),'id','Equipo'),array('prompt'=>'Seleccionar...'));//$form->textField($model,'idEquipo'); ?>
		<?php echo $form->error($model,'idEquipo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Tiempo'); ?>
		<?php echo $form->textField($model,'Tiempo'); ?>
		<?php echo $form->error($model,'Tiempo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->