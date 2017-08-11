<?php
/* @var $this ExpenseinvoiceController */
/* @var $model Expenseinvoice */
?>

<?php
$this->breadcrumbs=array(
	'Expenseinvoices'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Expenseinvoice', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Expenseinvoice', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Expenseinvoice', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Expenseinvoice', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Expenseinvoice', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Expenseinvoice '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'expense_heads_id',
		'invoice_type',
		'gstin_no',
		'is_gstn_compliant',
		'compliants_category',
		'place_of_supply',
		'state_code',
		'invoice_no',
		'invoice_date',
		'vendor_name',
		'vendor_id',
		'received_by',
		'discount_type',
		'total_amount',
		'total_discount',
		'round_off',
		'is_added_to_stock',
		'is_reviewed',
		'review_point',
		'review_desc',
		'truck_wagon_no',
		'truck_wagon_owner_name',
		'driver_name',
		'driver_contact',
		'driver_lic_no',
		'rr_no',
		'transport_name',
		'dispatch_from',
		'dispatch_to',
		'crossing',
		'created_by',
		'updated_by',
		'created_date',
	),
)); ?>