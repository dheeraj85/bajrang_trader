<?php

class ExpenseinvoiceController extends Controller {

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
                'actions' => array('create', 'update', 'admin', 'invoice', 'getList', 'getitemscale', 'checkmrdno', 'getinvoicedataforreview', 'deletetax', 'joinpoinvoice',
                    'processinvoice', 'getitemdata', 'getScale', 'getItype', 'getCategoryList', 'getcategorygpu', 'getMrd', 'editinvoiceitem', 'getItemname', 'getvendorname', 'updatepoinvoice',
                    'addinvoiceitem', 'getinvoicedata', 'itemdelete', 'getitemlist', 'completeinvoice', 'givereview', 'addtostock', 'getinvoicebilldata', 'index', 'getvendor_gstnno',
                    'authreview', 'getsecuritypwd', 'getCategoryListChoice', 'getpoitems', 'getitemlistbycid', 'getinvoice', 'saveinvoice', 'getitems'),
                'users' => array('@'),
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

    public function actionGetitemdata() {
        $model = Expenseinvoiceitems::model()->findByPk(Yii::app()->request->getParam('id'));
        echo CJSON::encode(array('model' => $model));
    }

    public function actionGetitems() {
        $model = Expensemaster::model()->findByPk(Yii::app()->request->getParam('id'));
        echo CJSON::encode(array('items' => $model));
    }

    public function actionGetvendor_gstnno() {
        $model = Expenseaccount::model()->findByPk(Yii::app()->request->getParam('id'));
        if (!empty($model->gstin_no)) {
            echo $model->gstin_no;
        }
    }

