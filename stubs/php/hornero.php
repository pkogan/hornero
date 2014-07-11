<?php

class Hornero {
    /*
      modificar el token que le corresponde al equipo para el torneo
      y el numero de Problema a Trabajar
     */

    public $token = 'eb1d954e6cfa2749f7624b0eda4a939f';
    public $tokenSolicitud;
    public $problema = 1;

    /*
      Se piden los parametros al servidor hornero NO TOCAR!!!! */
    public $host = 'hornero.fi.uncoma.edu.ar';
    //public $host = 'localhost/yii/hornero';
    public function __construct($problema,$token) {
        $this->problema = $problema;
        $this->token=$token;
    }

    public function solicitud() {
        $urlsolicitud = "http://".$this->host."/index.php?r=juego/solicitud&token=".$this->token."&problema=".$this->problema;
        echo $urlsolicitud;
        $handle = fopen($urlsolicitud, 'r');
        $json = fgets($handle);
        $solicitud = json_decode($json);
        echo '<pre>';  print_r($solicitud);

        $this->tokenSolicitud = $solicitud->token;
        $parametros = explode(',', $solicitud->parametrosEntrada);
        return $parametros;
    }

    public function respuesta($respuesta) {
        $urlrespuesta = "http://".$this->host."/index.php?r=juego/respuesta&tokenSolicitud=" . $this->tokenSolicitud . "&solucion=$respuesta";
        echo $urlrespuesta;
        $handle = fopen($urlrespuesta, 'r');
        $json = fgets($handle);
        $respuesta = json_decode($json);
        return $respuesta;
    }

}
