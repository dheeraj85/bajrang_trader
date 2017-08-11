<?php
$this->breadcrumbs=array(
	'Tickets'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Ticket', 'url'=>array('index')),
	array('label'=>'Manage Ticket', 'url'=>array('admin')),
);
?>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/bs/js/jquery.js"></script>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border bg-aqua">
                    <h3 class="panel-title">Generate Ticket</h3>
                </div>
                <div class="panel-body">
                 <?php if (Yii::app()->user->hasFlash('ticket')) { ?>
                <div class="alert1 alert-success">
                    <?php echo Yii::app()->user->getFlash('ticket'); ?>
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