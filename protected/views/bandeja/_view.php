<?php
/* @var $this BandejaController */
/* @var $data TorneoUsuario */
?>

<div class="view <?php echo 'estado_' . $data->idTorneo0->idEstado; ?>">
     
    <h2><?php echo CHtml::link('Torneo '.CHtml::encode($data->idTorneo0->Nombre),array('/torneo/view', 'id'=>$data->idTorneo0->idTorneo)); ?></h2>
    <b>Token: <?php echo $data->Token;?></b><br/>
    <b>Su posicion es: <?php echo $data->getPosicion();?></b>
    <p><?php echo '<b>'.$data->idTorneo0->getCartelEstado().'</b>. '.CHtml::encode($data->idTorneo0->Descripcion); ?></p>
    
</div>