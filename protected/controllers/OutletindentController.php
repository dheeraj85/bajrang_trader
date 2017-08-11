<?php

class OutletindentController extends Controller {

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
                'actions' => array('create', 'update', 'checkitemexist','deleteitem','additemindent','stockaccept',
                    'itemevaluate','indentcomplete','admin','index','review','indentupdate','printindent','acceptorder'),
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
    
        public function actionStockaccept() {
        $this->active_menu = "indent_outlet_mgr";
        $this->open_class = "omunit";
        $this->active_class = "admin";
        $model = Indentmaster::model()->findByAttributes(array('sync_id' => $_GET['sync_id']));
        $this->render('stockaccept', array(
            'model' => $model,
        ));
    }
    
     public function actionAcceptorder() {
         $indent_itemid=Yii::app()->request->getPost('indent_itemid');
         Indentitems::model()->updateByPk($indent_itemid,array("qty_in_stock"=>$_POST['Indentitems']['qty_in_stock'],"qty_for_sale"=>$_POST['Indentitems']['qty_in_stock'],"item_accepted_by_pos"=>1)); 
     }
     
     public function actionPrintindent() {
         $this->active_menu = "indent_outlet_mgr";
        $this->open_class = "omunit";
        $this->active_class = "admin";
        $model = Indentmaster::model()->findByAttributes(array('sync_id' => Yii::app()->request->getParam('sync_id')));
        $this->render('print', array(
            'model' => $model,
        ));
    }

     public function actionIndentupdate() {
        if (isset($_GET['msg'])) {
            $smsg = "<div class='alert1 alert-success'>Item Added Successfully !!!</div>";
        }
        $msg = "";
        $sync_id=Yii::app()->request->getPost('sync_id'); 
        $id=Yii::app()->request->getPost('id'); 
        if(Yii::app()->request->getPost('updateindent')){          
        $ilist = Indentitems::model()->findAllBySql("select * from internal_indent_items where sync_id='$sync_id' order by id desc");                          
        foreach ($ilist as $v) {
            $cmodel = Indentitems::model()->findByAttributes(array("id" => $v->id));
            $cmodel->qty_required = Yii::app()->request->getPost('qty_required_' . $v->id);
            $cmodel->req_date = Yii::app()->request->getPost('req_date_' . $v->id);
            $cmodel->item_purpose= Yii::app()->request->getPost('item_purpose_' . $v->id);
            $cmodel->save();
          }   
          $this->redirect(array('outletindent/admin'));
        }
        if($_POST['generateorder']){
         Indentmaster::model()->updateByPk($id,array("is_indenting_done"=>2)); 
         foreach(Indentitems::model()->findAllByAttributes(array("sync_id"=>$sync_id)) as $iitems){
            Indentitems::model()->updateByPk($iitems->id,array("is_indenting_done"=>0));  
         }
         $this->redirect(array('outletindent/admin'));
        }
        d21('Internal Indent updated by '.Yii::app()->user->getUsername(),"site.login");
        //d21('Vendor Itemsupply added by '.Yii::app()->user->getUsername(),"vendoritemsupply.create");
        //  }
        $this->render('itemevaluate', array('msg' => $msg));
    }
    
     public function actionReview() {
       if(empty(Yii::app()->session['security'])){
         $this->redirect(array("site/unauthorize"));   
        }         
         $this->active_menu = "indent_outlet_mgr";
        $this->open_class = "omunit";
        $this->active_class = "admin";
        $model =  Indentmaster::model()->findByAttributes(array("sync_id"=>Yii::app()->request->getParam('sync_id')));
        d21('Internal Indent review by '.Yii::app()->user->getUsername(),"site.login");
        $this->render('review', array(
            'model' => $model,'id'=>Yii::app()->request->getParam('id'),
        ));
    }

