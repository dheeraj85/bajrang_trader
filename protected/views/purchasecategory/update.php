<?php
/* @var $this PurchasecategoryController */
/* @var $model Purchasecategory */
?>

<?php
$this->breadcrumbs=array(
        'Home'=>array('site/cmsdashboard'),
        'Item Master',
	'Purchase Category',
	//$model->name=>array('view','id'=>$model->id),
	'Update Purchase Category',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Purchasecategory', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Purchasecategory', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Purchasecategory', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Purchasecategory', 'url'=>array('admin')),
);
?>
<div class='form-css'>
    <div class='row'>
    <div class="col-lg-12">
    <div class="col-lg-6">
         <div class="box box-primary">
        <div class="box-header bg-aqua">
            <h3 class="panel-title">Update Product Category</h3>
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
    </div>
    </div>
</div>