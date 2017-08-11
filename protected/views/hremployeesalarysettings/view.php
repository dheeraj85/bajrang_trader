<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Employee Salary Settings'=> array('create'),
    'View Employee Salary Setting'
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Hremployeesalarysettings', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Hremployeesalarysettings', 'url' => array('create')),
    array('icon' => 'glyphicon glyphicon-edit', 'label' => 'Update Hremployeesalarysettings', 'url' => array('update', 'id' => $model->id)),
    array('icon' => 'glyphicon glyphicon-minus-sign', 'label' => 'Delete Hremployeesalarysettings', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Hremployeesalarysettings', 'url' => array('admin')),
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                    <h3 class="panel-title">View Employee Salary Setting</h3>
                </div>
                <div class="panel-body table-responsive">
                    <?php
                    $this->widget('zii.widgets.CDetailView', array(
                        'htmlOptions' => array(
                            'class' => 'table table-striped table-condensed table-hover',
                        ),
                        'data' => $model,
                        'attributes' => array(
                            //'id',
                            'employee.empname',
                            'total_ctc',
                            'per_day_ctc',
                            'pf_deduction',
                            'other_deduction',
                            'hra',
                            'earned_leaves',
                            'used_earned_leaves',
                            'medical_leaves',
                            'used_medical_leaves',
                            'lwp',
                            'used_lwp_leaves',
                        ),
                    ));
                    ?>
                </div>
            </div>
        </div>  
    </div>
</div>