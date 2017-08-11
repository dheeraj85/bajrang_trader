<?php
/* @var $this EmployeeController */
/* @var $model Employee */
?>

<?php
$this->breadcrumbs = array(
    'Home' => array('site/cmsdashboard'),
    'Employees'=>array('admin'),
    'View Employee',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Employee', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Employee', 'url' => array('create')),
    array('icon' => 'glyphicon glyphicon-edit', 'label' => 'Update Employee', 'url' => array('update', 'id' => $model->id)),
    array('icon' => 'glyphicon glyphicon-minus-sign', 'label' => 'Delete Employee', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Employee', 'url' => array('admin')),
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                    <h3 class="panel-title">View Employee Details</h3>
                </div>
                <div class="panel-body table-responsive">
                    <?php
                    $this->widget('zii.widgets.CDetailView', array(
                        'htmlOptions' => array(
                            'class' => 'table table-striped table-condensed table-hover',
                        ),
                        'data' => $model,
                        'attributes' => array(
                            'empcode',
                            'empname',
                            'fname',
                            'dob',
                            'contact',
                            'address',
                            'qualification',
                            'experience',
                            'speciality',
                            'martial_status',
                            'reference_by',
                            'aadhar_no',
                            'license_no',
                            'pan_no',
                            'account_no',
                            'bank_name',
                            'branch',
                            'ifsc',
                        ),
                    ));
                    ?>
                </div>
            </div>
        </div>  
    </div>
</div>