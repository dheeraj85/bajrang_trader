<?php
/* @var $this UsersloginsController */
/* @var $model Userslogins */
?>

<?php
$this->breadcrumbs=array(
	'Userslogins'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Userslogins', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Userslogins', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Userslogins', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Userslogins', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Update','Userslogins '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>