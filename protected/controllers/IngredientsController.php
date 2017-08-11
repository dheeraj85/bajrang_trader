<?php

class IngredientsController extends Controller {

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
                'actions' => array('create', 'update', 'getItemList', 'saveweight','deleteitem'),
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
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionSaveweight() {
        $rid = $_POST['rid'];
        $list = Ingredients::model()->findAllByAttributes(array('recipe_item_id' => $rid));
        if (!empty($list)) {
            foreach ($list as $item) {
                $item->weight_in_gm = $_POST[$item->id . 'weight'];
                $item->description = $_POST[$item->id . 'description'];
                $item->save();
            }
        }
    }

    public function actionDeleteitem() {
        $id = $_GET['id'];
        $item = Ingredients::model()->findByPk($id);
        $item->delete();
    }

    public function actionGetItemList() {
        $rid = $_GET['rid'];
        $item = $_GET['item'];
        if (!empty($item)) {
            $model = new Ingredients();
            $model->recipe_item_id = $rid;
            $model->item_id = $item;
            $model->save();
        }
        $list = Ingredients::model()->findAllByAttributes(array('recipe_item_id' => $rid));
        $this->renderPartial('_ingredients_list', array(
            'rid' => $rid,
            'list' => $list,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $this->active_menu = "cms";
        $this->open_class = "cake";
        $this->active_class = "recipe_items";
        $model = new Ingredients;
        $rid = $_GET['rid'];
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Ingredients'])) {
            $model->attributes = $_POST['Ingredients'];
            if ($model->save()) {
                d21('Ingredients added by ' . Yii::app()->user->getUsername(), "site.login");
                $this->redirect(array('create', 'rid' => $model->recipe_item_id));
            }
        }

        $this->render('create', array(
            'model' => $model,
            'rid' => $rid,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $this->active_menu = "cms";
        $this->open_class = "cake";
        $this->active_class = "recipe_items";
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Ingredients'])) {
            $model->attributes = $_POST['Ingredients'];
            if ($model->save()) {
                d21('Ingredients Updated by ' . Yii::app()->user->getUsername(), "site.login");
                $this->redirect(array('create', 'rid' => $model->recipe_item_id));
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
            $model = $this->loadModel($id);
            $rid = $model->recipe_item_id;
            $model->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('create', 'rid' => $rid));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Ingredients');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->active_menu = "cms";
        $this->open_class = "cake";
        $this->active_class = "recipe_items";
        $model = new Ingredients('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Ingredients']))
            $model->attributes = $_GET['Ingredients'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Ingredients the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Ingredients::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Ingredients $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ingredients-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
