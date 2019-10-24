<?php

class CuentaController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    public $autorefresh;

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
                'actions' => array('index', 'view', 'viewtorneo', 'descargar'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'iniciar', 'deleteparcial'),
                'users' => array('admin'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIniciar($id) {
        $model = $this->loadModel($id);
        $model->Inicio = date('Y-m-d H:i:s');
        $fecha = new DateTime($model->Inicio);
        $interval = new DateInterval('PT' . $model->Tiempo . 'M');
        $fecha->add($interval);

        $model->Fin = $fecha->format('Y-m-d H:i:s');
        if ($model->update()) {

            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            else
                $this->redirect(array('view', 'id' => $model->id));
        }
        /* $this->render('view',array(
          'model'=>$model,
          )); */
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $model = $this->loadModel($id);
        $modelnuevoParcial = $this->nuevoParcial($model);
        $modelParcial = new Parcial('search');
        $modelParcial->idCuenta = $id;
        $this->layout = '//layouts/columntabla';


        $this->render('view', array(
            'model' => $model,
            'modelParcial' => $modelParcial,
            'modelnuevoParcial' => $modelnuevoParcial
        ));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionViewtorneo($idTorneo) {
        $this->autorefresh = TRUE;
        $this->layout = '//layouts/cuenta';
        /**
         * Buscar la ùltima Cuenta Regresiva del $idTorneo y mostrarla
         */
        $modelTorneo = Torneo::model()->findByPk($idTorneo);
        if ($modelTorneo === null)
            throw new CHttpException(404, 'No se encuentra el Torneo;');

        $criteria = new CDbCriteria;
        $criteria->order = 'Inicio Desc';
        $criteria->limit = '1';
        $criteria->compare('idTorneo', $idTorneo);

        $model = Cuenta::model()->find($criteria);

        //$model = Cuenta::model()->find() $this->loadModel($id);
        /* $modelnuevoParcial = $this->nuevoParcial($model);
          $modelParcial = new Parcial('search');
          $modelParcial->idCuenta = $id;
         */
        $connection = Yii::app()->db;
        $sql = "select Equipo.id,Equipo, sum(Parcial.`Tiempo`) as `Puntos` from Equipo inner join Parcial on  Equipo.id=Parcial.idEquipo"
                . " inner join Cuenta on Parcial.idCuenta=Cuenta.id and Cuenta.idTorneo=$idTorneo group by Equipo.id,Equipo order by Puntos desc";
        $command = $connection->createCommand($sql);

        $equipos = $command->queryAll();


        $this->render('viewtorneo', array(
            'modelTorneo' => $modelTorneo,
            'model' => $model,
            'equipos' => $equipos
                /* 'modelParcial' => $modelParcial,
                  'modelnuevoParcial' => $modelnuevoParcial */
        ));
    }

    protected function nuevoParcial($cuenta) {

        $parcial = new Parcial;

        if (isset($_POST['Parcial'])) {
            $parcial->attributes = $_POST['Parcial'];
            $parcial->idCuenta = $cuenta->id;
            $Fin = new DateTime($cuenta->Fin);
            $Ahora = new DateTime(date('Y-m-d H:i:s'));
            $tiempo = $Ahora->diff($Fin);
            /** @var DateInterval $tiempo */
            if ($tiempo->invert == 0) {
                $parcial->Tiempo = ($tiempo->s + 60 * $tiempo->i + 3600 * $tiempo->h);


                if ($parcial->save()) {

                    $this->redirect(array('view', 'id' => $cuenta->id));
//                Yii::app()->user->setFlash('parcial', 'El parcial ha sido agregado');
//                $this->refresh();
                }
            } else {
                // no lo agrega por terminarse el tiempo
            }
        }
        return $parcial;
    }

    public function actionDeleteparcial($id) {

        $parcial = Parcial::model()->findByPk($id);
        $idCuenta = $parcial->idCuenta;
        $parcial->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('view', 'id' => $idCuenta));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Cuenta;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['Cuenta'])) {

            $this->guardarArchivo($model);
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
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

        if (isset($_POST['Cuenta'])) {

            $this->guardarArchivo($model);
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    protected function guardarArchivo(&$model) {
        $nombreViejo = $model->Archivo;
        $model->attributes = $_POST['Cuenta'];
        $file = CUploadedFile::getInstance($model, 'Archivo');

        if (is_object($file) && get_class($file) == 'CUploadedFile') {      //
            $path = Yii::app()->basePath . DIRECTORY_SEPARATOR . 'archivos';
            if (!is_dir($path))
                mkdir($path);

            /* --------------------------------- */
            $url = $path . DIRECTORY_SEPARATOR . $file->name; //url definitiva al archivo                                                            
            $array = pathinfo($url);
            $ext = $array['extension'];
            $ext = strtolower($ext);
            /* --------------------------------- */

            if (empty($ext) OR ( $ext != 'pdf' && $ext != 'png' && $ext != 'jpg' && $ext != 'gif')) {
                throw new CHttpException(204, " Solo puede subir archivos con extension (.txt, .pdf, .png, .jpg, .gif");
            } else {
                $file->saveAs($url);
                $model->Archivo = $file->name;
            }
        }

        if ($model->Archivo == '') {
            $model->Archivo = $nombreViejo;
        }
        return true;
    }

    public function actionDescargar() {
        if (isset($_GET['id'])) {

            $path = Yii::app()->basePath . DIRECTORY_SEPARATOR . 'archivos' . DIRECTORY_SEPARATOR;
            $file = $path . $_GET['id'];

            /* ---------------------------- */
            header('Content-disposition: attachment; filename=' . $file);
            header("Content-Type: application/force-download");
            /* ---------------------------- */
            $dirInfo = pathinfo($file);
            $nombre = $dirInfo['basename'];
            $ext = $dirInfo['extension'];
            /* ----------------------------- */
            if (strtolower($ext) == 'pdf')
                header('Content-type: application/pdf');

            header("Content-disposition: attachment; filename=" . $nombre);
            /* ------------------------------ */
            $file = file_get_contents($file);
            echo $file;
            die;
        }else {
            throw new CHtppException(204, " No se ah encontrado el archivo solicitado ");
        }
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
        /* $dataProvider = new CActiveDataProvider('Cuenta');
          $this->render('index', array(
          'dataProvider' => $dataProvider,
          ));
         * 
         */
        $this->redirect(array('admin'));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Cuenta('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Cuenta']))
            $model->attributes = $_GET['Cuenta'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Cuenta the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Cuenta::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Cuenta $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'cuenta-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
