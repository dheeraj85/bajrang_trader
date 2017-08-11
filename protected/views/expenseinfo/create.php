<?php
/* @var $this ExpenseinfoController */
/* @var $model Expenseinfo */
?>

<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Expense Head Reconciliation List'=>array('admin'),
    'Add Expense Head Reconciliation'
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Expenseinfo', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Expenseinfo', 'url' => array('admin')),
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                    <h3 class="panel-title">Add Expense Head Reconciliation</h3>
                </div>
                <div class="panel-body">
                    <?php if (Yii::app()->user->hasFlash('success')) { ?>
                        <div class="alert1 alert-success">
                            <?php echo Yii::app()->user->getFlash('success'); ?>
                        </div>
                    <?php } ?>
                    <?php $this->renderPartial('_form', array('model' => $model)); ?>
                </div>
            </div>     
        </div>  
    </div> 
</div>  