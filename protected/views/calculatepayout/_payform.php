<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'voucher-form',
    'enableAjaxValidation' => false,
        ));
?>
<input type="hidden" name="Voucher[voucher_type_id]" value="<?php echo $voucher_type_id;?>"/>
<input type="hidden" name="Voucher[receiver_id]" value="<?php echo $receiver_id;?>"/>
<input type="hidden" name="Voucher[payment_receiver_type]" value="<?php echo $receiver_type;?>"/>
<input type="hidden" name="gstin_no" value="<?php echo $gstin_no;?>"/>
<input type="hidden" name="place_of_supply" value="<?php echo $place_of_supply;?>"/>
<div class="row">    
     <div class="col-lg-4">
        <label>Voucher Amount</label><br/>
        <input type="text" name="Voucher[amount]" class="form-control" value="<?php echo $amount;?>" readonly>
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
</div><br/>
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
    <?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>
</div> 
<?php $this->endWidget(); ?>
<script type="text/javascript">
    $(document).ready(function() {  
        $('#payment_mode').change(function() {
            var pay_mode = $(this).val();
            if (pay_mode == "cash") {
                $("#online_trans").hide();
               // $("#offline_trans").show();
            } else {
                //$("#offline_trans").hide();
                $("#online_trans").show();
            }
        });
</script>