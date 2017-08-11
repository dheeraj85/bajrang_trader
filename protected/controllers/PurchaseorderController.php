<?php

class PurchaseorderController extends Controller {

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
                'actions' => array('create', 'update', 'admin', 'getitems', 'getSupplier', 'getpoitems', 'porderevaluate',
                    'deleteitem', 'review', 'orderupdate', 'printpo', 'cancelpo', 'authreview', 'getsecuritypwd'),
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
    public function actionGetSupplier() {
        $itemid = Yii::app()->request->getParam('itemid');
        $l = array('id' => '');
        $list = Yii::app()->db->createCommand("select v.id,v.name,v.firm_name from vendor v,vendor_item_supply vs where vs.vendor_id=v.id and vs.purchase_item_id=$itemid")->queryAll();
        if (!empty($list)) {
            echo CJSON::encode(array('items' => $list, 'item' => $l));
        } else {
            $l = array('id' => '1', 'name' => 'Open Market');
            echo CJSON::encode(array('item' => $l));
        }
    }

    public function actionDeleteitem() {
        $pmodel = Purchaseindent::model()->findByAttributes(array("item_id" => Yii::app()->request->getPost('item_id'), "is_done" => 1));
        Purchaseindent::model()->updateByPk($pmodel->id, array("is_done" => 0));
        Purchaseorderitems::model()->findByPk(Yii::app()->request->getPost('id'))->delete();
    }

    public function actionCancelpo() {
        $id = Yii::app()->request->getParam('id');
        Purchaseorder::model()->updateByPk($id, array("order_status" => 'cancel'));
        $this->redirect(array('purchaseorder/admin'));
    }

