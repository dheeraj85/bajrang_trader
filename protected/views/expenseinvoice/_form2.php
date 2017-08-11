<?php
/* @var $this ExpenseinvoiceController */
/* @var $model Expenseinvoice */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'expenseinvoice-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'expense_heads_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'invoice_type',array('maxlength'=>6)); ?>
    <?php echo $form->textFieldControlGroup($model,'gstin_no',array('maxlength'=>25)); ?>
    <?php echo $form->textFieldControlGroup($model,'is_gstn_compliant'); ?>
    <?php echo $form->textFieldControlGroup($model,'compliants_category'); ?>
    <?php echo $form->textFieldControlGroup($model,'place_of_supply'); ?>
    <?php echo $form->textFieldControlGroup($model,'state_code'); ?>
    <?php echo $form->textFieldControlGroup($model,'invoice_no',array('maxlength'=>50)); ?>
    <?php echo $form->textFieldControlGroup($model,'invoice_date'); ?>
    <?php echo $form->textFieldControlGroup($model,'vendor_name',array('maxlength'=>50)); ?>
    <?php echo $form->textFieldControlGroup($model,'vendor_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'received_by'); ?>
    <?php echo $form->textFieldControlGroup($model,'discount_type',array('maxlength'=>13)); ?>
    <?php echo $form->textFieldControlGroup($model,'total_amount',array('maxlength'=>14)); ?>
    <?php echo $form->textFieldControlGroup($model,'total_discount',array('maxlength'=>12)); ?>
    <?php echo $form->textFieldControlGroup($model,'round_off',array('maxlength'=>5)); ?>
    <?php echo $form->textFieldControlGroup($model,'is_added_to_stock'); ?>
    <?php echo $form->textFieldControlGroup($model,'is_reviewed'); ?>
    <?php echo $form->textFieldControlGroup($model,'review_point'); ?>
    <?php echo $form->textFieldControlGroup($model,'review_desc',array('maxlength'=>200)); ?>
    <?php echo $form->textFieldControlGroup($model,'truck_wagon_no',array('maxlength'=>200)); ?>
    <?php echo $form->textFieldControlGroup($model,'truck_wagon_owner_name',array('maxlength'=>200)); ?>
    <?php echo $form->textFieldControlGroup($model,'driver_name',array('maxlength'=>200)); ?>
    <?php echo $form->textFieldControlGroup($model,'driver_contact',array('maxlength'=>50)); ?>
    <?php echo $form->textFieldControlGroup($model,'driver_lic_no',array('maxlength'=>200)); ?>
    <?php echo $form->textFieldControlGroup($model,'rr_no',array('maxlength'=>200)); ?>
    <?php echo $form->textFieldControlGroup($model,'transport_name',array('maxlength'=>200)); ?>
    <?php echo $form->textFieldControlGroup($model,'dispatch_from',array('maxlength'=>200)); ?>
    <?php echo $form->textFieldControlGroup($model,'dispatch_to',array('maxlength'=>200)); ?>
    <?php echo $form->textFieldControlGroup($model,'crossing',array('maxlength'=>200)); ?>
    <?php echo $form->textFieldControlGroup($model,'created_by'); ?>
    <?php echo $form->textFieldControlGroup($model,'updated_by'); ?>
    <?php echo $form->textFieldControlGroup($model,'created_date'); ?>

    <?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
