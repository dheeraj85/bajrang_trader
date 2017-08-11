<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'calculatepayout-form',
    'enableAjaxValidation' => false,
        ));
?>
<label>Invoice No.</label>
<?php echo $form->dropDownList($model, 'customer_id', CHtml::listData(Purchaseinvoice::model()->findAll(), 'id', 'invoice_no'), array('class' => 'form-control', 'empty' => '--Select--')); ?>
<div id="getcustomer_details"></div><br/>
<div class="row">
    <div class="col-lg-4">
        <label class="control-label" for="Calculatepayout_load_wgt">Net Weight in MT</label>
        <input maxlength="12" name="Calculatepayout[load_wgt]" id="Calculatepayout_load_wgt" class="form-control" placeholder="Load Weight in MT" type="text">
    </div>
    <div class="col-lg-4">
        <label class="control-label">Rate in MT</label>
        <input maxlength="12" name="Calculatepayout[rate]" id="Calculatepayout_rate" class="form-control" placeholder="Rate in MT" type="text">
    </div>
    <div class="col-lg-4">
        <label class="control-label">Amount</label>
        <input maxlength="12" name="Calculatepayout[amount]" id="Calculatepayout_amount" class="form-control" placeholder="Amount" type="text" readonly>
    </div>
</div><br/>    
<?php echo $form->textAreaControlGroup($model, 'remark'); ?>
<?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>
<?php $this->endWidget(); ?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/front/libs/jquery/jquery-1.11.2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#Calculatepayout_customer_id').click(function() {
            var invoice_id = $(this).val();
            $.ajax({
                url: '<?php echo $this->createUrl('calculatepayout/getinvoicedata') ?>',
                data: {'invoice_id': invoice_id, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
                type: 'post',
                success: function(response) {
                    $('#getcustomer_details').html(response);
                    $('#getcustomer_details').focus();
                }
            });
        });

        $("#Calculatepayout_rate").blur(function() {
            var qty = $('#Calculatepayout_load_wgt').val();
            var uprice = $("#Calculatepayout_rate").val();
            var amt = ((parseFloat(qty) * parseFloat(uprice)));
            $("#Calculatepayout_amount").val(amt.toFixed(3));
        });

        $("#Calculatepayout_load_wgt").blur(function() {
            var qty = $('#Calculatepayout_load_wgt').val();
            var uprice = $("#Calculatepayout_rate").val();
            var amt = ((parseFloat(qty) * parseFloat(uprice)));
            $("#Calculatepayout_amount").val(amt.toFixed(3));
        });
    });
</script>