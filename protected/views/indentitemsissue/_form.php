<?php
/* @var $this IndentitemsissueController */
/* @var $model Indentitemsissue */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'indentitemsissue-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'internal_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'p_category_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'p_sub_category_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'item_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'item_name',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'item_brand',array('maxlength'=>50)); ?>
    <?php echo $form->textFieldControlGroup($model,'issue_qty'); ?>
    <?php echo $form->textFieldControlGroup($model,'issue_date'); ?>
    <?php echo $form->textFieldControlGroup($model,'issue_purpose',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'created_by'); ?>
    <?php echo $form->textFieldControlGroup($model,'created_user_role',array('maxlength'=>30)); ?>
    <?php echo $form->textFieldControlGroup($model,'is_issue_done'); ?>

    <?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
