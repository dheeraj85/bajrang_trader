<?php
/* @var $this ItemledgerController */
/* @var $model Itemledger */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'itemledger-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'item_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'invoice_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'stock_type',array('maxlength'=>8)); ?>
    <?php echo $form->textFieldControlGroup($model,'debit_qty',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'credit_qty',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'balance_qty',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'dated'); ?>
    <?php echo $form->textAreaControlGroup($model,'description',array('rows'=>6)); ?>

    <?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
