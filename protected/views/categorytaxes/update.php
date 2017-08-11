<?php
/* @var $this CategorytaxesController */
/* @var $model Categorytaxes */
?>

<?php
$this->breadcrumbs=array(
	'Categorytaxes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Categorytaxes', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Categorytaxes', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Categorytaxes', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Categorytaxes', 'url'=>array('admin')),
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                <div class="pull-left">
                    <h3 class="panel-title">Update Category Taxes</h3>
                </div>
                <div class="pull-right">
                    <a class="btn btn-default" href="<?php echo $this->createUrl('categorytaxes/create') ?>"><i class="glyphicon glyphicon-backward"></i> Back</a>
                </div>
                </div>
                <div class="panel-body">
                    <?php $this->renderPartial('_form', array('model' => $model)); ?>
                </div>
            </div>     
        </div>  
    </div>  
</div>  