    public function actionAuthreview() {
        $id = $_GET['sync_id'];
        $url = $_GET['url'];
        $this->renderPartial('//layouts/_authreview', array('id' => $id, 'url' => $url));
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

    public function actionPrintpo() {
        $this->active_menu = "cps";
        $this->open_class = "ps";
        $this->active_class = "generatepo";
        $model = Purchaseorder::model()->findByPk(Yii::app()->request->getParam('id'));
        $id = Yii::app()->request->getParam('id');
        $this->render('print', array(
            'data' => $model, 'id' => $id
        ));
    }

    public function actionReview() {
        if (empty(Yii::app()->session['security'])) {
            $this->redirect(array("site/unauthorize"));
        }
        $this->active_menu = "cps";
        $this->open_class = "inventory";
        $this->active_class = "generatepo";
        $model = Purchaseorder::model()->findByPk(Yii::app()->request->getParam('id'));
        $ilist = Purchaseorderitems::model()->findAllByAttributes(array("purchase_order_id" => $model->id));
        d21('Purchase order review by ' . Yii::app()->user->getUsername(), "site.login");
        $this->render('review', array(
            'model' => $model, 'id' => Yii::app()->request->getParam('id'), 'ilist' => $ilist
        ));
    }

    public function actionOrderupdate() {
        $id = Yii::app()->request->getPost('purchase_order_id');
        if (Yii::app()->request->getPost('generateorder')) {
            $ilist = Purchaseorderitems::model()->findAllByAttributes(array("purchase_order_id" => $id));
            foreach ($ilist as $vs) {
                $cmodel = Purchaseorderitems::model()->findByAttributes(array("id" => $vs->id));
                $cmodel->qty_req = Yii::app()->request->getPost('qty_req_' . $vs->id);
                $cmodel->req_date = Yii::app()->request->getPost('req_date_' . $vs->id);
                $cmodel->save();
            }
            Purchaseorder::model()->updateByPk($id, array("order_status" => "generated", "order_date" => date('Y-m-d')));
            $porder = Purchaseorder::model()->findByPk($id);
            $venderdetails = Vendor::model()->findByPk($porder->supplier_id);
            $msg = "Dear " . $venderdetails->firm_name . " Order No:(" . $porder->order_no . ") processed on date :" . date("d-m-Y", strtotime($porder->order_date)) . " Please Check your registered E-mail address for PO details.";
            SendSms::send($msg, $venderdetails->mobile);
            $podetails = Purchaseorderitems::model()->findAllByAttributes(array("purchase_order_id" => $id));
            if (!empty($venderdetails->email)) {
                //Sendemail::SendPurchaseOrderdetails($porder->order_no,$venderdetails->email,$venderdetails->name,$podetails);
                d21('Purchase Order updated by ' . Yii::app()->user->getUsername(), "site.login");
            } else {
                $msg = "emailnotexist";
            }
            $this->redirect(array('purchaseorder/admin', 'msg' => $msg));
        }
        $this->render('itemevaluate');
    }

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionPorderevaluate() {
        $sid = Yii::app()->request->getPost('supplier_id');
        $pcimodel = Purchaseorder::model()->findBySql("select * from purchase_order where supplier_id=$sid and order_status='pending' order by id desc limit 1");
        if (empty($pcimodel)) {
            $pmodel = new Purchaseorder();
            $pmodel->supplier_id = $sid;
            $pmodel->order_status = 'pending';
            if ($sid == 1) {
                $pmodel->po_type = 'openmarket';
            } else {
                $pmodel->po_type = 'supplier';
            }
            $pmodel->created_by = Yii::app()->user->id;
            $pmodel->save();
            if ($sid == 1) {
                $pmodel->order_no = 'OPO-' . $pmodel->id;
            } else {
                $pmodel->order_no = 'PO-' . $pmodel->id;
            }
            $pmodel->save();
        }
        $poid = isset($pmodel->id) ? $pmodel->id : $pcimodel->id;
        if (!empty($_POST['itemid'])) {
            $dmodel = Purchaseorderitems::model()->findByAttributes(array("purchase_order_id" => $poid, "item_id" => Yii::app()->request->getPost('itemid')));
            $cmodel = Purchaseindent::model()->findByAttributes(array("indent_id" => Yii::app()->request->getPost('indent_item_id_val'), "item_id" => Yii::app()->request->getPost('itemid')));
            if (empty($dmodel)) {
                $model = new Purchaseorderitems();
                $model->purchase_order_id = isset($pmodel->id) ? $pmodel->id : $pcimodel->id;
                $model->item_id = Yii::app()->request->getPost('itemid');
                $model->item_name = $cmodel->item_name;
                $model->item_brand = $cmodel->item_brand;
                $model->qty_req = $cmodel->qty_req;
                $model->qty_scale = $cmodel->qty_scale;
                $model->req_date = $cmodel->req_date;
                $model->save();
            }
            Purchaseindent::model()->updateByPk($cmodel->id, array("is_done" => 1));
            d21('Purchase Order added by ' . Yii::app()->user->getUsername(), "site.login");
        }
        echo "1";
    }

    public function actionGetitems() {
        $id = Yii::app()->request->getPost('id');
        $list = Purchaseindent::model()->findAllByAttributes(array("indent_id" => $id, "is_done" => 0));
        $this->renderPartial('_indent_item_list', array(
            'list' => $list,
        ));
    }

    public function actionGetpoitems() {
        $id = Yii::app()->request->getPost('id');
        $list = Purchaseorder::model()->findByAttributes(array("supplier_id" => $id, "order_status" => 'pending'));
        $this->renderPartial('_polist', array(
            'list' => $list,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $this->active_menu = "cps";
        $this->open_class = "inventory";
        $this->active_class = "generatepo";
        $model = new Purchaseorder;
        if (isset($_POST['Purchaseorder'])) {
            $model->attributes = $_POST['Purchaseorder'];
            $model->state_code = $_POST['Purchaseorder']['state_code'];
            $model->place = Gststatecodes::model()->findByAttributes(array("state_code" => $_POST['Purchaseorder']['state_code']))->state_name;
            $model->order_status = 'pending';
            if ($model->save())
                $this->redirect(array('admin'));
        }
        $this->render('create', array(
            'model' => $model
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $this->active_menu = "cps";
        $this->open_class = "inventory";
        $this->active_class = "generatepo";
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Purchaseorder'])) {
            $model->attributes = $_POST['Purchaseorder'];
            $model->state_code = $_POST['Purchaseorder']['state_code'];
            $model->place = Gststatecodes::model()->findByAttributes(array("state_code" => $_POST['Purchaseorder']['state_code']))->state_name;
            if ($model->save())
                $this->redirect(array('admin'));
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
        // throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Purchaseorder');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->active_menu = "cps";
        $this->open_class = "ps";
        $this->active_class = "generatepo";
        $model = new Purchaseorder('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Purchaseorder']))
            $model->attributes = $_GET['Purchaseorder'];
        d21('Purchase Order viewed by ' . Yii::app()->user->getUsername(), "site.login");
        if (!empty($_GET['msg'])) {
            $msg = "<div class='alert alert-danger'>Email Address does'nt exist for this vendor,share PO details by other means.</div>";
        }
        $this->render('admin', array(
            'model' => $model, 'msg' => $msg,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Purchaseorder the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Purchaseorder::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Purchaseorder $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'purchaseorder-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
