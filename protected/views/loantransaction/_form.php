<?php
/* @var $this LoantransactionController */
/* @var $model Loantransaction */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'loantransaction-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'employee_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'employee_benifits_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'amount',array('maxlength'=>12)); ?>
    <?php echo $form->textFieldControlGroup($model,'dated'); ?>

    <?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
