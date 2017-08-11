<?php
/* @var $this VendoritemsupplyController */
/* @var $model Vendoritemsupply */
?>

<?php
$this->breadcrumbs=array(
	'Vendoritemsupplies'=>array('index'),
	'Create',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Vendoritemsupply', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Vendoritemsupply', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Create','Vendoritemsupply') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>