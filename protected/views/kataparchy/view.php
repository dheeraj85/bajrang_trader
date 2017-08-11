<?php
/* @var $this KataparchyController */
/* @var $model Kataparchy */
?>

<?php
$this->breadcrumbs=array(
	'Kataparchies'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Kataparchy', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Kataparchy', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Kataparchy', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Kataparchy', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Kataparchy', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Kataparchy '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'purchase_invoice_id',
		'challan_id',
		'order_no',
		'item_id',
		'item_name',
		'item_code',
		'load_weight',
		'net_weight',
		'truck_wagon_no',
	),
)); ?>