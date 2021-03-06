<?php
/* @var $this ExpenseheadsController */
/* @var $model Expenseheads */
?>

<?php
$this->breadcrumbs=array(
	'Home'=>array('site/dashboard'),
	'Expenseheads'=>array('create'),
//	$model->name=>array('view','id'=>$model->id),
	'Update Expense Head',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Expenseheads', 'url'=>array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Expenseheads', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Expenseheads', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Expenseheads', 'url'=>array('admin')),
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="col-lg-6">
                <div class="box">
                    <div class="box-header btn-primary">
                        <h3 class="panel-title">Update Expense Head</h3>
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