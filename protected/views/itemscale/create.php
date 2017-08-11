<?php
/* @var $this ItemscaleController */
/* @var $model Itemscale */
?>

<?php
$this->breadcrumbs=array(
	'Itemscales'=>array('index'),
	'Create',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Itemscale', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Itemscale', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Create','Itemscale') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>