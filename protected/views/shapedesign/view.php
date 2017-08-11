<?php
/* @var $this ShapedesignController */
/* @var $model Shapedesign */
?>

<?php
$this->breadcrumbs=array(
	'Shapedesigns'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Shapedesign', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Shapedesign', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Shapedesign', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Shapedesign', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Shapedesign', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Shapedesign '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'shape_id',
		'design_name',
		'design_img',
		'design_description',
		'design_added_by',
		'added_by_id',
	),
)); ?>