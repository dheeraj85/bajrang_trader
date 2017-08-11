<?php
/* @var $this BankdetailsController */
/* @var $model Bankdetails */
?>

<?php
$this->breadcrumbs=array(
	'Bankdetails'=>array('index'),
	'Create',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Bankdetails', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Bankdetails', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Create','Bankdetails') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>