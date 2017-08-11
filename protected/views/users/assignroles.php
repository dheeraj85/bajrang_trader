<?php
/* @var $this UsersController */
/* @var $model Users */
?>

<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Add User Assign Roles',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Users', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Users', 'url' => array('admin')),
);
?>
<div class='form-css'>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="panel-title">User Assign Roles</h3>
        </div>
        <div class="panel-body">
            <?php if (Yii::app()->user->hasFlash('usersright')) { ?>
                <div class="alert alert-success">
                    <?php echo Yii::app()->user->getFlash('usersright'); ?>

                </div>
            <?php } ?>
            <?php $this->renderPartial('_assignrolesform', array('model' => $model)); ?>
        </div>
    </div>
</div>