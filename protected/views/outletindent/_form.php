<?php
/* @var $this IndentmasterController */
/* @var $model Indentmaster */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'indentmaster-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'sync_id',array('maxlength'=>20)); ?>
    <?php echo $form->textFieldControlGroup($model,'indent_date'); ?>
    <?php echo $form->textFieldControlGroup($model,'indent_type',array('maxlength'=>7)); ?>
    <?php echo $form->textFieldControlGroup($model,'purchase_type',array('maxlength'=>11)); ?>
    <?php echo $form->textFieldControlGroup($model,'created_by'); ?>
    <?php echo $form->textFieldControlGroup($model,'created_user_role',array('maxlength'=>30)); ?>
    <?php echo $form->textFieldControlGroup($model,'supply_type',array('maxlength'=>7)); ?>
    <?php echo $form->textFieldControlGroup($model,'invoice_id',array('maxlength'=>50)); ?>
    <?php echo $form->textFieldControlGroup($model,'invoice_date'); ?>
    <?php echo $form->textFieldControlGroup($model,'issued_by'); ?>
    <?php echo $form->textFieldControlGroup($model,'discount',array('maxlength'=>12)); ?>
    <?php echo $form->textFieldControlGroup($model,'remark',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'is_indenting_done'); ?>
    <?php echo $form->textFieldControlGroup($model,'is_order_done'); ?>
    <?php echo $form->textFieldControlGroup($model,'is_sync'); ?>
    <?php echo $form->textFieldControlGroup($model,'sync_date'); ?>

    <?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
