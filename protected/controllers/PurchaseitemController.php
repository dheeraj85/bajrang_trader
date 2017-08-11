<?php

class PurchaseitemController extends Controller {

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
                // 'postOnly + delete', // we only allow deletion via POST request
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
                'actions' => array('getCategoryList', 'create', 'update', 'admin', 'getSCategoryList',
                    'saveitem', 'view', 'approval', 'savemenuitem', 'savemenu', 'delete', 'stockadmin',
                    'stockopening', 'salesitem', 'updateitemstatus'),
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

    public function actionUpdateitemstatus() {
        $id = $_GET['id'];
        $status = $_GET['status'];
        if (!empty($id)) {
            Purchaseitem::model()->updateByPk($id, array('is_active' => $status));
            echo "success";
        } else {
            echo "fail";
        }
    }

    public function actionSalesitem() {
        $this->active_menu = "mcms";
        $this->open_class = "category";
        $this->active_class = "stkadmin";
        $page = 1;
        $url = "";
        if (isset($_POST['filter_date_start'])) {
            $filter_date_start = $_POST['filter_date_start'];
        } else {
            $filter_date_start = date('Y-m-d', strtotime(date('Y') . '-' . date('m') . '-01'));
        }

        if (isset($_POST['filter_date_end'])) {
            $filter_date_end = $_POST['filter_date_end'];
        } else {
            $filter_date_end = date('Y-m-d');
        }

        if (isset($_POST['choice_item'])) {
            $choice_item = $_POST['choice_item'];
        }
        if (isset($_POST['item_id'])) {
            $item_id = $_POST['item_id'];
        }

        $report = new Stockhistory();

        $data['data'] = array();

        $filter_data = array(
            'choice_item' => $choice_item,
            'item_id' => $item_id,
            'filter_date_start' => $filter_date_start,
            'filter_date_end' => $filter_date_end,
            // 'filter_order_status_id' => $filter_order_status_id,
            'start' => ($page - 1) * 5,
            'limit' => 5
        );

        $results = $report->getsalesitem($filter_data);
        if (!empty($results)) {
            $data['order'] = $results;
        } else {
            $data['text_no_results'] = 'No Result Found';
        }
        if (isset($_POST['choice_item'])) {
            $url .= '&choice_item=' . $_POST['choice_item'];
        }
        if (isset($_POST['item_id'])) {
            $url .= '&item_id=' . $_POST['item_id'];
        }
        if (isset($_POST['filter_date_start'])) {
            $url .= '&filter_date_start=' . $_POST['filter_date_start'];
        }
        if (isset($_POST['filter_date_end'])) {
            $url .= '&filter_date_end=' . $_POST['filter_date_end'];
        }
        $data['results'] = $data['text_no_results'];
        $data['filter_date_start'] = $filter_date_start;
        $data['filter_date_end'] = $filter_date_end;
        $data['choice_item'] = $choice_item;
        $data['item_id'] = $item_id;
        $this->render('salesitem', array(
            'data' => $data,
        ));
    }

