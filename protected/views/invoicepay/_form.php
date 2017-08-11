<?php
/* @var $this InvoicepayController */
/* @var $model Invoicepay */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'invoicepay-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'invoice_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'paymode',array('maxlength'=>6)); ?>
    <?php echo $form->textFieldControlGroup($model,'amount',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'dated'); ?>
    <?php echo $form->textFieldControlGroup($model,'cheque_dd_txn_no',array('maxlength'=>20)); ?>
    <?php echo $form->textFieldControlGroup($model,'bankname',array('maxlength'=>50)); ?>
    <?php echo $form->textFieldControlGroup($model,'branch',array('maxlength'=>50)); ?>

    <?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
