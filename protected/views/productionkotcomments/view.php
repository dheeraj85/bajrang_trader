<?php
/* @var $this ProductionkotcommentsController */
/* @var $model Productionkotcomments */
?>

<?php
$this->breadcrumbs=array(
	'Productionkotcomments'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Productionkotcomments', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Productionkotcomments', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Productionkotcomments', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Productionkotcomments', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Productionkotcomments', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Productionkotcomments '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'production_kot_id',
		'from_id',
		'to_id',
		'comments',
		'dated',
	),
)); ?>