<?php
/* @var $this DesignationController */
/* @var $model Designation */
?>

<?php
$this->breadcrumbs=array(
        'Home'=>array('site/cmsdashboard'),
        'HR CMS',
	//'HR Designations'=>array('admin'),
	//$model->name=>array('view','id'=>$model->id),
	'Update Designation',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Designation', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Designation', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Designation', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Designation', 'url'=>array('admin')),
);
?>
<div class='form-css'>
    <div class='row'>
    <div class="col-lg-12">
    <div class="col-lg-6">
         <div class="box box-primary">
        <div class="box-header bg-aqua">
            <h3 class="panel-title">Update HR Designation</h3>
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
</div>