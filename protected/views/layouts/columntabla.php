<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="span-19">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-5 last">
	<div id="sidebar">
	<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Operaciones',
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget();
                
                $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Tabla de Posiciones',
		));
                $connection = Yii::app()->db;
                $sql = "select Equipo.id,Equipo, sum(`Tiempo`) as `Puntos` from Equipo left outer join Parcial on Equipo.id=Parcial.idEquipo group by Equipo.id,Equipo order by Puntos desc";
                $command=$connection->createCommand($sql);
                
                $equipos = $command->queryAll();
                
                foreach ($equipos as $registro){
                    /* @var $registro Equipo */
                    
                    echo '<p>'.$registro['Equipo'].' <b>'.$registro['Puntos'].'</b></p>';
                }
		$this->endWidget();
                
	?>
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>