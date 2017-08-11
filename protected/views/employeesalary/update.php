<?php
/* @var $this EmployeesalaryController */
/* @var $model Employeesalary */
?>

<?php
$this->breadcrumbs=array(
	'Home'=>array('site/dashboard'),
	'Employee'=>array('employee/admin'),
	'Employee Salary'=>array('create'),
//	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Employeesalary', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Employeesalary', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Employeesalary', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Employeesalary', 'url'=>array('admin')),
);
?>

<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                <div class="pull-left">
                    <h3 class="panel-title">Update Employee Salary</h3>
                </div>
                <div class="pull-right">
                    <a class="btn btn-default" href="<?php echo $this->createUrl('employeesalary/create') ?>"><i class="glyphicon glyphicon-backward"></i> Back</a>
                </div>
                </div>
                <div class="panel-body">
                    <?php $this->renderPartial('_form', array('model' => $model)); ?>
                </div>
            </div>     
        </div>  
    </div>  
</div>  