<?php
/* @var $this EmployeesalaryController */
/* @var $model Employeesalary */


$this->breadcrumbs = array(
    'Home' => array('site/cmsdashboard'),
    'Vouchers'=>array('admin'),
    'Review Voucher',
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                    <h3 class="panel-title">Voucher No : <?php echo $model->voucher_no?> | Type : <?php echo $model->voucher->voucher_name?></h3>
                </div>
                <div class="panel-body">
                     <table class='table table-bordered'>
                        <thead>
                            <tr>
                                <th>Receiver / Expense Head</th>                                
                                <th>Amount</th>
                                <th>Dated</th>
                                <th>Payment Mode</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="15%"><?php echo $model->reqstatus($model); ?></td>
                                <td width="15%"><?php echo $model->amount; ?></td>
                                <td width="15%"><?php echo $model->dated; ?></td>
                                <td width="25%"><?php echo $model->payment_mode; ?></td>
                            </tr>    
                        </tbody>
                    </table>
                    <?php if (Yii::app()->user->hasFlash('success')) { ?>
                        <div class="alert1 alert-success">
                            <?php echo Yii::app()->user->getFlash('success'); ?>
                        </div>
                    <?php } ?>
                    <?php
                    $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                        'enableAjaxValidation' => false,
                        'action' => $this->createUrl('voucher/voucherupdate'),
                    ));
                    ?>
                    <input type="hidden" id="Voucher_id" name="id" value="<?php echo $model->id?>"/>
                    <div class="row">
                        <div class="col-lg-4 col-sm-4 col-xs-12">
                            <label>Received By </label><br/>
                            <input type="text" id="Voucher_received_by" name="received_by" class="form-control" placeholder="Received By" />                            
                        </div>
                        <div class="col-lg-4 col-sm-4 col-xs-12">
                            <label>Received Mobile No</label><br/>
                            <input type="text" id="Voucher_received_mobileno" name="received_mobileno" class="form-control" placeholder="Received Mobile No" />                            
                        </div>
                    </div>  <br/>                  
                        <div class='row'>
                            <div class='col-md-6'>
                               <input type="submit" name="generateorder" value="Receive Voucher" class="btn btn-primary" />         
                            </div>
                        </div>
                    <?php $this->endWidget(); ?>
                </div>
            </div>     
        </div>  
    </div> 
</div>