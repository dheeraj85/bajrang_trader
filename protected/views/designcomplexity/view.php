<?php
/* @var $this DesigncomplexityController */
/* @var $model Designcomplexity */
?>

<?php
$this->breadcrumbs=array(
	'Designcomplexities'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Designcomplexity', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Designcomplexity', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Designcomplexity', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Designcomplexity', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Designcomplexity', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Designcomplexity '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'design_code',
		'description',
		'rate',
	),
)); ?>