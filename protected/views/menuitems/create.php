<?php
/* @var $this MenuitemsController */
/* @var $model Menuitems */
?>

<?php
$this->breadcrumbs = array(
    'POS Management System' => array('positemoffers/index'),
    'Menu Items',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Menuitems', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Menuitems', 'url' => array('admin')),
);
?>

<style>
    .delete{
        display: none;
    }
</style>
<div class='form-css'>
<!--    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                    <h3 class="panel-title">Add Menu Items</h3>
                </div>
                <div class="panel-body">
                    <?php // $this->renderPartial('_form', array('model' => $model)); ?>
                </div>
            </div>     
        </div>  
    </div>  -->
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-info">
                    <h3 class="panel-title">Manage Menu Items</h3>
                </div>
                <div class="panel-body">
                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'menuitems-grid',
                        'dataProvider' => $model->search(),
//                        'filter' => $model,
                        'columns' => array(
//        		'id',
                            array(
                                'name' => 'p_category_id',
                                'value' => '$data->category->name'
                            ),
                            array(
                                'name' => 'p_sub_category_id',
                                'value' => '$data->category->name'
                            ),
                            array(
                                'name' => 'item_id',
                                'value' => '$data->positem->itemname'
                            ),
                            'barcode',
                            'tax_type',
                            'sale_price',
//                            'itemname',
//                            'brand',
//                            'item_unit',
//                            'item_scale',
//                            'specification',
//                            'unit_price',
//                            array('htmlOptions' => array('width' => '140'), 'header' => 'Item Image', 'name' => 'item_image', 'type' => 'raw', 'value' => '$data->Getimg($data)'),
                            /*
                              'barcode',
                              array('htmlOptions' => array('width' => '140'), 'header' => 'Item Image', 'name' => 'item_image', 'type' => 'raw', 'value' => '$data->Getimg($data)'),
                              'is_active',
                             */
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