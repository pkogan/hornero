<?php

class RobotController extends Controller
{
	public function actionIndex()
	{
            /**
             * Recorrer todos los torneos
             * Si tiempo inicio es menor a ahora pasar a estado EnProceso
             * Si tiempo de fin es menor a ahora pasar a estado Terminado
             */
            $Torneos=  Torneo::model()->findAll();
            $ahora=  time();
            echo 'Ahora '.$ahora.'<br>';
            
            foreach ($Torneos as $Torneo) {
                /* @var $Torneo Torneo */
                $ini=strtotime($Torneo->FechaInicio);
                $fin=strtotime($Torneo->FechaFin);
                echo 'Torneo '.$Torneo->Nombre. 'en estado '.$Torneo->idEstado.' ini '.$ini;
                echo ', fin '.$fin.'<br>';
                if($ini<$ahora && $fin>$ahora
                        && $Torneo->idEstado!= EstadoTorneo::ENPROCESO){
                        $Torneo->idEstado = EstadoTorneo::ENPROCESO;
                        echo 'cambia torneo '.$Torneo->Nombre. ' a en Proceso <br>';
                        $Torneo->save();
                    }
                elseif($fin<$ahora
                        && $Torneo->idEstado!= EstadoTorneo::TERMINADO){
                        $Torneo->idEstado = EstadoTorneo::TERMINADO;
                        echo 'cambia torneo '.$Torneo->Nombre. ' a Terminado <br>';
                        $Torneo->save();
                    
                }
                
            }
            exit();
		$this->render('index');
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