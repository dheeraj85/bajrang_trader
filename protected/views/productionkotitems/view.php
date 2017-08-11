<?php
/* @var $this ProductionkotitemsController */
/* @var $model Productionkotitems */
?>

<?php
$this->breadcrumbs=array(
	'Productionkotitems'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Productionkotitems', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Productionkotitems', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Productionkotitems', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Productionkotitems', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Productionkotitems', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Productionkotitems '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'production_kot_id',
		'menu_item_id',
		'qty',
		'status',
	),
)); ?>