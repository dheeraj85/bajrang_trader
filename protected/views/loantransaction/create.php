<?php
/* @var $this LoantransactionController */
/* @var $model Loantransaction */
?>

<?php
$this->breadcrumbs=array(
	'Loantransactions'=>array('index'),
	'Create',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Loantransaction', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Loantransaction', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Create','Loantransaction') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>