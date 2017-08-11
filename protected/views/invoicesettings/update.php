<?php
/* @var $this InvoicesettingsController */
/* @var $model Invoicesettings */
?>

<?php
$this->breadcrumbs=array(
        'Home'=>array('site/cmsdashboard'),
	'Invoice Setting',
	//$model->id=>array('view','id'=>$model->id),
	'Update Invoice Setting type',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Invoicesettings', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Invoicesettings', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Invoicesettings', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Invoicesettings', 'url'=>array('admin')),
);
?>
<div class='form-css'>
    <div class='row'>
    <div class="col-lg-12">
    <div class="col-lg-6">
         <div class="box box-primary">
        <div class="box-header bg-aqua">
            <h3 class="panel-title">Update Invoice Setting type</h3>
        </div>
        <div class="panel-body">
                <?php
                $this->renderPartial('_form', array(
                    'model' => $model,
                ));
                ?>
        </div>
    </div>
    </div>  
    </div>
    </div>
</div>