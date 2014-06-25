<?php
/* @var $this TorneoController */
/* @var $model Torneo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'torneo-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Nombre'); ?>
		<?php echo $form->textField($model,'Nombre',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'Nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Descripcion'); ?>
		<?php echo $form->textArea($model,'Descripcion',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'Descripcion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FechaInicio'); ?>
		<?php echo $form->textField($model,'FechaInicio'); ?>
		<?php echo $form->error($model,'FechaInicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FechaFin'); ?>
		<?php echo $form->textField($model,'FechaFin'); ?>
		<?php echo $form->error($model,'FechaFin'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idEstado'); ?>
                <?php echo $form->dropDownList($model,'idEstado',CHtml::listData(EstadoTorneo::model()->findAll(array('order' => 'Estado')),'idEstado','Estado'),array('prompt'=>'Seleccionar...'));//$form->textField($model,'idEquipo'); ?>
		<?php echo $form->error($model,'idEstado'); ?>
	</div>
<div class="row">
		<?php echo $form->labelEx($model,'idTipo'); ?>
                <?php echo $form->dropDownList($model,'idTipo',CHtml::listData(TipoTorneo::model()->findAll(array('order' => 'Tipo')),'idTipo','Tipo'),array('prompt'=>'Seleccionar...'));//$form->textField($model,'idEquipo'); ?>
		<?php echo $form->error($model,'idTipo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->