<?php
/* @var $this PurchaseinvoiceController */
/* @var $model Purchaseinvoice */
?>

<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Item Stock' => array('finisheditem/index'),
    'Add Item Stock',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Purchaseinvoice', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Purchaseinvoice', 'url' => array('admin')),
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="panel-body" style="padding:0px;">
                    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
                </div>
            </div>
        </div>
    </div>
</div>