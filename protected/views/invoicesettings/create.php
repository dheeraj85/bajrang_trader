<?php
/* @var $this InvoicesettingsController */
/* @var $model Invoicesettings */
?>

<?php
$this->breadcrumbs=array(
	'Invoicesettings'=>array('index'),
	'Create',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Invoicesettings', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Invoicesettings', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Create','Invoicesettings') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>