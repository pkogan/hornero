<?php

class CambioClaveController extends Controller {

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

    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'captcha'),
                'users' => array('*'),
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

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new CambioClave;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['CambioClave'])) {
            $model->attributes = $_POST['CambioClave'];
            $usuario = Usuario::model()->find('Email=:Email', array(':Email' => $model->email));
            /**
             * @var $usuario Usuario
             * */
            if (is_null($usuario)) {
                $model->addError('email', 'No se encuentra registrado el mail.');
            } else {
                $model->idUsuario = $usuario->idUsuario;
                $model->token = md5(microtime() . $usuario->idUsuario);
                /*
                 * envia mail
                 */
                //$name = '=?UTF-8?B?' . base64_encode($usuario->NombreUsuario) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode('Cambio Clave Hornero') . '?=';
                $headers = "From: Hornero <" . Yii::app()->params['adminEmail'] . ">\r\n" .
                        "Reply-To: " . Yii::app()->params['adminEmail'] . "\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-type: text/plain; charset=UTF-8";
                
                $mail = Yii::app()->Smtpmail;
               
                $mail->SetFrom(Yii::app()->params['adminEmail'], 'From Hornero');
                $mail->Subject = $subject;
                $mail->MsgHTML('Su usuario/equipo es: "'.$usuario->NombreUsuario
                        .'" y su clave es: "' . $usuario->Clave.'".'
                        . 'Ingresar a http://hornero.fi.uncoma.edu.ar'.Yii::app()->createUrl("/site/login"));
                $mail->AddAddress($model->email, "");
                $envio=$mail->send();
                /*$envio=mail($model->email, $subject, 'Su usuario/equipo es: "'.$usuario->NombreUsuario
                        .'" y su clave es: "' . $usuario->Clave.'".'
                        . 'Ingresar a '.Yii::app()->baseUrl.Yii::app()->createUrl("/site/login"), $headers);*/
                if ($envio) {

                    if ($model->save()) {
                        Yii::app()->user->setFlash('contact', 'Se ha enviado un mail a '.$model->email.
                        '. Siga las instrucciones del mail para actualizar su clave.');
                        $this->refresh();
                        $this->render('create', array(
                            'model' => $model,
                        ));
                    }
                }else{
                    $model->addError('email', 'No se pudo enviar el mail');
                }
            }
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

        if (isset($_POST['CambioClave'])) {
            $model->attributes = $_POST['CambioClave'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->idCambio));
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
        $dataProvider = new CActiveDataProvider('CambioClave');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new CambioClave('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['CambioClave']))
            $model->attributes = $_GET['CambioClave'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return CambioClave the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = CambioClave::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CambioClave $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'cambio-clave-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
