<?php
/* @var $this ParcialController */
/* @var $model Parcial */
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
		<?php echo $form->label($model,'idCuenta'); ?>
		<?php echo $form->textField($model,'idCuenta'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idEquipo'); ?>
		<?php echo $form->textField($model,'idEquipo'); ?>
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