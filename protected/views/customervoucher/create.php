<?php
$this->breadcrumbs = array(
    'Home' => array('site/cmsdashboard'),
    'Vouchers'=> array('admin'),
    'Add Voucher',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Voucher', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Voucher', 'url' => array('admin')),
);
//$vtypes=Vouchertype::model()->findByPk($id);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header bg-primary">
                    <h3 class="panel-title">Receive Payment Voucher</h3>
                </div>
                <div class="panel-body">
                    <?php if (Yii::app()->user->hasFlash('success')) { ?>
                        <div class="alert1 alert-success">
                            <?php echo Yii::app()->user->getFlash('success'); ?>

                        </div>
                    <?php } ?>
                    <?php           
                    $this->renderPartial('_receiveform', array(
                        'model' => $model, 'id' => $id,"receiver_type"=>$receiver_type,
                        "nature"=>$vtypes->voucher_nature,
                        'vtypes_id'=>$voucher_type_id,
                        'customer'=>$customer,
                    ));            
                    ?>
                </div>
            </div>     
        </div>  
    </div>  
</div>  