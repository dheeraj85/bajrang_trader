<?php
/* @var $this StaffattendanceController */
/* @var $model Staffattendance */
?>

<?php
$this->breadcrumbs=array(
	'Staffattendances'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Staffattendance', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Staffattendance', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Staffattendance', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Staffattendance', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Update','Staffattendance '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>