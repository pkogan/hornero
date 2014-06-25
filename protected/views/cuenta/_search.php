<?php
/* @var $this CuentaController */
/* @var $model Cuenta */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Nombre'); ?>
		<?php echo $form->textField($model,'Nombre',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Inicio'); ?>
		<?php echo $form->textField($model,'Inicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Fin'); ?>
		<?php echo $form->textField($model,'Fin'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Tiempo'); ?>
		<?php echo $form->textField($model,'Tiempo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->