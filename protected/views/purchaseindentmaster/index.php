<?php
/* @var $this PurchaseindentmasterController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Purchaseindentmasters',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Purchaseindentmaster', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Purchaseindentmaster', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Purchaseindentmasters') ?>
<?php $this->widget('bootstrap.widgets.BsListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>