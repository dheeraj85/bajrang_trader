<?php
/* @var $this TickettypeController */
/* @var $model Tickettype */
?>

<?php
$this->breadcrumbs=array(
	'Tickettypes'=>array('index'),
	'Create',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Tickettype', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Tickettype', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Create','Tickettype') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>