<?php
/* @var $this TorneoController */
/* @var $data Torneo */
?>

<div class="view <?php echo 'estado_' . $data->idEstado; ?>">
     <?php if (!$data->usuarioInscripcion&&$data->idEstado!=3){
                echo CHtml::button("Inscribirse - Jugar", array(
                    'submit' => $this->createUrl('/torneo/inscripcion', array('idTorneo' => $data->idTorneo)),
                    'style' => 'float:right'));
     }
           ?>
    <h2><?php echo CHtml::link('Torneo '.CHtml::encode($data->Nombre),array('view', 'id'=>$data->idTorneo)); ?></h2>   
    <p><?php echo '<b>'.$data->getCartelEstado().'</b>. '.CHtml::encode($data->Descripcion); ?></p>
</div>