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
<input type="hidden" name="Voucher[voucher_type_id]" value="<?php echo $voucher_type_id;?>"/>
<input type="hidden" name="Voucher[receiver_id]" value="<?php echo $receiver_id;?>"/>
<input type="hidden" name="Voucher[payment_receiver_type]" value="<?php echo $receiver_type;?>"/>
<div class="row">
    <div class="col-lg-4">
        <div id="receiver_name">
            <label><?php if($nature=="debit"){?>Receiver-<?php }else{?>Payer-<?php }?><?php echo strtoupper($receiver_type);?></label><br/>           
            <select name="Voucher[receiver_id]" id="Voucher_receiver_id" class="form-control">
                <option value="">--Select--</option>
            </select> 
        </div>    
        <div id="other_name" style="display:none;">
            <?php echo $form->textFieldControlGroup($model, 'other_name', array('maxlength' => 100)); ?>
        </div>
    </div>    
    <div class="col-lg-4" id="party_balance"></div>
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
<div class="row" style="display:none;" id="contact_details">
    <div class="col-lg-6">
        <?php echo $form->textFieldControlGroup($model, 'mobile', array('maxlength' => 10)); ?>   
    </div>
    <div class="col-lg-6">
        <?php echo $form->textFieldControlGroup($model, 'address', array('maxlength' => 255)); ?>   
    </div>
</div>
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
</div> 
<?php $this->endWidget(); ?>
<script type="text/javascript">
    $(document).ready(function() {      
        <?php if(!empty($receiver_id)){?> 
        var pay_rec_type="<?php echo $receiver_type;?>";    
        var receiver_id=<?php echo $receiver_id;?>;    
        Getreceiverlist(pay_rec_type,receiver_id);   
        Getbalance(receiver_id);
        searchresult(receiver_id);
        $("#Voucher_amount").removeAttr("readonly");
        <?php }else{?>
        var pay_rec_type="<?php echo $receiver_type;?>";    
        var receiver_id=0;    
        Getreceiverlist(pay_rec_type,receiver_id);    
        //Getbenefitamount("others","vendor",3);
        <?php }?> 
         <?php if(empty($id)){?> 
           $("#Voucher_amount").removeAttr("readonly");
          <?php }?>    
        
        $('#Voucher_receiver_id').change(function() {
            <?php if(!empty($id)){?> 
            var vtype=<?php echo $id;?>;
            <?php }else{?>
            var vtype=0;             
            <?php }?>
            var receiver_type ="<?php echo $receiver_type;?>";  
            var voucher_receiver_id = $(this).val();
            Getbenefitamount(vtype,receiver_type,voucher_receiver_id);
            if(receiver_type=="employee" && vtype==6){
             Getloan(voucher_receiver_id);   
            }
            if(receiver_type=="vendor"){
            Getbalance(voucher_receiver_id);
            searchresult(voucher_receiver_id);
            }
        });

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
            var invbal=$("#invoice_bal").val();
            var vamt=$("#Voucher_amount").val();
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
                if(vamt<invbal){
                 alert("The Subtotal of the selected bill in the range is higher than the amount entered in the voucher, Kindly select specific bills you want to clear.");  
                 return false;
                }else{
                $("#btnvoucher").attr('disabled', 'disabled').html("Submiting...");
                $.ajax({
                    url: '<?php echo $this->createUrl('voucher/addvoucheritem') ?>',
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
                            window.location.href = "<?php echo $this->createUrl('voucher/admin') ?>";
                        }, 1000);
                    }
                });
                return true;
                }
            }
        });
    });

    function Getreceiverlist(pay_rec_type,receiver_id) {
        $("#Voucher_receiver_id").html("");        
        $.ajax({
            url: '<?php echo $this->createUrl('voucher/getreceiverlist') ?>',
            data: {'pay_rec_type': pay_rec_type,'receiver_id':receiver_id},
            type: 'get',
            success: function(response) {
                $("#Voucher_receiver_id").html(response);
            }
        });
    }
    
    function Getbenefitamount(vtype,receiver_type,voucher_receiver_id) {
        $.ajax({
            url: '<?php echo $this->createUrl('voucher/getbenefitamount') ?>',
            data: {'vtype': vtype,'receiver_type': receiver_type,'voucher_receiver_id': voucher_receiver_id},
            type: 'get',
            success: function(response) {
                 if(vtype=="3"){
                   //    $("#Voucher_amount").val("");
                    $("#Voucher_amount").val(response);
                 }else if(vtype=="4"){
                     $("#Voucher_amount").val(response);
                 }else{
                       $("#Voucher_amount").removeAttr("readonly");
                       $("#Voucher_amount").val(response);
                 }
            }
        });
    }
    function Getbalance(voucher_receiver_id) {
        $.ajax({
            url: '<?php echo $this->createUrl('voucher/getbalance') ?>',
            data: {'voucher_receiver_id': voucher_receiver_id},
            type: 'get',
            success: function(response) {
                $("#party_balance").html("<h4 style='padding-top:15px;'>Pending Balance : "+response+"</h4>");
            }
        });
    }
        function Getloan(voucher_receiver_id) {
        $.ajax({
            url: '<?php echo $this->createUrl('voucher/getloan') ?>',
            data: {'voucher_receiver_id': voucher_receiver_id},
            type: 'get',
            success: function(response) {
                $("#party_balance").html("<h4 style='padding-top:15px;'>Pending Balance : "+response+"</h4>");
            }
        });
    }
   function searchresult(voucher_receiver_id){
    $.ajax({
            url: '<?php echo $this->createUrl('voucher/getinvoice') ?>',
            data: {'voucher_receiver_id': voucher_receiver_id},
            type: 'get',
            success: function(response) {
             $("#pending_invoicelist").html(response);   
            }
        });
    }
</script>