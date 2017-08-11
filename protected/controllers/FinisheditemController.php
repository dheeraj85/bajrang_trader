<?php

class FinisheditemController extends Controller {

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
                'actions' => array('create', 'update', 'admin', 'index','view','additem', 'getlatestitem', 'edititem','getitemdata','getItemname','itemdelete'),
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

    public function actionGetlatestitem() {
        $uid=Yii::app()->user->id;
        $list = Itemstock::model()->findAllBySql("select * from item_stock where entry_type='Direct' and created_by=$uid order by id desc");
        $this->renderPartial('_getlatestitem', array(
            'list' => $list,
        ));
    }
    
    public function actionGetitemdata() {
        $model = Itemstock::model()->findByPk(Yii::app()->request->getParam('id'));
        $taxmodel = Processeditemtax::model()->findAllByAttributes(array("processed_item_id" => Yii::app()->request->getParam('id')));
        echo CJSON::encode(array('model' => $model, 'taxmodel' => $taxmodel));
    }

    public function actionGetItemname() {
        $model = Purchaseitem::model()->findByPk(Yii::app()->request->getParam('id'));
        echo CJSON::encode(array('itemname' => $model->itemname, 'brand' => $model->brand));
    }

    public function actionItemdelete() {
        Itemstock::model()->findByPk(Yii::app()->request->getPost('id'))->delete();
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView() {
        $this->active_menu = "gpu2";
        $this->open_class = "factory";
        $this->active_class = "create";
        $model = Itemstock::model()->findByPk(Yii::app()->request->getParam('id'));
        $this->render('view', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $this->active_menu = "gpu2";
        $this->open_class = "factory";
        $this->active_class = "create";
        $model = new Itemstock;
        if (isset($_POST['Itemstock'])) {
            
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }
    public function actionAdditem() {        
        $model1 =new Itemstock();
        //$model1->p_category_id=Yii::app()->request->getPost('p_category_id');
        //$model1->p_sub_category_id=Yii::app()->request->getPost('p_sub_category_id');
        $model1->entry_type = "Direct";
        $model1->item_id = Yii::app()->request->getPost('item_id');
        $model1->particulars = Yii::app()->request->getPost('particulars');
        $model1->v_qty = Yii::app()->request->getPost('v_qty');
        $model1->v_scale = Yii::app()->request->getPost('v_scale');
        $model1->input_type = Yii::app()->request->getPost('input_type');
        $model1->c_unit_value = Yii::app()->request->getPost('c_unit_value');
        $model1->stock_qty = Yii::app()->request->getPost('stock_qty');
        $model1->stock_taking_scale = Yii::app()->request->getPost('stock_taking_scale');
        $model1->rate = Yii::app()->request->getPost('rate');
        $model1->amount = Yii::app()->request->getPost('amount');
        $model1->discount = Yii::app()->request->getPost('discount');
        $model1->is_mrd = Yii::app()->request->getPost('is_mrd');
        $model1->mrd_no = Yii::app()->request->getPost('mrd_no');
        $model1->make_date = Yii::app()->request->getPost('make_date');
        $model1->ready_date = Yii::app()->request->getPost('ready_date');
        $model1->discard_date = Yii::app()->request->getPost('discard_date');
        $model1->schedule_date = Yii::app()->request->getPost('schedule_date');
        $model1->remarks = Yii::app()->request->getPost('remarks');
        $model1->created_by = Yii::app()->user->id;
        $model1->created_date = date('Y-m-d');
        $model1->save();
        if(!empty($model1->id)){
        $item_model=Purchaseitem::model()->findByPk(Yii::app()->request->getPost('item_id'));    
        Purchaseinvoiceitems::model()->updateByPk($model1->id, array('p_category_id' => $item_model->p_category_id,'p_sub_category_id'=>$item_model->p_sub_category_id));
        foreach(Invoicesettings::model()->findAllByAttributes(array('type'=>'tax_in_items')) as $isetting){
        if(Yii::app()->request->getPost('taxtype_'.$isetting->id)>0.0){
            $model=new Processeditemtax();
            $model->processed_item_id=$model1->id;
            $model->invoice_settings_id=$isetting->id;
            $model->label=$isetting->label;
            $model->tax_percent=Yii::app()->request->getPost('taxtype_'.$isetting->id);
            $model->save();
            }
          }

       }
        $model1->amount = Yii::app()->request->getPost('amount');
        $model1->save();
        d21('Finished Item added by ' . Yii::app()->user->getUsername(), "site.login");
    }

     public function actionEdititem() {        
        $model1=  Itemstock::model()->findByPk(Yii::app()->request->getPost('processed_item_id'));
        if(!empty($model1)){
        //$model1->attributes = $_POST['Purchaseinvoiceitems'];
        //$model1->p_category_id=Yii::app()->request->getPost('p_category_id');
        //$model1->p_sub_category_id=Yii::app()->request->getPost('p_sub_category_id');
        $model1->invoice_id =Yii::app()->request->getPost('invoice_id');
        $model1->item_id = Yii::app()->request->getPost('item_id');
        $model1->particulars = Yii::app()->request->getPost('particulars');
        $model1->v_qty = Yii::app()->request->getPost('v_qty');
        $model1->v_scale = Yii::app()->request->getPost('v_scale');
        $model1->input_type = Yii::app()->request->getPost('input_type');
        $model1->c_unit_value = Yii::app()->request->getPost('c_unit_value');
        $model1->stock_qty = Yii::app()->request->getPost('stock_qty');
        $model1->stock_taking_scale = Yii::app()->request->getPost('stock_taking_scale');
        $model1->rate = Yii::app()->request->getPost('rate');
        $model1->amount = Yii::app()->request->getPost('amount');
        $model1->discount = Yii::app()->request->getPost('discount');
        $model1->is_mrd = Yii::app()->request->getPost('is_mrd');
        $model1->mrd_no = Yii::app()->request->getPost('mrd_no');
        $model1->make_date = Yii::app()->request->getPost('make_date');
        $model1->ready_date = Yii::app()->request->getPost('ready_date');
        $model1->discard_date = Yii::app()->request->getPost('discard_date');
        $model1->schedule_date = Yii::app()->request->getPost('schedule_date');
        $model1->remarks = Yii::app()->request->getPost('remarks');
        $model1->amount = Yii::app()->request->getPost('amount');
        $model1->save();
       
        foreach (Processeditemtax::model()->findAllByAttributes(array("processed_item_id"=>Yii::app()->request->getPost('processed_item_id'))) as $itax){
            $itax->delete();
        }
        foreach(Invoicesettings::model()->findAllByAttributes(array('type'=>'tax_in_items')) as $isetting){
        if(Yii::app()->request->getPost('taxtype_'.$isetting->id)>0.0){
            $model=new Processeditemtax();
            $model->processed_item_id=$model1->id;
            $model->invoice_settings_id=$isetting->id;
            $model->label=$isetting->label;
            $model->tax_percent=Yii::app()->request->getPost('taxtype_'.$isetting->id);
            $model->save();
            }
          }

        d21('Finished Item updated by ' . Yii::app()->user->getUsername(), "site.login");
       }
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

        if (isset($_POST['Itemstock'])) {
            $model->attributes = $_POST['Itemstock'];
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
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        //} else
        // throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $this->active_menu = "gpu2";
        $this->open_class = "factory";
        $this->active_class = "eindex";
        $this->render('index');
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->active_menu = "gpu2";
        $this->open_class = "factory";
        $this->active_class = "admin";
        $model = new Itemstock('searchGPU');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Itemstock']))
            $model->attributes = $_GET['Itemstock'];
        d21('Finished Item viewed by ' . Yii::app()->user->getUsername(), "site.login");
        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Itemstock the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Itemstock::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Itemstock $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'itemstock-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
