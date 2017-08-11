<?php

class MenuitemsController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $active_menu = '';
    public $active_class = '';
    public $open_class = '';
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
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@'),
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
        $this->active_menu = "pos";
        $this->open_class = "menu";
        $this->active_class = "menu_items";
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $this->active_menu = "pos";
        $this->open_class = "menu";
        $this->active_class = "menu_items";
        $model = new Menuitems;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Menuitems'])) {
            $model->attributes = $_POST['Menuitems'];
            //$model->is_active = 1;
  //          $image = CUploadedFile::getInstance($model, 'item_image');
//            $model->item_image = $image;
//            if (!empty($model->item_image)) {
//                $image_name = $model->item_image;
////                $image_name = $model->item_image . '_' . time();
//                $model->item_image = $image_name;
//                $image->saveAs(Yii::app()->basePath . '/../uploads/Itemimage/' . $model->item_image);
//            }
            if ($model->save()) {
                d21('Menu Items added by ' . Yii::app()->user->getUsername(), "site.login");
                $this->redirect(array('create'));
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
        $this->active_menu = "pos";
        $this->open_class = "menu";
        $this->active_class = "menu_items";
        $model = $this->loadModel($id);
        //$img = $model->item_image;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Menuitems'])) {
            $model->attributes = $_POST['Menuitems'];
            //$model->is_active = 1;
           // $image = CUploadedFile::getInstance($model, 'item_image');
           // $image_name = $image;
//            $image_name = $image . '_' . time();
//            if (!empty($image_name)) {
//               // $model->item_image = $image_name;
//             //   unlink(Yii::app()->basePath . '/../uploads/Itemimage/' . $img);
//               // $model->item_image->saveAs(Yii::app()->basePath . '/../uploads/Itemimage/' . $model->item_image);
//            } else {
//                $model->item_image = $img;
//            }
            if ($model->save()) {
                d21('Menu Items Updated by ' . Yii::app()->user->getUsername(), "site.login");
                $this->redirect(array('create'));
            }
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
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Menuitems');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->active_menu = "pos";
        $this->open_class = "menu";
        $this->active_class = "menu_items";
        $model = new Menuitems('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Menuitems']))
            $model->attributes = $_GET['Menuitems'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Menuitems the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Menuitems::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Menuitems $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'menuitems-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
