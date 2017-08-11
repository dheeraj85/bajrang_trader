<?php
/* @var $this TickettypeController */
/* @var $model Tickettype */
?>

<?php
$this->breadcrumbs=array(
        'Home'=>array('site/cmsdashboard'),
        'Ticket Management',
	//'Ticket Types'=>array('admin'),
	//$model->name=>array('view','id'=>$model->id),
	'Update Ticket Type',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Tickettype', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Tickettype', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Tickettype', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Tickettype', 'url'=>array('admin')),
);
?>
<div class='form-css'>
    <div class='row'>
    <div class="col-lg-12">
    <div class="col-lg-6">
         <div class="box box-primary">
        <div class="box-header bg-aqua">
            <h3 class="panel-title">Update Ticket Type</h3>
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