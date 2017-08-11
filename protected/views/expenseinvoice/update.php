<?php
/* @var $this ExpenseinvoiceController */
/* @var $model Expenseinvoice */
?>

<?php
$this->breadcrumbs=array(
	'Expenseinvoices'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Expenseinvoice', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Expenseinvoice', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Expenseinvoice', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Expenseinvoice', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Update','Expenseinvoice '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>