<?php
/* @var $this ItemledgerController */
/* @var $model Itemledger */
?>

<?php
$this->breadcrumbs=array(
	'Itemledgers'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Itemledger', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Itemledger', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Itemledger', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Itemledger', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Itemledger', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Itemledger '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'item_id',
		'invoice_id',
		'stock_type',
		'debit_qty',
		'credit_qty',
		'balance_qty',
		'dated',
		'description',
	),
)); ?>