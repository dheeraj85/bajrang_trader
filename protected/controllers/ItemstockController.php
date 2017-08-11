<?php

class ItemstockController extends Controller {

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
                'actions' => array('create', 'update', 'admin','index','indent','itemevaluate','itemevaluatelow','indentcomplete'),
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

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Itemstock;
        if (isset($_POST['Itemstock'])) {
            $model->attributes = $_POST['Itemstock'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }
    
    public function actionIndent() {
        $this->active_menu = "cps";
        $this->open_class = "inventory";
        $this->active_class = "indent";
        $id = Yii::app()->request->getParam('id');
        $model = new Itemstock;
        if (isset($_POST['Itemstock'])) {
        $model->attributes = $_POST['Itemstock'];   
        $id=Yii::app()->request->getPost('id');
        $sort=Yii::app()->request->getPost('sorting');
        }        
        $this->render('indent', array(
           'model' => $model,'id'=>$id,'sort'=>$sort,
        ));
    }
    
     public function actionItemevaluate() {
        if (isset($_GET['msg'])) {
            $smsg = "<div class='alert1 alert-success'>Item Added Successfully !!!</div>";
        }
        $msg = "";
        $uid=Yii::app()->user->id;
        $pcimodel=Purchaseindentmaster::model()->findBySql("select * from purchase_indent_master where created_by=$uid and is_done=0 order by id desc limit 1");
        if(empty($pcimodel)){
            $imodel=new Purchaseindentmaster();
            $imodel->indend_date=date('Y-m-d');
            $imodel->created_by = Yii::app()->user->id;
            $imodel->save();
        }
        $indentid=isset($imodel->id)?$imodel->id:$pcimodel->id;
        
        if (!empty($_POST['item_id'])) {
            foreach(Yii::app()->request->getPost('item_id') as $k) {
                $cmodel = Purchaseindent::model()->findByAttributes(array("item_id" => Yii::app()->request->getPost('item_id_' . $k),"is_added_to_order"=>1));
                if (empty($cmodel)) {
                $model = new Purchaseindent();
                $model->indent_id = isset($imodel->id)?$imodel->id:$pcimodel->id;
                $model->item_id = Yii::app()->request->getPost('item_id_' . $k);
                $model->item_name = Yii::app()->request->getPost('item_name_' . $k);
                $model->item_brand = Yii::app()->request->getPost('item_brand_' . $k);
                $model->qty_scale=Yii::app()->request->getPost('stock_taking_scale_' . $k);
                $model->is_added_to_order=1;
                $model->save();
                }
            }
        }
        d21('Indent Processed done by '.Yii::app()->user->getUsername(),"site.login");
        $this->redirect(array('indent'));
        //  }
        $this->render('itemevaluate', array('msg' => $msg));
    }
     public function actionItemevaluatelow() {
        if (isset($_GET['msg'])) {
            $smsg = "<div class='alert1 alert-success'>Item Added Successfully !!!</div>";
        }
        $msg = "";
        $uid=Yii::app()->user->id;
        $pcimodel=Purchaseindentmaster::model()->findBySql("select * from purchase_indent_master where created_by=$uid and is_done=0 order by id desc limit 1");
        if(empty($pcimodel)){
            $imodel=new Purchaseindentmaster();
            $imodel->indend_date=date('Y-m-d');
            $imodel->created_by = Yii::app()->user->id;
            $imodel->save();
        }
        $indentid=isset($imodel->id)?$imodel->id:$pcimodel->id;
        
        if (!empty($_POST['item_id'])) {
            foreach(Yii::app()->request->getPost('item_id') as $k) {
                $cmodel = Purchaseindent::model()->findByAttributes(array("item_id" => Yii::app()->request->getPost('item_id_' . $k),"is_added_to_order"=>1));
                if(empty($cmodel)) {
                $model = new Purchaseindent();
                $model->indent_id = isset($imodel->id)?$imodel->id:$pcimodel->id;
                $model->item_id = Yii::app()->request->getPost('item_id_' . $k);
                $model->item_name = Yii::app()->request->getPost('item_name_' . $k);
                $model->item_brand = Yii::app()->request->getPost('item_brand_' . $k);
                $model->qty_scale=Yii::app()->request->getPost('stock_taking_scale_' . $k);
                $model->is_added_to_order=1;
                $model->save();
                }
            }
        }
        d21('Indent low Processed done by '.Yii::app()->user->getUsername(),"site.login");
        $this->redirect(array('indent'));
        //  }
        $this->render('itemevaluate', array('msg' => $msg));
    }
     public function actionIndentcomplete() {
        if (isset($_GET['msg'])) {
            $smsg = "<div class='alert1 alert-success'>Item Added Successfully !!!</div>";
        }
        $msg = "";
        $uid=Yii::app()->user->id;
        $pcimodel=Purchaseindentmaster::model()->findBySql("select * from purchase_indent_master where created_by=$uid and is_done=0 order by id desc limit 1");        
        if(!empty($pcimodel->id)){    
        $ilist = Purchaseindent::model()->findAllBySql("select * from purchase_indent where indent_id=$pcimodel->id order by id desc");                          
        foreach ($ilist as $v) {
            $cmodel = Purchaseindent::model()->findByAttributes(array("id" => $v->id));
            $cmodel->qty_req = Yii::app()->request->getPost('qty_req_' . $v->id);
            $cmodel->req_date = Yii::app()->request->getPost('req_date_' . $v->id);
            $cmodel->save();
            }
            Purchaseindentmaster::model()->updateByPk($pcimodel->id,array("is_done"=>1));    
        }
        d21('Indent done by '.Yii::app()->user->getUsername(),"site.login");
        $this->redirect(array('purchaseindentmaster/admin'));
        //  }
        $this->render('itemevaluate', array('msg' => $msg));
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
        $this->active_menu = "cps";
        $this->open_class = "inventory";
        $this->active_class = "iindex";
        $this->render('index');
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->active_menu = "cps";
        $this->open_class = "inventory";
        $this->active_class = "sadmin";
        $model = new Itemstock('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Itemstock']))
         $model->attributes = $_GET['Itemstock'];
        d21('Item stock viewed by '.Yii::app()->user->getUsername(),"site.login");
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
