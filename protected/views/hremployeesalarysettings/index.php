<?php
/* @var $this HremployeesalarysettingsController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Hremployeesalarysettings',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Hremployeesalarysettings', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Hremployeesalarysettings', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Hremployeesalarysettings') ?>
<?php $this->widget('bootstrap.widgets.BsListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>