<?php
/* @var $this PurchasecategoryController */
/* @var $model Purchasecategory */


$this->breadcrumbs = array(
    'Home'=>array('site/cmsdashboard'),
    'Item Master'=>array('purchasecategory/index'),
    'Product Category',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Purchasecategory', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Purchasecategory', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#purchasecategory-grid').yiiGridView('update', {
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
                        <h3 class="panel-title">Add Product Category</h3>
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
                        <h3 class="panel-title">Manage Product Category</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                        $this->widget('bootstrap.widgets.BsGridView', array(
                            'id' => 'purchasecategory-grid',
                            'type'=>'bordered',
                            'dataProvider' => $model->search(),
                           // 'filter' => $model,
                            'columns' => array(
                                //'id',
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