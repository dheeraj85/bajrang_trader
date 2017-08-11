<?php
/* @var $this PurchasesubcategoryController */
/* @var $model Purchasesubcategory */


$this->breadcrumbs = array(
    'Home'=>array('site/cmsdashboard'),
    'Item Master'=>array('purchasecategory/index'),
    'Product Sub Category',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Purchasesubcategory', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Purchasesubcategory', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#purchasesubcategory-grid').yiiGridView('update', {
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
            <div class="col-lg-5">
                <div class="box box-primary">
                    <div class="box-header with-border bg-aqua">
                        <h3 class="panel-title">Add Product Sub Category</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                        $this->renderPartial('_form', array(
                            'model' => $model,
                        ));
                        ?>
                    </div>
                </div>
            </div>  
            <div class="col-lg-7">
                <div class="box box-primary">
                    <div class="box-header with-border bg-aqua">
                        <h3 class="panel-title">Manage Product Sub Category</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                        $this->widget('bootstrap.widgets.BsGridView', array(
                            'id' => 'purchasesubcategory-grid',
                            'type'=>'bordered',
                            'dataProvider' => $model->search(),
                            //'filter' => $model,
                            'columns' => array(
                               // 'id',
                                array('htmlOptions' => array('width' => '100'), 'header' => 'Category', 'name' => 'category_id', 'type' => 'raw', 'value' => '$data->category->name'),
                                'name',
                                'type',
                                'description',
                                //'is_active',
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
</div>



