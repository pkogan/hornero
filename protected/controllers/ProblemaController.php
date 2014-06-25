<?php

class ProblemaController extends Controller {

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
                'actions' => array( 'descargar'),
                'users' => array('*'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('index', 'view','admin', 'delete', 'create', 'update'),
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
        $model=$this->loadModel($id);
        $soluciones=new Solucion('search');
	$soluciones->unsetAttributes();  // clear any default values
	if(isset($_GET['Solucion']))
		$soluciones->attributes=$_GET['Solucion'];
        
	$soluciones->idProblema=$id;
        
        $this->render('view', array(
            'model' => $model,
            'soluciones'=>$soluciones
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Problema;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Problema'])) {
            $this->guardarArchivo($model);
//$model->attributes = $_POST['Problema'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->idProblema));
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

        if (isset($_POST['Problema'])) {
            $this->guardarArchivo($model);
            //$model->attributes = $_POST['Problema'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->idProblema));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    protected function guardarArchivo(&$model) {
        $nombreViejo = $model->Archivo;
        $model->attributes = $_POST['Problema'];
        $file = CUploadedFile::getInstance($model, 'Archivo');

        if (is_object($file) && get_class($file) == 'CUploadedFile') {      //
            $path = Yii::app()->basePath . DIRECTORY_SEPARATOR . 'archivos' . DIRECTORY_SEPARATOR . 'problemas';
            if (!is_dir($path))
                mkdir($path);

            /* --------------------------------- */
            $array = pathinfo($file->name);
            $ext = $array['extension'];
            $ext = strtolower($ext);
            $nombrearchivo = md5($file->name . date('d-m-a h:i:s')) . '.' . $ext;
            $url = $path . DIRECTORY_SEPARATOR . $nombrearchivo; //url definitiva al archivo                                                            

            /* --------------------------------- */

            if (empty($ext) OR ( $ext != 'pdf' && $ext != 'png' && $ext != 'jpg' && $ext != 'jpeg' && $ext != 'gif')) {
                throw new CHttpException(204, " Solo puede subir archivos con extension (.txt, .pdf, .png, .jpg, .gif");
            } else {
                $file->saveAs($url);
                $model->Archivo = $nombrearchivo;
            }
        }

        if ($model->Archivo == '') {
            $model->Archivo = $nombreViejo;
        }
        return true;
    }

    public function actionDescargar() {
        if (isset($_GET['id'])) {

            $path = Yii::app()->basePath . DIRECTORY_SEPARATOR . 'archivos' . DIRECTORY_SEPARATOR . 'problemas' . DIRECTORY_SEPARATOR;
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
        $dataProvider = new CActiveDataProvider('Problema');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Problema('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Problema']))
            $model->attributes = $_GET['Problema'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Problema the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Problema::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Problema $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'problema-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
