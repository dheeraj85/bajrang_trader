<?php
/* @var $this PurchaseorderitemsController */
/* @var $model Purchaseorderitems */
?>

<?php
$this->breadcrumbs=array(
	'Purchaseorderitems'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Purchaseorderitems', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Purchaseorderitems', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Purchaseorderitems', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Purchaseorderitems', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Purchaseorderitems', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Purchaseorderitems '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'purchase_order_id',
		'item_id',
		'item_name',
		'item_code',
		'qty_req',
		'qty_scale',
		'rate',
		'amount',
		'req_date',
	),
)); ?>