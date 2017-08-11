<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'expenseinfo-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));
?>
<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php //echo $form->errorSummary($model); ?>     
<div class="row">
    <div class="col-lg-4">
        <?php echo $form->textFieldControlGroup($model, 'voucher_no', array('maxlength' => 50)); ?>
    </div>   
    <div class="col-lg-4" style="margin-top:22px;">
        <?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>
    </div>
</div>
<?php
$vs = Voucher::model()->findByAttributes(array("id" => $_POST['Expenseinfo']['voucher_no'], "payment_receiver_type" => 'expense_head'));
$exp_head = Expenseheads::model()->findByPk($vs->receiver_id);
if (!empty($vs)) {
    ?>
    <div class="box">
        <div class="box-header bg-green">
            <h3 class="panel-title">Expense Voucher List</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <?php
                $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                    'id' => 'expenseinfo',
                    'enableAjaxValidation' => false,
                    'action' => $this->createUrl('expenseinfo/reconcileitem'),
                ));
                ?>
                <?php
                $exp_vouchers=  Expenseinfo::model()->findByAttributes(array("voucher_no"=>$_POST['Expenseinfo']['voucher_no']));
                if(empty($exp_vouchers)){
                ?>
                <table class='table table-bordered'>
                    <thead>
                        <tr>
                            <th>Voucher No</th>                            
                            <th>Expense Head</th>
                            <th>Voucher Amount</th>
                            <th>Reg No./Bill No.</th>
                            <th>Voucher Date</th>            
                            <th>Particulars</th>            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="10%"><?php echo $vs->id; ?></td>                            
                            <td width="15%">
                                <select class="form-control" name="expense_head_id">
                                    <option value="<?php echo $exp_head->id ?>" selected><?php echo $exp_head->name; ?></option>
                                </select>
                            </td>
                            <td width="15%"><?php echo $vs->amount; ?></td>
                            <td width="20%"><input class="form-control" id="regno" type="text" name="reg_no" placeholder="Reg No./Bill No."></td>
                            <td width="10%"><?php echo $vs->dated; ?></td>
                            <td width="30%"><textarea name="particular" id="particular" class="form-control" placeholder="Particular"></textarea></td>
                        </tr>    
                    </tbody>
                </table>
                <input type="hidden" name="dated" value="<?php echo $vs->dated; ?>">
                <input type="hidden" name="amount" value="<?php echo $vs->amount; ?>">
                <input type="hidden" name="expensehead_name" value="<?php echo $exp_head->name; ?>">
                <input type="submit" id="reconcileproceed" name="evaluate" value="Reconcile &gt;&gt;" class="btn btn-green pull-right" />         
                <?php }else{?>
                <div class="alert bg-red">Expense Voucher Already Exists !!!</div>
                <?php }?> 
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
<?php } ?>
<?php $this->endWidget(); ?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/bs/js/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#reconcileproceed').click(function() {
            //var form = $('#expenseinfo').serialize();
            if ($("#regno").val() == "") {
                alert("Reg No./Bill No. Required");
                $("#regno").focus();
                return false;
            } else if ($("#particular").val() == "") {
                alert("Particular Required");
                $("#particular").focus();
                return false;
            } 
        });
    });
</script>