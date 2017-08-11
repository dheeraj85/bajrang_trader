<?php
$this->breadcrumbs = array(
    'Home' => array('site/cmsdashboard'),
    'Expense Masters' => array('expensemaster/admin'),
    'Add Expense Master',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Expensemaster', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Expensemaster', 'url'=>array('admin')),
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border bg-primary">
                    <h3 class="panel-title">Add Expense Master
                    </h3>
                </div>
                <div class="panel-body">
                    <?php if (Yii::app()->user->hasFlash('success')) { ?>
                        <div class="alert1 alert-success">
                            <?php echo Yii::app()->user->getFlash('success'); ?>
                        </div>
                    <?php } ?>
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