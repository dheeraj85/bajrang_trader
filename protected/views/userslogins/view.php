<?php
/* @var $this UsersloginsController */
/* @var $model Userslogins */
?>

<?php
$this->breadcrumbs=array(
	'Userslogins'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Userslogins', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Userslogins', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Userslogins', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Userslogins', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Userslogins', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Userslogins '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'log_type',
		'in_out',
	),
)); ?>