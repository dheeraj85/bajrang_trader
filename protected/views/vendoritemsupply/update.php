<?php
/* @var $this VendoritemsupplyController */
/* @var $model Vendoritemsupply */
?>

<?php
$this->breadcrumbs=array(
	'Vendoritemsupplies'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Vendoritemsupply', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Vendoritemsupply', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Vendoritemsupply', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Vendoritemsupply', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Update','Vendoritemsupply '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>