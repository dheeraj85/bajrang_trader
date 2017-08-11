<?php

class PurchaseindentmasterController extends Controller {

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
                'actions' => array('create', 'update', 'admin','review','indentupdate','printindent','checkitemexist',
                    'deleteitem','additemindent'),
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

    public function actionCheckitemexist() {
        $model = Purchaseindent::model()->findByAttributes(array("item_id"=>Yii::app()->request->getParam('itemid'),"is_added_to_order"=>1));
        if(!empty($model)){
            $msg= "1";
            $indentno=$model->indent_id;
        }else{
            $msg= "0";
            $indentno=0;
        }
        echo CJSON::encode(array('msg' => $msg,'indentno'=>$indentno));
    }
    
     public function actionDeleteitem() {
         Purchaseindent::model()->findByPk(Yii::app()->request->getPost('id'))->delete();
    }
     public function actionAdditemindent() {
        Purchaseindentmaster::model()->updateByPk(Yii::app()->request->getParam('id'),array("is_done"=>0));   
        $this->redirect(array('itemstock/indent','id'=>Yii::app()->request->getParam('id')));
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
        $model = new Purchaseindentmaster;

        if (isset($_POST['Purchaseindentmaster'])) {
            $model->attributes = $_POST['Purchaseindentmaster'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }
    
    public function actionReview() {
       if(empty(Yii::app()->session['security'])){
         $this->redirect(array("site/unauthorize"));   
        }
        $this->active_menu = "cps";
        $this->open_class = "inventory";
        $this->active_class = "indentreview";
        $model =Purchaseindentmaster::model()->findByPk(Yii::app()->request->getParam('id'));
        d21('Purchase Indent review by '.Yii::app()->user->getUsername(),"site.login");
        $this->render('review', array(
            'model' => $model,'id'=>Yii::app()->request->getParam('id'),
        ));
    }
    public function actionPrintindent() {
        $this->active_menu = "cps";
        $this->open_class = "inventory";
        $this->active_class = "indentreview";
        $model =Purchaseindentmaster::model()->findByPk(Yii::app()->request->getParam('id'));
        $this->render('print', array(
            'model' => $model,
        ));
    }

        public function actionIndentupdate() {
        $msg = "";
        $id=Yii::app()->request->getPost('indent_id'); 
        if(Yii::app()->request->getPost('updateindent')){          
        $ilist = Purchaseindent::model()->findAllBySql("select * from purchase_indent where indent_id=$id order by id desc");                          
        foreach ($ilist as $v) {
            $cmodel = Purchaseindent::model()->findByAttributes(array("id" => $v->id));
            $cmodel->qty_req = Yii::app()->request->getPost('qty_req_' . $v->id);
            $cmodel->req_date = Yii::app()->request->getPost('req_date_' . $v->id);
            $cmodel->save();
          }   
          $this->redirect(array('purchaseindentmaster/review','id'=>$id));
        }
        if(Yii::app()->request->getPost('generateorder')){
          Purchaseindentmaster::model()->updateByPk($id,array("is_done"=>2)); 
          foreach(Purchaseindent::model()->findAllByAttributes(array("indent_id"=>$id)) as $iitems){
            Purchaseindent::model()->updateByPk($iitems->id,array("is_added_to_order"=>0));  
         }
         $this->redirect(array('purchaseindentmaster/admin'));
        }
        d21('Purchase Indent updated by '.Yii::app()->user->getUsername(),"site.login");
        //  }
        $this->render('itemevaluate');
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

        if (isset($_POST['Purchaseindentmaster'])) {
            $model->attributes = $_POST['Purchaseindentmaster'];
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
        //} else
        //   throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Purchaseindentmaster');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->active_menu = "cps";
        $this->open_class = "inventory";
        $this->active_class = "indentreview";
        $model = new Purchaseindentmaster('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Purchaseindentmaster']))
            $model->attributes = $_GET['Purchaseindentmaster'];
        d21('Purchase Indent viewed by '.Yii::app()->user->getUsername(),"site.login");
        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Purchaseindentmaster the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Purchaseindentmaster::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Purchaseindentmaster $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'purchaseindentmaster-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
