<?php
/* @var $this IndentmasterController */
/* @var $model Indentmaster */
?>

<?php
$this->breadcrumbs=array(
	'Indentmasters'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Indentmaster', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Indentmaster', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Indentmaster', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Indentmaster', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Indentmaster', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Indentmaster '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'sync_id',
		'indent_date',
		'indent_type',
		'purchase_type',
		'created_by',
		'created_user_role',
		'supply_type',
		'invoice_id',
		'invoice_date',
		'issued_to',
		'discount',
		'remark',
		'is_indenting_done',
		'is_order_done',
		'is_sync',
		'sync_date',
	),
)); ?>