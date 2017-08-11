<?php
/* @var $this LoantransactionController */
/* @var $model Loantransaction */
?>

<?php
$this->breadcrumbs=array(
	'Loantransactions'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Loantransaction', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Loantransaction', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Loantransaction', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Loantransaction', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Loantransaction', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Loantransaction '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'employee_id',
		'employee_benifits_id',
		'amount',
		'dated',
	),
)); ?>