<?php
/* @var $this TorneoProblemaController */
/* @var $model TorneoProblema */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'torneo-problema-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'idProblema'); ?>
		<?php echo $form->textField($model,'idProblema'); ?>
		<?php echo $form->error($model,'idProblema'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idTorneo'); ?>
		<?php echo $form->textField($model,'idTorneo'); ?>
		<?php echo $form->error($model,'idTorneo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Orden'); ?>
		<?php echo $form->textField($model,'Orden'); ?>
		<?php echo $form->error($model,'Orden'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->