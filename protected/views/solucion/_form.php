<?php
/* @var $this SolucionController */
/* @var $model Solucion */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'solucion-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'idSolucion'); ?>
		<?php echo $form->textField($model,'idSolucion'); ?>
		<?php echo $form->error($model,'idSolucion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idProblema'); ?>
		<?php echo $form->textField($model,'idProblema'); ?>
		<?php echo $form->error($model,'idProblema'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ParametrosEntrada'); ?>
		<?php echo $form->textField($model,'ParametrosEntrada',array('size'=>60,'maxlength'=>2000)); ?>
		<?php echo $form->error($model,'ParametrosEntrada'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Salida'); ?>
		<?php echo $form->textField($model,'Salida',array('size'=>60,'maxlength'=>2000)); ?>
		<?php echo $form->error($model,'Salida'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->