    public function actionAuthreview() {
        $id = Yii::app()->request->getParam('id');
        $this->renderPartial('_authreview', array('id' => $id));
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

    public function actionGetList() {
        $id = Yii::app()->request->getParam('vid');
        $list = Yii::app()->db->createCommand("select vs.purchase_item_id,i.itemname,i.brand,i.item_scale from vendor_item_supply vs,purchase_item i where vs.purchase_item_id=i.id and vs.vendor_id=$id")->queryAll();
        echo CJSON::encode(array('items' => $list));
    }

    public function actionGetitemlist() {
        $list = Expensemaster::model()->findAll();
        echo CJSON::encode(array('items' => $list));
    }

    public function actionGetItemname() {
        $model = Expensemaster::model()->findByPk(Yii::app()->request->getParam('id'));
        echo CJSON::encode(array('itemname' => $model->gs_name));
    }

    public function actionItemdelete() {
        Expenseinvoiceitems::model()->findByPk(Yii::app()->request->getPost('id'))->delete();
    }

    public function actionGetinvoicedata() {
        $list = Expenseinvoice::model()->findByAttributes(array('id' => Yii::app()->request->getPost('invoice_id'), 'is_reviewed' => 0));
        $this->renderPartial('_addpartial', array(
            'list' => $list,
        ));
    }

    public function actionGetinvoicebilldata() {
        $list = Expenseinvoice::model()->findByAttributes(array('id' => Yii::app()->request->getPost('invoice_id'), 'is_reviewed' => 0));
        $this->renderPartial('_addbilltotal', array(
            'list' => $list,
        ));
    }

    public function actionGetinvoicedataforreview() {
        $list = Expenseinvoice::model()->findByAttributes(array('id' => Yii::app()->request->getParam('invoice_id'), 'is_reviewed' => 0));
        $this->renderPartial('_getinvoicedataforreview', array(
            'list' => $list,
        ));
    }

    public function actionGivereview() {
        $cinvoice = Expenseinvoice::model()->findByPk(Yii::app()->request->getPost('invoice_id'));
        if (!empty($cinvoice)) {
            Expenseinvoice::model()->updateByPk($cinvoice->id, array('review_point' => Yii::app()->request->getPost('review_rating'), 'review_desc' => Yii::app()->request->getPost('review_desc'), 'is_reviewed' => 1, 'is_conflict_bill_accepted' => Yii::app()->request->getPost('is_conflict_bill_accepted')));
            if (!empty($cinvoice->vendor_id)) {
                $vendor_acc = Expenseaccount::model()->findByPk($cinvoice->vendor_id);
                if ($vendor_acc->exp_bal == 0.00) {
                    $vendor_acc->exp_bal = $vendor_acc->exp_bal + $cinvoice->total_amount;
                    $vendor_acc->save();
                } else {
                    $vendor_acc->exp_bal = $vendor_acc->exp_bal + $cinvoice->total_amount;
                    $vendor_acc->save();
                }
            }
        }
        d21('Invoice Review done by ' . Yii::app()->user->getUsername(), "site.login");
    }

    public function actionProcessinvoice() {
        $cinvoice = Expenseinvoice::model()->findByPk(Yii::app()->request->getPost('invoice_id'));
        if (!empty($cinvoice)) {
            $criteria = new CDbCriteria;
            $criteria->order = "id desc";
            $mitem_amt = 0.0;
            foreach (Expenseinvoiceitems::model()->findAllByAttributes(array("invoice_id" => $cinvoice->id), $criteria) as $lists) {
                if ($lists->is_reverse_item == "1") {
                    $mitem_amt = $mitem_amt + $lists->amount;
                } else {
                    $mitem_amt = $mitem_amt + $lists->amount + $lists->tax_amt + $lists->cess_amt;
                }
            }
            $round_mitem_amt = $mitem_amt + Yii::app()->request->getPost('round_off_amount');
            Expenseinvoice::model()->updateByPk($cinvoice->id, array('total_amount' => $round_mitem_amt, 'round_off' => Yii::app()->request->getPost('round_off_amount')));
        }
    }

    public function actionAddinvoiceitem() {
        $taxable_amt = 0.0;
        $model1 = new Expenseinvoiceitems();
        $purchase_item = Expensemaster::model()->findByPk(Yii::app()->request->getPost('item_id'));
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

        $model1->item_tax_type = Yii::app()->request->getPost('item_tax_type');
        $model1->tax_percent_rate = Yii::app()->request->getPost('tax_percent');
        if (!empty($_POST['discount'])) {
            $taxable_amt = Yii::app()->request->getPost('amount') - Yii::app()->request->getPost('discount');
            $model1->discount = Yii::app()->request->getPost('discount');
        } else {
            $taxable_amt = Yii::app()->request->getPost('amount');
            $model1->discount = 0.0;
        }
        $model1->amount = $taxable_amt;
        /* tax amount calculation */
        if ($_POST['choice_tax'] == 1) {
            $model1->is_choice_tax = 1;
            $tax_amt = $taxable_amt * Yii::app()->request->getPost('vendor_tax_percent') / 100;
        } else {
            $model1->is_choice_tax = 0;
            $tax_amt = $taxable_amt * Yii::app()->request->getPost('tax_percent') / 100;
        }

        $cess_amt = $taxable_amt * Yii::app()->request->getPost('cess_rate') / 100;
        if ($_POST['is_reverse_item'] == 1) {
            $model1->reverse_percent_rate = Yii::app()->request->getPost('tax_percent');
            $model1->reverse_amt = $tax_amt;
            $model1->tax_amt = 0.0;
        } else {
            $model1->tax_amt = $tax_amt;
            $model1->reverse_percent_rate = 0.0;
            $model1->reverse_amt = 0.0;
        }
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
        $model1->save();
        d21('Invoice Item added by' . Yii::app()->user->getUsername(), "site.login");
    }

    public function actionEditinvoiceitem() {
        $taxable_amt = 0.0;
        $model1 = Expenseinvoiceitems::model()->findByPk(Yii::app()->request->getPost('invoice_item_id'));
        if (!empty($_POST['item_id'])) {
            $purchase_item = Expensemaster::model()->findByPk(Yii::app()->request->getPost('item_id'));
        } else {
            $purchase_item = Expensemaster::model()->findByPk($model1->item_id);
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
            $model1->item_tax_type = Yii::app()->request->getPost('item_tax_type');
            $model1->tax_percent_rate = Yii::app()->request->getPost('tax_percent');
            if (!empty($_POST['discount'])) {
                $taxable_amt = Yii::app()->request->getPost('amount') - Yii::app()->request->getPost('discount');
                $model1->discount = Yii::app()->request->getPost('discount');
            } else {
                $taxable_amt = Yii::app()->request->getPost('amount');
                $model1->discount = 0.0;
            }
            $model1->amount = $taxable_amt;

            /* tax amount calculation */
            if ($_POST['choice_tax'] == 1) {
                $model1->is_choice_tax = 1;
                $tax_amt = $taxable_amt * Yii::app()->request->getPost('vendor_tax_percent') / 100;
            } else {
                $model1->is_choice_tax = 0;
                $tax_amt = $taxable_amt * Yii::app()->request->getPost('tax_percent') / 100;
            }
            $cess_amt = $taxable_amt * Yii::app()->request->getPost('cess_rate') / 100;
            if ($_POST['is_reverse_item'] == "1") {
                $model1->reverse_percent_rate = Yii::app()->request->getPost('tax_percent');
                $model1->reverse_amt = $tax_amt;
                $model1->tax_amt = 0.0;
            } else {
                $model1->tax_amt = $tax_amt;
                $model1->reverse_percent_rate = 0.0;
                $model1->reverse_amt = 0.0;
            }
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
            $model1->save();

            d21('Invoice Item Edit by ' . Yii::app()->user->getUsername(), "site.login");
        }
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
        $this->active_menu = "exps";
        $this->open_class = "exps";
        $this->active_class = "expinvoice";
        $imodel = Expenseinvoice::model()->findByPk(Yii::app()->request->getParam('id'));
        $model = new Expenseinvoiceitems();
        if (isset($_POST['Expenseinvoice'])) {
            
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

        if (isset($_POST['Expenseinvoice'])) {
            $model->attributes = $_POST['Expenseinvoice'];
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
        //  if (Yii::app()->request->isPostRequest) {
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
        $dataProvider = new CActiveDataProvider('Expenseinvoice');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $this->active_menu = "exps";
        $this->open_class = "exps";
        $this->active_class = "expinvoice";
        $model = new Expenseinvoice();
        // $model->unsetAttributes();  // clear any default values
        //if (isset($_GET['Expenseinvoice'])) {
        $model->attributes = $_GET['Expenseinvoice'];
        $criteria = new CDbCriteria;
        $criteria->order = 'id desc';
        $criteria->compare('invoice_type', $_GET['Expenseinvoice']['invoice_type']);
        $criteria->compare('invoice_no', $_GET['Expenseinvoice']['invoice_no']);
        $criteria->compare('invoice_date', $_GET['Expenseinvoice']['invoice_date']);
        $criteria->compare('vendor_id', $_GET['Expenseinvoice']['vendor_id']);
        $criteria->compare('received_by', $_GET['Expenseinvoice']['received_by']);
        $pages = new CPagination(Expenseinvoice::model()->count($criteria));
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
        $list = Expenseinvoice::model()->findAll($criteria);
        //}
        if (isset($_POST['Expenseinvoice'])) {
            $model->attributes = $_POST['Expenseinvoice'];
            $model->vendor_name = $_POST['Expenseinvoice']['vendor_name'];
            if (empty($_POST['Expenseinvoice']['gstin_no'])) {
                $model->is_gstn_compliant = 1;
            }
            if ($_POST['is_gstn_compliant'] == "1") {
                $model->is_gstn_compliant = $_POST['is_gstn_compliant'];
                $model->compliants_category = $_POST['Expenseinvoice']['compliants_category_id'];
            } else {
                $model->is_gstn_compliant = $_POST['is_gstn_compliant'];
                $model->compliants_category = "";
            }
            if ($_POST['place_of_supply'] == "1") {
                $model->place_of_supply = $_POST['place_of_supply'];
                $model->state_code = $_POST['Expenseinvoice']['state_code'];
            } else {
                $model->place_of_supply = $_POST['place_of_supply'];
                $model->state_code = 0;
            }
            $model->is_added_to_stock = 0;
            $model->is_reviewed = 0;
            $model->created_by = Yii::app()->user->id;
            $model->created_date = date('Y-m-d');
//            print_r($model->attributes);
//            exit();
            if ($model->save()) {
                d21('Invoice added by ' . Yii::app()->user->getUsername(), "site.login");
                Yii::app()->user->setFlash('pitem', 'Expense Invoice Added successfully');
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
     * @return Expenseinvoice the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Expenseinvoice::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Expenseinvoice $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'expenseinvoice-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
