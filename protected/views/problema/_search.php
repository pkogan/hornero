<?php
/* @var $this ProblemaController */
/* @var $model Problema */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idProblema'); ?>
		<?php echo $form->textField($model,'idProblema'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idTipo'); ?>
		<?php echo $form->textField($model,'idTipo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Nombre'); ?>
		<?php echo $form->textField($model,'Nombre',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Archivo'); ?>
		<?php echo $form->textField($model,'Archivo',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Enunciado'); ?>
		<?php echo $form->textArea($model,'Enunciado',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idComplejidad'); ?>
		<?php echo $form->textField($model,'idComplejidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TiempoEjecucionMax'); ?>
		<?php echo $form->textField($model,'TiempoEjecucionMax'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->