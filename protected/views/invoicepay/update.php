<?php
/* @var $this InvoicepayController */
/* @var $model Invoicepay */
?>

<?php
$this->breadcrumbs=array(
	'Invoicepays'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Invoicepay', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Invoicepay', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Invoicepay', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Invoicepay', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Update','Invoicepay '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>