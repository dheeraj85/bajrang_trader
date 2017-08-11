<?php
$this->breadcrumbs = array(
    'Home' => array('site/cmsdashboard'),
    'Payout List' => array('calculatepayout/admin'),
    'Payment Voucher',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Voucher', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Voucher', 'url' => array('admin')),
);
$data=Calculatepayout::model()->findByPk($calculate_payout_id);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
             <div class="box">
                <div class="box-header bg-green">
                    <h3 class="panel-title">Payout Details</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Invoice No.</th>
                            <th>Invoice Date</th>
                            <th>Name of Farmer & their Father</th>
                            <th>Address of Farmer</th>
                            <th>Item</th>
                            <th>Net Weight in MT</th>
                            <th>Amount</th>
                        </tr>
                        <tr>
                            <td><?php echo $data->customer->invoice_no?></td>
                            <td><?php echo $data->customer->invoice_date?></td>
                            <td><?php echo $data->farmername($data);?></td>
                            <td><?php echo $data->address($data);?></td>
                            <td><?php echo $data->item($data);?></td>
                            <td><?php echo $data->load_wgt?></td>
                            <td><?php echo $data->amount?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="box">
                <div class="box-header bg-green">
                    <h3 class="panel-title">Payment Voucher</h3>
                </div>
                <div class="panel-body">
                    <?php if (Yii::app()->user->hasFlash('success')) { ?>
                        <div class="alert1 alert-success">
                            <?php echo Yii::app()->user->getFlash('success'); ?>

                        </div>
                    <?php } ?>
                    <?php
                    $this->renderPartial('_payform', array(
                        'model' => $model, 'calculate_payout_id' => $calculate_payout_id, 'receiver_type' => 'vendor',
                        'receiver_id' => $receiver_id, 'voucher_type_id' =>12,'amount'=>$data->amount,'gstin_no'=>$data->customer->gstin_no,'place_of_supply'=>$data->customer->place_of_supply,
                    ));
                    ?>
                </div>
            </div>     
        </div>  
    </div>  
</div>  