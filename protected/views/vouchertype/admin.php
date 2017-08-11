<?php
$this->breadcrumbs = array(
    'Home' => array('site/cmsdashboard'),
    'Account Management System' => array('expenseheads/index'),
    'Voucher Types',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Vouchertype', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Vouchertype', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#vouchertype-grid').yiiGridView('update', {
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
            <div class="col-lg-5">
                <div class="box">
                    <div class="box-header  btn-primary">
                        <h3 class="panel-title">Add Voucher Type</h3>
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
            <div class="col-lg-7">
                <div class="box">
                    <div class="box-header btn-primary">
                        <h3 class="panel-title">Manage Voucher Types</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                        $this->widget('bootstrap.widgets.BsGridView', array(
                            'id' => 'vouchertype-grid',
                            'type' => 'bordered',
                            'dataProvider' => $model->search(),
                            //'filter' => $model,
                            'columns' => array(
                                //'id',
                                'voucher_name',
                                'payment_receiver_type',
                                'voucher_nature',
                                'user_role',
                                'description',
                                array(
                                    'class' => 'bootstrap.widgets.BsButtonColumn',
                                ),
                            ),
                        ));
                        ?>
                    </div>
                </div>
            </div>      
        </div>
    </div>
</div>



