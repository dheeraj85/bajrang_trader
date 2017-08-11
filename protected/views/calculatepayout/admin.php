<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Payout List' => array('calculatepayout/admin'),
        //'Purchase Order List',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Calculatepayout', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Calculatepayout', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#calculatepayout-grid').yiiGridView('update', {
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
                <div class="box-header bg-green">
                    <h3 class="panel-title">
                        <div class="pull-left">Payout List</div>
                        <a href="<?php echo $this->createUrl('calculatepayout/create')?>" class="btn btn-primary pull-right">Calculate Payout</a>  
                        <div style="clear:both"></div>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="search-form" style="display:none">
                        <?php
                       // $this->renderPartial('_search', array(
                        //    'model' => $model,
                       // ));
                        ?>
                    </div>
                    <!-- search-form -->

                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'calculatepayout-grid',
                        'type'=>'bordered',
                        'dataProvider' => $model->search(),
                        //'filter' => $model,
                        'columns' => array(
                            //'id',
                            'customer.invoice_no',
                            'customer.invoice_date',
                            array('htmlOptions' => array('width' => '200'), 'header' => 'Name of Farmer & their Father', 'type' => 'raw', 'value' => 'Calculatepayout::farmername($data)'),
                            array('htmlOptions' => array('width' => '200'), 'header' => 'Address of Farmer', 'type' => 'raw', 'value' => 'Calculatepayout::address($data)'),
                            array('htmlOptions' => array('width' => '150'), 'header' => 'Item', 'type' => 'raw', 'value' => 'Calculatepayout::item($data)'),
                            //'customer_id',
                            'load_wgt',
                            'amount',
                            array('htmlOptions' => array('width' => '110'), 'header' => 'Action', 'value' => 'Calculatepayout::reqaction($data)'),
                            //'payment_mode',
                            /*
                              'payment_date',
                              'c_number_t_num_utr_num',
                              'account_no',
                              'bank_card_name',
                              'remark',
                              'dated',
                              'is_paid',
                             */
//                            array(
//                                'class' => 'bootstrap.widgets.BsButtonColumn',
//                            ),
                        ),
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>