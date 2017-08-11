<?php
/* @var $this ShelfitemsController */
/* @var $model Shelfitems */
?>

<?php
$this->breadcrumbs = array(
    'POS Management System' => array('positemoffers/index'),
    'Shelf Items',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Shelfitems', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Shelfitems', 'url' => array('admin')),
);
?>

<style>
    .view{
        display: none;
    }
</style>
<div class='form-css'>
    <!--    <div class='row'>
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-header btn-primary">
                        <h3 class="panel-title">Add Shelf Items</h3>
                    </div>
                    <div class="panel-body">
    <?php // $this->renderPartial('_form', array('model' => $model)); ?>
                    </div>
                </div>     
            </div>  
        </div>  -->
    <div class="alert alert-info">Off the Shelf Item's List. All list will populate on OTS/POS. 
        If any item not added 
        <a href="<?php echo $this->createUrl('purchaseitem/admin')?>">Click Here</a>
    </div>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                    <h3 class="panel-title">View / Manage Shelf Items</h3>
                </div>
                <div class="panel-body">
                            <div class="search-form">
                        <?php
                        $this->renderPartial('_searchShelfItems', array(
                            'model' => $model,
                        ));
                        ?>
                    </div>
                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'menuitems-grid',
                        'dataProvider' => $model->search(),
//                        'filter' => $model,
                        'columns' => array(
//        		'id',
                            array(
                                'name' => 'p_category_id',
                                'value' => '$data->pCategory->name'
                            ),
                            array(
                                'name' => 'p_sub_category_id',
                                'value' => '$data->pSubCategory->name'
                            ),
                            array(
                                'name' => 'item_id',
                                'value' => '$data->positem->itemname'
                            ),
                            'barcode',
                            'tax_type',
                            'sale_price',
                            'total_qty',
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
<script type="text/javascript">
$('.delete').click(function(){
    return confirm("Are you sure you want to delete this shelf item ?");
});
$(function(){
    $("#Shelfitems_item_name").focus();
});
</script>