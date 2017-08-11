<?php

class ShapedesignController extends Controller {

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
                'actions' => array('create', 'update', 'designweight', 'savedesignweight'),
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
    public function actionSavedesignweight() {
        $did = $_GET['did'];
        $model = new Designweights();
        if (!empty($_GET['weight'])) {
            foreach (Designweights::model()->findAllByAttributes(array('design_id' => $did)) as $check) {
                $check->delete();
            }
            foreach ($_GET['weight'] as $val) {
                $model = new Designweights();
                $model->design_id = $did;
                $model->weight_for_design = $val;
                $model->save();
            }
        }
    }

    public function actionDesignweight() {
        $model = Designweights::model()->findAllByAttributes(array('design_id' => $_GET['id']));
        $weight = Cakeweight::model()->findAll();
        $this->renderPartial('_designweight', array(
            'weight' => $weight,
            'model' => $model,
            'did' => $_GET['id'],
        ));
    }

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
        $this->active_menu = "cms";
        $this->open_class = "cake";
        $this->active_class = "cake_shape";
        $model = new Shapedesign;
        $model->shape_id = $_GET['sid'];

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Shapedesign'])) {
            $model->attributes = $_POST['Shapedesign'];
            $model->design_complexity_id = $_POST['design_complexity_id'];
            $model->added_by_id = Yii::app()->user->id;
            $model->design_added_by = 'om';
            $image = CUploadedFile::getInstance($model, 'design_img');
            $model->design_img = $image;
            if ($model->save()) {
//                $image_name = $model->design_img;
                $image_name = time() . '_' . $model->design_img;
                $model->design_img = $image_name;
                $model->save();
                if (!empty($image)) {
                    $image->saveAs(Yii::app()->basePath . '/../uploads/Shapeimage/design/' . $model->design_img);
                }
                d21('Cake Shape Design added by ' . Yii::app()->user->getUsername(), "site.login");
                $this->redirect(array('create', 'sid' => $model->shape_id));
            }
//            print_r($model->getErrors());
//            exit();
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
        $this->active_menu = "cms";
        $this->open_class = "cake";
        $this->active_class = "cake_shape";
        $model = $this->loadModel($id);
        $img = $model->design_img;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Shapedesign'])) {
            $model->attributes = $_POST['Shapedesign'];
             $model->design_complexity_id = $_POST['design_complexity_id'];
            $model->added_by_id = Yii::app()->user->id;
            $model->design_added_by = 'om';
            $image = CUploadedFile::getInstance($model, 'design_img');
//            $image_name = $image;
            $image_name = time() . '_' . $image;
            if (!empty($image)) {
                $model->design_img = $image_name;
                if(!empty($img)){
                unlink(Yii::app()->basePath . '/../uploads/Shapeimage/design/' . $img);
                }
                $image->saveAs(Yii::app()->basePath . '/../uploads/Shapeimage/design/' . $model->design_img);
            } else {
                $model->design_img = $img;
            }
            if ($model->save()) {
                d21('Cake Shape Design Updated by ' . Yii::app()->user->getUsername(), "site.login");
                $this->redirect(array('create', 'sid' => $model->shape_id));
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
        $dataProvider = new CActiveDataProvider('Shapedesign');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Shapedesign('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Shapedesign']))
            $model->attributes = $_GET['Shapedesign'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Shapedesign the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Shapedesign::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Shapedesign $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'shapedesign-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
