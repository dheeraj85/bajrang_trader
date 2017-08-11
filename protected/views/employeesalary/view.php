<?php
$this->breadcrumbs = array(
    'Home' => array('site/cmsdashboard'),
    'Employees Salary' => array('admin'),
    'View Employee Salary',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Employeesalary', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Employeesalary', 'url' => array('create')),
    array('icon' => 'glyphicon glyphicon-edit', 'label' => 'Update Employeesalary', 'url' => array('update', 'id' => $model->id)),
    array('icon' => 'glyphicon glyphicon-minus-sign', 'label' => 'Delete Employeesalary', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Employeesalary', 'url' => array('admin')),
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                    <h3 class="panel-title">View Employee Salary</h3>
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
                            'month',
                            'year',
                            'payment_mode',
                            'voucher_no',
                            'dated',
                            'total_present_days',
                            'total_absent_days',
                            'total_leave_days',
                            'amount',
                            'advance',
                            'incentive',
                            'ta',
                            'da',
                            'hra',
                            'salary_deduction',
                            'remark',
                            'total_salary',
                        ),
                    ));
                    ?>
                </div>
            </div>
        </div>  
    </div>
</div>