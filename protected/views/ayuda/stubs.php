<?php
/* @var $this AyudaController */

$this->breadcrumbs=array(
	'Ayuda'=> array('index'),
        'Stubs',
);
?>
<h1>Stubs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

