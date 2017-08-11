<?php
/* @var $this IndentmasterController */
/* @var $model Indentmaster */
?>

<?php
$this->breadcrumbs=array(
	'Indentmasters'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Indentmaster', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Indentmaster', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Indentmaster', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Indentmaster', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Update','Indentmaster '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>