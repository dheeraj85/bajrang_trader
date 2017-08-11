<?php

$this->breadcrumbs = array(
    'Home' => array('site/cpsdashboard'),
    'Inventory Management' => array('itemstock/index'),
    'Purchase Order List',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Purchaseorder', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Purchaseorder', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#purchaseorder-grid').yiiGridView('update', {
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
                       Purchase Order List
                    </h3>
                </div>
                <div class="panel-body">
                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'purchaseorder-grid',
                        'type' => 'bordered',
                        'dataProvider' => $model->searchvendorpo($id),
                        //'filter' => $model,
                        'columns' => array(
                            array('htmlOptions' => array(), 'header' => 'Order', 'name' => 'id', 'type' => 'raw', 'value' => 'Purchaseorder::getpo($data)'),
                            array('htmlOptions' => array(), 'header' => 'Supplier Name', 'name' => 'supplier_id', 'type' => 'raw', 'value' => 'Purchaseorder::reqstatus($data)'),
                            'po_type',
                            array('htmlOptions' => array(), 'header' => 'Created By', 'name' => 'created_by', 'type' => 'raw', 'value' => '$data->createdby->name'),
                            'order_date',
                            array('htmlOptions' => array(), 'header' => 'Status', 'value' => 'Purchaseorder::status($data)'),
                           // array('htmlOptions' => array('width' => '300'), 'header' => 'Action', 'value' => 'Purchaseorder::reqaction($data)'),
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
<div id="load_model"></div>
<script type="text/javascript">
    function authreview(id, url) {
        $.ajax({
            url: '<?php echo Yii::app()->createUrl('purchaseorder/authreview') ?>',
            data: 'id=' + id + '&url=' + url,
            success: function (response) {
                $("#load_model").html(response);
            }
        });
    }
</script>