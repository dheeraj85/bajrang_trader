<?php
/* @var $this IndentitemsissueController */
/* @var $model Indentitemsissue */
?>

<?php
$this->breadcrumbs=array(
	'Indentitemsissues'=>array('index'),
	'Create',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Indentitemsissue', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Indentitemsissue', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Create','Indentitemsissue') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>