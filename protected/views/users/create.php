<?php
/* @var $this UsersController */
/* @var $model Users */
?>

<?php
$this->breadcrumbs=array(
    'Home'=>array('site/dashboard'),
    'Add Account',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Users', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Users', 'url' => array('admin')),
);
?>
<div class='form-css'>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="panel-title">Add Account</h3>
    </div>
    <div class="panel-body">
        <?php if (Yii::app()->user->hasFlash('user')) { ?>
            <div class="alert1 alert-success">
                <?php echo Yii::app()->user->getFlash('user'); ?>

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