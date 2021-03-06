<?php
$this->breadcrumbs = array(
    'Home' => array('site/cpsdashboard'),
    'Inventory Management' => array('itemstock/index'),
    'View Inventory',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Itemstock', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Itemstock', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#itemstock-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">      
            <div class="box">
                <div class="box-header bg-green">
                    <h3 class="panel-title">View Inventory</h3>
                </div>
                <div class="panel-body table-responsive">
                <div class="search-form">
                    <?php
                    $this->renderPartial('_search', array(
                        'model' => $model,
                    ));
                    ?>
                </div>
            <?php
            $this->widget('bootstrap.widgets.BsGridView', array(
                'id' => 'itemstock-grid',
                'type' => 'bordered',
                'dataProvider' => $model->search(),
                //'filter' => $model,
                'columns' => array(
                    //'id',
                    //array('htmlOptions' => array(), 'header' => 'Invoice No', 'name' => 'invoice_id', 'type' => 'raw', 'value' => '$data->invoice->invoice_no'),
                    //array('htmlOptions' => array(), 'header' => 'Category', 'name' => 'p_category_id', 'type' => 'raw', 'value' => 'Itemstock::getcategory($data)'),
                    //array('htmlOptions' => array(), 'header' => 'Sub Category', 'name' => 'p_sub_category_id', 'type' => 'raw', 'value' => 'Itemstock::getscategory($data)'),
                    array('htmlOptions' => array(), 'header' => 'Item', 'name' => 'item_id', 'type' => 'raw', 'value' => '$data->item->itemname'),
                    array('htmlOptions' => array(), 'header' => 'Brand', 'name' => 'item_id', 'type' => 'raw', 'value' => '$data->item->brand'),
                    //'invoice.invoice_no',
                    //'item.itemname',
                    //'item.brand',
                    'particulars',
                    array('htmlOptions' => array(), 'header' => 'Stock Qty', 'name' => 'stock_qty', 'type' => 'raw', 'value' => 'Itemstock::getstockqty($data)'),
                    'stock_taking_scale',
                    'mrd_no',
                    'make_date',
                    'ready_date',
                    array('htmlOptions' => array(), 'header' => 'Discard Date', 'name' => 'discard_date', 'type' => 'raw', 'value' => 'Itemstock::getitemdiscard($data)'),
                ),
            ));
            ?>
            <div id="printslist" style="display:none;">
            <?php
            $this->widget('bootstrap.widgets.BsGridView', array(
                'id' => 'itemstock-grid',
                'type' => 'bordered',
                'dataProvider' => $model->searchprint(),
                //'filter' => $model,
                'columns' => array(
                    //'id',
                    //array('htmlOptions' => array(), 'header' => 'Invoice No', 'name' => 'invoice_id', 'type' => 'raw', 'value' => '$data->invoice->invoice_no'),
                    //array('htmlOptions' => array(), 'header' => 'Category', 'value' => 'Itemstock::getcategory($data)'),
                    //array('htmlOptions' => array(), 'header' => 'Sub Category', 'value' => 'Itemstock::getscategory($data)'),
                    array('htmlOptions' => array(), 'header' => 'Item', 'value' => '$data->item->itemname'),
                    array('htmlOptions' => array(), 'header' => 'Brand','value' => '$data->item->brand'),
                    //'invoice.invoice_no',
                    //'item.itemname',
                    //'item.brand',
                    array('htmlOptions' => array(), 'header' => 'Particulars','value' => '$data->particulars'),
                    array('htmlOptions' => array(), 'header' => 'Stock Qty', 'value' => 'Itemstock::getstockqty($data)'),
                    array('htmlOptions' => array(), 'header' => 'Scale','value' => '$data->stock_taking_scale'),
                    array('htmlOptions' => array(), 'header' => 'MRD No.','value' => '$data->mrd_no'),
                    array('htmlOptions' => array(), 'header' => 'Make Date','value' => '$data->make_date'),
                    array('htmlOptions' => array(), 'header' => 'Processed Date','value' => '$data->ready_date'),
                    array('htmlOptions' => array(), 'header' => 'Discard Date', 'value' => 'Itemstock::getitemdiscard($data)'),
                ),
            ));
            ?>
            </div>
            <div style="display:none;" id="itemstock-excel-grid">
            <?php
            $this->widget('bootstrap.widgets.BsGridView', array(
                'id' => 'itemstock-grid',
                'type' => 'bordered',
                'dataProvider' => $model->search(),
                //'filter' => $model,
                'columns' => array(
                    //'id',
                    //array('htmlOptions' => array(), 'header' => 'Invoice No', 'name' => 'invoice_id', 'type' => 'raw', 'value' => '$data->invoice->invoice_no'),
                    //array('htmlOptions' => array(), 'header' => 'Category', 'name' => 'p_category_id', 'type' => 'raw', 'value' => 'Itemstock::getcategory($data)'),
                    //array('htmlOptions' => array(), 'header' => 'Sub Category', 'name' => 'p_sub_category_id', 'type' => 'raw', 'value' => 'Itemstock::getscategory($data)'),
                    array('htmlOptions' => array(), 'header' => 'Item', 'name' => 'item_id', 'type' => 'raw', 'value' => '$data->item->itemname'),
                    array('htmlOptions' => array(), 'header' => 'Brand', 'name' => 'item_id', 'type' => 'raw', 'value' => '$data->item->brand'),
                    //'invoice.invoice_no',
                    //'item.itemname',
                    //'item.brand',
                    'particulars',
                    array('htmlOptions' => array(), 'header' => 'Stock Qty', 'name' => 'stock_qty', 'type' => 'raw', 'value' => 'Itemstock::getstockqty($data)'),
                    'stock_taking_scale',
                    'mrd_no',
                    'make_date',
                    'ready_date',
                    array('htmlOptions' => array(), 'header' => 'Discard Date', 'name' => 'discard_date', 'type' => 'raw', 'value' => 'Itemstock::getitemdiscard($data)'),
                ),
            ));
            ?>
            </div>
        </div>
            </div> 
        </div>
    </div>
</div>