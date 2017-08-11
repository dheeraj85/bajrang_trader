<?php
/* @var $this PurchaseitemController */
/* @var $model Purchaseitem */
?>

<?php
$this->breadcrumbs = array(
    'Home' => array('site/cmsdashboard'),
    'Item Master',
    'View Purchase Item',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Purchaseitem', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Purchaseitem', 'url' => array('create')),
    array('icon' => 'glyphicon glyphicon-edit', 'label' => 'Update Purchaseitem', 'url' => array('update', 'id' => $model->id)),
    array('icon' => 'glyphicon glyphicon-minus-sign', 'label' => 'Delete Purchaseitem', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Purchaseitem', 'url' => array('admin')),
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border bg-aqua">
                    <h3 class="panel-title">
                        View Purchase Item
                    </h3>
                </div>
                <div class="panel-body table-responsive">
                    <?php
                    $this->widget('zii.widgets.CDetailView', array(
                        'htmlOptions' => array(
                            'class' => 'table table-striped table-condensed table-hover',
                        ),
                        'data' => $model,
                        'attributes' => array(
                            //    'id',
                            'goods_service',
                            'item_type',
                            array(
                                'label' => 'Category',
                                'value' => $model->category->name,
                            ),
                            array(
                                'label' => 'Sub Category',
                                'value' => $model->subcategory->name,
                            ),
                            'itemname',
                            'gst_code_type',
                            'gst_code',
                            'gst_percent',
                            //'cess_tax',
                            //'brand',
                            'item_scale',
                            //'low_qty',
                            'type',
                            'specification',
                            //'item_classification',
                            //'cess_percent',
                            'createdBy.name',
                            //array('name' => 'barcode', 'type' => 'raw', 'value' => Common::getItemBarcode(array("itemId" => $model->id, "barocde" => $model->barcode))),
                        ),
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>