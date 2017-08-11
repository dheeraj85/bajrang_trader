<?php
/* @var $this IndentitemsissueController */
/* @var $model Indentitemsissue */
?>

<?php
$this->breadcrumbs=array(
	'Indentitemsissues'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Indentitemsissue', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Indentitemsissue', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Indentitemsissue', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Indentitemsissue', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Update','Indentitemsissue '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>