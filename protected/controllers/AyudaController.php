<?php

class AyudaController extends Controller
{
	public function actionIndex()
	{
            if(!Yii::app()->user->isGuest)
                $usuario = Usuario::model()->findByPk(Yii::app()->user->idUsuario);
            else{
                $usuario=null;
            }
	    $this->render('index',array('usuario'=>$usuario));
	}
        public function actionStubs()
	{
            $dataProvider=new CActiveDataProvider('Stub');
		$this->render('stubs',array(
			'dataProvider'=>$dataProvider,
		));
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