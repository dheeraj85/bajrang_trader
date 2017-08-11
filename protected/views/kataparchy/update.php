<?php
/* @var $this KataparchyController */
/* @var $model Kataparchy */
?>

<?php
$this->breadcrumbs=array(
	'Kataparchies'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Kataparchy', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Kataparchy', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Kataparchy', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Kataparchy', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Update','Kataparchy '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>