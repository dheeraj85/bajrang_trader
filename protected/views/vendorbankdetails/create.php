<?php
/* @var $this VendorbankdetailsController */
/* @var $model Vendorbankdetails */
?>

<?php
$this->breadcrumbs=array(
	'Vendorbankdetails'=>array('index'),
	'Create',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Vendorbankdetails', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Vendorbankdetails', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Create','Vendorbankdetails') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>