<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'voucher-form',
    'enableAjaxValidation' => false,
        ));
?>
<p class="help-block">Fields with <span class="required">*</span> are required.</p>
<?php //echo $form->errorSummary($model);  ?>
<input type="hidden" name="Voucher[voucher_type_id]" value="<?php echo $id; ?>"/>
<input type="hidden" name="Voucher[receiver_id]" id="customer_id" value="<?php echo $customer->id; ?>"/>
<input type="hidden" name="Voucher[payment_receiver_type]" value="<?php echo $receiver_type; ?>"/>
<div class="row">
    <div class="col-lg-4">            
        <div id="other_name">
            <label>From</label><br/>
            <input name="Voucher[other_name]" id="Voucher_other_name" class="form-control" value="<?php echo $customer->full_name; ?>">
        </div>
    </div>
    <div class="col-lg-4">
        <?php echo $form->textFieldControlGroup($model, 'mobile', array('maxlength' => 10, 'value' => $customer->mobile_no)); ?>   
    </div>
</div> 
<div style="clear:both"></div><br/>
<div class="row">
    <div class="col-lg-4">
        <label>Voucher Amount</label><br/>
        <input type="number" name="Voucher[amount]" class="form-control" id="Voucher_amount">
    </div>
    <div class="col-lg-4">
        <label>Voucher Date</label><br/>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'Voucher[dated]',
            'id' => 'voucher_date',
            'value' => isset($model->dated) ? $model->dated : date('Y-m-d'),
            'options' => array(
                'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
            ),
            'htmlOptions' => array(
                'style' => '',
                //'readonly' => 'readonly'
                'placeholder' => 'Voucher Date', 'class' => 'form-control',
            ),
        ));
        ?>
    </div>
    <div class="col-lg-4">
        <label>Payment Mode</label><br/>
        <?php echo $form->dropdownlist($model, 'payment_mode', Utils::paymentmode(), array('maxlength' => 100, 'id' => 'payment_mode', 'class' => 'form-control')); ?>            
    </div>
</div>
<div style="clear:both"></div><br/>
<div class="row" id="offline_trans">
    <div class="col-lg-6">
        <label>Counter</label>
        <?php echo $form->dropDownList($model, 'counter_id', CHtml::listData(Cashcounter::model()->findAll(), 'id', 'counter_name'), array('class' => 'form-control', 'empty' => '---Select Counter---')); ?>
    </div>  
</div>
<div class="row" id="online_trans" style="display:none;">
    <div class="col-lg-3">
        <?php echo $form->textFieldControlGroup($model, 'c_number_t_num_utr_num', array('maxlength' => 100)); ?>   
    </div>
    <div class="col-lg-3">
        <?php echo $form->textFieldControlGroup($model, 'account_no', array('maxlength' => 100)); ?>       
    </div>
    <div class="col-lg-3">
        <?php echo $form->textFieldControlGroup($model, 'bank_card_name', array('maxlength' => 100)); ?>  
    </div>
    <div class="col-lg-3">      
        <label>Payment Date</label><br/>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'Voucher[payment_date]',
            'id' => 'payment_date',
            'value' => $model->payment_date,
            'options' => array(
                'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
            ),
            'htmlOptions' => array(
                'style' => '',
                //'readonly' => 'readonly'
                'placeholder' => 'Payment Date', 'class' => 'form-control',
            ),
        ));
        ?>
    </div>
</div> 
<div style="clear:both"></div><br/>
<div class="row">
    <div class="col-lg-12"> 
        <?php echo $form->textAreaControlGroup($model, 'remark', array('maxlength' => 255)); ?> 
    </div>
</div> 
<div id="pending_invoicelist"></div>
<div class="row pull-right" style="margin-right:0px;">
    <input type="button" class="btn btn-primary" id="btnvoucher" value="Submit"/>
    <a href="<?php echo $this->createUrl("offshelfsale/ledger",array('cid'=>$customer->id)) ?>" class="btn btn-default">Back</a>
</div> 
<?php $this->endWidget(); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#payment_mode').change(function() {
            var pay_mode = $(this).val();
            if (pay_mode == "cash") {
                $("#online_trans").hide();
                $("#offline_trans").show();
            } else {
                $("#offline_trans").hide();
                $("#online_trans").show();
            }
        });

        $('#btnvoucher').click(function() {
            var form = $('#voucher-form').serialize();
            if ($("#Voucher_receiver_id").val() == "") {
                alert("Select Receiver");
                $("#Voucher_receiver_id").focus();
                return false;
            } else if ($("#Voucher_amount").val() == "") {
                alert("Amount Required");
                $("#Voucher_amount").focus();
                return false;
            } else if ($("#payment_mode").val() == "") {
                alert("Select Payment Mode");
                $("#payment_mode").focus();
                return false;
            } else if ($("#Voucher_remark").val() == "") {
                alert("Narration Required");
                $("#Voucher_remark").focus();
                return false;
            } else {
                $("#btnvoucher").attr('disabled', 'disabled').html("Submiting...");
                $.ajax({
                    url: '<?php echo $this->createUrl('customervoucher/addvoucheritem') ?>',
                    data: form + '&YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>',
                    type: 'post',
                    cache: false,
                    success: function(response) {
                        $("#btnvoucher").removeAttr('disabled').html('Submit');
                        $('#voucher-form')[0].reset();
                        $("#payment_receiver_type").val('');
                        $("#Voucher_voucher_type_id").val('');
                        $("#Voucher_expense_nature_id").val('');
                        $("#other_name").hide();
                        $("#online_trans").hide();
                        setInterval(function() {
                            window.location.href = '<?php echo $this->createUrl("offshelfsale/ledger") ?>?cid=' + $("#customer_id").val();

                        }, 1000);
                    }
                });
                return true;
            }
        });
    });
</script>