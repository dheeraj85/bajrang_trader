<?php
/* @var $this PurchaseindentmasterController */
/* @var $model Purchaseindentmaster */
?>

<?php
$this->breadcrumbs=array(
	'Purchaseindentmasters'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Purchaseindentmaster', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Purchaseindentmaster', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Purchaseindentmaster', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Purchaseindentmaster', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Purchaseindentmaster', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Purchaseindentmaster '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'indend_date',
		'is_done',
		'created_by',
	),
)); ?>