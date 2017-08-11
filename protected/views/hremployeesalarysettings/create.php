<?php
/* @var $this HremployeesalarysettingsController */
/* @var $model Hremployeesalarysettings */
?>

<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Human Resource' => array('employee/index'),
    'Employee Salary Settings',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Hremployeesalarysettings', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Hremployeesalarysettings', 'url' => array('admin')),
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
                    <h3 class="panel-title">Employee Salary Settings</h3>
                </div>
                <div class="panel-body">
                    <?php $this->renderPartial('_form', array('model' => $model)); ?>
                </div>
            </div>     
        </div>  
    </div>  
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                    <h3 class="panel-title">Manage Salary Settings</h3>
                </div>
                <div class="panel-body">
                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'employeesalarysettings-grid',
                        'type'=>'bordered',
                        'dataProvider' => $model->search(),
//			'filter'=>$model,
                        'columns' => array(
//        		'id',
                            array('htmlOptions' => array('width' => '100'), 'name' => 'employee_id', 'type' => 'raw', 'value' => '$data->employee->empname'),
                            array('htmlOptions' => array('width' => '100'), 'header' => 'Designation','name' => 'employee_id', 'type' => 'raw', 'value' => '$data->employee->designation->name'),
//       'employee_id',
                            'total_ctc',
                            'per_day_ctc',
                            'pf_deduction',
                            'other_deduction',
                            'hra',
                            'earned_leaves',
                            //'used_earned_leaves',
                            'medical_leaves',
                            //'used_medical_leaves',
                            'lwp',
                            //'used_lwp_leaves',
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