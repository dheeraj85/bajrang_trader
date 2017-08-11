<?php
/* @var $this DesignweightsController */
/* @var $model Designweights */
?>

<?php
$this->breadcrumbs=array(
	'Designweights'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Designweights', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Designweights', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Designweights', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Designweights', 'url'=>array('admin')),
);
?>

<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                <div class="pull-left">
                    <h3 class="panel-title">Update Cake Shape Design Weight</h3>
                </div>
                <div class="pull-right">
                    <a class="btn btn-default" href="<?php echo $this->createUrl('designweights/create',array('did'=>$model->design_id)) ?>"><i class="glyphicon glyphicon-backward"></i> Back</a>
                </div>
                </div>
                <div class="panel-body">
                    <?php $this->renderPartial('_form', array('model' => $model)); ?>
                </div>
            </div>     
        </div>  
    </div>  
</div>  