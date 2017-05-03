<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ProxyHornero {
    /*
      modificar el token que le corresponde al equipo para el torneo
      y el numero de Problema a Trabajar
     */

    public $token = 'eb1d954e6cfa2749f7624b0eda4a939f';
    public $tokenSolicitud;
    public $problema = 1;
    public $parametros;

    /*
      Se piden los parametros al servidor hornero NO TOCAR!!!! */
    
    //TODO: ver como mejorar esta linea para que funcione siempre
    public $host = 'localhost';
    //public $host = 'localhost/yii/hornero';
    public function __construct($problema,$token) {
        $this->problema = $problema;
        $this->token=$token;
    }

    public function solicitud() {
        $urlsolicitud = Yii::app()->createAbsoluteUrl("juego/solicitud",array('token'=>$this->token,'problema'=>$this->problema));
        //echo $urlsolicitud; exit;
        $handle = fopen($urlsolicitud, 'r');
        $json = fgets($handle);
        $solicitud = json_decode($json);
        //echo '<pre>';  print_r($solicitud);exit;
        if(isset($solicitud->error)){
            throw new CHttpException('Comunicación Proxy '.$solicitud->error);
        }
        $this->tokenSolicitud = $solicitud->token;
        $this->parametros=$solicitud->parametrosEntrada;
        $parametros = explode(',', $solicitud->parametrosEntrada);
        
        return $parametros;
    }

    public function respuesta($respuesta) {
        $urlrespuesta = Yii::app()->createAbsoluteUrl("juego/respuesta",array('tokenSolicitud'=>$this->tokenSolicitud,'solucion'=>$respuesta));
        //echo $urlrespuesta;
        $handle = fopen($urlrespuesta, 'r');
        $json = fgets($handle);
        $respuesta = json_decode($json);
        return $respuesta;
    }

}
