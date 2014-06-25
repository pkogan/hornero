<?php
/* @var $this TorneoinicialController */

$this->breadcrumbs=array(
	'Torneoinicial',
);
?>
<h1>Tiempo para terminar ejercicio 1: <?php 
$fecha=new DateTime('2014-04-22 22:00');
                    $this->widget('ext.bcountdown.BCountdown', 
        array(

                'title'=>'Torneo Inicial',  // Title
                'message'=>false, // message for user
                'isDark'=>false,  // two skin dark and light , by default it light i.e isDark=false
                'year'=>$fecha->format('Y'),   
                'month'=>$fecha->format('m'),   
                'day'=>$fecha->format('j'),
                'hour'=>$fecha->format('G'),
                'min'=>$fecha->format('i'),
                'sec'=>$fecha->format('s'),
            )
        );

                    $this->widget('ext.duciscounter.DucisCounter', 
        array(
              'start_timestamp' => strtotime("2014-04-04 02:00:00 GMT"), 
              'end_timestamp' => strtotime("2014-05-04 02:00:00 GMT"), 
               'now' => strtotime("2014-04-02 02:00:00 GMT")
            )
        );
                    ?></h1>

<p>
	You may change the content of this page by modifying
	the file <tt><?php echo __FILE__; ?></tt>.
</p>
