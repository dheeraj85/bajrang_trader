<?php
/* @var $this StaffattendanceController */
/* @var $model Staffattendance */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'staffattendance-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'session'); ?>
    <?php echo $form->textFieldControlGroup($model,'subcategory'); ?>
    <?php echo $form->textFieldControlGroup($model,'staff_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'attendance',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'in_time'); ?>
    <?php echo $form->textFieldControlGroup($model,'out_time'); ?>
    <?php echo $form->textFieldControlGroup($model,'half_day'); ?>
    <?php echo $form->textFieldControlGroup($model,'teacher_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'date'); ?>
    <?php echo $form->textFieldControlGroup($model,'is_approved'); ?>

    <?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
