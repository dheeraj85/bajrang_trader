<?php
/* @var $this UsersController */
/* @var $model Users */
?>

<?php
$this->breadcrumbs=array(
	'Home'=>array('site/dashboard'),
        'Users'=>array('admin'),
	//$model->name=>array('view','id'=>$model->id),
	'Update Account',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Users', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Users', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Users', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Users', 'url'=>array('admin')),
);
?>
<div class='form-css'>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="panel-title">Update Account</h3>
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