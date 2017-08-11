<?php
$this->breadcrumbs = array(
    'Home' => array('site/cmsdashboard'),
    'Item Master' => array('purchasecategory/index'),
    'Manage Purchase Items',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Purchaseitem', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Purchaseitem', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#purchaseitem-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border bg-aqua">
                    <h3 class="panel-title">Manage Item Stock Settlement</h3>
                </div>
                <div class="panel-body table-responsive">
                    <a href="<?php echo $this->createUrl('purchaseitem/salesitem'); ?>" class="btn btn-primary">View Stock Settlement</a>
                    <?php
                    $this->renderPartial('_search', array(
                        'model' => $model,
                    ));
                    ?>
                    <br/>
                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'purchaseitem-grid',
                        'type' => 'bordered',
                        'dataProvider' => $model->search_for_stock_settlements(),
                        //'filter' => $model,
                        'columns' => array(
                            //  'id',
                            'item_type',
                            array('htmlOptions' => array(), 'header' => 'Category', 'name' => 'p_category_id', 'type' => 'raw', 'value' => '$data->category->name'),
                            array('htmlOptions' => array(), 'header' => 'Sub Category', 'name' => 'p_sub_category_id', 'type' => 'raw', 'value' => '$data->subcategory->name'),
                            'itemname',
                            //  'brand',
                            'item_scale',
                            //'specification',
                            //'low_qty',
                            //'type',
                            
                            array('htmlOptions' => array('width' => '90'), 'header' => 'Qty in CSK', 'value' => '$data->CSKStock($data)'),
                            array('htmlOptions' => array('width' => '180'), 'header' => 'Action', 'value' => '$data->stockSettlement($data)'),
                            array('htmlOptions' => array('width' => '90'), 'header' => 'Qty in Store', 'value' => '$data->ShelfStock($data)'),
                            array(
                                'class' => 'bootstrap.widgets.BsButtonColumn',
                            ),
                        ),
                    ));
                    ?>
                    <div id="printslist" style="display:none;">
                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'purchaseitem-grid',
                        'type' => 'bordered',
                        'dataProvider' => $model->searchprint(),
                        //'filter' => $model,
                        'columns' => array(
                            //  'id',
                            array('htmlOptions' => array(), 'header' => 'Category', 'value' => '$data->category->name'),
                            array('htmlOptions' => array(), 'header' => 'Sub Category', 'value' => '$data->subcategory->name'),
                            array('htmlOptions' => array(), 'header' => 'Item', 'value' => '$data->itemname'),
                            array('htmlOptions' => array(), 'header' => 'Brand', 'value' => '$data->brand'),
                            array('htmlOptions' => array(), 'header' => 'Item Scale', 'value' => '$data->item_scale'),
                            array('htmlOptions' => array(), 'header' => 'Low Qty', 'value' => ''),
                        ),
                    ));
                    ?> 
                    </div>
                    <div id="purchaseitem-excel" style="display:none;">
<?php
$this->widget('bootstrap.widgets.BsGridView', array(
    'id' => 'purchaseitem-excel-grid',
    'type' => 'bordered',
    'dataProvider' => $model->searchexcel(),
    //'filter' => $model,
    'columns' => array(
        //  'id',
        'item_type',
        array('htmlOptions' => array(), 'header' => 'Category', 'name' => 'p_category_id', 'type' => 'raw', 'value' => '$data->category->name'),
        array('htmlOptions' => array(), 'header' => 'Sub Category', 'name' => 'p_sub_category_id', 'type' => 'raw', 'value' => '$data->subcategory->name'),
        'itemname',
        'brand',
        'item_scale',
        //'specification',
        'low_qty',
    //'type',
    //array('htmlOptions' => array(), 'header' => 'Created By', 'name' => 'created_by', 'type' => 'raw', 'value' => '$data->createdby->name'),
    // array('htmlOptions' => array('width' => '280'), 'header' => 'Action', 'value' => '$data->Addtoshelf($data)'),
    //          array('htmlOptions' => array(), 'header' => 'Action', 'value' => '$data->Addtoshelf($data)'),
    // array(
    //    'class' => 'bootstrap.widgets.BsButtonColumn',
    //),
    ),
));
?>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>