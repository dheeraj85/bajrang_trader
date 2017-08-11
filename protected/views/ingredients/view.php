<?php
/* @var $this IngredientsController */
/* @var $model Ingredients */
?>

<?php
$this->breadcrumbs=array(
	'Ingredients'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Ingredients', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Ingredients', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Ingredients', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Ingredients', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Ingredients', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Ingredients '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'recipe_item_id',
		'item_id',
		'weight_in_gm',
		'description',
	),
)); ?>