<?php
/* @var $this ShelfitemsController */
/* @var $model Shelfitems */
?>

<?php
$this->breadcrumbs=array(
	'Shelfitems'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Shelfitems', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Shelfitems', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Shelfitems', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Shelfitems', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Shelfitems', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Shelfitems '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'p_category_id',
		'p_sub_category_id',
		'item_id',
		'barcode',
		'tax_type',
	),
)); ?>