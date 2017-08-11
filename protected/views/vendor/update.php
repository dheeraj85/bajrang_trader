<?php
/* @var $this VendorController */
/* @var $model Vendor */
?>

<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Vendor Management',
    //'Vendor Details' => array('admin'),
    //$model->name=>array('view','id'=>$model->id),
    'Update Vendor Details',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Vendor', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Vendor', 'url' => array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt', 'label' => 'View Vendor', 'url' => array('view', 'id' => $model->id)),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Vendor', 'url' => array('admin')),
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header bg-green">
                    <h3 class="panel-title">Update Vendor Details</h3>
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