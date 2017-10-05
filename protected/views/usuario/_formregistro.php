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
                <label for="Registro_Institucion" class="required">Institución, Escuela, Universidad, ... <span class="required">*</span></label>
		<?php //echo $form->labelEx($model,'Institucion'); ?>
		<?php echo $form->textField($model,'Institucion',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'Institucion'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'NombreUsuario'); ?>
		<?php echo $form->textField($model,'NombreUsuario',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'NombreUsuario'); ?>
	</div>

	<div class="row">
                <label for="Registro_Descripcion" class="required">Nombre y Apellido de cada uno de los Participantes del equipo <span class="required">*</span></label>
		<?php //echo $form->labelEx($model,'Descripcion'); ?>
		<?php echo $form->textArea($model,'Descripcion',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'Descripcion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Clave'); ?>
		<?php echo $form->passwordField($model,'Clave',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'Clave'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'ReClave'); ?>
		<?php echo $form->passwordField($model,'ReClave',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'ReClave'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Email'); ?>
		<?php echo $form->textField($model,'Email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'Email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idLenguaje'); ?>
		<?php echo $form->dropDownList($model,'idLenguaje',CHtml::listData(Lenguaje::model()->findAll(array('order' => 'Lenguaje')),'idLenguaje','Lenguaje'),array('prompt'=>'Seleccionar...'));//textField($model,'idLenguaje'); ?>
		<?php echo $form->error($model,'idLenguaje'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->