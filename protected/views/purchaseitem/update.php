<?php
/* @var $this PurchaseitemController */
/* @var $model Purchaseitem */
?>

<?php
$this->breadcrumbs = array(
    'Home' => array('site/cmsdashboard'),
    'Item Master',
    'Purchase Items',
    //$model->id=>array('view','id'=>$model->id),
    'Update Purchase Item',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Purchaseitem', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Purchaseitem', 'url' => array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt', 'label' => 'View Purchaseitem', 'url' => array('view', 'id' => $model->id)),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Purchaseitem', 'url' => array('admin')),
);
?>
 
<script src="<?php echo Yii::app()->request->baseUrl; ?>/bs/js/jquery.js"></script>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header bg-aqua">
                    <h3 class="panel-title">Update <?php
                        if (Yii::app()->user->isSA() == 'sa') {
                            echo 'Purchase';
                        }
                        if (Yii::app()->user->isCPS() == 'cps') {
                            echo 'Purchase';
                        }
                        if (Yii::app()->user->isGPU() == 'gpu') {
                            echo 'Processed';
                        }
                        ?> Items</h3>
                </div>
                <div class="panel-body">
                    <?php
                    $this->renderPartial('_form', array(
                        'model' => $model,
                    ));
                    ?>
                </div>
            </div>     
        </div>  
    </div>  
</div> 