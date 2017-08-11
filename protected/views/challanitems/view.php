<?php
/* @var $this ChallanitemsController */
/* @var $model Challanitems */
?>

<?php
$this->breadcrumbs=array(
	'Challanitems'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Challanitems', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Challanitems', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Challanitems', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Challanitems', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Challanitems', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Challanitems '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'challan_id',
		'item_id',
		'item_name',
		'item_code',
		'weight',
		'rate',
		'amount',
		'added_date',
	),
)); ?>