<?php
/* @var $this SolucionController */
/* @var $model Solucion */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idSolucion'); ?>
		<?php echo $form->textField($model,'idSolucion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idProblema'); ?>
		<?php echo $form->textField($model,'idProblema'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ParametrosEntrada'); ?>
		<?php echo $form->textField($model,'ParametrosEntrada',array('size'=>60,'maxlength'=>2000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Salida'); ?>
		<?php echo $form->textField($model,'Salida',array('size'=>60,'maxlength'=>2000)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->