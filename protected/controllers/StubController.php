<?php

class StubController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
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
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','descargar'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'roles'=>array('Administrador'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'roles'=>array('Administrador'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Stub;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Stub']))
		{
			$this->guardarArchivo($model);
			if($model->save())
				$this->redirect(array('view','id'=>$model->idStubs));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
    public function actionDescargar()
        {                             
            if(isset($_GET['id']))
            {   
                
                $path = Yii::app()->basePath.DIRECTORY_SEPARATOR.'archivos'.DIRECTORY_SEPARATOR.'stubs'.DIRECTORY_SEPARATOR;                     
                $file = $path.$_GET['id']                    ;
                              
                /* ---------------------------- */
                header('Content-disposition: attachment; filename='.$file);                   
                header("Content-Type: application/force-download");                
                /* ---------------------------- */
                $dirInfo = pathinfo($file);                
                $nombre = $dirInfo['basename'];                                            
                $ext = $dirInfo['extension'];                
                /* ----------------------------- */                
                if(strtolower($ext) == 'pdf')
                    header('Content-type: application/pdf');                                                
                            
                header("Content-disposition: attachment; filename=".$nombre);
                /* ------------------------------ */                
                $file = file_get_contents($file);
                echo $file;
                die;                  
            }else{
                throw new CHtppException(204, " No se ah encontrado el archivo solicitado ");
            }                      
        }
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Stub']))
		{
			$this->guardarArchivo($model);
			if($model->save())
				$this->redirect(array('view','id'=>$model->idStubs));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
    protected function guardarArchivo(&$model){
        $nombreViejo=$model->Archivo;
        $model->attributes = $_POST['Stub'];
        $file = CUploadedFile::getInstance($model, 'Archivo');

            if (is_object($file)&& get_class($file) == 'CUploadedFile') {      //
                
                $path = Yii::app()->basePath . DIRECTORY_SEPARATOR . 'archivos'. DIRECTORY_SEPARATOR .'stubs' ;
                if (!is_dir($path))
                    mkdir($path);

                /* --------------------------------- */
                $url = $path . DIRECTORY_SEPARATOR . $file->name; //url definitiva al archivo                                                            
                $array = pathinfo($url);
                $ext = $array['extension'];
                $ext = strtolower($ext);
                /* --------------------------------- */

                if (empty($ext) OR ( $ext != 'zip')) {
                    throw new CHttpException(204, " Solo puede subir archivos con extension (.zip");
                } else {
                    $file->saveAs($url);
                    $model->Archivo=$file->name;
                }
                
            }

            if($model->Archivo==''){
                $model->Archivo=$nombreViejo;
            }
            return true;
    }
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Stub');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Stub('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Stub']))
			$model->attributes=$_GET['Stub'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Stub the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Stub::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Stub $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='stub-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
