<?php
/* @var $this UserledgerController */
/* @var $model Userledger */
?>

<?php
$this->breadcrumbs=array(
	'Userledgers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Userledger', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Userledger', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Userledger', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Userledger', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Update','Userledger '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>