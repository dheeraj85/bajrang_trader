<?php
/* @var $this VendoritemsupplyController */
/* @var $model Vendoritemsupply */
?>

<?php
$this->breadcrumbs=array(
	'Vendoritemsupplies'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Vendoritemsupply', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Vendoritemsupply', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Vendoritemsupply', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Vendoritemsupply', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Vendoritemsupply', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Vendoritemsupply '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'vendor_id',
		'purchase_item_id',
	),
)); ?>