<?php
/* @var $this StubController */
/* @var $model Stub */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'stub-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'idLenguaje'); ?>
		<?php echo $form->dropDownList($model,'idLenguaje',CHtml::listData(Lenguaje::model()->findAll(array('order' => 'Lenguaje')),'idLenguaje','Lenguaje'),array('prompt'=>'Seleccionar...'));//textField($model,'idLenguaje'); ?>
		<?php echo $form->error($model,'idLenguaje'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Descripcion'); ?>
		<?php echo $form->textArea($model,'Descripcion',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'Descripcion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Archivo'); ?>
		<?php echo $form->fileField($model,'Archivo',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'Archivo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->