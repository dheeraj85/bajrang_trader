<?php
/* @var $this ExpenseinvoiceitemsController */
/* @var $model Expenseinvoiceitems */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'expenseinvoiceitems-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'invoice_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'item_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'goods_service',array('maxlength'=>8)); ?>
    <?php echo $form->textFieldControlGroup($model,'hsn_sac_code'); ?>
    <?php echo $form->textFieldControlGroup($model,'vendor_hsn_sac_code',array('maxlength'=>50)); ?>
    <?php echo $form->textFieldControlGroup($model,'vendor_tax_percent'); ?>
    <?php echo $form->textFieldControlGroup($model,'unmatched_code'); ?>
    <?php echo $form->textFieldControlGroup($model,'is_reverse_charge'); ?>
    <?php echo $form->textFieldControlGroup($model,'is_reverse_item'); ?>
    <?php echo $form->textFieldControlGroup($model,'particulars',array('maxlength'=>200)); ?>
    <?php echo $form->textFieldControlGroup($model,'rate',array('maxlength'=>12)); ?>
    <?php echo $form->textFieldControlGroup($model,'amount',array('maxlength'=>12)); ?>
    <?php echo $form->textFieldControlGroup($model,'discount',array('maxlength'=>12)); ?>
    <?php echo $form->textFieldControlGroup($model,'item_tax_type',array('maxlength'=>9)); ?>
    <?php echo $form->textFieldControlGroup($model,'tax_percent_rate',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'tax_amt',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'cess_rate',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'cess_amt',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'ut_rate',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'ut_amt',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'is_active'); ?>
    <?php echo $form->textFieldControlGroup($model,'is_added_to_stock'); ?>
    <?php echo $form->textFieldControlGroup($model,'is_good_return'); ?>
    <?php echo $form->textFieldControlGroup($model,'is_choice_tax'); ?>

    <?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
