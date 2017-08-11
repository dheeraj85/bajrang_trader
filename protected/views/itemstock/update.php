<?php
/* @var $this ItemstockController */
/* @var $model Itemstock */
?>

<?php
$this->breadcrumbs=array(
	'Itemstocks'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Itemstock', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Itemstock', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Itemstock', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Itemstock', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Update','Itemstock '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>