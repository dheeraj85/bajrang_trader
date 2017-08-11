<?php
/* @var $this PurchaseorderController */
/* @var $model Purchaseorder */
?>

<?php
$this->breadcrumbs=array(
	'Purchaseorders'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Purchaseorder', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Purchaseorder', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Purchaseorder', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Purchaseorder', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Purchaseorder', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Purchaseorder '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'supplier_id',
		'order_status',
		'created_by',
		'order_date',
	),
)); ?>