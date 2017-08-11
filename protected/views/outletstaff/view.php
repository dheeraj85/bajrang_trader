<?php
/* @var $this OutletstaffController */
/* @var $model Outletstaff */
?>

<?php
$this->breadcrumbs=array(
	'Outletstaff'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Outletstaff', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Outletstaff', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Outletstaff', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Outletstaff', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Outletstaff', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Outletstaff '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'created_by',
		'first_name',
		'last_name',
		'mobile_no',
		'address',
		'loginid',
		'password',
		'staff_role',
	),
)); ?>