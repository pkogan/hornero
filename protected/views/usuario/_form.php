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

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<div class="row">
            <label for="Registro_Institucion">Institución, Escuela, Universidad, ...</label>
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
                <label for="Registro_Descripcion">Nombre y Apellido de cada uno de los Participantes del equipo</label>
		<?php //echo $form->labelEx($model,'Descripcion'); ?>
		<?php echo $form->textField($model,'Descripcion',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'Descripcion'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'Clave'); ?>
		<?php //echo $form->textField($model,'Clave',array('size'=>60,'maxlength'=>100)); ?>
		<?php //echo $form->error($model,'Clave'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idRol'); ?>
		<?php echo $form->textField($model,'idRol'); ?>
		<?php echo $form->error($model,'idRol'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Email'); ?>
		<?php echo $form->textField($model,'Email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'Email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idLenguaje'); ?>
		<?php echo $form->textField($model,'idLenguaje'); ?>
		<?php echo $form->error($model,'idLenguaje'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->