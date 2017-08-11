<?php
/* @var $this PurchaseitemController */
/* @var $model Purchaseitem */
?>

<?php
$this->breadcrumbs = array(
    'Home' => array('site/cmsdashboard'),
    'Item Master'=>array('purchasecategory/index'),
    'Purchase Item',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Purchaseitem', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Purchaseitem', 'url' => array('admin')),
);
?>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/bs/js/jquery.js"></script>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border bg-aqua">
                    <h3 class="panel-title">Add <?php
                        if (Yii::app()->user->isSA() == 'sa') {
                            echo 'Purchase';
                        }
                        if (Yii::app()->user->isCPS() == 'cps') {
                            echo 'Purchase';
                        }
                        if (Yii::app()->user->isGPU() == 'gpu') {
                            echo 'Processed';
                        }
                        ?> Items
                    </h3>
                </div>
                <div class="panel-body">
                    <?php if (Yii::app()->user->hasFlash('pitem')) { ?>
                        <div class="alert1 alert-success">
                            <?php echo Yii::app()->user->getFlash('pitem'); ?>
                        </div>
                    <?php } ?>
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
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/tableexport/jquery.min.js"></script>