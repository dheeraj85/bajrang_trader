<?php
/* @var $this ChallanitemsController */
/* @var $model Challanitems */
?>

<?php
$this->breadcrumbs=array(
	'Challanitems'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Challanitems', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Challanitems', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Challanitems', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Challanitems', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Update','Challanitems '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>