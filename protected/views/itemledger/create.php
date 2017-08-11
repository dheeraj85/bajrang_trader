<?php
/* @var $this ItemledgerController */
/* @var $model Itemledger */
?>

<?php
$this->breadcrumbs=array(
	'Itemledgers'=>array('index'),
	'Create',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Itemledger', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Itemledger', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Create','Itemledger') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>