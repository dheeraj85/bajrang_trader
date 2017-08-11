<?php
/* @var $this PurchaseindentmasterController */
/* @var $model Purchaseindentmaster */
?>

<?php
$this->breadcrumbs=array(
	'Purchaseindentmasters'=>array('index'),
	'Create',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Purchaseindentmaster', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Purchaseindentmaster', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Create','Purchaseindentmaster') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>