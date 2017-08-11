<?php
/* @var $this ExpenseinvoiceitemsController */
/* @var $model Expenseinvoiceitems */
?>

<?php
$this->breadcrumbs=array(
	'Expenseinvoiceitems'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Expenseinvoiceitems', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Expenseinvoiceitems', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Expenseinvoiceitems', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Expenseinvoiceitems', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Update','Expenseinvoiceitems '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>