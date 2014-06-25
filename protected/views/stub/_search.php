<?php
/* @var $this StubController */
/* @var $model Stub */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idStubs'); ?>
		<?php echo $form->textField($model,'idStubs'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idLenguaje'); ?>
		<?php echo $form->textField($model,'idLenguaje'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Descripcion'); ?>
		<?php echo $form->textArea($model,'Descripcion',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Archivo'); ?>
		<?php echo $form->textField($model,'Archivo',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->