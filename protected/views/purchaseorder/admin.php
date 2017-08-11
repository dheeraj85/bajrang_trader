<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Purchase Orders' => array('purchaseorder/admin'),
    //'Purchase Order List',
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
            <?php
            if (!empty($msg)) {
                echo $msg;
            }
            ?>

            <div style="clear:both"></div>
            <div class="box">
                <div class="box-header bg-green">
                    <h3 class="panel-title">
                        <div class="pull-left">Purchase Order List</div>
                        <a href="<?php echo $this->createUrl('purchaseorder/create'); ?>" class="btn btn-primary pull-right">Add Purchase Order</a>
                    </h3>
                </div>
                <div class="panel-body">

                    <div class="search-form">
                        <?php
                        //$this->renderPartial('_search', array(
                         //   'model' => $model,
                        //));
                        ?>
                    </div>
                    <!-- search-form -->

                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'purchaseorder-grid',
                        'type' => 'bordered',
                        'dataProvider' => $model->search(),
                        //'filter' => $model,
                        'columns' => array(
                            array('htmlOptions' => array(), 'header' => 'Purchase Order No.', 'name' => 'id', 'type' => 'raw', 'value' => '$data->order_no'),
                            array('htmlOptions' => array(), 'header' => 'GST No.', 'name' => 'id', 'type' => 'raw', 'value' => '$data->gst_no'),
                            array('htmlOptions' => array(), 'header' => 'Delivery Period From', 'name' => 'delivery_form', 'type' => 'raw', 'value' => '$data->delivery_form'),
                            array('htmlOptions' => array(), 'header' => 'Delivery Period To', 'name' => 'delivery_to', 'type' => 'raw', 'value' => '$data->delivery_to'),
                            array('htmlOptions' => array(), 'header' => 'Location', 'name' => 'place', 'type' => 'raw', 'value' => '$data->place'),
                            //array('htmlOptions' => array(), 'header' => 'Status', 'value' => 'Purchaseorder::status($data)'),
                            array('htmlOptions' => array('width' => '240'), 'header' => 'Action', 'value' => 'Purchaseorder::reqaction($data)'),
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