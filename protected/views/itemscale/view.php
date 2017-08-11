<?php
/* @var $this ItemscaleController */
/* @var $model Itemscale */
?>

<?php
$this->breadcrumbs=array(
	'Itemscales'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Itemscale', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Itemscale', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Itemscale', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Itemscale', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Itemscale', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Itemscale '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'scale_type',
		'type_name',
	),
)); ?>