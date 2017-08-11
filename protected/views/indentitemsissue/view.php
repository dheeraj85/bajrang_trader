<?php
/* @var $this IndentitemsissueController */
/* @var $model Indentitemsissue */
?>

<?php
$this->breadcrumbs=array(
	'Indentitemsissues'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Indentitemsissue', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Indentitemsissue', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Indentitemsissue', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Indentitemsissue', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Indentitemsissue', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Indentitemsissue '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'internal_id',
		'p_category_id',
		'p_sub_category_id',
		'item_id',
		'item_name',
		'item_brand',
		'issue_qty',
		'issue_date',
		'issue_purpose',
		'created_by',
		'created_user_role',
		'is_issue_done',
	),
)); ?>