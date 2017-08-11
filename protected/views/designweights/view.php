<?php
/* @var $this DesignweightsController */
/* @var $model Designweights */
?>

<?php
$this->breadcrumbs=array(
	'Designweights'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Designweights', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Designweights', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Designweights', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Designweights', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Designweights', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Designweights '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'design_id',
		'weight_for_design',
	),
)); ?>