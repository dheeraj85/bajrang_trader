<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Payout List' => array('calculatepayout/admin'),
    'Calculate Payout',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Calculatepayout', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Calculatepayout', 'url' => array('admin')),
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">      
            <div class="box">
                <div class="box-header bg-green">
                    <h3 class="panel-title">Calculate Payout</h3>
                </div>
                <div class="panel-body">  
                    <?php if (Yii::app()->user->hasFlash('success')) { ?>
                        <div class="alert1 alert-success">
                            <?php echo Yii::app()->user->getFlash('success'); ?>
                        </div><br/>
                    <?php } ?>
                    <?php $this->renderPartial('_form', array('model' => $model, 'id' => $id,'invoice_details'=>$invoice_details,'kataparchy'=>$kataparchy)); ?>
                </div>
            </div>
        </div>
    </div>
</div>