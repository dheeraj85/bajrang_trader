<?php

class PositemoffersController extends Controller {

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
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('contravoucher', 'saveclosing', 'create', 'update', 'getscategory', 'getitem', 'counter',
                    'countervalidation', 'counteropening', 'counterclosing', 'closing','debitdetails'),
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

    public function actionContravoucher() {
        $date = $_POST['date'];
        $this->renderPartial('_contra_voucher', array(
            'date' => $date,
        ));
    }
    public function actionDebitdetails() {
        $date = $_GET['date'];
        $counter_id = $_GET['counter_id'];
        $vtype = $_GET['vtype'];
        $list=Yii::app()->db->createCommand("select v.*,vt.voucher_name,c.counter_name from voucher v,voucher_type vt,cash_counter c where v.voucher_type_id=vt.id and vt.voucher_nature='debit' and v.dated='$date' and v.voucher_type_id=$vtype and v.counter_id=c.id")->queryAll();
        $this->renderPartial('_debitdetails', array(
            'date' => $date,'counter_id'=>$counter_id,'vtype'=>$vtype,'list'=>$list
        ));
    }

    public function actionSaveclosing() {
        $user = Users::model()->findByAttributes(array('role' => 'sa'));
        $check = Cashdrawer::model()->findByAttributes(array('counter_id' => $_POST['counter_id'], 'date' => $_POST['date'], 'txn_type' => 'closing'));
        if (!empty($check)) {
            echo '0';
        } else if (empty($check)) {
            $model1 = new Cashdrawer();
            $model1->counter_id = $_POST['counter_id'];
            $model1->user_id = Yii::app()->user->id;
            $model1->txn_type = 'closing';
            $model1->date = $_POST['date'];
            $model1->cash = $_POST['closing'];
            $model1->final_closing = $_POST['grand_closing'];
            if ($model1->save()) {
                $check_contra = Contraclosing::model()->findByAttributes(array('dated' => $_POST['date']));
                if (!empty($check_contra)) {
                    $amt = $check_contra->amount + $model1->final_closing;
                    $check_contra->amount = $amt;
                    if ($check_contra->update()) {
                        echo '1';
                    }
                } else {
                    $contra = new Contraclosing();
                    $contra->amount = $model1->final_closing;
                    $contra->dated = $_POST['date'];
                    $contra->time = date('h:m:s');
                    if ($contra->save()) {
                        echo '1';
                    }
                }
//        $model1->user_from = Yii::app()->user->id;
//        $model1->user_to = $user->id;
//            $this->renderPartial('_contra_voucher', array(
//                'date' => $model1->date,
//            ));
            }
        }
    }

    public function actionClosing() {
        $date = $_POST['date'];
        $str_date = strtotime($date);
        $cid = $_POST['cid'];
        $drawer = Cashdrawer::model()->findByAttributes(array('counter_id' => $cid, 'date' => $date, 'txn_type' => 'opening'));
        $voucher = Voucher::model()->findAllByAttributes(array('counter_id' => $cid, 'dated' => $date));
        $cake_adv = Cakeorder::model()->findAllByAttributes(array('picked_counter_id' => $cid, 'order_date' => $str_date));
        $cake_payment = Cakeorder::model()->findAllBySql("select * from cake_order where picked_counter_id=$cid and order_date='$str_date'");
        $ots = Offshelfsale::model()->findAllBySql("select * from off_shelf_sale where counter_id=$cid and txn_type='cash' and order_date='$date'");
        $menu = Menusale::model()->findAllBySql("select * from menu_sale where counter_id=$cid and txn_type='cash' and order_date='$date'");
        $this->renderPartial('_closing', array(
            'date' => $date,
            'drawer' => $drawer,
            'voucher' => $voucher,
            'cake_adv' => $cake_adv,
            'cake_payment' => $cake_payment,
            'ots' => $ots,
            'menu' => $menu,
            'cid'=>$cid,
        ));
    }

    public function actionCounterclosing() {
        $this->active_menu = "pos";
        $this->open_class = "menu";
        $this->active_class = "pos_closing_counters";
        $this->render('counter_closing');
    }

    public function actionCounteropening() {
        $counter_id = $_POST['Cashdrawer']['counter_id'];
        $opening = Cashdrawer::model()->findBySql("select * from cash_drawer where counter_id=$counter_id and txn_type!='handover' order by id desc limit 1");
        if ($opening->txn_type == 'opening') {
            echo '';
        } else if ($opening->txn_type == 'closing') {
            echo $opening->cash;
        } else {
            echo '';
        }
    }

