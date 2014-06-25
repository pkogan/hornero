<?php
/* @var $this ProblemaController */
/* @var $model Problema */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'problema-form',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'Nombre'); ?>
		<?php echo $form->textField($model,'Nombre',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'Nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Archivo'); ?>
		<?php echo $form->fileField($model,'Archivo',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'Archivo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Enunciado'); ?>
		<?php echo $form->textArea($model,'Enunciado',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'Enunciado'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'idTipo'); ?>
		<?php echo $form->dropDownList($model,'idTipo',CHtml::listData(TipoProblema::model()->findAll(array('order' => 'Tipo')),'idTipo','Tipo'),array('prompt'=>'Seleccionar...'));//$form->textField($model,'idEquipo'); ?>
		<?php echo $form->error($model,'idTipo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idComplejidad'); ?>
                <?php echo $form->dropDownList($model,'idComplejidad',CHtml::listData(Complejidad::model()->findAll(array('order' => 'Complejidad')),'idComplejidad','Complejidad'),array('prompt'=>'Seleccionar...'));//$form->textField($model,'idEquipo'); ?>
		<?php echo $form->error($model,'idComplejidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TiempoEjecucionMax'); ?>
		<?php echo $form->textField($model,'TiempoEjecucionMax'); ?>
		<?php echo $form->error($model,'TiempoEjecucionMax'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->