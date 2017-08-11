<?php
/* @var $this VoucherController */
/* @var $model Voucher */


$this->breadcrumbs = array(
    'Home' => array('site/cmsdashboard'),
    'Vendor Ledger'=>array('ledger'),
    'Payment History',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Voucher', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Voucher', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#voucher-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<style type="text/css">
    .view,.delete{
        display:none; 
    }
</style>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">     
            <div class="box">
                <div class="box-header btn-green">
                    <h3 class="panel-title">Payment History</h3>
                </div>
                <div class="panel-body">                   
                    <!-- search-form -->

                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'voucher-grid',
                        'type' => 'bordered',
                        'dataProvider' => $model->history($vendorid),
                        //'filter' => $model,
                        'columns' => array(
                            array('htmlOptions' => array(), 'header' => 'Voucher No', 'name' => 'id', 'type' => 'raw', 'value' => '$data->voucher_no'),
                            array('htmlOptions' => array(), 'header' => 'Voucher Type', 'name' => 'voucher_type_id', 'type' => 'raw', 'value' => '$data->voucher->voucher_name'),
                            //'payment_receiver_type',
                            array('htmlOptions' => array(), 'header' => 'Receiver', 'name' => 'receiver_id', 'value' => 'Voucher::reqstatus($data)'),
                            //'receiver_id',
                            //'other_name',
                           // 'mobile',
                            //'address',
                            'amount',
                            //array('htmlOptions' => array(), 'header' => 'Expense Nature', 'name' => 'expense_nature_id', 'type' => 'raw', 'value' => '$data->expnature->name'),
                            //'remark',
                            'dated',
                            'payment_mode',
                            //'payment_date',
                            //'c_number_t_num_utr_num',
                            //'account_no',
                            //'bank_card_name',
                            //array('htmlOptions' => array(), 'header' => 'Created By', 'name' => 'created_by', 'type' => 'raw', 'value' => '$data->users->name'),
                            //'is_assigned',
                            //'received_by',
                            //'received_mobileno',
                            array('htmlOptions' => array(), 'header' => 'Action', 'value' => 'Voucher::viewaction($data)'),
                        ),
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>