<?php
/* @var $this OffshelfsaleController */
/* @var $model Offshelfsale */
/* @var $form BSActiveForm */
?>

<?php
$state_list = Gststatecodes::model()->findAll();
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'offshelfsale-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));

$sale = Offshelfsale::model()->findByAttributes(array(), array('order' => 'id desc', 'limit' => 1));
if (!empty($sale)) {
    $memo = $sale->memo_number + 1;
} else {
    $memo = '01';
}
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php // echo $form->errorSummary($model);   ?>

<?php
if (!empty($model->memo_number)) {
    echo $form->hiddenField($model, 'memo_number', array('maxlength' => 32));
} else {
    echo $form->hiddenField($model, 'memo_number', array('maxlength' => 32, 'value' => sprintf("%04d", $memo)));
}
?>
<div class='row'>
    <div class='col-md-3'>
        <label>Tax Type</label>
            <?php echo $form->dropdownlist($model, 'tax_type', Utils::taxType(), array('options' => array($model->tax_type => array('selected' => true))), array('maxlength' => 100, 'id' => 'tax_type', 'class' => 'form-control')); ?>

    </div>
    <div class='col-md-3'>
        <label>Customer Type<a class="badge badge-blue" data-title="Details" title="" data-toggle="tooltip" 
                               data-original-title="Select Customer type"><b>?</b></a></label>
            <?php echo $form->dropdownlist($model, 'txn_type', Utils::customerType(), array('options' => array($model->txn_type => array('selected' => true))), array('maxlength' => 100, 'id' => 'txn_type', 'class' => 'form-control')); ?>

    </div>
    <div class='col-md-6 customer' style="display: none">
        <?php echo $form->dropDownListControlGroup($model, 'customer_id', CHtml::listData(Customer::model()->findAllByAttributes(array('type' => 'party')), 'id', 'full_name'), array('empty' => '--Select Party/Customer--', 'class' => 'select2')); ?>
    </div>
    <div class='col-md-3 cash_customer' style="display: none">
        <?php echo $form->textFieldControlGroup($model, 'customer_name', array('maxlength' => 100)); ?>
    </div>
    <div class='col-md-3 cash_customer' style="display: none">
        <?php echo $form->textFieldControlGroup($model, 'customer_mobile', array('maxlength' => 100)); ?>
    </div>
</div>

<div class='row'>

    <div class='col-md-3'>
        <label>Place of Supply</label>
        <?php echo $form->dropDownList($model, 'supply_state_code', CHtml::listData($state_list, 'state_code', 'state_name'), array('class' => 'form-control', 'empty' => '---Select State---')); ?>
        <?php echo $form->error($model, 'supply_state_code'); ?>
    </div> 
    <div class='col-md-3'>
        <label>Invoice Type<a class="badge badge-blue" data-title="Details" title="" data-toggle="tooltip" 
                              data-original-title="Select Invoice type"><b>?</b></a></label>
            <?php echo $form->dropdownlist($model, 'invoice_type', Utils::invoice_type(), array('options' => array($model->invoice_type => array('selected' => true))), array('maxlength' => 100, 'id' => 'invoice_type', 'class' => 'form-control')); ?>
    </div>
    <div class='col-md-3'>
        <label>Reverse Charge Status<a class="badge badge-blue" data-title="Details" title="" data-toggle="tooltip" 
                                       data-original-title="If Reverse charge is applicable for this bill Select 'Yes' else 'No' "><b>?</b></a></label>
            <?php echo $form->dropdownlist($model, 'is_reverse_charge_applicable', Utils::yes_no_list(), array('options' => array($model->is_reverse_charge_applicable => array('selected' => true))), array('maxlength' => 100, 'id' => 'is_reverse_charge_applicable', 'class' => 'form-control')); ?>
    </div>

    <div class='col-md-3'>
        <label>Consignee is same <a class="badge badge-blue" data-title="Details" title="" data-toggle="tooltip" 
                            data-original-title="If Consignee details are same Select 'Yes' else 'No' "><b>?</b></a></label>
            <?php echo $form->dropdownlist($model, 'is_consignee_same', Utils::yes_no_list(), array('options' => array($model->is_consignee_same => array('selected' => true))), array('maxlength' => 100, 'id' => 'is_consignee_same', 'class' => 'form-control')); ?>
    </div>
</div>

<div class='row' style="display: none" id="consignee_data">
    <div class='col-lg-3'>
        <?php echo $form->textFieldControlGroup($model, 'consignee_name', array('maxlength' => 100)); ?>
    </div>
    <div class='col-lg-3'>
        <?php echo $form->textFieldControlGroup($model, 'consignee_gstin_code', array('maxlength' => 100)); ?>
    </div>
    <div class='col-lg-3'>
        <?php echo $form->textFieldControlGroup($model, 'consignee_address', array('maxlength' => 100)); ?>
    </div>
    <div class='col-md-3'>
        <label>Consignee State</label>
        <?php echo $form->dropDownList($model, 'consignee_state_code', CHtml::listData($state_list, 'state_code', 'state_name'), array('class' => 'form-control', 'empty' => '---Select State---')); ?>     
    </div> 
</div>
<div class='row'>

    <div class='col-md-3' style="display: none" id="previous_invoice_div">
        <?php echo $form->textFieldControlGroup($model, 'previous_invoice_no', array('maxlength' => 100)); ?>
    </div>
    <div class='col-md-5'>
        <?php echo $form->textAreaControlGroup($model, 'comment', array('rows' => 1)); ?>
    </div>

    <div class='col-md-4' style="margin-top: 23px;">  
        <?php if(empty($model->id)) { ?>
        <?php echo BsHtml::submitButton('Create Bill', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>
        <?php }else { ?>
        <?php echo BsHtml::submitButton('Update Bill', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>
         <a  href="<?php echo $this->createUrl('offshelfsale/create'); ?>" class="btn btn-default">Back</a>
      
        <?php } ?>
    </div>
</div>
<?php $this->endWidget(); ?>
<script type="text/javascript">
    $(document).ready(function() {

        if ($("#invoice_type").val() == 'Revised') {
            $("#previous_invoice_div").show();
        }
        if ($("#Offshelfsale_is_consignee_same").val() == 'N') {
            $("#consignee_data").show();
        }
        if ($("#Offshelfsale_txn_type").val() == 'customer') {
            $(".customer").show();
        } else {
            $(".cash_customer").show();
        }

        $("#Offshelfsale_txn_type").change(function() {
            var val = $(this).val();
         //   alert('val' + val);
            if (val == 'customer') {
                $(".customer").show();
                $(".cash_customer").hide();
            } else {
                $(".customer").hide();
                $(".cash_customer").show();
            }
        });

        $("#Offshelfsale_invoice_type").change(function() {
            var val = $(this).val();
            //alert('val'+val);
            if (val == 'Revised') {
                $("#previous_invoice_div").show();
            } else {
                $("#previous_invoice_div").hide();
            }
        });

        $("#Offshelfsale_is_consignee_same").change(function() {
            var val = $(this).val();
            //alert('val'+val);
            if (val == 'N') {
                $("#consignee_data").show();
            } else {
                $("#consignee_data").hide();
            }
        });
    });

</script>
