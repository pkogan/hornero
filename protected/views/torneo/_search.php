<?php
/* @var $this TorneoController */
/* @var $model Torneo */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>


	<div class="row">
 	    <?php echo $form->textField($model,'Nombre',array('size'=>20,'maxlength'=>255)); ?>
            <?php echo CHtml::submitButton('Buscar'); ?>
	</div>


<?php $this->endWidget(); ?>

</div><!-- search-form -->