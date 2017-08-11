<?php
/* @var $this PostaxesController */
/* @var $model Postaxes */
?>

<?php
$this->breadcrumbs=array(
	'Postaxes'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Postaxes', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Postaxes', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Postaxes', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Postaxes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Postaxes', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Postaxes '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'tax_name',
		'tax_percent',
		'description',
	),
)); ?>