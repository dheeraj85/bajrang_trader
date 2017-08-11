<?php
/* @var $this VendorbankdetailsController */
/* @var $model Vendorbankdetails */
?>

<?php
$this->breadcrumbs = array(
    'Home'=>array('site/dashboard'),
    'Vendor Bank details' => array('admin'),
    //$model->id => array('view', 'id' => $model->id),
    'Update Vendor Bank Details',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Vendorbankdetails', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Vendorbankdetails', 'url' => array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt', 'label' => 'View Vendorbankdetails', 'url' => array('view', 'id' => $model->id)),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Vendorbankdetails', 'url' => array('admin')),
);
?>

<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header with-border bg-green">
                    <h3 class="panel-title">Edit Vendor Bank Details</h3>
                </div>
                <div class="panel-body">
                    <?php
                    $this->renderPartial('_form', array(
                        'model' => $model
                    ));
                    ?>
                </div>
            </div>     
        </div> 
    </div> 
</div> 