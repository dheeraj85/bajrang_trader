<?php
/* @var $this BankdetailsController */
/* @var $model Bankdetails */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'bankdetails-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'account_no',array('maxlength'=>20)); ?>
    <?php echo $form->textFieldControlGroup($model,'account_holder',array('maxlength'=>20)); ?>
    <?php echo $form->textFieldControlGroup($model,'bank_name',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'branch',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'ifsc',array('maxlength'=>100)); ?>

    <?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
