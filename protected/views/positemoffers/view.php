<?php
/* @var $this PositemoffersController */
/* @var $model Positemoffers */
?>

<?php
$this->breadcrumbs=array(
	'Positemoffers'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Positemoffers', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Positemoffers', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Positemoffers', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Positemoffers', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Positemoffers', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Positemoffers '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'item_id',
		'offer_dscount',
		'offer_description',
		'from_date',
		'to_date',
		'status',
	),
)); ?>