    public function actionCountervalidation() {
        $model = new Cashdrawer();
        $model->attributes = $_POST['Cashdrawer'];
        if ($model->txn_type == 'opening') {
            $check_opening = Cashdrawer::model()->findByAttributes(array('counter_id' => $model->counter_id, 'txn_type' => 'opening', 'date' => $model->date));
            if (empty($check_opening)) {
                echo '';
                exit();
            } else if (!empty($check_opening)) {
                echo '<h4 class="alert alert-danger" style="text-align: center;color: black;">Same Date Multiple Entries are Not Allowed</h4>';
                exit();
            }
        } else if ($model->txn_type == 'closing') {
            $check_closing = Cashdrawer::model()->findByAttributes(array('counter_id' => $model->counter_id, 'txn_type' => 'closing', 'date' => $model->date));
            if (empty($check_closing)) {
                echo '';
                exit();
            } else if (!empty($check_closing)) {
                echo '<h4 class="alert alert-danger" style="text-align: center;color: black;">Same Date Multiple Entries are Not Allowed</h4>';
                exit();
            }
        }
    }

    public function actionCounter() {
        $this->active_menu = "pos";
        $this->open_class = "menu";
        $this->active_class = "pos_counters";
        $model = new Cashdrawer();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Cashdrawer'])) {
            $model->attributes = $_POST['Cashdrawer'];
            $model->user_id = Yii::app()->user->id;
            $model->user_from = Yii::app()->user->id;
            if ($model->save()) {
                if ($model->txn_type = 'opening') {
                    $model1 = new Cashdrawer();
                    $model1->attributes = $model->attributes;
                    $model1->txn_type = 'handover';
                    $model1->user_from = Yii::app()->user->id;
                    $model1->user_to = $model->user_to;
                    $model1->save();
                }
                d21('POS counter managed by ' . Yii::app()->user->getUsername(), "site.login");
                $this->redirect(array('counter'));
            }
        }

        $this->render('counter', array(
            'model' => $model,
        ));
    }

    public function actionGetscategory() {
        $cid = Yii::app()->request->getParam('cid');
        ?>
        <option value="">--Select Sub Category--</option>
        <?php
        foreach (Shelfitems::model()->findAllBySql("select * from shelf_items where p_category_id=$cid group by p_sub_category_id") as $scat) {
            ?>
            <option value="<?php echo $scat->p_sub_category_id; ?>"><?php echo Purchasesubcategory::model()->findByPk($scat->p_sub_category_id)->name; ?></option>
            <?php
        }
    }

    public function actionGetitem() {
        $cid = Yii::app()->request->getParam('cid');
        $scid = Yii::app()->request->getParam('scid');
        $list = Shelfitems::model()->findAllByAttributes(array('p_category_id' => $cid, 'p_sub_category_id' => $scid));
        $listdata = array();
        foreach ($list as $l) {
            $data['id'] = $l->id;
            $data['itemname'] = trim(Purchaseitem::model()->findByPk($l->item_id)->itemname);
            $listdata[] = $data;
        }
        echo CJSON::encode(array('items' => $listdata));
        exit();
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->active_menu = "pos";
        $this->open_class = "menu";
        $this->active_class = "pos_item_offers";
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $this->active_menu = "pos";
        $this->open_class = "menu";
        $this->active_class = "pos_item_offers";
        $model = new Positemoffers;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Positemoffers'])) {
            $model->attributes = $_POST['Positemoffers'];
            $model->offer_code = $_POST['Positemoffers']['offer_code'];
            $model->status = 'active';
            if ($model->save()) {
                d21('POS Item offers added by ' . Yii::app()->user->getUsername(), "site.login");
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
        $this->active_menu = "pos";
        $this->open_class = "menu";
        $this->active_class = "pos_item_offers";
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Positemoffers'])) {
            $model->attributes = $_POST['Positemoffers'];
            $model->offer_code = $_POST['Positemoffers']['offer_code'];
            if ($model->save()) {
                d21('POS Item offers Updated by ' . Yii::app()->user->getUsername(), "site.login");
                $this->redirect(array('create'));
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
        $this->active_menu = "pos";
        $this->open_class = "menu";
        $this->active_class = "pos";
        $dataProvider = new CActiveDataProvider('Positemoffers');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->active_menu = "pos";
        $this->open_class = "menu";
        $this->active_class = "pos_item_offers";
        $model = new Positemoffers('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Positemoffers']))
            $model->attributes = $_GET['Positemoffers'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Positemoffers the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Positemoffers::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Positemoffers $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'positemoffers-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
