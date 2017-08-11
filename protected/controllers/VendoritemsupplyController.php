<?php

class VendoritemsupplyController extends Controller {

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
                'actions' => array('create', 'update', 'admin', 'itemevaluate', 'delete', 'approval'),
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

    public function actionApproval() {
        $id = $_GET['id'];
        $active = $_GET['is_active'];
        $model = Vendoritemsupply::model()->findByPk($id);
        //$model->isactive = $active;
        Vendoritemsupply::model()->updateByPk($model->id, array("is_active" => $active));
        //$admin = new CActiveDataProvider('Vendoritemsupply');
        $this->redirect(array('admin', 'id' => $model->vendor_id));
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
        $model = new Vendoritemsupply;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Vendoritemsupply'])) {
            $model->attributes = $_POST['Vendoritemsupply'];
            if ($model->save()) {
                $model->save();
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
        $this->active_menu = "cps";
        $this->open_class = "vendor";
        $this->active_class = "admin";
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Vendoritemsupply'])) {
            $model->attributes = $_POST['Vendoritemsupply'];
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
        // if (Yii::app()->request->isPostRequest) {
        // we only allow deletion via POST request
        $model = Vendoritemsupply::model()->findByPk($id);
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin', 'id' => $model->vendor_id));
        //} else
        //  throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Vendoritemsupply');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->active_menu = "cps";
        $this->open_class = "vendor";
        $this->active_class = "admin";
        $vid = $_GET['id'];
        $model = new Vendoritemsupply('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_POST['Vendoritemsupply'])) {
            $model->attributes = $_POST['Vendoritemsupply'];
            $model->p_category_id = $_POST['Vendoritemsupply']['p_category_id'];
            $model->p_sub_category_id = $_POST['Vendoritemsupply']['p_sub_category_id'];
            $model->vendor_id = $_POST['Vendoritemsupply']['vendor_id'];
            if ($model->save()){
                $this->redirect(array('admin'));
            }
        }
        $this->render('admin', array(
            'model' => $model, 'vid' => $vid,
        ));
    }

    public function actionItemevaluate() {
        if (isset($_GET['msg'])) {
            $smsg = "<div class='alert1 alert-success'>Item Added Successfully !!!</div>";
        }
        $msg = "";

        $pitem = Purchaseitem::model()->findAllByAttributes(array("p_category_id" => $_POST['p_category_id'], "p_sub_category_id" => $_POST['p_sub_category_id']));
        if (!empty($pitem)) {
            foreach ($pitem as $v) {
              if(!empty($_POST['purchase_item_id_' . $v->id])){  
                $pitems = Purchaseitem::model()->findByPk($_POST['purchase_item_id_' . $v->id]);
                $cmodel = Vendoritemsupply::model()->findByAttributes(array("vendor_id" => $_POST['vendor_id'], 'purchase_item_id' => $_POST['purchase_item_id_' . $v->id]));
                if (empty($cmodel)) {
                    $model = new Vendoritemsupply();
                    $model->vendor_id = $_POST['vendor_id'];
                    $model->purchase_item_id = $_POST['purchase_item_id_' . $v->id];
                    $model->itemname = $pitems->itemname;
                    $model->brand = $pitems->brand;
                    $model->save();
                }
            }
            }
        }
        d21('Vendor Itemsupply added by '.Yii::app()->user->getUsername(),"vendoritemsupply.create");
        $this->redirect(array('admin', 'id' => $_POST['vendor_id']));
        //  }
        $this->render('itemevaluate', array('msg' => $msg));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Vendoritemsupply the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Vendoritemsupply::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Vendoritemsupply $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'vendoritemsupply-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
