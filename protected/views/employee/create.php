<?php
/* @var $this EmployeeController */
/* @var $model Employee */
?>

<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Human Resource' => array('employee/index'),
    'Add Employee',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Employee', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Employee', 'url' => array('admin')),
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                    <h3 class="panel-title">Add Employee Details</h3>
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