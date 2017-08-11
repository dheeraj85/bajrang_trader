<?php

class PurchaseinvoiceController extends Controller {

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
                'actions' => array('create', 'update', 'admin', 'invoice', 'getList', 'getitemscale', 'checkmrdno', 'getinvoicedataforreview', 'deletetax',
                    'processinvoice', 'getitemdata', 'getScale', 'getItype', 'getCategoryList', 'getMrd',
                    'addinvoiceitem', 'getinvoicedata', 'itemdelete', 'getitemlist', 'completeinvoice', 'givereview', 'addtostock', 'getinvoicebilldata', 'index'),
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

    public function actionGetCategoryList() {
        $list = Purchasecategory::model()->findAllByAttributes(array('type' => 'Purchase'));
        echo CJSON::encode(array('scat' => $list));
    }

    public function actionGetScale() {
        $list = Itemscale::model()->findAllByAttributes(array('scale_type' => 'Vscale'));
        echo CJSON::encode(array('items' => $list));
    }

    public function actionGetItype() {
        $list = Utils::inputtype();
        echo CJSON::encode(array('items' => $list));
    }

    public function actionGetMrd() {
        $list = Utils::schedule();
        echo CJSON::encode(array('items' => $list));
    }

    public function actionGetitemscale() {
        $model = Purchaseitem::model()->findByPk($_GET['id']);
        echo CJSON::encode(array('scale' => $model->item_scale, 'is_schedule' => $model->is_schedule));
    }

    public function actionGetitemdata() {
        $model = Purchaseinvoiceitems::model()->findByPk($_GET['id']);
        $taxmodel = Invoiceitemtax::model()->findAllByAttributes(array("invoice_item_id" => $_GET['id']));
        echo CJSON::encode(array('model' => $model, 'taxmodel' => $taxmodel));
    }

    public function actionCheckmrdno() {
        $model = Purchaseinvoiceitems::model()->findByAttributes(array("mrd_no" => $_GET['mrd']));
        if (!empty($model)) {
            $msg = "1";
        } else {
            $msg = "0";
        }
        echo CJSON::encode(array('msg' => $msg));
    }

    public function actionGetList() {
        $id = $_GET['vid'];
        $list = Yii::app()->db->createCommand("select vs.purchase_item_id,i.itemname,i.brand,i.item_scale from vendor_item_supply vs,purchase_item i where vs.purchase_item_id=i.id and vs.vendor_id=$id")->queryAll();
        echo CJSON::encode(array('items' => $list));
    }

    public function actionGetitemlist() {
        $list = Purchaseitem::model()->findAllByAttributes(array("p_category_id" => $_GET['cid'], "p_sub_category_id" => $_GET['scid']));
        echo CJSON::encode(array('items' => $list));
    }

    public function actionItemdelete() {
        Purchaseinvoiceitems::model()->findByPk($_POST['id'])->delete();
    }

