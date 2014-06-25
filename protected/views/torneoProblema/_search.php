<?php
/* @var $this TorneoProblemaController */
/* @var $model TorneoProblema */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idTorneoProblema'); ?>
		<?php echo $form->textField($model,'idTorneoProblema'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idProblema'); ?>
		<?php echo $form->textField($model,'idProblema'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idTorneo'); ?>
		<?php echo $form->textField($model,'idTorneo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Orden'); ?>
		<?php echo $form->textField($model,'Orden'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->