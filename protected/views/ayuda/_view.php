<?php
/* @var $this StubController */
/* @var $data Stub */
?>

<div class="view">

<!--	<b><?php echo CHtml::encode($data->getAttributeLabel('idStubs')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idStubs), array('view', 'id'=>$data->idStubs)); ?>
	<br />-->

	<b><?php echo CHtml::encode($data->getAttributeLabel('idLenguaje')); ?>:</b>
	<?php echo CHtml::encode($data->idLenguaje0->Lenguaje); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->Descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Archivo')); ?>:</b>
	<?php echo CHtml::link('Descargar', array('/stub/descargar', 'id'=>$data->Archivo));?>
	<br />


</div>