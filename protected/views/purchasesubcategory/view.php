<?php
/* @var $this PurchasesubcategoryController */
/* @var $model Purchasesubcategory */
?>

<?php
$this->breadcrumbs=array(
	'Purchasesubcategories'=>array('index'),
	$model->name,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Purchasesubcategory', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Purchasesubcategory', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Purchasesubcategory', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Purchasesubcategory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Purchasesubcategory', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Purchasesubcategory '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'category_id',
		'name',
		'type',
		'description',
		'is_active',
	),
)); ?>