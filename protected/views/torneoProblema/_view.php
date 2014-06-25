<?php
/* @var $this TorneoProblemaController */
/* @var $data TorneoProblema */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idTorneoProblema')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idTorneoProblema), array('view', 'id'=>$data->idTorneoProblema)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idProblema')); ?>:</b>
	<?php echo CHtml::encode($data->idProblema); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idTorneo')); ?>:</b>
	<?php echo CHtml::encode($data->idTorneo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Orden')); ?>:</b>
	<?php echo CHtml::encode($data->Orden); ?>
	<br />


</div>