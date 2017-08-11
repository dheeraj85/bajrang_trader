<?php
/* @var $this PurchaseorderitemsController */
/* @var $model Purchaseorderitems */
?>

<?php
$this->breadcrumbs=array(
	'Purchaseorderitems'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Purchaseorderitems', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Purchaseorderitems', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Purchaseorderitems', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Purchaseorderitems', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Update','Purchaseorderitems '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>