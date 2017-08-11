<?php
/* @var $this UsersloginsController */
/* @var $model Userslogins */
?>

<?php
$this->breadcrumbs=array(
	'Userslogins'=>array('index'),
	'Create',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Userslogins', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Userslogins', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Create','Userslogins') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>