<?php
/* @var $this VouchertypeController */
/* @var $model Vouchertype */
?>

<?php
$this->breadcrumbs=array(
	'Vouchertypes'=>array('index'),
	'Create',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Vouchertype', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Vouchertype', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Create','Vouchertype') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>