     public function actionItemevaluate() {
        if (isset($_GET['msg'])) {
            $smsg = "<div class='alert1 alert-success'>Item Added Successfully !!!</div>";
        }
        $msg = "";
        $uid=Yii::app()->user->id;
        $pcimodel=Indentmaster::model()->findBySql("select * from internal_indent_master where created_by=$uid and is_indenting_done=0 order by id desc limit 1");
        if(empty($pcimodel)){
            $imodel=new Indentmaster();
            $imodel->indent_date=date('Y-m-d');
            $imodel->indent_type=Yii::app()->request->getPost('indent_type');
            $imodel->purchase_type=Yii::app()->request->getPost('purchase_type');            
            $imodel->created_by = Yii::app()->user->id;
            $imodel->created_user_role = Yii::app()->user->getUser()->role;
            $imodel->save();
            $imodel->sync_id="Offline-".$imodel->id;
            $imodel->save();
        }
        $indentid=isset($imodel->sync_id)?$imodel->sync_id:$pcimodel->sync_id;
        
        if (!empty($_POST['item_id'])) {
            foreach(Yii::app()->request->getPost('item_id') as $k) {
                $cmodel = Indentitems::model()->findByAttributes(array("item_id" => Yii::app()->request->getPost('item_id_' . $k),"is_indenting_done"=>1));
                if (empty($cmodel)) {
                $model = new Indentitems();
                $model->sync_id = isset($imodel->sync_id)?$imodel->sync_id:$pcimodel->sync_id;
                $model->barcode="123456";
                if(Yii::app()->request->getPost('choice_item')=="itemwise"){
                $model->p_category_id=$_POST['p_category_id'];
                $model->p_sub_category_id=$_POST['p_sub_category_id'];
                }else{
                $model->p_category_id=$_POST['category_id_' . $k];
                $model->p_sub_category_id=$_POST['sub_category_id_' . $k]; 
                }
                $model->item_id = $_POST['item_id_' . $k];
                $model->item_name = $_POST['item_name_' . $k];
                $model->item_brand = $_POST['item_brand_' . $k];
                $model->qty_scale=$_POST['stock_taking_scale_' . $k];
                $model->created_by = Yii::app()->user->id;
                $model->created_user_role = Yii::app()->user->getUser()->role;
                $model->is_indenting_done=1;
                $model->save();
                }
            }
        }
        d21('Internal Indent processed by '.Yii::app()->user->getUsername(),"site.login");
        //d21('Vendor Itemsupply added by '.Yii::app()->user->getUsername(),"vendoritemsupply.create");
        $this->redirect(array('create','id'=>Yii::app()->request->getPost('id')));
        //  }
        $this->render('itemevaluate', array('msg' => $msg));
    }
    
      public function actionIndentcomplete() {
        if (isset($_GET['msg'])) {
            $smsg = "<div class='alert1 alert-success'>Item Added Successfully !!!</div>";
        }
        $msg = "";
        $uid=Yii::app()->user->id;
        $pcimodel=Indentmaster::model()->findBySql("select * from internal_indent_master where created_by=$uid and is_indenting_done=0 order by id desc limit 1");        
        if(!empty($pcimodel->id)){    
        $ilist = Indentitems::model()->findAllBySql("select * from internal_indent_items where sync_id='$pcimodel->sync_id' order by id desc");                          
        foreach ($ilist as $v) {
            $cmodel = Indentitems::model()->findByAttributes(array("id" => $v->id));
            $cmodel->qty_required = Yii::app()->request->getPost('qty_required_' . $v->id);
            $cmodel->req_date = Yii::app()->request->getPost('req_date_' . $v->id);
            $cmodel->item_purpose= Yii::app()->request->getPost('item_purpose_' . $v->id);
            $cmodel->save();
            }
            Indentmaster::model()->updateByPk($pcimodel->id,array("is_indenting_done"=>1));    
        }
        d21('Internal Indent done by '.Yii::app()->user->getUsername(),"site.login");
        //d21('Vendor Itemsupply added by '.Yii::app()->user->getUsername(),"vendoritemsupply.create");
        $this->redirect(array('outletindent/admin'));
        //  }
        $this->render('itemevaluate', array('msg' => $msg));
    }
    
    public function actionCheckitemexist() {
        $model = Indentitems::model()->findByAttributes(array("item_id" => Yii::app()->request->getParam('itemid'),"is_indenting_done"=>1));
        if (!empty($model)) {
            $msg = "1";
            $indentno = $model->sync_id;
        } else {
            $msg = "0";
            $indentno = 0;
        }
        echo CJSON::encode(array('msg' => $msg, 'indentno' => $indentno));
    }

    public function actionDeleteitem() {
        Indentitems::model()->findByPk(Yii::app()->request->getPost('id'))->delete();
    }

    public function actionAdditemindent() {
        Indentmaster::model()->updateByPk($_GET['id'], array("is_indenting_done" => 0));
        $this->redirect(array('outletindent/create','id'=>$_GET['id']));
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
         $this->active_menu = "indent_outlet_mgr";
        $this->open_class = "omunit";
        $this->active_class = "create";
        $id="";
        $item_name= "";
        $id = Yii::app()->request->getParam('indent_id');
        $model = new Itemstock;
        if (isset($_POST['Itemstock'])) {
            $model->attributes = $_POST['Itemstock'];
             $item_name= $_POST['item_name'];
            $id = $_POST['indent_id'];
        }
        $this->render('create', array(
            'model' => $model, 'id' => $id,'item_name'=>$item_name
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

        if (isset($_POST['Indentmaster'])) {
            $model->attributes = $_POST['Indentmaster'];
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
        // } else
        //   throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $this->active_menu = "gpu";
        $this->open_class = "gpunit";
        $this->active_class = "index";
        $this->render('index');
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
         $this->active_menu = "indent_outlet_mgr";
        $this->open_class = "omunit";
        $this->active_class = "admin";
        $model = new Indentmaster('searchOutlet');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Indentmaster']))
            $model->attributes = $_GET['Indentmaster'];
        d21('Internal Indent viewed by '.Yii::app()->user->getUsername(),"site.login");

        $this->render('admin', array(
            'model' => $model,
        ));
    }


    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Indentmaster the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Indentmaster::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Indentmaster $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'indentmaster-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }   
}