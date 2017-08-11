<?php
/* @var $this LoantransactionController */
/* @var $model Loantransaction */
?>

<?php
$this->breadcrumbs=array(
	'Loantransactions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Loantransaction', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Loantransaction', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Loantransaction', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Loantransaction', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Update','Loantransaction '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>