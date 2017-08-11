<?php
/* @var $this EmployeesalaryController */
/* @var $model Employeesalary */
?>

<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Employees Salary'=> array('admin'),
    'Salary',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Employeesalary', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Employeesalary', 'url' => array('admin')),
);
?>

<style>
    .delete{
        display: none;
    }
</style>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                    <h3 class="panel-title">Add Employee Salary</h3>
                </div>
                <div class="panel-body">
                    <?php $this->renderPartial('_form', array('model' => $model)); ?>
                </div>
            </div>     
        </div>  
    </div> 
</div>