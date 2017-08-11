<?php
$this->breadcrumbs = array(
    'Home' => array('site/cmsdashboard'),
    'Expense Masters' => array('expensemaster/admin'),
    'Update Expense Master',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Expensemaster', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Expensemaster', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Expensemaster', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Expensemaster', 'url'=>array('admin')),
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border bg-primary">
                    <h3 class="panel-title">Update Expense Master
                    </h3>
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