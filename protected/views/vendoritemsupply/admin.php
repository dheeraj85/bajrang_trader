<?php
/* @var $this VendoritemsupplyController */
/* @var $model Vendoritemsupply */


$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Vendor Details' => array('vendor/admin'),
    'Manage Vendor Item Supply',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Vendoritemsupply', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Vendoritemsupply', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#vendoritemsupply-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<!--<style type="text/css">
    .view,.update{
        display:none; 
    }
</style>-->
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-6">
            <div class="box">
                <div class="box-header with-border bg-green">
                    <h3 class="panel-title">Add Vendor Item Supply ( Vendor Name : <?php $data=Vendor::model()->findByPk($vid); echo $data->name."( ".$data->firm_name." )"; ?> )</h3>
                </div>
                <div class="panel-body">
                    <?php
                    $this->renderPartial('_form', array(
                        'model' => $model, 'vid' => $vid,
                    ));
                    ?>
                </div>
            </div>     
        </div>  
        <div class="col-lg-6">
            <div class="box">
                <div class="box-header with-border bg-green">
                    <h3 class="panel-title">Manage Vendor Item Supply</h3>
                </div>
                <div class="panel-body">
                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'vendoritemsupply-grid',
                        'type' => 'bordered',
                        'dataProvider' => $model->search($vid),
                        //'filter' => $model,
                        'columns' => array(
                           // 'id',
                           // array('htmlOptions' => array(), 'header' => 'Vendor Name', 'name' => 'vendor_id', 'type' => 'raw', 'value' => '$data->vendor->name'),
                            array('htmlOptions' => array(), 'header' => 'Item', 'name' => 'itemname', 'type' => 'raw', 'value' => '$data->itemname'),
                            array('htmlOptions' => array(), 'header' => 'Brand', 'name' => 'brand', 'type' => 'raw', 'value' => '$data->brand'),
                            array('htmlOptions' => array(), 'header' => 'Item Scale', 'name' => 'purchase_item_id', 'type' => 'raw', 'value' => '$data->purchaseItem->item_scale'),
                            array('htmlOptions' => array(), 'header' => 'Action', 'name' => 'is_active', 'type' => 'raw', 'value' => 'Vendoritemsupply::request($data)'),
                           // 'purchase_item_id',
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