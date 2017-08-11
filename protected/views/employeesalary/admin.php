<?php
/* @var $this EmployeesalaryController */
/* @var $model Employeesalary */


$this->breadcrumbs = array(
    'Home' => array('site/cmsdashboard'),
    'Human Resource' => array('employee/index'),
    'Employees Salary',
);


$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Employeesalary', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Employeesalary', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#employeesalary-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<style type="text/css">
    .update,.delete{
        display:none; 
    }
</style>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">     
            <a href="<?php echo $this->createUrl('employeesalary/create'); ?>" class="btn btn-primary pull-right">Add Employee Salary</a>
            <div style="clear:both"></div>
            <div class="box">
                <div class="box-header btn-primary">
                    <h3 class="panel-title">Employee Salary List</h3>
                </div>
                <div class="panel-body">
                    <div class="search-form">
                        <?php
                        $this->renderPartial('_search', array(
                            'model' => $model,
                        ));
                        ?>
                    </div>
                    <!-- search-form -->

                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'employeesalary-grid',
                        'type' => 'bordered',
                        'dataProvider' => $model->search(),
                        //'filter' => $model,
                        'columns' => array(
                            //'id',
                            array('htmlOptions' => array('width' => '100'), 'name' => 'employee_id', 'type' => 'raw', 'value' => '$data->employee->empname'),
                            array('htmlOptions' => array(), 'header' => 'Month', 'name' => 'month', 'type' => 'raw', 'value' => 'Employeesalary::request($data)'),
                            'year',
                           // 'payment_mode',
                            'dated',
                            //'total_present_days',
                            //'total_absent_days',
                            //'total_leave_days',
                            'amount',
                            'advance',
                            'incentive',
                            'ta',
                            'da',
                            'hra',
                            'salary_deduction',
                            //'remark',
                            'total_salary',
                            'voucher_no',
                            array(
                                'class' => 'bootstrap.widgets.BsButtonColumn',
                            ),
                        ),
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>