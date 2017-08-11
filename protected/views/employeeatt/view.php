<?php
/* @var $this StaffattendanceController */
/* @var $model Staffattendance */
?>

<?php
$this->breadcrumbs=array(
	'Staffattendances'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Staffattendance', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Staffattendance', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Staffattendance', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Staffattendance', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Staffattendance', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Staffattendance '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'session',
		'subcategory',
		'staff_id',
		'attendance',
		'in_time',
		'out_time',
		'half_day',
		'teacher_id',
		'date',
		'is_approved',
	),
)); ?>