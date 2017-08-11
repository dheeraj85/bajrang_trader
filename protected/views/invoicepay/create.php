<?php
/* @var $this InvoicepayController */
/* @var $model Invoicepay */
?>

<?php
$this->breadcrumbs=array(
	'Invoicepays'=>array('index'),
	'Create',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Invoicepay', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Invoicepay', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Create','Invoicepay') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>