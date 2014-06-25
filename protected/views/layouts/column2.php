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
			'title'=>'Ultimas Soluciones',
		));
                $criteria = new CDbCriteria;
                $criteria->addCondition('t.idEstado<>1');
                $criteria->order='FechaRespuesta DESC';
                $criteria->limit = 7;

                $registros=  Resolucion::model()->with(array('idUsuario0','idProblema0','idTorneo0','idEstado0'))->findAll($criteria);
                foreach ($registros as $registro){
                    /* @var $registro Resolucion */
                    echo $registro->fechaRespuestaOK.' <b>'.  CHtml::encode($registro->idUsuario0->NombreUsuario)
                            .'</b> resolvio el problema '.CHtml::encode($registro->idProblema0->Nombre)
                            .' del torneo '.CHtml::encode($registro->idTorneo0->Nombre)
                            .' de forma '.CHtml::encode($registro->idEstado0->Estado).'<hr/>';
                }
		$this->endWidget();
                
	?>
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>