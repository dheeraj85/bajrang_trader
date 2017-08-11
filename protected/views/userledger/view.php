<?php
/* @var $this UserledgerController */
/* @var $model Userledger */
?>

<?php
$this->breadcrumbs=array(
	'Userledgers'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Userledger', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Userledger', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Userledger', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Userledger', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Userledger', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Userledger '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'type',
		'user_id',
		'debit_amt',
		'credit_amt',
		'balance_amt',
		'dated',
		'description',
	),
)); ?>