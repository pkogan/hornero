<?php
/* @var $this SolucionController */
/* @var $data Solucion */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idSolucion')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idSolucion), array('view', 'id'=>$data->idSolucion)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idProblema')); ?>:</b>
	<?php echo CHtml::encode($data->idProblema); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ParametrosEntrada')); ?>:</b>
	<?php echo CHtml::encode($data->ParametrosEntrada); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Salida')); ?>:</b>
	<?php echo CHtml::encode($data->Salida); ?>
	<br />


</div>