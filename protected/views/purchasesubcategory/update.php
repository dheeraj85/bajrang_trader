<?php
/* @var $this PurchasesubcategoryController */
/* @var $model Purchasesubcategory */
?>

<?php
$this->breadcrumbs = array(
    'Home' => array('site/cmsdashboard'),
    'Item Master',
    'Purchase Sub Category',
    //$model->name=>array('view','id'=>$model->id),
    'Update Purchase Sub Category',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Purchasesubcategory', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Purchasesubcategory', 'url' => array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt', 'label' => 'View Purchasesubcategory', 'url' => array('view', 'id' => $model->id)),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Purchasesubcategory', 'url' => array('admin')),
);
?>

<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="col-lg-6">
                <div class="box box-primary">
                    <div class="box-header bg-aqua">
                        <h3 class="panel-title">Update Product Sub Category</h3>
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