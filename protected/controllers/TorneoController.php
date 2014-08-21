<?php

class TorneoController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('inscripcion', 'actualizartoken', 'verproblema','borrarinscripcion'),
                'users' => array('@')),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'asignarproblema','asignarequipos','borrarequipo'),
                'roles' => array('Administrador'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'roles' => array('Administrador'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $model = $this->loadModel($id);
        
        /*
         * si no es administrador y es un torneo cerrado y no está inscripto no pasa
         */
        if(!Yii::app()->user->checkAccess('Administrador')&&$model->idTipo==TipoTorneo::CERRADO && !$model->getUsuarioInscripcion()){
            throw new CHttpException('Es un torneo Cerrado ');
        }


        //$modelResolucion->idTorneo = $id;

        
        /*$usuarios = new CArrayDataProvider($model->torneoUsuarios, array('keyField' => 'idUsuario',
            'pagination' => false));
        /*$problemas = new CArrayDataProvider($model->torneoProblemas, array('keyField' => 'idProblema',
            'pagination' => false ));*/
        $torneoUsuario= new TorneoUsuario('search');
        $torneoUsuario->unsetAttributes();  // clear any default values
        if (isset($_GET['TorneoUsuario']))
            $torneoUsuario->attributes = $_GET['TorneoUsuario'];
        $torneoUsuario->idTorneo=$id;
        
        
        $torneoProblema = new TorneoProblema('search');
        $torneoProblema->unsetAttributes();  // clear any default values
        if (isset($_GET['TorneoProblema']))
            $torneoProblema->attributes = $_GET['TorneoProblema'];
        
        $torneoProblema->idTorneo=$id;
        
        
        $resoluciones = new Resolucion('search');
        $resoluciones->unsetAttributes();  // clear any default values
        if (isset($_GET['Resolucion']))
            $resoluciones->attributes = $_GET['Resolucion'];
        $resoluciones->idTorneo = $id;
        

        $this->render('view', array(
            'model' => $model,
            'usuarios' => $torneoUsuario,
            'problemas' => $torneoProblema,
            'resoluciones'=>$resoluciones,
        ));
    }

    public function actionVerproblema($idTorneo, $idProblema) {
        
        
        $model = TorneoProblema::model()->find('idTorneo=:idTorneo and idProblema=:idProblema', array('idTorneo' => $idTorneo, 'idProblema' => $idProblema));
        /*
         * @var $model TorneoProblema
         */
       

        
        
        if (is_null($model)) {
            throw new CHttpException('El problema no existe asociado al Torneo');
        }
        /*
         * si no es administrador y es un torneo cerrado y no está inscripto no pasa
         */
        if(!Yii::app()->user->checkAccess('Administrador')&&$model->idTorneo0->idTipo==TipoTorneo::CERRADO && !$model->idTorneo0->getUsuarioInscripcion()){
            throw new CHttpException('Es un torneo Cerrado ');
        }
        if($model->idTorneo0->idEstado==EstadoTorneo::ANTESCOMIENZO && !Yii::app()->user->checkAccess('Administrador')) {
            throw new CHttpException('El Torneo no ha empezado');
        }
            
            
        $resoluciones = new Resolucion('search');
        $resoluciones->idProblema = $idProblema;
        $resoluciones->idTorneo = $idTorneo;
        $resoluciones->idUsuario = Yii::app()->user->idUsuario;
        $resolucionesProvider = $resoluciones->search();

        $this->render('verproblema', array(
            'model' => $model,
            'resoluciones' => $resolucionesProvider,
        ));
    }

    public function actionAsignarproblema($id) {
        $model=  $this->loadModel($id);
        if (isset($_GET['idProblema'])) {
            //se asigna y se redirige al view
            $idProblema=$_GET['idProblema'];
            $torneoproblema=  TorneoProblema::model()->find('idTorneo=:idTorneo and idProblema=:idProblema', array('idTorneo' => $id, 'idProblema' => $idProblema));
            if(is_null($torneoproblema)){
                
                $torneoproblema=new TorneoProblema();
                $torneoproblema->idProblema=$idProblema;
                $torneoproblema->idTorneo=$id;
                $torneoproblema->Orden=$model->problemasCount+1;
                if(!$torneoproblema->save())
                    throw new CHttpException('error al asignar problema');
            }
            $this->redirect(array('view', 'id' => $id));
        } else {
            $modelProblemas = new Problema('search');
            $modelProblemas->unsetAttributes();  // clear any default values
            if (isset($_GET['Problema']))
                $modelProblemas->attributes = $_GET['Problema'];

            $this->render('asignarproblema', array(
                'model' => $model,
                'problemas'=>$modelProblemas,
            ));
        }
    }


        public function actionAsignarequipos($id) {
        $model=  $this->loadModel($id);
        if (isset($_GET['idUsuario'])) {
            //se asigna y se redirige al view
            $idUsuario=$_GET['idUsuario'];
            $modelUsuario=  Usuario::model()->findByPk($idUsuario);
            if(is_null($modelUsuario)){
                throw new CHttpException('El usuario no existe');
            }
            $torneousuario=  TorneoUsuario::model()->find('idTorneo=:idTorneo and idUsuario=:idUsuario', array('idTorneo' => $id, 'idUsuario' => $idUsuario));
            if(is_null($torneousuario)){
                
                $torneousuario=new TorneoUsuario();
                $torneousuario->idUsuario=$idUsuario;
                $torneousuario->idTorneo=$id;
                $torneousuario->Token = md5($modelUsuario->NombreUsuario. microtime());
                if(!$torneousuario->save())
                    throw new CHttpException('error al asignar problema');
            }
            $this->redirect(array('view', 'id' => $id));
        } else {
            $modelUsuarios = new Usuario('search');
            $modelUsuarios->unsetAttributes();  // clear any default values
            if (isset($_GET['Usuario']))
                $modelUsuarios->attributes = $_GET['Usuario'];

            $this->render('asignarequipos', array(
                'model' => $model,
                'usuarios'=>$modelUsuarios,
            ));
        }
    }

    
    
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Torneo;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Torneo'])) {
            $model->attributes = $_POST['Torneo'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->idTorneo));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionInscripcion($idTorneo) {
        $torneo=$this->loadModel($idTorneo);
                /*
         * si no es administrador y es un torneo cerrado y no está inscripto no pasa
         */
        if(!Yii::app()->user->checkAccess('Administrador')&&$torneo->idTipo==TipoTorneo::CERRADO && !$torneo->getUsuarioInscripcion()){
            throw new CHttpException('Es un torneo Cerrado ');
        }
        
        if($torneo->idEstado==EstadoTorneo::TERMINADO){
            throw new CHttpException('El torneo está terminado');
        }
        
 
        $idUsuario = Yii::app()->user->idUsuario;
        $model = TorneoUsuario::model()->find('idTorneo=:idTorneo and idUsuario=:idUsuario', array(':idTorneo' => $idTorneo, ':idUsuario' => $idUsuario));

        if (is_null($model)) {
            $model = new TorneoUsuario;
            $model->idTorneo = $idTorneo;
            $model->idUsuario = $idUsuario;
            /**
             * TODO: Ver que se pueden repetir tokens
             */
            $model->Token = md5(Yii::app()->user->name . microtime());

            if (!$model->save())
                throw new CHttpException('no se pudo inscribir');
        }
        $this->redirect(array('view', 'id' => $idTorneo));
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
    }
    
    public function actionBorrarinscripcion($idTorneo) {
        $torneo=$this->loadModel($idTorneo);
        if($torneo->idEstado==EstadoTorneo::TERMINADO){
            throw new CHttpException('El torneo está terminado');
        }
        $idUsuario = Yii::app()->user->idUsuario;
        $this->borrarequipo($idTorneo,$idUsuario);
        $this->redirect(array('/bandeja'));
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
    }
    
    public function actionBorrarequipo($idTorneo,$idUsuario) {
        $this->borrarequipo($idTorneo,$idUsuario);
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('view','id'=>$idTorneo));
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
    }
    
    protected function borrarequipo($idTorneo,$idUsuario){
        $model = TorneoUsuario::model()->find('idTorneo=:idTorneo and idUsuario=:idUsuario', array(':idTorneo' => $idTorneo, ':idUsuario' => $idUsuario));
        
        if (!is_null($model)) {
            if (!$model->delete())
                throw new CHttpException('no se pudo borrar Inscripcion');
            Resolucion::model()->deleteAll('idTorneo=:idTorneo and idUsuario=:idUsuario', array(':idTorneo' => $idTorneo, ':idUsuario' => $idUsuario));
        }
    }
    
    

    public function actionActualizartoken($idTorneo) {
        $torneo=$this->loadModel($idTorneo);
        if($torneo->idEstado==EstadoTorneo::TERMINADO){
            throw new CHttpException('El torneo está terminado');
        }
 
        $idUsuario = Yii::app()->user->idUsuario;
        $model = TorneoUsuario::model()->find('idTorneo=:idTorneo and idUsuario=:idUsuario', array(':idTorneo' => $idTorneo, ':idUsuario' => $idUsuario));

        if (is_null($model)) {
            $model = new TorneoUsuario;
            $model->idTorneo = $idTorneo;
            $model->idUsuario = $idUsuario;
            $model->Token = md5(Yii::app()->user->name . date('hh:ii:ss'));
            
            /**
             * :todo ver posibles token repetidos
             */
            if (!$model->save())
                throw new CHttpException('no se pudo inscribir');
        }else {
            $model->Token = md5(Yii::app()->user->name . date('hh:ii:ss'));
            if (!$model->save())
                throw new CHttpException('no se pudo actualizar');
        }
        $this->redirect(array('view', 'id' => $idTorneo));
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Torneo'])) {
            $model->attributes = $_POST['Torneo'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->idTorneo));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new Torneo('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Torneo']))
            $model->attributes = $_GET['Torneo'];

        
        $dataProvider = $model->search();
        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Torneo('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Torneo']))
            $model->attributes = $_GET['Torneo'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Torneo the loaded model
     * @throws CHttpCHttpException
     */
    public function loadModel($id) {
        $model = Torneo::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'No existe el torneo.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Torneo $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'torneo-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
