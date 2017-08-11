<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Purchase Invoice' => array('admin'),
    'View Invoice Entry',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Purchaseinvoice', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Purchaseinvoice', 'url' => array('create')),
    array('icon' => 'glyphicon glyphicon-edit', 'label' => 'Update Purchaseinvoice', 'url' => array('update', 'id' => $model->id)),
    array('icon' => 'glyphicon glyphicon-minus-sign', 'label' => 'Delete Purchaseinvoice', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Purchaseinvoice', 'url' => array('admin')),
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">      
            <div class="box">
                <div class="box-header bg-green">
                    <h3 class="panel-title">View Purchase Invoice Entry</h3>
                </div>
                <div class="panel-body">

                    <?php
                    $this->widget('zii.widgets.CDetailView', array(
                        'htmlOptions' => array(
                            'class' => 'table table-striped table-condensed table-hover',
                        ),
                        'data' => $model,
                        'attributes' => array(
                            //'id',
                            'invoice_type',
                            'invoice_no',
                            'invoice_date',
                            'vendor_name',
                            'land_owner',
                            'village',
                            'district',
                            'state',
                            'state_code',
                            'validity_of_pass_from',
                            'validity_of_pass_to',
                            'truck_wagon_no',
                            'truck_wagon_owner_name',
                            'lr_no',
                            'transport_name',
                            'driver_name',
                            'driver_contact',
                            'driver_lic_no',
                            'dispatch_from',
                            'dispatch_to',
                        ),
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>