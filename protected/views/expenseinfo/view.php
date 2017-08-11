<?php
/* @var $this ExpenseinfoController */
/* @var $model Expenseinfo */
?>

<?php
$this->breadcrumbs=array(
	'Expenseinfos'=>array('index'),
	$model->name,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Expenseinfo', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Expenseinfo', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Expenseinfo', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Expenseinfo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Expenseinfo', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Expenseinfo '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'expense_head_id',
		'name',
		'reg_no',
		'particular',
		'voucher_no',
		'voucher_date',
		'created_by',
	),
)); ?>