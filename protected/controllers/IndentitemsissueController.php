<?php

class IndentitemsissueController extends Controller {

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
                //'postOnly + delete', // we only allow deletion via POST request
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
                'actions' => array(''),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'index', 'view', 'stockissue', 'getStockItem', 'issueitem','inventory'),
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

    public function actionIssueitem() {
        $model = new Indentitemsissue();
        $rmodel = Indentitems::model()->findByPk(Yii::app()->request->getPost('internal_id'));
        if ($rmodel->qty_for_sale >= $_POST['Indentitemsissue']['issue_qty']) {
            $model->internal_id = Yii::app()->request->getPost('internal_id');
            $model->p_category_id = $rmodel->p_category_id;
            $model->p_sub_category_id = $rmodel->p_sub_category_id;
            $model->item_id = $rmodel->item_id;
            $model->item_name = $rmodel->item_name;
            $model->item_brand = $rmodel->item_brand;
            $model->issue_qty = $_POST['Indentitemsissue']['issue_qty'];
            $model->issue_date = Yii::app()->request->getPost('issue_date');
            $model->issue_purpose = $_POST['Indentitemsissue']['issue_purpose'];
            $model->created_by = Yii::app()->user->id;
            $model->created_user_role = Yii::app()->user->getUser()->role;
            $model->save();
            $rmodel->qty_for_sale = $rmodel->qty_for_sale - $_POST['Indentitemsissue']['issue_qty'];
            $rmodel->update();
            echo "1";
        } else {
            echo "0";
        }
    }

    public function actionStockissue() {
        $this->active_menu = "gpu";
        $this->open_class = "gpunit";
        $this->active_class = "admin";
        $model = Indentmaster::model()->findByAttributes(array('sync_id' => $_GET['sync_id']));
        $this->render('stockissue', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Indentitemsissue;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Indentitemsissue'])) {
            $model->attributes = $_POST['Indentitemsissue'];
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

        if (isset($_POST['Indentitemsissue'])) {
            $model->attributes = $_POST['Indentitemsissue'];
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
        //if (Yii::app()->request->isPostRequest) {
        // we only allow deletion via POST request
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        //} else
        //  throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Indentitemsissue');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->active_menu = "gpu";
        $this->open_class = "gpunit";
        $this->active_class = "issueadmin";

        unset(Yii::app()->request->cookies['from_date']);  // first unset cookie for dates
        unset(Yii::app()->request->cookies['to_date']);

        $model = new Indentitemsissue('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Indentitemsissue'])){
            Yii::app()->request->cookies['from_date'] = new CHttpCookie('from_date', $_GET['from_date']);  // define cookie for from_date
            Yii::app()->request->cookies['to_date'] = new CHttpCookie('to_date', $_GET['to_date']);
            $model->from_date = $_GET['from_date'];
            $model->to_date = $_GET['to_date'];
            $model->attributes = $_GET['Indentitemsissue'];
        }
        
        $this->render('admin', array(
            'model' => $model,
        ));
    }
    
    public function actionInventory() {
        $this->active_menu = "gpu";
        $this->open_class = "gpunit";
        $this->active_class = "gpuinventory";

        $model = new InternalStock('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['InternalStock']))
            $model->attributes = $_GET['InternalStock'];

        $this->render('inventory', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Indentitemsissue the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Indentitemsissue::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Indentitemsissue $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'indentitemsissue-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
