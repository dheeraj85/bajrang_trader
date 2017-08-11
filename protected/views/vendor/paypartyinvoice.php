<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Vendor Management' => array('vendor/index'),
    'Pay Party Invoice',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Voucher', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Voucher', 'url' => array('admin')),
);
$vtypes=Vouchertype::model()->findByPk($id);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header bg-primary">
                    <h3 class="panel-title"><?php echo $vtypes->voucher_name;?></h3>
                </div>
                <div class="panel-body">
                    <?php if (Yii::app()->user->hasFlash('success')) { ?>
                        <div class="alert1 alert-success">
                            <?php echo Yii::app()->user->getFlash('success'); ?>

                        </div>
                    <?php } ?>
                    <?php
                    $this->renderPartial('_paypartyinvoiceform', array(
                        'model' => $model, 'id' => $id,"receiver_type"=>$receiver_type,"receiver_id"=>$receiver_id,'voucher_type_id'=>$voucher_type_id,"nature"=>$vtypes->voucher_nature,'date'=>$date,'invoice_id'=>$invoice_id,
                    ));
                    ?>
                </div>
            </div>     
        </div>  
    </div>  
</div>  