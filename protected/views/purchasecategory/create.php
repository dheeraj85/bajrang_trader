<?php
/* @var $this PurchasecategoryController */
/* @var $model Purchasecategory */
?>

<?php
$this->breadcrumbs=array(
	'Purchasecategories'=>array('index'),
	'Create',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Purchasecategory', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Purchasecategory', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Create','Purchasecategory') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>