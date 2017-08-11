<?php
/* @var $this OutletstaffController */
/* @var $model Outletstaff */
?>

<?php
$this->breadcrumbs=array(
	'Home' => array('site/dashboard'),
    'Add Staff',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Outletstaff', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Outletstaff', 'url'=>array('admin')),
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                    <h3 class="panel-title">Add Outlet Staff</h3>
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