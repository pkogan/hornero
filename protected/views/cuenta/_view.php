<?php
/* @var $this CuentaController */
/* @var $data Cuenta */
?>

<div class="view">

	<b><?php echo CHtml::encode('Ejercicio');//$data->getAttributeLabel('Nombre')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('Inicio')); ?>:</b>
	<?php echo CHtml::encode($data->Inicio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Fin')); ?>:</b>
	<?php echo CHtml::encode($data->Fin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Tiempo')); ?>:</b>
	<?php echo CHtml::encode($data->Tiempo); ?>
	<br />


</div>