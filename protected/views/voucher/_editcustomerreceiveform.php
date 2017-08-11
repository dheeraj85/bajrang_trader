<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'voucher-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));
?>
<p class="help-block">Fields with <span class="required">*</span> are required.</p>
<?php //echo $form->errorSummary($model);  ?>
<input type="hidden" name="Voucher[id]" id="Voucher_id" value="<?php echo $model->id ?>">
<div class="row"> 
    <?php if ($vtypes_id == 12) { ?>
        <div class="col-lg-4">
            <div id="receiver_name">
                <label>From</label><br/>           
                <select class="form-control" name="Voucher[receiver_id]" id="Voucher_receiver_id">
                    <option value="">--Select--</option>
                    <?php
                    foreach (Customer::model()->findAllByAttributes(array('type' => 'party')) as $c) {
                        if ($model->receiver_id == $c->id) {
                            ?>
                            <option value="<?php echo $c->id ?>" selected><?php echo $c->full_name . " (" . $c->party_store_name . ")" ?></option>
                        <?php } else { ?>
                            <option value="<?php echo $c->id ?>"><?php echo $c->full_name . " (" . $c->party_store_name . ")" ?></option>
                        <?php }
                    } ?>
                </select>
            </div>
        </div>    
<?php } ?>
    <div class="col-lg-4">
<?php echo $form->textFieldControlGroup($model, 'mobile', array('maxlength' => 10)); ?>   
    </div>
</div> 
<div style="clear:both"></div><br/>
<div class="row">
    <div class="col-lg-4">
        <label>Voucher Amount</label><br/>
        <input type="text" name="Voucher[amount]" class="form-control" id="Voucher_amount" readonly>
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
                //'readonly' => 'readonly',
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
<div class="row" id="offline_trans" style="display:none;">
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
                //'readonly' => 'readonly',
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
<div class="row pull-right" style="margin-right:0px;">
    <input type="button" class="btn btn-primary" id="updatevoucher" value="Save"/>   
</div> 
<?php $this->endWidget(); ?>
<script type="text/javascript">
    $(document).ready(function() {
<?php
if (!empty($model->amount)) {
    ?>
            $("#Voucher_amount").val("<?php echo $model->amount; ?>");
<?php } ?>

<?php
if (!empty($model->payment_mode)) {
    ?>
            var pay_mode = "<?php echo $model->payment_mode ?>";
           if (pay_mode == "cash") {
                $("#online_trans").hide();
                $("#offline_trans").show();
            } else {
                $("#offline_trans").hide();
                $("#online_trans").show();
            }
<?php } ?>

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

        $('#updatevoucher').click(function() {
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
                alert("Remark Required");
                $("#Voucher_remark").focus();
                return false;
            } else {
                $("#updatevoucher").attr('disabled', 'disabled').html("Submiting...");
                $.ajax({
                    url: '<?php echo $this->createUrl('voucher/editvoucheritem') ?>',
                    data: form + '&YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>',
                    type: 'post',
                    cache: false,
                    success: function(response) {
                        $("#updatevoucher").removeAttr('disabled').html('Save');
                        $('#voucher-form')[0].reset();
                        $("#payment_receiver_type").val('');
                        $("#Voucher_voucher_type_id").val('');
                        $("#Voucher_expense_nature_id").val('');
                        $("#other_name").hide();
                        $("#online_trans").hide();
                        setInterval(function() {
                            window.location.href = "<?php echo $this->createUrl('voucher/admin') ?>";
                        }, 1000);
                    }
                });
                return true;
            }
        });
    });
</script>