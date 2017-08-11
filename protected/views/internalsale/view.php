<?php
/* @var $this OffshelfsaleController */
/* @var $model Offshelfsale */
?>

<?php
$this->breadcrumbs=array(
	'Offshelfsales'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Offshelfsale', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Offshelfsale', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Offshelfsale', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Offshelfsale', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Offshelfsale', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Offshelfsale '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'invoice_number',
		'memo_number',
		'txn_type',
		'customer_name',
		'customer_mobile',
		'customer_id',
		'counter_id',
		'created_by',
		'order_date',
		'order_time',
		'comment',
	),
)); ?>