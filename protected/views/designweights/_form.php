<?php
/* @var $this DesignweightsController */
/* @var $model Designweights */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'designweights-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php // echo $form->errorSummary($model); ?>
    <?php echo $form->hiddenField($model,'design_id'); ?>
<div class='row'>
    <div class='col-md-6'>
        <?php echo $form->textFieldControlGroup($model,'weight_for_design'); ?>
        <label><b>Note :- </b>Enter Design Weight Only Once. No Repetition are Allowed.</label>
    </div>
    <div class='col-md-6' style="margin-top: 25px;">
        <?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>
        
    </div>
        
</div>
  
<?php $this->endWidget(); ?>