    public function actionStockopening($id, $type) {
       $this->active_menu = "cds";
        $this->open_class = "cds";
        $this->active_class = "stkadmin";
        $stk_model = new Stockhistory('search');
        $stk_model->item_id = $id;
//        $id = $_GET['id'];
//        $type = $_GET['type'];
        if (empty($id)) {
            $this->redirect(array('purchaseitem/stockopening'));
        }
        $total_qty = 0;
        if ($type == 'csk') {
            $data = Yii::app()->db->createCommand()
                    ->select('sum(stock_qty) as stock_qty')
                    ->from('item_stock')
                    ->where('item_id = ' . $id)
                    ->queryRow();
            $total_qty = $data['stock_qty'];
        } else if ($type == 'shelf') {
            $data = Yii::app()->db->createCommand()
                    ->select('total_qty as stock_qty')
                    ->from('shelf_items')
                    ->where('item_id = ' . $id)
                    ->queryRow();
            $total_qty = $data['stock_qty'];
        }
        $model = Purchaseitem::model()->findByPk($id);
        if (!empty($_POST['stock_qty'])) {
            $stk_hstry = new Stockhistory();
            if ($type == 'csk') {
                $stk = new Itemstock();
                $stk->entry_type = 'Direct';
                $stk->invoice_id = 0;
                $stk->p_category_id = $model->p_category_id;
                $stk->p_sub_category_id = $model->p_sub_category_id;
                $stk->item_id = $model->id;
                $stk->particulars = $model->itemname;
                $stk->input_type = 'Direct';
                $stk->stock_qty = $_POST['stock_qty'];
                $stk->stock_taking_scale = $model->item_scale;
                $stk->created_date = date('Y-m-d');
                $stk->rate = $_POST['price'];
                $stk->amount = $stk->rate * $stk->stock_qty;
                $stk->created_by = Yii::app()->user->id;
                $stk->is_active = 1;
                $stk->save();
                $stk_hstry->stock_type = 'main';
            } else if ($type == 'shelf') {
//                $isk = new InternalStock();
//                $isk->indent_item_id = 0;
//                $isk->item_stock_id = 0;
//                $isk->user_id = Yii::app()->user->id;
//                $isk->p_category_id = $model->p_category_id;
//                $isk->p_sub_category_id = $model->p_sub_category_id;
//                $isk->item_id = $model->id;
//                $isk->item_name = $model->itemname;
//                $isk->stock_qty = $_POST['stock_qty'];
//                $isk->stock_taking_scale = $model->item_scale;
//                $isk->dispatch_date = date('Y-m-d');
//                $isk->save();
                $stk_hstry->stock_type = 'internal';
                $shelf = Shelfitems::model()->findByAttributes(array('item_id' => $id));
//                print_r($shelf->attributes);
//                echo $shelf->id;
                $shelf->total_qty = $shelf->total_qty + $_POST['stock_qty'];
                Shelfitems::model()->updateByPk($shelf->id, array("total_qty" => $shelf->total_qty));
            }
            $stk_hstry->p_category_id = $model->p_category_id;
            $stk_hstry->p_sub_category_id = $model->p_sub_category_id;
            $stk_hstry->item_id = $model->id;
            $stk_hstry->stock_qty = $_POST['stock_qty'];
            $stk_hstry->stock_taking_scale = $model->item_scale;
            $stk_hstry->created_date = date('Y-m-d h:i:s');
            $stk_hstry->created_by = Yii::app()->user->id;
            $stk_hstry->save();
            $this->redirect(array('stockopening', 'id' => $model->id, 'type' => $type));
        }

        $this->render('stockopening', array(
            'model' => $model, 'total_qty' => $total_qty, 'type' => $type
        ));
    }

    public function actionStockadmin() {
        $this->active_menu = "cds";
        $this->open_class = "cds";
        $this->active_class = "stkadmin";
        $model = new Purchaseitem('search_for_stock_settlements');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Purchaseitem']))
            $model->attributes = $_GET['Purchaseitem'];
        d21('Purchase Item viewed by ' . Yii::app()->user->getUsername(), "site.login");
        $this->render('stockadmin', array(
            'model' => $model,
        ));
    }

    public function actionApproval() {
        $id = $_GET['id'];
        $active = $_GET['isfreshstock'];
        $model = Purchaseitem::model()->findByPk($id);
        $model->isfreshstock = $active;
        $model->save();
        $admin = new CActiveDataProvider('Purchaseitem');
        $this->redirect(array('admin'), array('model' => $admin));
    }

    public function actionSavemenu() {
        $itemid = $_GET['item_id'];
        $pitem = Purchaseitem::model()->findByPk($itemid);
        if (!empty($_GET['vid'])) {
            foreach ($_GET['vid'] as $k => $v) {
                $model = new Vendoritemsupply();
                $model->vendor_id = $v;
                $model->purchase_item_id = $itemid;
                $model->itemname = $pitem->itemname;
                $model->brand = $pitem->brand;
                $model->is_active = 1;
                $model->save();
            }
        }
    }

