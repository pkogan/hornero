<?php

class BandejaController extends Controller {

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'cuenta'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        $usuario = Usuario::model()->findByPk(Yii::app()->user->idUsuario);
        /* @var $usuario Usuario */
        $torneos = new CArrayDataProvider($usuario->torneoUsuarios, array('keyField' => 'idTorneo',
            'pagination' => false));

        $this->render('index', array('usuario' => $usuario, 'torneos' => $torneos));
    }

    public function actionCuenta() {

        //$this->redirect(array('/usuario/update', 'id' => Yii::app()->user->idUsuario));
        $model = Usuario::model()->findByPk(Yii::app()->user->idUsuario);
        if(is_null($model)){
            throw new Exception('No existe el usuario');
        }
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Usuario'])) {
            unset($_POST['Usuario']['idRol']);
            unset($_POST['Usuario']['Clave']);
            $model->attributes = $_POST['Usuario'];
            if ($model->save()) {
                    $this->redirect(array('/bandeja'));
            }
        }
        $this->render('update', array(
            'model' => $model,
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
