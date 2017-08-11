<?php

class TicketController extends Controller {

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
                'actions' => array('admin', 'delete', 'create', 'update', 'reply', 'adminreply',
                    'adminview', 'getuser', 'assignticket', 'assignedtickets', 'assignedview', 'tickets', 'replysave', 'deletereply', 'close'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'reply'),
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

    public function actionAssignedview($id) {
        d21(Yii::app()->user->getUsername().' View Assigned Ticket',"site.login");
        $this->render('assignedview', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionView($id) {
        d21(Yii::app()->user->getUsername().' View Generated Ticket Details',"site.login");
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Ticket;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Ticket'])) {
            $model->attributes = $_POST['Ticket'];
            $model->submitted_by = Yii::app()->user->id;
            if ($model->save()) {
                d21(Yii::app()->user->getUsername().' Generate Ticket',"site.login");
                $this->redirect(array('admin'));
//                        }else{
//                            print_r($model->getErrors());
////                            exit();
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionReply() {
        $tid = $_GET['tid'];
        $reply = Reply::model()->findAllByAttributes(array('ticket_id' => $tid));
        $ticket = Ticket::model()->findByPk($tid);

        $this->renderPartial('_reply', array(
            'reply' => $reply,
            'ticket' => $ticket,
            'tid' => $tid,
        ));
    }

    public function actionReplysave() {
        $model = new Reply();
        $model->ticket_id = $_GET['tid'];
        $model->from_id = $_GET['from_id'];
        $model->to_id = $_GET['to_id'];
        $model->reply_msg = $_GET['reply_msg'];
        $model->reply_date = date('Y-m-d H:m:s');
        if ($model->save()) {
            d21(Yii::app()->user->getUsername().' Give the comments on ticket',"site.login");
            echo '1';
        } else {
            echo '0';
            print_r($model->getErrors());
        }
        exit();
    }

    public function actionDeletereply() {
        $id = $_GET['id'];
        $model = Reply::model()->findByPk($id);
        if ($model->delete()) {
            d21(Yii::app()->user->getUsername().' Delete His Comment On Ticket',"site.login");
            echo '1';
        } else {
            echo '0';
        }
    }

    public function actionClose() {
        $model = Ticket::model()->findByPk($_GET['ticket_id']);
        $model->status = 'close';
        $model->close_reason = $_GET['close_msg'];
        if ($model->save()) {
            d21(Yii::app()->user->getUsername().' Close Conversation On Ticket',"site.login");
            echo '1';
        } else {
            echo '0';
        }
    }

    public function actionGetuser() {
        $val = $_GET['val'];
        $user = Users::model()->findAllByAttributes(array('role' => $val));
        foreach ($user as $value) {
            ?>
            <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
            <?php
        }
    }

    public function actionAssignticket() {
        $tid = $_GET['tid'];
        $uid = $_GET['uid'];
        $ticket = Ticket::model()->findByPk($tid);
        $ticket->assigned_to = $uid;
        $ticket->assigned_date = date('Y-m-d');
        $ticket->status = 'assigned';
        $ticket->save();
        d21(Yii::app()->user->getUsername().' Assign Tickets',"site.login");
        $this->redirect(array('site/ticketmanagerview', 'id' => $tid));
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

        if (isset($_POST['Ticket'])) {
            $model->attributes = $_POST['Ticket'];
            $model->submitted_by = Yii::app()->user->id;
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
        $dataProvider = new CActiveDataProvider('Ticket');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAssignedtickets() {
        $model = new Ticket('searchtickets');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Ticket']))
            $model->attributes = $_GET['Ticket'];

        $this->render('assignedtickets', array(
            'model' => $model,
        ));
    }

    public function actionAdmin() {
        $model = new Ticket('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Ticket']))
            $model->attributes = $_GET['Ticket'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Ticket::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ticket-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
