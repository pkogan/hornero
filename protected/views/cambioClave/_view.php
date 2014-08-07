<?php
/* @var $this CambioClaveController */
/* @var $data CambioClave */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idCambio')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idCambio), array('view', 'id'=>$data->idCambio)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idUsuario')); ?>:</b>
	<?php echo CHtml::encode($data->idUsuario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('token')); ?>:</b>
	<?php echo CHtml::encode($data->token); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />


</div>