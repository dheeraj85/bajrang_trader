<?php
/* @var $this EmployeeController */
/* @var $model Employee */
?>

<?php
$this->breadcrumbs=array(
     'Home' => array('site/dashboard'),
	'Employee Details'=>array('admin'),
	//$model->id=>array('view','id'=>$model->id),
	'Update Vendor Details',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Employee', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Employee', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Employee', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Employee', 'url'=>array('admin')),
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                    <h3 class="panel-title">Update Employee Details</h3>
                </div>
                <div class="panel-body">
                    <?php
                    $this->renderPartial('_form', array(
                        'model' => $model,
                    ));
                    ?>
                </div>
            </div>     
        </div>  
    </div>  
</div>  