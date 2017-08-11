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
                'actions' => array('create', 'update', 'admin', 'invoice', 'getList', 'getitemscale', 
                    'checkmrdno', 'getinvoicedataforreview', 'deletetax', 'joinpoinvoice', 'view',
                    'processinvoice', 'getitemdata', 'getScale', 'getItype', 'getCategoryList',
                    'getcategorygpu', 'getMrd', 'editinvoiceitem', 'getItemname', 'getvendorname',
                    'updatepoinvoice','cancel_invoice','cancel_challan','check_invoice',
                    'addinvoiceitem', 'getinvoicedata', 'itemdelete', 'getitemlist', 'completeinvoice',
                    'givereview', 'addtostock', 'getinvoicebilldata', 'index', 'getvendor_gstnno',
                    'authreview', 'getsecuritypwd', 'getCategoryListChoice', 'getpoitems', 'getitemlistbycid', 'getinvoice', 'saveinvoice', 'getitems'),
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

    public function actionGetitems() {
        $model = Purchaseitem::model()->findByPk(Yii::app()->request->getParam('id'));
        echo CJSON::encode(array('items' => $model));
    }

    public function actionGetvendor_gstnno() {
        $model = Vendor::model()->findByPk(Yii::app()->request->getParam('id'));
        if (!empty($model->tin_no)) {
            echo $model->tin_no;
        }
    }
    
    public function actionCancel_invoice() {
        $pmodel = Purchaseinvoice::model()->findByPk(Yii::app()->request->getParam('id'));
        $model = Challan::model()->findByAttributes(array("purchase_invoice_id"=>Yii::app()->request->getParam('id'),"is_cancel"=>0));
        if (!empty($model)) {
            echo "1";
        }else{            
            echo "0";
            Purchaseinvoice::model()->updateByPk($pmodel->id, array("is_conflict_bill_accepted" => 1));
        }
    }
    
    public function actionCheck_invoice() {
        $model = Challan::model()->findByAttributes(array("purchase_invoice_id"=>Yii::app()->request->getParam('id')));
        if (!empty($model)) {
            echo "1";
        }else{            
            echo "0";
        }
    }

    public function actionCancel_challan() {
        $cmodel = Challan::model()->findByPk(Yii::app()->request->getParam('id'));
        $model = Kataparchy::model()->findByAttributes(array("challan_id"=>Yii::app()->request->getParam('id')));
        if (!empty($model)) {
            echo "1";
        }else{            
            echo "0";
            Challan::model()->updateByPk($cmodel->id, array("is_cancel" => 1));
        }
    }

    public function actionJoinpoinvoice() {
        if (!empty($_POST['poid'])) {
            foreach (Yii::app()->request->getPost('poid') as $k) {
                
            }
        }
        //d21('Vendor Itemsupply added by '.Yii::app()->user->getUsername(),"vendoritemsupply.create");
        $this->redirect(array('indent'));
        //  }
        $this->render('itemevaluate');
    }

    public function actionAuthreview() {
        $id = Yii::app()->request->getParam('id');
        $this->renderPartial('_authreview', array('id' => $id));
    }

    public function actionGetinvoice() {
        $id = Yii::app()->request->getParam('invoice_id');
        $model = Purchaseinvoice::model()->findByPk($id);
        $this->renderPartial('_editinvoice', array('id' => $id, 'model' => $model));
    }

    public function actionSaveinvoice() {
        $id = Yii::app()->request->getPost('id');
        $model = Purchaseinvoice::model()->findByPk($id);
        $model->attributes = $_POST['Purchaseinvoice'];
        $model->vendor_name = $_POST['Purchaseinvoice']['vendor_name'];
        if ($_POST['is_gstn_compliant'] == "1") {
            $model->is_gstn_compliant = $_POST['is_gstn_compliant'];
            $model->compliants_category_id = $_POST['Purchaseinvoice']['compliants_category_id'];
        } else {
            $model->is_gstn_compliant = $_POST['is_gstn_compliant'];
            $model->compliants_category_id = "";
        }
        if ($_POST['place_of_supply'] == "1") {
            $model->place_of_supply = $_POST['place_of_supply'];
            $model->state_code = $_POST['Purchaseinvoice']['state_code'];
        } else {
            $model->place_of_supply = $_POST['place_of_supply'];
            $model->state_code = '23';
        }
        if ($model->invoice_type == "cash") {
            $model->land_owner = $_POST['Purchaseinvoice']['land_owner'];
            $model->village = $_POST['Purchaseinvoice']['village'];
            $model->district = $_POST['Purchaseinvoice']['district'];
            $model->state = $_POST['Purchaseinvoice']['state'];
            $model->validity_of_pass_from = $_POST['Purchaseinvoice']['validity_of_pass_from'];
            $model->validity_of_pass_to = $_POST['Purchaseinvoice']['validity_of_pass_to'];
            $model->pass_provider = $_POST['Purchaseinvoice']['pass_provider'];
        } else {
            $model->land_owner = "";
            $model->village = "";
            $model->district = "";
            $model->state = "";
            $model->validity_of_pass_from = "";
            $model->validity_of_pass_to = "";
        }
        $model->save();
    }

    public function actionSaveinvoice1() {
        $id = Yii::app()->request->getPost('id');
        $model = Purchaseinvoice::model()->findByPk($id);
        $model->attributes = $_POST['Purchaseinvoice'];
        $model->save();
        if ($model->invoice_format != $_POST['Purchaseinvoice']['invoice_format']) {
            foreach (Invoiceitemtax::model()->findAllByAttributes(array("invoice_item_id" => Yii::app()->request->getPost('id'))) as $invoice_item_tax) {
                $invoice_item_tax->delete();
            }
            foreach (Purchaseinvoiceitems::model()->findAllByAttributes(array("invoice_id" => Yii::app()->request->getPost('id'))) as $invoice_item) {
                $invoice_item->delete();
            }
        }
    }

    public function actionGetsecuritypwd() {
        Yii::app()->session['security'] = Yii::app()->request->getPost('valid_data');
        $model = Users::model()->findByAttributes(array("auth_password" => Yii::app()->request->getPost('authpwd'), "id" => Yii::app()->user->id));
        if (!empty($model)) {
            echo "1";
        } else {
            echo "Invalid Security Password !! Please try again.";
        }
    }

    public function actionGetCategoryList() {
        $list = Purchasecategory::model()->findAllByAttributes(array('type' => 'Purchase'));
        echo CJSON::encode(array('scat' => $list));
    }

    public function actionGetCategoryListChoice() {
        $type = $_GET['type'];
        $list = Purchasecategory::model()->findAllByAttributes(array('type' => $type));
        echo CJSON::encode(array('scat' => $list));
    }

    public function actionGetcategorygpu() {
        $list = Purchasecategory::model()->findAllByAttributes(array('type' => 'Processed'));
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

    public function actionGetitemdata() {
        $model = Purchaseinvoiceitems::model()->findByPk(Yii::app()->request->getParam('id'));
        $taxmodel = Invoiceitemtax::model()->findAllByAttributes(array("invoice_item_id" => Yii::app()->request->getParam('id')));
        echo CJSON::encode(array('model' => $model, 'taxmodel' => $taxmodel));
    }

    public function actionGetitemscale() {
        $model = Purchaseitem::model()->findByPk(Yii::app()->request->getParam('id'));
        echo CJSON::encode(array('scale' => $model->item_scale,
            'is_schedule' => $model->is_schedule,
            'gst_code' => $model->gst_code,
            'gst_code_type' => $model->gst_code_type,
            'gst_percent' => $model->gst_percent,
        ));
    }

    public function actionGetvendorname() {
        $model = Vendor::model()->findByPk(Yii::app()->request->getParam('id'));
        $list = Purchaseorder::model()->findAllByAttributes(array("supplier_id" => Yii::app()->request->getParam('id'), "order_status" => 'generated', "is_po_supplied" => 0));
        $this->renderPartial('_pendingpo_itemlist', array(
            'model' => $model, 'list' => $list, 'id' => Yii::app()->request->getParam('id'),
        ));
    }

    public function actionGetpoitems() {
        $cinvoice = Purchaseinvoice::model()->findByPk(Yii::app()->request->getParam('id'));
        if (empty($cinvoice->vendor_id)) {
            $vname = $cinvoice->vendor_name;
        } else {
            $vname = Vendor::model()->findByPk($cinvoice->vendor_id)->name;
        }
        $this->renderPartial('_pendingpo_items', array(
            'name' => $vname, 'id' => Yii::app()->request->getParam('id'),
        ));
    }

    public function actionUpdatepoinvoice() {
        if (!empty($_POST['poid'])) {
            foreach (Yii::app()->request->getPost('poid') as $k) {
                $cmodel = Purchaseorder::model()->findByAttributes(array("id" => $k, "is_po_supplied" => 0, "order_status" => 'generated'));
                if (!empty($cmodel)) {
                    foreach (Purchaseorderitems::model()->findAllByAttributes(array("purchase_order_id" => $cmodel->id)) as $po) {
                        $model = Purchaseorderitems::model()->findByAttributes(array("id" => $po->id));
                        if (!empty($model)) {
                            if (Yii::app()->request->getPost('is_item_supplied_' . $po->id) == "1") {
                                $model->supplier_invoice_no = Yii::app()->request->getPost('supplier_invoice_no_' . $po->id);
                            } else {
                                $model->supplier_invoice_no = "";
                            }
                            $model->is_item_supplied = Yii::app()->request->getPost('is_item_supplied_' . $po->id);
                            $model->save();
                        }
                    }
                    Purchaseorder::model()->updateByPk($cmodel->id, array("is_po_supplied" => 1));
                }
            }
            echo "1";
        }
    }

    public function actionGetItemname() {
        $model = Purchaseitem::model()->findByPk(Yii::app()->request->getParam('id'));
        echo CJSON::encode(array('itemname' => $model->itemname, 'brand' => $model->brand));
    }

    public function actionCheckmrdno() {
        $model = Purchaseinvoiceitems::model()->findByAttributes(array("mrd_no" => Yii::app()->request->getParam('mrd')));
        if (!empty($model)) {
            $msg = "1";
        } else {
            $msg = "0";
        }
        echo CJSON::encode(array('msg' => $msg));
    }

    public function actionGetList() {
        $id = Yii::app()->request->getParam('vid');
        $list = Yii::app()->db->createCommand("select vs.purchase_item_id,i.itemname,i.brand,i.item_scale from vendor_item_supply vs,purchase_item i where vs.purchase_item_id=i.id and vs.vendor_id=$id")->queryAll();
        echo CJSON::encode(array('items' => $list));
    }

    public function actionGetitemlist() {
        $list = Purchaseitem::model()->findAllByAttributes(array("is_active" => 1));
        echo CJSON::encode(array('items' => $list));
    }

    public function actionGetitemlistbycid() {
        $cid = $_GET['cid'];
        $scid = $_GET['scid'];
        $list = Purchaseitem::model()->findAllByAttributes(array("p_category_id" => $cid, "p_sub_category_id" => $scid, "is_active" => 1));
        echo CJSON::encode(array('items' => $list));
    }

    public function actionItemdelete() {
        Purchaseinvoiceitems::model()->findByPk(Yii::app()->request->getPost('id'))->delete();
    }

    public function actionDeletetax() {
        Invoicebilltax::model()->findByPk(Yii::app()->request->getPost('id'))->delete();
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->active_menu = "cps";
        $this->open_class = "invoice";
        $this->active_class = "admin";
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionGetinvoicedata() {
        $list = Purchaseinvoice::model()->findByAttributes(array('id' => Yii::app()->request->getPost('invoice_id'), 'is_reviewed' => 0));
        $this->renderPartial('_addpartial', array(
            'list' => $list,
        ));
    }

    public function actionGetinvoicebilldata() {
        $list = Purchaseinvoice::model()->findByAttributes(array('id' => Yii::app()->request->getPost('invoice_id'), 'is_reviewed' => 0));
        $this->renderPartial('_getinvoicebilldata', array(
            'list' => $list,
        ));
    }

    public function actionGetinvoicedataforreview() {
        $list = Purchaseinvoice::model()->findByAttributes(array('id' => Yii::app()->request->getParam('invoice_id'), 'is_reviewed' => 0));
        $this->renderPartial('_getinvoicedataforreview', array(
            'list' => $list,
        ));
    }

    public function actionGivereview() {
        $cinvoice = Purchaseinvoice::model()->findByPk(Yii::app()->request->getPost('invoice_id'));
        if (!empty($cinvoice)) {
            Purchaseinvoice::model()->updateByPk($cinvoice->id, array('review_point' => Yii::app()->request->getPost('review_rating'), 'review_desc' => Yii::app()->request->getPost('review_desc'), 'is_reviewed' => 1, 'is_conflict_bill_accepted' => Yii::app()->request->getPost('is_conflict_bill_accepted')));
            if (!empty($cinvoice->vendor_id)) {
                $vendor_acc = Vendor::model()->findByPk($cinvoice->vendor_id);
                if ($vendor_acc->vendor_bal == 0.00) {
                    $vendor_acc->vendor_bal = $vendor_acc->vendor_bal + $cinvoice->total_amount;
                    $vendor_acc->save();
                } else {
                    $vendor_acc->vendor_bal = $vendor_acc->vendor_bal + $cinvoice->total_amount;
                    $vendor_acc->save();
                }
            }
        }
        d21('Invoice Review done by ' . Yii::app()->user->getUsername(), "site.login");
    }

    public function actionAddtostock() {
        if (!empty($_POST['item_id'])) {
            foreach ($_POST['item_id'] as $k => $v) {
                foreach (Purchaseinvoiceitems::model()->findAllByAttributes(array("id" => $v)) as $pitem) {
                    $model1 = new Itemstock();
                    $model1->entry_type = "Invoice";
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
                    $model1->created_by = Yii::app()->user->id;
                    $model1->created_date = date('Y-m-d');
                    $model1->save();
                    Purchaseinvoiceitems::model()->updateByPk($v, array('is_added_to_stock' => 1));
                    d21('Invoice Stock updated by ' . Yii::app()->user->getUsername(), "site.login");
                    // insert record into item ledger and vendor ledger 
                    $credit_item_ledger = new Itemledger();
                    $credit_item_ledger->addCreditInLedgerFromPurchaseInvoice($pitem->item_id, 'main', $pitem->invoice_id, $pitem->stock_qty);
                }
            }
        }
        if (!empty($_POST['good_return'])) {
            foreach ($_POST['good_return'] as $gk => $gv) {
                foreach (Purchaseinvoiceitems::model()->findAllByAttributes(array("id" => $gv)) as $gitem) {
                    Purchaseinvoiceitems::model()->updateByPk($gv, array('is_good_return' => 1));
                }
            }
        }
        $comment = Yii::app()->request->getPost('invoice_comment');
        $invoice_id = Yii::app()->request->getPost('invoice_id');
        $checkpoitem = Purchaseinvoiceitems::model()->findAll(array(
            'condition' => 'invoice_id=:invoiceid and is_added_to_stock=:status OR invoice_id=:invoiceid and is_good_return = :gr',
            'params' => array(':invoiceid' => $invoice_id, ':status' => 0, ':gr' => 1),
        ));
        $checkgr = Purchaseinvoiceitems::model()->countbyAttributes(array("invoice_id" => $invoice_id, "is_good_return" => 1));
        if (count($checkpoitem) == 0 || !empty($checkgr)) {
            Purchaseinvoice::model()->updateByPk(Yii::app()->request->getPost('invoice_id'), array('comments' => $comment, 'is_added_to_stock' => 1));
        }
    }

    public function actionProcessinvoice() {
        $cinvoice = Purchaseinvoice::model()->findByPk(Yii::app()->request->getPost('invoice_id'));
        if (!empty($cinvoice)) {
            $criteria = new CDbCriteria;
            $criteria->order = "id desc";
            $mitem_amt = 0.0;
            $tshare = 0.0;
            $mtaxamt = "";
            foreach (Purchaseinvoiceitems::model()->findAllByAttributes(array("invoice_id" => $cinvoice->id, "is_reverse_item" => 0), $criteria) as $lists) {
                $mitem_amt = $mitem_amt + $lists->amount + $mtaxamt + $lists->tax_amt + $lists->cess_amt;
            }
            foreach (Invoicebilltax::model()->findAllByAttributes(array("invoice_id" => $cinvoice->id, "type" => "others")) as $itax) {
                $mtax = $mtax + $itax->tax_percent;
            }
            $round_mitem_amt = $mitem_amt + $mtax + Yii::app()->request->getPost('round_off_amount');
            Purchaseinvoice::model()->updateByPk($cinvoice->id, array('total_amount' => $round_mitem_amt, 'round_off' => Yii::app()->request->getPost('round_off_amount')));
        }
    }

    public function actionCompleteinvoice() {
        foreach (Invoicesettings::model()->findAllByAttributes(array('type' => 'bill_cost')) as $isetting) {
            if (Yii::app()->request->getPost('billcost_' . $isetting->id) > 0.0) {
                $cexistbilltax = Invoicebilltax::model()->findByAttributes(array("invoice_id" => Yii::app()->request->getPost('invoicemain_id'), "invoice_settings_id" => $isetting->id));
                if (empty($cexistbilltax)) {
                    $model = new Invoicebilltax();
                    $model->invoice_id = Yii::app()->request->getPost('invoicemain_id');
                    $model->invoice_settings_id = $isetting->id;
                    $model->label = $isetting->label;
                    $model->tax_percent = Yii::app()->request->getPost('billcost_' . $isetting->id);
                    $model->type = "others";
                    $model->save();
                } else {
                    $cexistbilltax->invoice_id = Yii::app()->request->getPost('invoicemain_id');
                    $cexistbilltax->invoice_settings_id = $isetting->id;
                    $cexistbilltax->label = $isetting->label;
                    $cexistbilltax->tax_percent = Yii::app()->request->getPost('billcost_' . $isetting->id);
                    $cexistbilltax->type = "others";
                    $cexistbilltax->save();
                }
            }
        }
        d21('Invoice Bill created by' . Yii::app()->user->getUsername(), "site.login");
    }

    public function actionAddinvoiceitem() {
        $taxable_amt = 0.0;
        $model1 = new Purchaseinvoiceitems();
        $purchase_item = Purchaseitem::model()->findByPk(Yii::app()->request->getPost('item_id'));
        //$model1->attributes = $_POST['Purchaseinvoiceitems'];
        $model1->invoice_id = Yii::app()->request->getPost('invoice_id');
        $model1->item_id = Yii::app()->request->getPost('item_id');
        $model1->goods_service = $purchase_item->goods_service;
        $model1->hsn_sac_code = Yii::app()->request->getPost('hsn_sac_code');
        $model1->vendor_hsn_sac_code = Yii::app()->request->getPost('vendor_hsn_sac_code');
        $model1->is_reverse_item = Yii::app()->request->getPost('is_reverse_item');
        $model1->vendor_tax_percent = Yii::app()->request->getPost('vendor_tax_percent');
        if ($_POST['hsn_sac_code'] != $_POST['vendor_hsn_sac_code'] || $_POST['tax_percent'] != $_POST['vendor_tax_percent']) {
            $model1->unmatched_code = 1;
        } else {
            $model1->unmatched_code = 0;
        }
        $model1->v_qty = Yii::app()->request->getPost('v_qty');
        $model1->v_scale = Yii::app()->request->getPost('v_scale');
        $model1->input_type = Yii::app()->request->getPost('input_type');
        $model1->c_unit_value = Yii::app()->request->getPost('c_unit_value');
        $model1->stock_qty = Yii::app()->request->getPost('stock_qty');
        $model1->stock_taking_scale = Yii::app()->request->getPost('stock_taking_scale');
        $model1->rate = Yii::app()->request->getPost('rate');
        $model1->is_mrd = Yii::app()->request->getPost('is_mrd');
        $model1->mrd_no = Yii::app()->request->getPost('mrd_no');
        $model1->make_date = Yii::app()->request->getPost('make_date');
        $model1->ready_date = Yii::app()->request->getPost('ready_date');
        $model1->discard_date = Yii::app()->request->getPost('discard_date');
        $model1->schedule_date = Yii::app()->request->getPost('schedule_date');
        $model1->item_tax_type = Yii::app()->request->getPost('item_tax_type');
        $model1->tax_percent_rate = Yii::app()->request->getPost('tax_percent');
        if (!empty($_POST['discount'])) {
            $actual_rate_amt = Yii::app()->request->getPost('rate') - Yii::app()->request->getPost('discount');
            $taxable_amt = $actual_rate_amt * Yii::app()->request->getPost('v_qty');
            $model1->discount = Yii::app()->request->getPost('discount');
        } else {
            $taxable_amt = Yii::app()->request->getPost('amount');
            $model1->discount = 0.0;
        }
        $model1->amount = $taxable_amt;
        /* tax amount calculation */
        if ($_POST['choice_tax'] == "1") {
            $model1->is_choice_tax = 1;
            $tax_amt = $taxable_amt * Yii::app()->request->getPost('vendor_tax_percent') / 100;
        } else {
            $model1->is_choice_tax = 0;
            $tax_amt = $taxable_amt * Yii::app()->request->getPost('tax_percent') / 100;
        }

        $cess_amt = $taxable_amt * Yii::app()->request->getPost('cess_rate') / 100;
        $model1->tax_amt = $tax_amt;
        if (!empty($_POST['cess_rate'])) {
            $model1->cess_rate = Yii::app()->request->getPost('cess_rate');
        } else {
            $model1->cess_rate = 0.0;
        }
        $model1->cess_amt = $cess_amt;
        $gst_state_codes = Gststatecodes::model()->findByAttributes(array("state_code" => Yii::app()->request->getPost('state_code'), "state_type" => 'UT'));
        if (!empty($gst_state_codes)) {
            $model1->ut_rate = Yii::app()->request->getPost('ut_rate');
            $ut_tax_amt = $taxable_amt * Yii::app()->request->getPost('ut_rate') / 100;
            $model1->ut_amt = $ut_tax_amt;
        } else {
            $model1->ut_rate = 0.00;
            $model1->ut_amt = 0.00;
        }
        $model1->particulars = Yii::app()->request->getPost('particulars');
        $model1->remarks = Yii::app()->request->getPost('remarks');
        $model1->save();
        if (!empty($model1->id)) {
            $item_model = Purchaseitem::model()->findByPk(Yii::app()->request->getPost('item_id'));
            Purchaseinvoiceitems::model()->updateByPk($model1->id, array('p_category_id' => $item_model->p_category_id, 'p_sub_category_id' => $item_model->p_sub_category_id));
        }
        d21('Invoice Item added by' . Yii::app()->user->getUsername(), "site.login");
    }

    public function actionEditinvoiceitem() {
        $taxable_amt = 0.0;
        $model1 = Purchaseinvoiceitems::model()->findByPk(Yii::app()->request->getPost('invoice_item_id'));
        if (!empty($_POST['item_id'])) {
            $purchase_item = Purchaseitem::model()->findByPk(Yii::app()->request->getPost('item_id'));
        } else {
            $purchase_item = Purchaseitem::model()->findByPk($model1->item_id);
        }
        if (!empty($model1)) {
            $model1->invoice_id = Yii::app()->request->getPost('invoice_id');
            if (!empty($_POST['item_id'])) {
                $model1->item_id = Yii::app()->request->getPost('item_id');
            } else {
                $model1->item_id = $purchase_item->id;
            }
            $model1->goods_service = $purchase_item->goods_service;
            $model1->hsn_sac_code = Yii::app()->request->getPost('hsn_sac_code');
            $model1->vendor_hsn_sac_code = Yii::app()->request->getPost('vendor_hsn_sac_code');
            $model1->vendor_tax_percent = Yii::app()->request->getPost('vendor_tax_percent');
            if ($_POST['hsn_sac_code'] != $_POST['vendor_hsn_sac_code'] || $_POST['tax_percent'] != $_POST['vendor_tax_percent']) {
                $model1->unmatched_code = 1;
            } else {
                $model1->unmatched_code = 0;
            }
            $model1->v_qty = Yii::app()->request->getPost('v_qty');
            $model1->v_scale = Yii::app()->request->getPost('v_scale');
            $model1->input_type = Yii::app()->request->getPost('input_type');
            $model1->c_unit_value = Yii::app()->request->getPost('c_unit_value');
            $model1->stock_qty = Yii::app()->request->getPost('stock_qty');
            $model1->stock_taking_scale = Yii::app()->request->getPost('stock_taking_scale');
            $model1->rate = Yii::app()->request->getPost('rate');
            $model1->item_tax_type = Yii::app()->request->getPost('item_tax_type');
            $model1->tax_percent_rate = Yii::app()->request->getPost('tax_percent');
            if (!empty($_POST['discount'])) {
                $actual_rate_amt = Yii::app()->request->getPost('rate') - Yii::app()->request->getPost('discount');
                $taxable_amt = $actual_rate_amt * Yii::app()->request->getPost('v_qty');
                $model1->discount = Yii::app()->request->getPost('discount');
            } else {
                $taxable_amt = Yii::app()->request->getPost('amount');
                $model1->discount = 0.0;
            }
            $model1->amount = $taxable_amt;
            $model1->is_mrd = Yii::app()->request->getPost('is_mrd');
            $model1->mrd_no = Yii::app()->request->getPost('mrd_no');
            $model1->make_date = Yii::app()->request->getPost('make_date');
            $model1->ready_date = Yii::app()->request->getPost('ready_date');
            $model1->discard_date = Yii::app()->request->getPost('discard_date');
            $model1->schedule_date = Yii::app()->request->getPost('schedule_date');

            /* tax amount calculation */
            if ($_POST['choice_tax'] == 1) {
                $model1->is_choice_tax = 1;
                $tax_amt = $taxable_amt * Yii::app()->request->getPost('vendor_tax_percent') / 100;
            } else {
                $model1->is_choice_tax = 0;
                $tax_amt = $taxable_amt * Yii::app()->request->getPost('tax_percent') / 100;
            }
            $cess_amt = $taxable_amt * Yii::app()->request->getPost('cess_rate') / 100;
            $model1->tax_amt = $tax_amt;
            if (!empty($_POST['cess_rate'])) {
                $model1->cess_rate = Yii::app()->request->getPost('cess_rate');
            } else {
                $model1->cess_rate = 0.0;
            }
            $model1->cess_amt = $cess_amt;
            $gst_state_codes = Gststatecodes::model()->findByAttributes(array("state_code" => Yii::app()->request->getPost('state_code'), "state_type" => 'UT'));
            if (!empty($gst_state_codes)) {
                $model1->ut_rate = Yii::app()->request->getPost('ut_rate');
                $ut_tax_amt = $taxable_amt * Yii::app()->request->getPost('ut_rate') / 100;
                $model1->ut_amt = $ut_tax_amt;
            } else {
                $model1->ut_rate = 0.00;
                $model1->ut_amt = 0.00;
            }
            $model1->particulars = Yii::app()->request->getPost('particulars');
            $model1->remarks = Yii::app()->request->getPost('remarks');
            $model1->save();

            Purchaseinvoiceitems::model()->updateByPk($model1->id, array('p_category_id' => $purchase_item->p_category_id, 'p_sub_category_id' => $purchase_item->p_sub_category_id));

            d21('Invoice Item Edit by ' . Yii::app()->user->getUsername(), "site.login");
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $this->active_menu = "cps";
        $this->open_class = "invoice";
        $this->active_class = "admin";
        $imodel = Purchaseinvoice::model()->findByPk(Yii::app()->request->getParam('id'));
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
        $this->active_menu = "cps";
        $this->open_class = "invoice";
        $this->active_class = "admin";
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
        $model = new Purchaseinvoice();
        // $model->unsetAttributes();  // clear any default values
        //if (isset($_GET['Purchaseinvoice'])) {
        $model->attributes = $_GET['Purchaseinvoice'];
        $criteria = new CDbCriteria;
        $criteria->order = 'id desc';
        $criteria->compare('invoice_type', $_GET['Purchaseinvoice']['invoice_type']);
        $criteria->compare('invoice_no', $_GET['Purchaseinvoice']['invoice_no']);
        $criteria->compare('invoice_date', $_GET['Purchaseinvoice']['invoice_date']);
        $criteria->compare('vendor_id', $_GET['Purchaseinvoice']['vendor_id']);
        $criteria->compare('received_by', $_GET['Purchaseinvoice']['received_by']);
        $pages = new CPagination(Purchaseinvoice::model()->count($criteria));
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
        $list = Purchaseinvoice::model()->findAll($criteria);
        //}
        if (isset($_POST['Purchaseinvoice'])) {
            $model->attributes = $_POST['Purchaseinvoice'];
            $model->vendor_name = $_POST['Purchaseinvoice']['vendor_name'];
            if (empty($_POST['Purchaseinvoice']['gstin_no'])) {
                $model->is_gstn_compliant = 1;
            }
            if ($_POST['is_gstn_compliant'] == "1") {
                $model->is_gstn_compliant = $_POST['is_gstn_compliant'];
                $model->compliants_category_id = $_POST['Purchaseinvoice']['compliants_category_id'];
            } else {
                $model->is_gstn_compliant = $_POST['is_gstn_compliant'];
                $model->compliants_category_id = "";
            }
            if ($_POST['place_of_supply'] == "1") {
                $model->place_of_supply = $_POST['place_of_supply'];
                $model->state_code = $_POST['Purchaseinvoice']['state_code'];
            } else {
                $model->place_of_supply = $_POST['place_of_supply'];
                $model->state_code = 23;
            }
            if ($model->invoice_type == "cash") {
                $model->land_owner = $_POST['Purchaseinvoice']['land_owner'];
                $model->village = $_POST['Purchaseinvoice']['village'];
                $model->district = $_POST['Purchaseinvoice']['district'];
                $model->state = $_POST['Purchaseinvoice']['state'];
                $model->validity_of_pass_from = $_POST['Purchaseinvoice']['validity_of_pass_from'];
                $model->validity_of_pass_to = $_POST['Purchaseinvoice']['validity_of_pass_to'];
                $model->pass_provider = $_POST['Purchaseinvoice']['pass_provider'];
            } else {
                $model->land_owner = "";
                $model->village = "";
                $model->district = "";
                $model->state = "";
                $model->validity_of_pass_from = "";
                $model->validity_of_pass_to = "";
            }
            $model->is_added_to_stock = 0;
            $model->is_reviewed = 0;
            $model->created_by = Yii::app()->user->id;
            $model->created_date = date('Y-m-d');
            $model->invoice_format = 'F1';
//            print_r($model->attributes);
//            exit();
            if ($model->save()) {
                d21('Invoice added by ' . Yii::app()->user->getUsername(), "site.login");
                Yii::app()->user->setFlash('pitem', 'Purchase Invoice Added successfully');
                $this->redirect(array('admin'));
            }
        }
        $this->render('admin', array('list' => $list, 'pages' => $pages, 'model' => $model));
//        $this->render('admin', array(
//            'model' => $model,
//        ));
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
