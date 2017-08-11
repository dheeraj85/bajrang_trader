<?php
/* @var $this ItemledgerController */
/* @var $model Itemledger */
?>

<?php
$this->breadcrumbs=array(
	'Itemledgers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Itemledger', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Itemledger', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Itemledger', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Itemledger', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Update','Itemledger '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>