    public function actionSaveitem() {
        $pid = Yii::app()->request->getParam('pitem_id');
        $taxtype = Yii::app()->request->getParam('tax_type');
        $purchaseitem = Purchaseitem::model()->findByPk($pid);
        $model = new Shelfitems();
        $model->p_category_id = $purchaseitem->p_category_id;
        $model->p_sub_category_id = $purchaseitem->p_sub_category_id;
        $model->item_id = $purchaseitem->id;
        $model->barcode = $purchaseitem->barcode;
        $model->tax_type = $taxtype;
        if ($model->save()) {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function actionSavemenuitem() {
        $pid = Yii::app()->request->getParam('item_id');
        $taxtype = Yii::app()->request->getParam('tax_type');
        $purchaseitem = Purchaseitem::model()->findByPk($pid);
        $model = new Menuitems();
        $model->p_category_id = $purchaseitem->p_category_id;
        $model->p_sub_category_id = $purchaseitem->p_sub_category_id;
        $model->barcode = $purchaseitem->barcode;
        $model->item_id = $purchaseitem->id;
        $model->tax_type = $taxtype;
        if ($model->save()) {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function actionGetCategoryList() {
        $type = Yii::app()->request->getParam('type');
        if ($type == 'ots') {
            $list = Purchasecategory::model()->findAllBySql("select * from purchase_category where type in('Processed','Resale') order by id");
        } else if ($type == 'menu') {
            $list = Purchasecategory::model()->findAllByAttributes(array('type' => 'Menu'));
        } else if ($type == 'aos') {
            $list = Purchasecategory::model()->findAllByAttributes(array('type' => 'AOS'));
        }
        echo CJSON::encode(array('scat' => $list));
    }

    public function actionGetSCategoryList() {
        $cid = Yii::app()->request->getParam('cid');
        //$type = Yii::app()->request->getParam('type');
        $list = Purchasesubcategory::model()->findAllByAttributes(array('category_id' => $cid));
        echo CJSON::encode(array('scat' => $list));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->active_menu = "mcms";
        $this->open_class = "category";
        $this->active_class = "piadmin";
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $this->active_menu = "mcms";
        $this->open_class = "category";
        $this->active_class = "picreate";
        $model = new Purchaseitem;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['Purchaseitem'])) {
            $model->attributes = $_POST['Purchaseitem'];
            $model->is_active = 1;
            $model->goods_service=$_POST['Purchaseitem']['goods_service'];
            if($_POST['Purchaseitem']['goods_service']=="Good"){
                $model->gst_code_type = 'HSN';
            }else{
                $model->gst_code_type = 'SAC';
            }
            $model->type = $_POST['Purchaseitem']['type'];
            $model->gst_code = $_POST['Purchaseitem']['gst_code'];            
            $model->gst_percent = $_POST['Purchaseitem']['gst_percent'];
            //$model->cess_tax = $_POST['Purchaseitem']['cess_tax'];
            $model->item_classification=$_POST['Purchaseitem']['item_classification'];
            //$model->cess_percent=$_POST['Purchaseitem']['cess_percent'];
            $model->created_by = Yii::app()->user->id;
            if ($model->save()) {
                $model->save();
                Yii::app()->user->setFlash('pitem', 'Purchase Item Added successfully');
                d21('Purchase Item '.$model->itemname.' added by ' . Yii::app()->user->getUsername(), "site.login");
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
        $this->active_menu = "mcms";
        $this->open_class = "category";
        $this->active_class = "piadmin";
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Purchaseitem'])) {
            $model->attributes = $_POST['Purchaseitem'];
            $model->goods_service=$_POST['Purchaseitem']['goods_service'];
            if($_POST['Purchaseitem']['goods_service']=="Good"){
                $model->gst_code_type = 'HSN';
            }else{
                $model->gst_code_type = 'SAC';
            }
            $model->low_qty = $_POST['Purchaseitem']['low_qty'];
            $model->type = $_POST['Purchaseitem']['type'];
            $model->gst_code = $_POST['Purchaseitem']['gst_code']; 
             $model->gst_percent = $_POST['Purchaseitem']['gst_percent'];
            $model->cess_tax = $_POST['Purchaseitem']['cess_tax'];
            $model->item_classification=$_POST['Purchaseitem']['item_classification'];
            $model->cess_percent=$_POST['Purchaseitem']['cess_percent'];
            if ($model->save()) {
                if (empty($model->barcode)) {
                    $model->barcode = time() . $model->id;
                    $model->save();
                }
                d21('Purchase Item updated by ' . Yii::app()->user->getUsername(), "site.login");
                $this->redirect(array('admin'));
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
        // if (Yii::app()->request->isPostRequest) {
        // we only allow deletion via POST request
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        //} else
        //   throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Purchaseitem');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->active_menu = "mcms";
        $this->open_class = "category";
        $this->active_class = "piadmin";
        $model = new Purchaseitem('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Purchaseitem']))
            $model->attributes = $_GET['Purchaseitem'];
        d21('Purchase Item viewed by ' . Yii::app()->user->getUsername(), "site.login");
        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Purchaseitem the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Purchaseitem::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Purchaseitem $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'purchaseitem-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
