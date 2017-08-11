<?php
/* @var $this EmployeebenifitsController */
/* @var $model Employeebenifits */
?>

<?php
$this->breadcrumbs=array(
	'Employeebenifits'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Employeebenifits', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Employeebenifits', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Employeebenifits', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Employeebenifits', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Employeebenifits', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Employeebenifits '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'employee_id',
		'txn_type',
		'month',
		'year',
		'amount',
		'interest',
		'dated',
	),
)); ?>