<?php

class UsersController extends Controller {

    //holds the password confirmation word
    public $repeat_password;
    //will hold the encrypted password for update actions.
    public $initialPassword;

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image
            // this is used by the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xF5F5F5,
            ),
        );
    }

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
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        $user = Users::model()->findByPk(Yii::app()->user->id);
        return array(
            array('allow', // allow all users to perform 'index', 'view' and 'register' actions
                'actions' => array('index', 'view', 'register', 'captcha', 'activate'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'update' actions
                'actions' => array('update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'expression' => isset($user) ? '' . in_array($user->user_group, array(1, 2)) : '0',
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
     * Creates a new user.
     * If registration is successful, the browser will be redirected to the 'view' page.
     */
    public function actionRegister() {
        $model = new Users;

        if (isset($_POST['Users'])) {
            $model->attributes = $_POST['Users'];
            if ($model->save()) {
                $user = Users::model()->find('LOWER(user_name)=?', array($_POST['Users']['user_name']));
                $msg = '<html><body>Thank you for registering at ' . Yii::app()->name . '.<br /><br />' . 'Please click ' .
                        CHtml::link(CHtml::encode('here'),
                                Company::getComURL('GraphOX').'users/activate?activateKey='.$user->user_acti_pass, 
                                array('title' => 'Click me to authenticate account')) . 
                        ' to activate your account.<br /><br />' .
                        'Thanks<br />' . Yii::app()->name . ' Administration</body></html>';
                Logger::email('Registration at ' . Yii::app()->name, $msg, null, null, $_POST['Users']['user_mail']);
                Yii::app()->user->logout();
                Yii::app()->session->open();
                Yii::app()->user->setFlash('register', 'Thank you for registering. In order for you to log in, you will have to go to check your email for an activation link.');
            }
        }

        $this->render('register', array(
            'model' => $model,
        ));
    }

    public function actionActivate() {
        if (isset($_GET['activateKey'])) {
            $model = Users::model()->find('user_acti_pass=?', array(CHtml::encode($_GET['activateKey'])));
            if (!$model)
                Yii::app()->user->setFlash('activate', 'Invalid activation ID.');
            else if ($model->user_acti == 3) {
                Yii::app()->user->setFlash('activate', 'Your account has already been activated.');
            } else {
                $model->user_acti = 3;

                if ($model->save(false)) {
                    Yii::app()->user->logout();
                    Yii::app()->session->open();
                    Yii::app()->user->setFlash('activate', 'Your account has been activated and you may now log in.');
                } else
                    die();
            }
        } else {
            yii::app()->user->setFlash('activate', 'You may not use this page without a valid activation link');
        }

        $this->render('activate');
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

        if (isset($_POST['Users'])) {
            $model->attributes = $_POST['Users'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
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
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Users');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Users('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Users']))
            $model->attributes = $_GET['Users'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Users::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'users-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
