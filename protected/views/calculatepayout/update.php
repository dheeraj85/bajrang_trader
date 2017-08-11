<?php
/* @var $this CalculatepayoutController */
/* @var $model Calculatepayout */
?>

<?php
$this->breadcrumbs=array(
	'Calculatepayouts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Calculatepayout', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Calculatepayout', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Calculatepayout', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Calculatepayout', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Update','Calculatepayout '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>