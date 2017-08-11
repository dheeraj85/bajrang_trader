<?php
$this->breadcrumbs=array(
	'Home' => array('site/cmsdashboard'),
	'Voucher types'=>array('admin'),
	'Update Voucher type',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Vouchertype', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Vouchertype', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Vouchertype', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Vouchertype', 'url'=>array('admin')),
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="col-lg-6">
                <div class="box">
                    <div class="box-header btn-primary">
                        <h3 class="panel-title">Update Voucher type</h3>
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
</div>