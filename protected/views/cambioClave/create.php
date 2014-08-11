<?php
/* @var $this CambioClaveController */
/* @var $model CambioClave */

$this->breadcrumbs=array(
	'Recuperar Clave',
);


?>

<h1>Recuperar Clave</h1>
<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>    
<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<?php endif;