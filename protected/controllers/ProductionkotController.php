<?php

class ProductionkotController extends Controller {

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
//			'postOnly + delete', // we only allow deletion via POST request
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
                'actions' => array('addtoshelf', 'printpkot', 'resendpkot', 'resend', 'addcomment', 'removeitem', 'updateqty', 'additems', 'getItemDetail', 'create', 'update', 'admin', 'delete'),
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
    public function actionAddtoshelf() {
        $id = $_GET['id'];
        $pkot_items = Productionkotitems::model()->findByPk($id);
        $shelf = Shelfitems::model()->findByPk($pkot_items->menu_item_id);
        $item = Purchaseitem::model()->findByPk($shelf->item_id);
        $qty = $item->low_qty + $pkot_items->qty;
        $item->low_qty = $qty;
        if ($item->update()) {
            $pkot_items->is_added_to_shelf = 1;
            $pkot_items->added_date = date("Y-m-d");
            if ($pkot_items->update()) {
                $items = Productionkotitems::model()->findBySql("select * from production_kot_items where production_kot_id=$pkot_items->production_kot_id order by id desc limit 1");
                if ($items->is_added_to_shelf == 1) {
                    $pkot = Productionkot::model()->findByPk($pkot_items->production_kot_id);
                    $pkot->is_added_to_shelf = 1;
                    $pkot->update();
                }
            }
        }
        $this->redirect(array('view', 'id' => $pkot_items->production_kot_id));
    }

    public function actionPrintpkot() {
        $this->layout = 'pos_front_layout';
        $id = $_GET['id'];
        $pkot = Productionkot::model()->findByPk($id);
        $pkot_items = Productionkotitems::model()->findAllByAttributes(array('production_kot_id' => $pkot->id));
        $pkot_comments = Productionkotcomments::model()->findAllByAttributes(array('production_kot_id' => $pkot->id));
        $this->render('print_pkot', array('id' => $id, 'pkot' => $pkot, 'pkot_items' => $pkot_items, 'pkot_comments' => $pkot_comments));
    }

    public function actionResendpkot($id) {
        $id = $_GET['id'];
        $pkot = Productionkot::model()->findByPk($id);
        $pkot->status = 'pending';
        $pkot->update();
        $this->redirect(array('create'));
    }

    public function actionResend($id) {
        $id = $_GET['id'];
        $kot_items = Productionkotitems::model()->findByPk($id);
        $kot_items->status = 'pending';
        $kot_items->update();
        $this->redirect(array('view', 'id' => $kot_items->production_kot_id));
    }

    public function actionAddcomment() {
        $pkot_id = $_POST['pkot'];
        $cmmt = $_POST['comment'];
        $kuser = Users::model()->findBySql("select * from users where role='kpos'");
        $kot_comments = new Productionkotcomments();
        $kot_comments->production_kot_id = $pkot_id;
        $kot_comments->comments = $cmmt;
        $kot_comments->from_id = Yii::app()->user->id;
        $kot_comments->to_id = $kuser->id;
        $kot_comments->save();
        $this->redirect(array('view', 'id' => $pkot_id));
    }

    public function actionRemoveitem($id) {
        $id = $_GET['id'];
        $kot_items = Productionkotitems::model()->findByPk($id);
        $pkot_id = $kot_items->production_kot_id;
        $kot_items->delete();
        $this->redirect(array('view', 'id' => $pkot_id));
    }

    public function actionUpdateqty() {
        $id = $_GET['id'];
        $qty = $_GET['qty'];
        $kot_items = Productionkotitems::model()->findByPk($id);
        $kot_items->qty = $qty;
        if ($kot_items->status != 'pending') {
            $kot_items->is_redraw = 1;
            $pkot = Productionkot::model()->findByPk($kot_items->production_kot_id);
            $pkot->is_redraw = 1;
            $pkot->save();
        }
        $kot_items->save();
        $this->redirect(array('view', 'id' => $kot_items->production_kot_id));
    }

    public function actionAdditems() {
        $pkot_id = $_GET['pkot'];
        $item = $_GET['item'];
        $kot_items = new Productionkotitems();
        $kot_items->production_kot_id = $pkot_id;
        $kot_items->menu_item_id = $item;
        $kot_items->qty = 1;
        $kot_items->status = 'pending';
        $kot_items->save();
        $this->redirect(array('view', 'id' => $pkot_id, 'val' => $kot_items->id));
    }

    public function actionGetItemDetail() {
        $items = Yii::app()->db->createCommand()
                ->select('si.id,pi.itemname as display')
                ->from('shelf_items si')
                ->join('purchase_item pi', 'pi.id=si.item_id')
                ->queryAll();
        echo CJSON::encode(array('data' => $items));
    }

    public function actionView($id) {
        $this->active_menu = "production";
        $this->open_class = "production";
        $this->active_class = "pkot";
        $this->layout = 'pos_main';
        $val = $_GET['val'];
        $this->render('view', array(
            'model' => $this->loadModel($id),
            'val' => $val,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $this->active_menu = "production";
        $this->open_class = "production";
        $this->active_class = "pkot";
        $model = new Productionkot;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Productionkot'])) {
            $model->attributes = $_POST['Productionkot'];
            $model->generated_by = Yii::app()->user->id;
            $model->status = 'pending';
            $model->kot_date = date('Y-m-d');
            if ($model->save())
                $this->redirect(array('create'));
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
        $this->active_menu = "production";
        $this->open_class = "production";
        $this->active_class = "pkot";
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Productionkot'])) {
            $model->attributes = $_POST['Productionkot'];
            $model->generated_by = Yii::app()->user->id;
//            $model->status = 'pending';
            if ($model->save())
                $this->redirect(array('create'));
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
//		if(Yii::app()->request->isPostRequest)
//		{
        // we only allow deletion via POST request
        $model = $this->loadModel($id);
        if (!empty($model)) {
            foreach (Productionkotitems::model()->findAllByAttributes(array('production_kot_id' => $model->id)) as $item) {
                $item->delete();
            }
            foreach (Productionkotcomments::model()->findAllByAttributes(array('production_kot_id' => $model->id)) as $comment) {
                $comment->delete();
            }
            $model->delete();
        }

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('create'));
//		}
//		else
//			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Productionkot');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->active_menu = "production";
        $this->open_class = "production";
        $this->active_class = "pkot";
        $model = new Productionkot('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Productionkot']))
            $model->attributes = $_GET['Productionkot'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Productionkot the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Productionkot::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Productionkot $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'productionkot-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
