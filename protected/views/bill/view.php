<?php
/* @var $this BillController */
/* @var $model Bill */
?>

<?php
$this->breadcrumbs=array(
	'Bills'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Bill', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Bill', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Bill', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Bill', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Bill', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Bill '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'bill_no',
		'bill_date',
		'bill_from_date',
		'bill_to_date',
		'customer_id',
		'purchase_order_id',
		'bill_type',
		'print_type',
		'added_on',
		'particulars',
	),
)); ?>