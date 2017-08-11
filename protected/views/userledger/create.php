<?php
/* @var $this UserledgerController */
/* @var $model Userledger */
?>

<?php
$this->breadcrumbs=array(
	'Userledgers'=>array('index'),
	'Create',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Userledger', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Userledger', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Create','Userledger') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>