<?php

class PurchaseorderitemsController extends Controller {

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
                'actions' => array('index', 'view', 'getinvoicedata', 'itemdelete','getitemdata','editorderitem'),
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

    public function actionGetinvoicedata() {
        $id = Yii::app()->request->getPost('order_id');
        $this->renderPartial('_addpartial', array(
            'id' => $id,
        ));
    }    
    
     public function actionEditorderitem() {
        $model1 = Purchaseorderitems::model()->findByPk(Yii::app()->request->getPost('order_item_id'));
         if (!empty($model1)) {
            $model1->rate = $_POST['Purchaseorderitems']['rate'];
            $model1->qty_req = $_POST['Purchaseorderitems']['qty_req'];
            $model1->amount = $_POST['Purchaseorderitems']['amount'];
            $model1->save();

            //Purchaseinvoiceitems::model()->updateByPk($model1->id, array('p_category_id' => $purchase_item->p_category_id, 'p_sub_category_id' => $purchase_item->p_sub_category_id));

            d21('Purchase Order Item Edit by ' . Yii::app()->user->getUsername(), "site.login");
        }
    }
    
    public function actionItemdelete() {
        Purchaseorderitems::model()->findByPk(Yii::app()->request->getPost('id'))->delete();
    }

    public function actionGetitemdata() {
        $model=Purchaseorderitems::model()->findByPk(Yii::app()->request->getParam('id'));
        $items=Purchaseitem::model()->findByPk($model->item_id);
        echo CJSON::encode(array('model' => $model,'items'=>$items));
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
        $this->active_menu = "cps";
        $this->open_class = "ps";
        $this->active_class = "generatepo";
        $model = new Purchaseorderitems;
        $id = $_GET['id'];

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Purchaseorderitems'])) {
            $items = Purchaseitem::model()->findByPk($_POST['Purchaseorderitems']['item_id']);
            $model->attributes = $_POST['Purchaseorderitems'];
            $model->purchase_order_id = $_POST['id'];
            $model->item_code = $items->brand;
            $model->item_name = $items->itemname;
            $model->qty_scale = $items->item_scale;
            $model->req_date = date('Y-m-d');
            $model->amount = $_POST['Purchaseorderitems']['amount'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Item Added successfully');
                $this->redirect(array('create', 'id' => $_POST['id']));
            }
        }

        $this->render('create', array(
            'model' => $model, 'id' => $id,
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

        if (isset($_POST['Purchaseorderitems'])) {
            $model->attributes = $_POST['Purchaseorderitems'];
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
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Purchaseorderitems');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Purchaseorderitems('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Purchaseorderitems']))
            $model->attributes = $_GET['Purchaseorderitems'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Purchaseorderitems the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Purchaseorderitems::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Purchaseorderitems $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'purchaseorderitems-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
