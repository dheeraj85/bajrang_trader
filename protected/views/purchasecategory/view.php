<?php
/* @var $this PurchasecategoryController */
/* @var $model Purchasecategory */
?>

<?php
$this->breadcrumbs=array(
	'Purchasecategories'=>array('index'),
	$model->name,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Purchasecategory', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Purchasecategory', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Purchasecategory', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Purchasecategory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Purchasecategory', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Purchasecategory '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'type',
		'description',
		'is_active',
	),
)); ?>