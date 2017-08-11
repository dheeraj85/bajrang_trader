<?php
/* @var $this CustomerController */
/* @var $model Customer */
/* @var $form BSActiveForm */
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'customer-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php // echo $form->errorSummary($model); ?>

        <?php echo $form->hiddenField($model, 'type', array('value' => 'internal')); ?>
<div class='row'>
    <div class='col-md-3'>
        <?php echo $form->textFieldControlGroup($model, 'full_name', array('maxlength' => 50)); ?>
    </div>
    <div class='col-md-3'>   
        <?php echo $form->textFieldControlGroup($model, 'mobile_no', array('maxlength' => 10)); ?>
    </div>
    <div class='col-md-3'>
        <?php echo $form->textFieldControlGroup($model, 'party_store_name', array('maxlength' => 150)); ?>
    </div>
    <div class='col-md-3'>
        <?php echo $form->textFieldControlGroup($model, 'email_id', array('maxlength' => 150)); ?>
    </div>
    <div class='col-md-3'>
        <?php echo $form->textFieldControlGroup($model, 'landline', array('maxlength' => 150)); ?>
    </div>
    <div class='col-md-6'>
        <?php echo $form->textFieldControlGroup($model, 'address', array('maxlength' => 150)); ?>
    </div>
    <div class='col-md-3' style="margin-top: 25px;">
    <?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>
    </div>
    </div>
<?php $this->endWidget(); ?>
