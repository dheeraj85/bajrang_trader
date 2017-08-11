<?php
/* @var $this TickettypeController */
/* @var $model Tickettype */
?>

<?php
$this->breadcrumbs=array(
	'Tickettypes'=>array('index'),
	$model->name,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Tickettype', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Tickettype', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Tickettype', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Tickettype', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Tickettype', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Tickettype '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'code',
	),
)); ?>