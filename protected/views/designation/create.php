<?php
/* @var $this DesignationController */
/* @var $model Designation */
?>

<?php
$this->breadcrumbs=array(
	'Designations'=>array('index'),
	'Create',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Designation', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Designation', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Create','Designation') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>