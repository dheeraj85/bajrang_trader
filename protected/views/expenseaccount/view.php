<?php
/* @var $this ExpenseaccountController */
/* @var $model Expenseaccount */
?>

<?php
$this->breadcrumbs=array(
	'Expenseaccounts'=>array('index'),
	$model->name,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Expenseaccount', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Expenseaccount', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Expenseaccount', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Expenseaccount', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Expenseaccount', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Expenseaccount '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'expense_heads_id',
		'name',
		'firm_name',
		'mobile',
		'contact_no',
		'email',
		'gstin_no',
		'pan_no',
		'address',
		'created_by',
		'created_date',
		'description',
	),
)); ?>