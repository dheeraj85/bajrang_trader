<?php
/* @var $this PurchasesubcategoryController */
/* @var $model Purchasesubcategory */
?>

<?php
$this->breadcrumbs=array(
	'Purchasesubcategories'=>array('index'),
	'Create',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Purchasesubcategory', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Purchasesubcategory', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Create','Purchasesubcategory') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>