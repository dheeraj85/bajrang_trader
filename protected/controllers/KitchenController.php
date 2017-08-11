<?php

class KitchenController extends Controller {

    public $active_menu = '';
    public $active_class = '';
    public $open_class = '';
    public $layout = '//layouts/column2';

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
                'actions' => array('changepkotstatus', 'changeitemstatus', 'savecomment', 'refreshkot',
                    'index', 'status', 'vieworder', 'viewingredients', 'productionkot', 'viewkot',
                    'menukot', 'viewmenukot', 'changemkotstatus', 'aos', 'pkot','mkot'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array(''),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionChangepkotstatus() {
        $status = $_POST['status'];
        $id = $_POST['id'];
        $data = Productionkot::model()->findByPk($id);
        $data->status = $status;
        $data->update();
    }

    public function actionChangeitemstatus() {
        $status = $_POST['status'];
        $id = $_POST['item_id'];
        $data = Productionkotitems::model()->findByPk($id);
        $data->status = $status;
        $data->update();
    }

    public function actionSavecomment() {
        $id = $_POST['id'];
        $cmmt = $_POST['comment'];
        $pkot = Productionkot::model()->findByPk($id);
        $kot_comments = new Productionkotcomments();
        $kot_comments->production_kot_id = $id;
        $kot_comments->comments = $cmmt;
        $kot_comments->from_id = Yii::app()->user->id;
        $kot_comments->to_id = $pkot->generated_by;
        $kot_comments->save();
    }

    public function actionIndex() {
        $this->render('index');
    }

    public function actionAos() {
        $this->active_menu='aos';
        $this->render('aos');
    }

    public function actionPkot() {
        $this->active_menu='pkot';
        $this->render('pkot');
    }

    public function actionMkot() {
        $this->active_menu='mkot';
        $this->render('mkot');
    }

    public function actionStatus() {
        $data = $_POST['data'];
        $d2 = strtotime(date('Y-m-d'));
        $d1 = $d2 - (86400 * 7);
        $fd = date('Y-m-d', $d2);
        $td = date('Y-m-d', $d1);
        if (!empty($data)) {
            $customer = array();
            $customer1 = Customer::model()->findAllBySql("select * from customer where full_name like '%$data%'");
            if (!empty($customer1)) {
                foreach ($customer1 as $val) {
                    $customer[] = $val->id;
                }
            } else {
                $customer2 = Customer::model()->findAllBySql("select * from customer where mobile_no like '%$data%'");
                foreach ($customer2 as $val) {
                    $customer[] = $val->id;
                }
            }
            $order1 = Cakeorder::model()->findAllByAttributes(array('customer_id' => $customer));
            if (!empty($order1)) {
                $searchdata = $order1;
            } else if (empty($order1)) {
                $order2 = Cakeorder::model()->findAllBySql("select * from cake_order where id like '%$data%' and order_date>=$d1 and order_date<=$d2");
                $searchdata = $order2;
            }
        } else {
            $searchdata = Cakeorder::model()->findAllBySql("select * from cake_order where order_date>=$d1 and order_date<=$d2");
//            $searchdata = Cakeorder::model()->findAll();
        }
        $this->renderPartial('_status', array('searchdata' => $searchdata));
    }

    public function actionVieworder() {
        $id = $_POST['id'];
        $this->renderPartial('_view_order', array('id' => $id,));
    }

    public function actionProductionkot() {
        $date = date('Y-m-d');
        $kot = Productionkot::model()->findAll();
//        $kot = Productionkot::model()->findAllByAttributes(array('kot_date' => $date));
        $this->renderPartial('_production_kot', array('kot' => $kot,));
    }

    public function actionViewkot() {
        $id = $_POST['id'];
        $this->renderPartial('_view_kot', array('id' => $id,));
    }

    public function actionRefreshkot() {
        $id = $_POST['id'];
        $pkot = Productionkot::model()->findByPk($id);
        $pkot_items = Productionkotitems::model()->findAllByAttributes(array('production_kot_id' => $pkot->id));
        $pkot_comments = Productionkotcomments::model()->findAllByAttributes(array('production_kot_id' => $pkot->id));
        $this->renderPartial('_kot', array('id' => $id, 'pkot' => $pkot, 'pkot_items' => $pkot_items, 'pkot_comments' => $pkot_comments));
    }

    public function actionMenukot() {
        $date = date('Y-m-d');
        $mkot = Menukot::model()->findAll();
//        $kot = Productionkot::model()->findAllByAttributes(array('kot_date' => $date));
        $this->renderPartial('_menu_kot', array('mkot' => $mkot,));
    }

    public function actionViewmenukot() {
        $id = $_POST['id'];
        $this->renderPartial('_view_menu_kot', array('id' => $id,));
    }

    public function actionChangemkotstatus() {
        $status = $_POST['status'];
        $id = $_POST['id'];
        $data = Menukot::model()->findByPk($id);
        $data->status = $status;
        $data->update();
//        $this->renderPartial('_view_menu_kot', array('id' => $id,));
    }

    public function actionViewingredients() {
        $id = $_POST['id'];
        $cake_order = Cakeorder::model()->findByPk($id);
        $recipe = Recipeitems::model()->findByAttributes(array('recipe_category' => 'Flavour', 'category_name_id' => $cake_order->flavour_id));
        $ingredients = Ingredients::model()->findAllByAttributes(array('recipe_item_id' => $recipe->id));
        $this->renderPartial('_ingredients', array(
            'list' => $ingredients,
            'recipe' => $recipe,
            'cake_order' => $cake_order,
        ));
    }

}
