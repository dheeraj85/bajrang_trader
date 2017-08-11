<?php
/* @var $this ItemstockController */
/* @var $model Itemstock */
?>

<?php
$this->breadcrumbs=array(
	'Itemstocks'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Itemstock', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Itemstock', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Itemstock', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Itemstock', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Itemstock', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Itemstock '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'invoice_id',
		'item_id',
		'particulars',
		'stock_qty',
		'stock_taking_scale',
		'rate',
		'amount',
		'is_mrd',
		'mrd_no',
		'make_date',
		'ready_date',
		'discard_date',
		'is_active',
	),
)); ?>