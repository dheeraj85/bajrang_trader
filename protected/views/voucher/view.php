<?php
/* @var $this VoucherController */
/* @var $model Voucher */
?>

<?php
$this->breadcrumbs = array(
    'Home' => array('site/cmsdashboard'),
    'Vouchers'=>array('admin'),
    'View Voucher',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Voucher', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Voucher', 'url' => array('create')),
    array('icon' => 'glyphicon glyphicon-edit', 'label' => 'Update Voucher', 'url' => array('update', 'id' => $model->id)),
    array('icon' => 'glyphicon glyphicon-minus-sign', 'label' => 'Delete Voucher', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Voucher', 'url' => array('admin')),
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                    <h3 class="panel-title">View Voucher Details</h3>
                </div>
                <div class="panel-body table-responsive">

                    <?php
                    $this->widget('zii.widgets.CDetailView', array(
                        'htmlOptions' => array(
                            'class' => 'table table-striped table-condensed table-hover',
                        ),
                        'data' => $model,
                        'attributes' => array(
                            //'id',
                            'voucher.voucher_name',
                            'payment_receiver_type',
                            'other_name',
                            'mobile',
                            'address',
                            'amount',
                            'expnature.name',
                            'remark',
                            'dated',
                            'payment_mode',
                            'payment_date',
                            'c_number_t_num_utr_num',
                            'account_no',
                            'bank_card_name',
                            'received_by',
                            'received_mobileno',
                            'voucher_no',
                            //'users.name'
                            //'is_assigned',
                        ),
                    ));
                    ?>
                </div>
            </div>
        </div>  
    </div>
</div>