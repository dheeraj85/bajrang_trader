<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Expense Accounts' => array('expenseaccount/admin'),
    'Update Expense Account',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Expenseaccount', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Expenseaccount', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Expenseaccount', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Expenseaccount', 'url'=>array('admin')),
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header bg-primary">
                    <h3 class="panel-title">Update Expense Account</h3>
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