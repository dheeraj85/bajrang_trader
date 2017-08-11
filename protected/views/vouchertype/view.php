<?php
/* @var $this VouchertypeController */
/* @var $model Vouchertype */
?>

<?php
$this->breadcrumbs=array(
	'Vouchertypes'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Vouchertype', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Vouchertype', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Vouchertype', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Vouchertype', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Vouchertype', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Vouchertype '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'voucher_name',
		'payment_receiver_type',
		'voucher_nature',
		'description',
	),
)); ?>