<?php
$this->breadcrumbs=array(
	'Home'=>array('site/dashboard'),
	'Employee Salary Settings'=>array('create'),
	'Update Employee Salary Settings',
);
$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Hremployeesalarysettings', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Hremployeesalarysettings', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Hremployeesalarysettings', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Hremployeesalarysettings', 'url'=>array('admin')),
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                <div class="pull-left">
                    <h3 class="panel-title">Update Hr Employee Salary Settings</h3>
                </div>
                </div>
                <div class="panel-body">
                    <?php $this->renderPartial('_form', array('model' => $model)); ?>
                </div>
            </div>     
        </div>  
    </div>  
</div>  