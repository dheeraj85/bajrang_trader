<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Purchase Orders' => array('purchaseorder/admin'),
    'Add Purchase Order',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Purchaseorder', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Purchaseorder', 'url' => array('admin')),
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">      
            <div class="box">
                <div class="box-header bg-green">
                    <h3 class="panel-title">Add Purchase Order</h3>
                </div>
                <div class="panel-body">
                    <?php $this->renderPartial('_form', array('model' => $model,'indentlist'=>$indentlist)); ?>
                </div>
            </div>
        </div>
    </div>
</div>