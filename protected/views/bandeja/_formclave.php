<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuario-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ClaveActual'); ?>
		<?php echo $form->passwordField($model,'ClaveActual',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'ClaveActual'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Clave',array('label'=>'Clave Nueva')); ?>
		<?php echo $form->passwordField($model,'Clave',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'Clave'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'ReClave'); ?>
		<?php echo $form->passwordField($model,'ReClave',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'ReClave'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Actualizar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->