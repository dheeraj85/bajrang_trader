<?php
/* @var $this CategorytaxesController */
/* @var $model Categorytaxes */
?>

<?php
$this->breadcrumbs=array(
	'Categorytaxes'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Categorytaxes', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Categorytaxes', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Categorytaxes', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Categorytaxes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Categorytaxes', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Categorytaxes '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'p_category_id',
		'tax_id',
	),
)); ?>