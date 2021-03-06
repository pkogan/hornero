<?php

class JuegoController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    /**
     * Crea una Resolución de un problema para un usuario y torneo dado.
     * Retorna los parámetros de una resolución random del problema y un token
     * que identifica la resolución creada
     * 
     * @param type $token
     * @param type $problema
     */
    public function actionSolicitud($token, $problema) {
        $tiempoActual = (int) (microtime(true) * 1000);
        $respuesta = array();
        //se busca el usuario y el toneo en base al token
        $Usuario = TorneoUsuario::model()->find('token=:token', array(':token' => $token));
        if (is_null($Usuario)) {
            $respuesta['error'] = 'NO ES UN TOKEN VALIDO';
        } elseif ($Usuario->idTorneo0->idEstado == EstadoTorneo::ANTESCOMIENZO) {
            $respuesta['error'] = 'EL TORNEO NO HA EMPEZADO';
        } else {

            /* @var $Usuario TorneoUsuario */
            $idTorneo = $Usuario->idTorneo;
            //busca el problema del torneo
            $Problema = TorneoProblema::model()->find('idTorneo=:idTorneo and Orden=:Orden', array(':idTorneo' => $idTorneo, ':Orden' => $problema));

            /* @var $Problema TorneoProblema */

            if (is_null($Problema)) {
                //si no existe el problema
                $respuesta['error'] = 'NO EXISTE EL PROBLEMA PARA EL TORNEO';
            } else {
                //si existe busco la cantidad de soluciones que hay disponibles para ese problema
                $cantidadSoluciones = $Problema->idProblema0->solucionCount;
                if ($cantidadSoluciones == 0) {
                    $respuesta['error'] = 'NO TIENE SOLUCIONES';
                } else {
                    /**
                     * si es la primera vez del usuario en el problema debe seleccionar un random
                     * si no un random sin las primeras 5 soluciones
                     */
                    /**
                     * Busco la últimas 5 soluciones del usuario en el torneo del problema
                     */
                    $criteria = new CDbCriteria;
                    $criteria->order = 'idResolucion Desc';
                    $criteria->limit = '5';
                    $criteria->compare('idUsuario', $Usuario->idUsuario);
                    $criteria->compare('idTorneo', $Usuario->idTorneo);
                    $criteria->compare('idProblema', $Problema->idProblema);

                    $rows = Resolucion::model()->findAll($criteria);
                    if (is_null($rows)) {
                        $solucionRandom = rand(0, $cantidadSoluciones - 1);
                        $soluciones = $Problema->idProblema0->solucions;
                        $solucion = $soluciones[$solucionRandom];
                    } else {
                        $in = array();
                        foreach ($rows as $key => $resolucion) {
                            /* @var $resolucion Resolucion */
                            $in[] = $resolucion->idSolucion;
                        }
                        //print_r($in);
                        //echo implode(',', $in);
                        $solucionRandom = rand(0, $cantidadSoluciones - count($in) - 1);
                        $criteria = new CDbCriteria;
                        $criteria->order = 'idSolucion Desc';
                        $criteria->offset = $solucionRandom;
                        $criteria->limit = 1;
                        $criteria->compare('idProblema',$Problema->idProblema);
                        $criteria->addNotInCondition('idSolucion',$in);
                         
                        $solucion = Solucion::model()->find($criteria);
                        /*$solucion = Solucion::model()->findAll($criteria);
                        $in=array();
                        foreach ($solucion as $key => $resolucion) {
                            
                            $in[] = $resolucion->idSolucion;
                        }
                        print_r($in);
                        
                        $solucion=$solucion[0];*/
                    }
                    if (is_null($solucion)) {
                        $respuesta['error'] = 'NO TIENE SUFICIENTES SOLUCIONES';
                    } else {

                        /* @var $solucion Solucion */
                        $token = md5(microtime() . $token);
                        //se crea un registro en la tabla Resolución esperando por la respuesta
                        $tablaResolucion = new Resolucion;
                        $tablaResolucion->idUsuario = $Usuario->idUsuario;
                        $tablaResolucion->idTorneo = $idTorneo;
                        $tablaResolucion->idProblema = $solucion->idProblema;
                        $tablaResolucion->idSolucion = $solucion->idSolucion;
                        $tablaResolucion->idEstado = 1;
                        $tablaResolucion->Token = $token;
                        $tablaResolucion->FechaSolicitud = $tiempoActual;
                        if ($tablaResolucion->insert()) {
                            $respuesta['nombreProblema'] = $Problema->idProblema0->Nombre;
                            //$respuesta['enunciado'] = $Problema->idProblema0->Enunciado;
                            $respuesta['parametrosEntrada'] = $solucion->ParametrosEntrada;
                            $respuesta['token'] = $token;
                            $respuesta['opciones'] = $solucion->getOpciones();
                        } else {
                            $respuesta['error'] = 'AL AGREGAR LA RESOLUCION';
                        }
                    }
                }
            }
        }
        header('Content-type: application/json; charset=utf-8');
        $json = json_encode($respuesta);
        //header('Content-Length: '.  sizeof($json));

        echo $json;
        $this->layout = FALSE;
        //exit;
    }

    /**
     * Valida que la Respuesta sea correcta
     * @param type $tokenSolicitud
     * @param type $solucion
     */
    public function actionRespuesta($tokenSolicitud, $solucion) {
        $tiempoActual = (int) (microtime(true) * 1000);
        $respuesta = array();
        //se busca el usuario y el toneo en base al token
        $Resolucion = Resolucion::model()->find('Token=:token', array(':token' => $tokenSolicitud));
        if (is_null($Resolucion)) {
            $respuesta['error'] = 'NO ES UN TOKEN VALIDO';
        } elseif ($Resolucion->idEstado != 1) {
            $respuesta['error'] = 'ESTA RESOLUCION YA ESTA RESPONDIDA';
        } else {
            /**
             * Busco la última solución mal resuelta del usuario en el torneo
             */
            $criteria = new CDbCriteria;
            $criteria->order = 'FechaRespuesta Desc';
            $criteria->limit = '1';
            $criteria->compare('idUsuario', $Resolucion->idUsuario);
            $criteria->compare('idTorneo', $Resolucion->idTorneo);
            $criteria->compare('idEstado', 3);
            /**
             * var $row Resolucion
             */
            $row = Resolucion::model()->find($criteria);
            $mensajePenalizacion = "";
            $tiempoPenalizacion = 0;
            if (!is_null($row)) {
                $idEstadoUltimo = $row->idEstado;
                $tiempoAnterior = $row->FechaRespuesta;
                $tiempoTranscurrido = $tiempoActual - $tiempoAnterior;
                /**
                 * Si el tiempo transcurrido de la última respuesta erronea en menor a 1000???
                 */
                if ($tiempoTranscurrido < 60000) {
                    $tiempoPenalizacion = 60000 - $tiempoTranscurrido;
                    $mensajePenalizacion = ". Para continuar debe esperar " . round($tiempoPenalizacion / 1000, 0) . " segundos.";
                    $idEstado = 14;
                }
            }
            $tiempo = $tiempoActual - $Resolucion->FechaSolicitud;
            if ($tiempoPenalizacion == 0) {


                /* @var $Resolucion Resolucion */


                if ($solucion == $Resolucion->idSolucion0->Salida) {
                    $idEstado = 2; //ok
                } else {
                    $idEstado = 3; //no ok
                }
                // si supera el tiempo y el torneo es distindo de proguntados Hornereando
                if ($tiempo > $Resolucion->idProblema0->TiempoEjecucionMax && $Resolucion->idTorneo0->idTipo != 4) {
                    $idEstado += 2; //supera el tiempo
                }

                if ($Resolucion->idTorneo0->idEstado != 2) {
                    $idEstado += 4; //torneo terminado
                } else {
                    /**
                     * buscar si ya resolvió el problema
                     */
                    $ResolucionCorrecta = Resolucion::model()->find('idTorneo=:idTorneo 
                and idUsuario=:idUsuario and idProblema=:idProblema and idEstado=2', array(':idTorneo' => $Resolucion->idTorneo,
                        ':idUsuario' => $Resolucion->idUsuario,
                        ':idProblema' => $Resolucion->idProblema));
                    if (count($ResolucionCorrecta) > 0) {
                        $idEstado += 8; //problema ya solucionado
                    }
                }


                if ($idEstado == 2) {
                    /**
                     * Busco la última solución resuelta del ejercicio
                     */
                    $criteria = new CDbCriteria;
                    $criteria->order = 'FechaRespuesta Desc';
                    $criteria->limit = '1';
                    $criteria->compare('idUsuario', $Resolucion->idUsuario);
                    $criteria->compare('idProblema', $Resolucion->idProblema);
                    $criteria->compare('idTorneo', $Resolucion->idTorneo);
                    $row = Resolucion::model()->find($criteria);
                    if (!is_null($row)) {
                        $idEstadoUltimo = $row->idEstado;
                    } else {
                        $idEstadoUltimo = NULL;
                    }
                    /*
                     * Si no existe $idEstado=21 
                     */
                    if (is_null($idEstadoUltimo) || $idEstadoUltimo < 21) {
                        $idEstado = 21;
                    } else {
                        /*
                         * Si existe $idEstado=$iEstadoEncontrado+1
                         */
                        $idEstado = $idEstadoUltimo + 1;
                    }


                    /*
                     * Si $idEstado==25 $idEstado=2 y 
                     * Si es un torneo Común 0
                     * Si $idEstado==23 si es un torneo Tipo Pregunrados
                     */

                    if ($idEstado == 25 || $idEstado == 23 && $Resolucion->idTorneo0->idTipo == 4) {
                        $idEstado = 2;
                        /*
                         * Si es la quinta (o tercera si es tipo preguntados) vez que se resuelve el problema
                         * de forma consecutiva
                         * Se actualiza la Tabla sumando un punto y
                         * el timestamp de la respuesta en la tabla 
                         */


                        $torneoUsuario = TorneoUsuario::model()->find('idTorneo=:idTorneo 
                and idUsuario=:idUsuario', array(':idTorneo' => $Resolucion->idTorneo,
                            ':idUsuario' => $Resolucion->idUsuario));
                        if ($torneoUsuario) {
                            $torneoUsuario->Puntos++;
                            $torneoUsuario->Tiempo = $tiempoActual;
                            $torneoUsuario->save();
                            /*
                             * :todo manejar el error
                             */
                        } else {
                            /**
                             * :todo manejar el error
                             */
                        }
                    }
                }
                //TorneoUsuario::model()->find($ResolucionCorrecta, $respuesta);
            }

            $Resolucion->idEstado = $idEstado;
            $Resolucion->Respuesta = $solucion;
            $Resolucion->FechaRespuesta = $tiempoActual;
            if ($Resolucion->update()) {
                $respuesta['codigo'] = $idEstado;
                $respuesta['mensaje'] = $Resolucion->idEstado0->Estado . $mensajePenalizacion;
                $respuesta['tiempoSolicitud'] = $Resolucion->FechaSolicitud;
                $respuesta['tiempoRespuesta'] = $Resolucion->FechaRespuesta;
                $respuesta['tiempo'] = $tiempo;
                $respuesta['tiempoPenalizacion'] = $tiempoPenalizacion;
            } else {
                $respuesta['error'] = 'AL ACTUALIZAR';
            }
        }
        header('Content-type: application/json; charset=utf-8');
        $json = json_encode($respuesta);
        //header('Content-Length: '.  sizeof($json));
        echo $json;
        $this->layout = FALSE;
        //exit;
    }

    // Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
}
