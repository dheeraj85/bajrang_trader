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
                    <h3 class="panel-title">Manage <?php
                        if (Yii::app()->user->isSA() == 'sa') {
                            echo 'Purchase';
                        }
                        if (Yii::app()->user->isCPS() == 'cps') {
                            echo 'Purchase';
                        }
                        if (Yii::app()->user->isGPU() == 'gpu') {
                            echo 'Processed';
                        }
                        ?> Items</h3>
                </div>
                <div class="panel-body table-responsive">
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
                        'dataProvider' => $model->search(),
                        //'filter' => $model,
                        'columns' => array(
                            //  'id',
                            'item_type',
                            array('htmlOptions' => array(), 'header' => 'Category', 'name' => 'p_category_id', 'type' => 'raw', 'value' => '$data->category->name'),
                            array('htmlOptions' => array(), 'header' => 'Sub Category', 'name' => 'p_sub_category_id', 'type' => 'raw', 'value' => '$data->subcategory->name'),
                            'itemname',
                            'brand',
                            'item_scale',
                            'gst_code',
                            //'specification',
                            //'low_qty',
                            //'type',
                            //array('htmlOptions' => array(), 'header' => 'Created By', 'name' => 'created_by', 'type' => 'raw', 'value' => '$data->createdby->name'),
                            // array('htmlOptions' => array('width' => '280'), 'header' => 'Action', 'value' => '$data->Addtoshelf($data)'),
                            array('htmlOptions' => array('width' => '180'), 'header' => 'Action', 'value' => '$data->Addtoshelf($data)'),
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
                                array('htmlOptions' => array(), 'header' => 'HAC/SAC CODE', 'value' => '$data->gst_code'),
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
                                'gst_code',
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
<script type="text/javascript">

    function updateItemStatus(id, status) {
        //alert(id + status);
        $.ajax({
            url: '<?php echo Yii::app()->createUrl('purchaseitem/updateitemstatus'); ?>',
            data: 'id=' + id + '&status=' + status,
            success: function(response) {
                if (response == 'success') {
                   alert('Status Updated Successfully');
                   if(status=='1')
                   $("#sts_"+id).html('Inactive');
               else
                   $("#sts_"+id).html('Active');
                }
            }
        });
    }

</script>