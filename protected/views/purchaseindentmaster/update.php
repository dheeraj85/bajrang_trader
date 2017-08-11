<?php
/* @var $this PurchaseindentmasterController */
/* @var $model Purchaseindentmaster */
?>

<?php
$this->breadcrumbs=array(
	'Purchaseindentmasters'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Purchaseindentmaster', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Purchaseindentmaster', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Purchaseindentmaster', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Purchaseindentmaster', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Update','Purchaseindentmaster '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>