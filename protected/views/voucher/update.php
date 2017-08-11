<?php
$this->breadcrumbs=array(
    'Home' => array('site/cmsdashboard'),
    'Vouchers'=> array('index'),
    'Update Voucher',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Voucher', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Voucher', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Voucher', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Voucher', 'url'=>array('admin')),
);
$vtypes=Vouchertype::model()->findByPk($model->voucher_type_id);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header bg-primary">
                    <h3 class="panel-title"><?php echo $vtypes->voucher_name;?></h3>
                </div>
                <div class="panel-body">
                     <?php
                    if($vtypes->id==9 || $vtypes->id==11){
                    $this->renderPartial('_editreceiveform', array(
                        'model' => $model, "receiver_type"=>$vtypes->payment_receiver_type,"nature"=>$vtypes->voucher_nature,'vtypes_id'=>$vtypes->id,
                    ));
                    }else if($vtypes->id==12){
                    $this->renderPartial('_editcustomerreceiveform', array(
                        'model' => $model, "receiver_type"=>$vtypes->payment_receiver_type,"nature"=>$vtypes->voucher_nature,'vtypes_id'=>$vtypes->id,
                    ));
                    }else{
                    $this->renderPartial('_editform', array(
                        'model' => $model, "receiver_type"=>$vtypes->payment_receiver_type,"nature"=>$vtypes->voucher_nature,
                    ));
                    }
                    ?>
                </div>
            </div>     
        </div>  
    </div>  
</div>  