    public function actionDeletetax() {
        Invoicebilltax::model()->findByPk($_POST['id'])->delete();
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

    public function actionGetinvoicedata() {
        $list = Purchaseinvoice::model()->findByAttributes(array('id' => $_POST['invoice_id'], 'is_reviewed' => 0));
        $this->renderPartial('_addpartial', array(
            'list' => $list,
        ));
    }

    public function actionGetinvoicebilldata() {
        $list = Purchaseinvoice::model()->findByAttributes(array('id' => $_POST['invoice_id'], 'is_reviewed' => 0));
        $this->renderPartial('_getinvoicebilldata', array(
            'list' => $list,
        ));
    }

    public function actionGetinvoicedataforreview() {
        $list = Purchaseinvoice::model()->findByAttributes(array('id' => $_GET['invoice_id'], 'is_reviewed' => 0));
        $this->renderPartial('_getinvoicedataforreview', array(
            'list' => $list,
        ));
    }

    public function actionGivereview() {
        $cinvoice = Purchaseinvoice::model()->findByPk($_POST['invoice_id']);
        if (!empty($cinvoice)) {
            Purchaseinvoice::model()->updateByPk($cinvoice->id, array('review_point' => $_POST['review_rating'], 'review_desc' => $_POST['review_desc'], 'is_reviewed' => 1));
        }
        d21('Invoice Review done by ' . Yii::app()->user->getUsername(), "purchaseinvoice.givereview");
    }

    public function actionAddtostock() {
        $cinvoice = Purchaseinvoice::model()->findByPk($_POST['invoice_id']);
        if (!empty($cinvoice)) {
            if ($cinvoice->is_added_to_stock == 0) {
                foreach (Purchaseinvoiceitems::model()->findAllByAttributes(array("invoice_id" => $_POST['invoice_id'])) as $pitem) {
                    $model1 = new Itemstock();
                    $model1->p_category_id = $pitem->p_category_id;
                    $model1->p_sub_category_id = $pitem->p_sub_category_id;
                    $model1->invoice_id = $pitem->invoice_id;
                    $model1->item_id = $pitem->item_id;
                    $model1->particulars = $pitem->particulars;
                    $model1->stock_qty = $pitem->stock_qty;
                    $model1->stock_taking_scale = $pitem->stock_taking_scale;
                    $model1->rate = $pitem->rate;
                    $model1->amount = $pitem->amount;
                    $model1->is_mrd = $pitem->is_mrd;
                    $model1->mrd_no = $pitem->mrd_no;
                    $model1->make_date = $pitem->make_date;
                    $model1->ready_date = $pitem->ready_date;
                    $model1->discard_date = $pitem->discard_date;
                    $model1->schedule_date = $pitem->schedule_date;
                    $model1->remarks = $pitem->remarks;
                    $model1->save();
                }
                Purchaseinvoice::model()->updateByPk($cinvoice->id, array('is_added_to_stock' => 1));
                d21('Invoice Stock Updated by ' . Yii::app()->user->getUsername(), "purchaseinvoice.addtostock");
            }
        }
    }

    public function actionProcessinvoice() {
        $cinvoice = Purchaseinvoice::model()->findByPk($_POST['invoice_id']);
        if (!empty($cinvoice)) {
            $mamt = 0.0;
            $mtax = 0.0;
            $bamt = 0.0;
            $tshare = 0.0;
            $namt = 0.0;
            $criteria = new CDbCriteria;
            $criteria->order = "id desc";
            foreach (Purchaseinvoiceitems::model()->findAllByAttributes(array("invoice_id" => $_POST['invoice_id']), $criteria) as $lists) {
                if ($cinvoice->invoice_format == "F1") {
                    $mtaxamt = 0.0;
                    foreach (Invoiceitemtax::model()->findAllByAttributes(array("invoice_item_id" => $lists->id)) as $itax) {
                        $taxamt = $lists->amount * $itax->tax_percent / 100;
                        $mtaxamt = $mtaxamt + $taxamt;
                    }
                }
                $mamt = $mamt + $lists->amount + $mtaxamt;
                $discount = $lists->discount;
                $mamt = $mamt - $discount;
            }
            $totalbilltax = Invoicebilltax::model()->findByAttributes(array("invoice_id" => $_POST['invoice_id'], "type" => "tax"));
            if (!empty($totalbilltax)) {
                $tshare = $mamt * $totalbilltax->tax_percent / 100;
            }
            foreach (Invoicebilltax::model()->findAllByAttributes(array("invoice_id" => $_POST['invoice_id'], "type" => "others")) as $itax) {
                $mtax = $mtax + $itax->tax_percent;
            }
            $bamt = $mamt + $mtax + $tshare;
            $namt = $bamt - $cinvoice->total_discount;
            Purchaseinvoice::model()->updateByPk($cinvoice->id, array('total_amount' => $namt));
        }
    }

    public function actionCompleteinvoice() {
        $cinvoice = Purchaseinvoice::model()->findByPk($_POST['invoicemain_id']);
        //if($cinvoice->invoice_format=="F1"){
        foreach (Invoicesettings::model()->findAllByAttributes(array('type' => 'bill_cost')) as $isetting) {
            if ($_POST['billcost_' . $isetting->id] > 0.0) {
                $cexistbilltax = Invoicebilltax::model()->findByAttributes(array("invoice_id" => $_POST['invoicemain_id'], "invoice_settings_id" => $isetting->id));
                if (empty($cexistbilltax)) {
                    $model = new Invoicebilltax();
                    $model->invoice_id = $_POST['invoicemain_id'];
                    $model->invoice_settings_id = $isetting->id;
                    $model->label = $isetting->label;
                    $model->tax_percent = $_POST['billcost_' . $isetting->id];
                    $model->type = "others";
                    $model->save();
                } else {
                    $cexistbilltax->invoice_id = $_POST['invoicemain_id'];
                    $cexistbilltax->invoice_settings_id = $isetting->id;
                    $cexistbilltax->label = $isetting->label;
                    $cexistbilltax->tax_percent = $_POST['billcost_' . $isetting->id];
                    $cexistbilltax->type = "others";
                    $cexistbilltax->save();
                }
            }
        }
        if ($cinvoice->invoice_format == "F2") {
            $cexistbilltax = Invoicebilltax::model()->findByAttributes(array("invoice_id" => $_POST['invoicemain_id'], 'type' => 'tax'));
            if (empty($cexistbilltax)) {
                $model2 = new Invoicebilltax();
                $model2->invoice_id = $_POST['invoicemain_id'];
                $model2->invoice_settings_id = $_POST['billcost_taxtype'];
                $model2->label = Invoicesettings::model()->findByPk($_POST['billcost_taxtype'])->label;
                $model2->tax_percent = $_POST['billcost_tax'];
                $model2->type = "tax";
                $model2->save();
            } else {
                $cexistbilltax->invoice_id = $_POST['invoicemain_id'];
                $cexistbilltax->invoice_settings_id = $_POST['billcost_taxtype'];
                $cexistbilltax->label = Invoicesettings::model()->findByPk($_POST['billcost_taxtype'])->label;
                $cexistbilltax->tax_percent = $_POST['billcost_tax'];
                $cexistbilltax->type = "tax";
                $cexistbilltax->save();
            }
        }
        Purchaseinvoice::model()->updateByPk($cinvoice->id, array('total_discount' => $_POST['bill_discount']));
        d21('Invoice Bill Created by ' . Yii::app()->user->getUsername(), "purchaseinvoice.completeinvoice");
    }

    public function actionAddinvoiceitem() {
        $model1 = new Purchaseinvoiceitems();
        $model1->attributes = $_POST['Purchaseinvoiceitems'];
        $model1->p_category_id = $_POST['Purchaseinvoiceitems']['p_category_id'];
        $model1->p_sub_category_id = $_POST['Purchaseinvoiceitems']['p_sub_category_id'];
        $model1->invoice_id = $_POST['invoice_id'];
        $model1->item_id = $_POST['item_id'];
        $model1->particulars = $_POST['particulars'];
        $model1->v_qty = $_POST['v_qty'];
        $model1->v_scale = $_POST['v_scale'];
        $model1->input_type = $_POST['input_type'];
        $model1->c_unit_value = $_POST['c_unit_value'];
        $model1->stock_qty = $_POST['stock_qty'];
        $model1->stock_taking_scale = $_POST['stock_taking_scale'];
        $model1->rate = $_POST['rate'];
        $model1->amount = $_POST['amount'];
        $model1->discount = $_POST['discount'];
        $model1->is_mrd = $_POST['is_mrd'];
        $model1->mrd_no = $_POST['mrd_no'];
        $model1->make_date = $_POST['make_date'];
        $model1->ready_date = $_POST['ready_date'];
        $model1->discard_date = $_POST['discard_date'];
        $model1->schedule_date = $_POST['schedule_date'];
        $model1->remarks = $_POST['remarks'];
        $model1->save();
        $cinvoice = Purchaseinvoice::model()->findByPk($_POST['invoice_id']);
        if ($cinvoice->invoice_format == "F1") {
            foreach (Invoicesettings::model()->findAllByAttributes(array('type' => 'tax_in_items')) as $isetting) {
                if ($_POST['taxtype_' . $isetting->id] > 0.0) {
                    $model = new Invoiceitemtax();
                    $model->invoice_item_id = $model1->id;
                    $model->invoice_settings_id = $isetting->id;
                    $model->label = $isetting->label;
                    $model->tax_percent = $_POST['taxtype_' . $isetting->id];
                    $model->save();
                }
            }
        }
        $model1->amount = $_POST['amount'];
        $model1->save();
        // d21('Invoice Item Added by ' . Yii::app()->user->getUsername(), "purchaseinvoice.addinvoiceitem");
        //}
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $this->active_menu = "cps";
        $this->open_class = "invoice";
        $this->active_class = "admin";
        $imodel = Purchaseinvoice::model()->findByPk($_GET['id']);
        $model = new Purchaseinvoiceitems();
        if (isset($_POST['Purchaseinvoice'])) {
            
        }
        $this->render('create', array(
            'model' => $model, 'imodel' => $imodel,
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

        if (isset($_POST['Purchaseinvoice'])) {
            $model->attributes = $_POST['Purchaseinvoice'];
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
        //  throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $this->active_menu = "cps";
        $this->open_class = "invoice";
        $this->active_class = "pindex";
        $this->render('index');
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->active_menu = "cps";
        $this->open_class = "invoice";
        $this->active_class = "admin";
        $model = new Purchaseinvoice('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Purchaseinvoice'])) {
            $model->attributes = $_GET['Purchaseinvoice'];
        }
        if (isset($_POST['Purchaseinvoice'])) {
            $model->attributes = $_POST['Purchaseinvoice'];
            $model->vendor_name = $_POST['Purchaseinvoice']['vendor_name'];
            $model->is_added_to_stock = 0;
            $model->is_reviewed = 0;
            $model->created_by = Yii::app()->user->id;
            $model->created_date = date('Y-m-d');
            if ($model->save()) {
                d21('Invoice Created by ' . Yii::app()->user->getUsername(), "purchaseinvoice.create");
                $this->redirect(array('admin'));
            }
        }
        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Purchaseinvoice the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Purchaseinvoice::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Purchaseinvoice $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'purchaseinvoice-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
