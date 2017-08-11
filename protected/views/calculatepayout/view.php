<?php
/* @var $this CalculatepayoutController */
/* @var $model Calculatepayout */
?>

<?php
$this->breadcrumbs=array(
	'Calculatepayouts'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Calculatepayout', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Calculatepayout', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Calculatepayout', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Calculatepayout', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Calculatepayout', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Calculatepayout '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'kata_parchy_id',
		'customer_id',
		'load_wgt',
		'amount',
		'payment_mode',
		'payment_date',
		'c_number_t_num_utr_num',
		'account_no',
		'bank_card_name',
		'remark',
		'dated',
		'is_paid',
	),
)); ?>