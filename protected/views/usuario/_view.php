<?php
/* @var $this UsuarioController */
/* @var $data Usuario */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idUsuario')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idUsuario), array('view', 'id'=>$data->idUsuario)); ?>
	<br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('Institucion')); ?>:</b>
	<?php echo CHtml::encode($data->Institucion); ?>
	<br />
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('NombreUsuario')); ?>:</b>
	<?php echo CHtml::encode($data->NombreUsuario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->Descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Clave')); ?>:</b>
	<?php echo CHtml::encode($data->Clave); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idRol')); ?>:</b>
	<?php echo CHtml::encode($data->idRol); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Email')); ?>:</b>
	<?php echo CHtml::encode($data->Email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idLenguaje')); ?>:</b>
	<?php echo CHtml::encode($data->idLenguaje); ?>
	<br />


</div>