<?php
/* @var $this VendorController */
/* @var $model Vendor */
?>

<?php
$this->breadcrumbs=array(
	'Vendors'=>array('index'),
	$model->name,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Vendor', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Vendor', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Vendor', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Vendor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Vendor', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Vendor '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'firm_name',
		'mobile',
		'contact_no',
		'email',
		'tin_no',
		'pan_no',
		'address',
		'created_by',
		'created_date',
	),
)); ?>