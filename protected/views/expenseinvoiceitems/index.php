<?php
/* @var $this ExpenseinvoiceitemsController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Expenseinvoiceitems',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Expenseinvoiceitems', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Expenseinvoiceitems', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Expenseinvoiceitems') ?>
<?php $this->widget('bootstrap.widgets.BsListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>