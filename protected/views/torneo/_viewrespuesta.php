<?php
/* @var $this TorneoController */
/* @var $data Resolucion */
?>

<div class="view <?php echo 'estado_' . $data->idEstado; ?>">
    <h3>Problema#<?php 
    echo isset($data->idTorneoProblema0->Orden)?$data->idTorneoProblema0->Orden:"";
    echo ' '.$data->idProblema0->Nombre;
    echo '. '.$data->idEstado0->Estado;?></h2>   
    <p><?php echo $data->FechaRespuestaOK.': '.$data->idSolucion0->ParametrosEntrada.'->'.$data->Respuesta; ?></p>
</div>