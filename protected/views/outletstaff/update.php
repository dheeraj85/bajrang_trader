<?php
/* @var $this OutletstaffController */
/* @var $model Outletstaff */
?>

<?php
$this->breadcrumbs=array(
     'Home' => array('site/dashboard'),
	'Outlet Staff Details'=>array('admin'),
	'Update Staff',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Outletstaff', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Outletstaff', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Outletstaff', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Outletstaff', 'url'=>array('admin')),
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                    <h3 class="panel-title">Update Outlet Staff</h3>
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