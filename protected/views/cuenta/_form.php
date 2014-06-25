<?php
/* @var $this CuentaController */
/* @var $model Cuenta */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cuenta-form',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'idTorneo'); ?>
		<?php echo $form->textField($model,'idTorneo'); ?>
		<?php echo $form->error($model,'idTorneo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Nombre'); ?>
		<?php echo $form->textArea($model,'Nombre',array('size'=>100,'rows'=>5,'cols'=>100)); ?>
		<?php echo $form->error($model,'Nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Archivo'); ?>
		<?php echo $form->fileField($model,'Archivo',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'Archivo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Inicio'); ?>
		<?php echo $form->textField($model,'Inicio'); ?>
		<?php echo $form->error($model,'Inicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Fin'); ?>
		<?php echo $form->textField($model,'Fin'); ?>
		<?php echo $form->error($model,'Fin'); ?>
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