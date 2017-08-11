<?php
/* @var $this ExpenseinvoiceitemsController */
/* @var $model Expenseinvoiceitems */
?>

<?php
$this->breadcrumbs=array(
	'Expenseinvoiceitems'=>array('index'),
	'Create',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Expenseinvoiceitems', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Expenseinvoiceitems', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Create','Expenseinvoiceitems') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>