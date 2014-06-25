<?php
/* @var $this ParcialController */
/* @var $data Parcial */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idCuenta')); ?>:</b>
	<?php echo CHtml::encode($data->idCuenta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idEquipo')); ?>:</b>
	<?php echo CHtml::encode($data->idEquipo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Tiempo')); ?>:</b>
	<?php echo CHtml::encode($data->Tiempo); ?>
	<br />


</div>