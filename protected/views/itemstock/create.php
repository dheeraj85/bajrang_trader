<?php
/* @var $this ItemstockController */
/* @var $model Itemstock */
?>

<?php
$this->breadcrumbs=array(
	'Itemstocks'=>array('index'),
	'Create',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Itemstock', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Itemstock', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Create','Itemstock') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>