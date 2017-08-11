<?php
/* @var $this BankdetailsController */
/* @var $model Bankdetails */
?>

<?php
$this->breadcrumbs=array(
	'Bankdetails'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Bankdetails', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Bankdetails', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Bankdetails', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Bankdetails', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Bankdetails', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Bankdetails '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'account_no',
		'account_holder',
		'bank_name',
		'branch',
		'ifsc',
	),
)); ?>