<?php
/* @var $this ProblemaController */
/* @var $data Problema */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idProblema')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idProblema), array('view', 'id'=>$data->idProblema)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idTipo')); ?>:</b>
	<?php echo CHtml::encode($data->idTipo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Nombre')); ?>:</b>
	<?php echo CHtml::encode($data->Nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Archivo')); ?>:</b>
	<?php echo CHtml::encode($data->Archivo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Enunciado')); ?>:</b>
	<?php echo CHtml::encode($data->Enunciado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idComplejidad')); ?>:</b>
	<?php echo CHtml::encode($data->idComplejidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TiempoEjecucionMax')); ?>:</b>
	<?php echo CHtml::encode($data->TiempoEjecucionMax); ?>
	<br />


</div>