<?php
/* @var $this ExpenseheadsController */
/* @var $model Expenseheads */
?>

<?php
$this->breadcrumbs=array(
	'Expenseheads'=>array('index'),
	$model->name,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Expenseheads', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Expenseheads', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Expenseheads', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Expenseheads', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Expenseheads', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Expenseheads '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>