<?php
/* @var $this InvoicesettingsController */
/* @var $model Invoicesettings */
?>

<?php
$this->breadcrumbs=array(
	'Invoicesettings'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Invoicesettings', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Invoicesettings', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Invoicesettings', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Invoicesettings', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Invoicesettings', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Invoicesettings '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'type',
		'label',
		'value',
	),
)); ?>