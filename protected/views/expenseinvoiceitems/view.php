<?php
/* @var $this ExpenseinvoiceitemsController */
/* @var $model Expenseinvoiceitems */
?>

<?php
$this->breadcrumbs=array(
	'Expenseinvoiceitems'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Expenseinvoiceitems', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Expenseinvoiceitems', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Expenseinvoiceitems', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Expenseinvoiceitems', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Expenseinvoiceitems', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Expenseinvoiceitems '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'invoice_id',
		'item_id',
		'goods_service',
		'hsn_sac_code',
		'vendor_hsn_sac_code',
		'vendor_tax_percent',
		'unmatched_code',
		'is_reverse_charge',
		'is_reverse_item',
		'particulars',
		'rate',
		'amount',
		'discount',
		'item_tax_type',
		'tax_percent_rate',
		'tax_amt',
		'cess_rate',
		'cess_amt',
		'ut_rate',
		'ut_amt',
		'is_active',
		'is_added_to_stock',
		'is_good_return',
		'is_choice_tax',
	),
)); ?>