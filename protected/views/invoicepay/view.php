<?php
/* @var $this InvoicepayController */
/* @var $model Invoicepay */
?>

<?php
$this->breadcrumbs=array(
	'Invoicepays'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Invoicepay', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Invoicepay', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Invoicepay', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Invoicepay', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Invoicepay', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Invoicepay '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'invoice_id',
		'paymode',
		'amount',
		'dated',
		'cheque_dd_txn_no',
		'bankname',
		'branch',
	),
)); ?>