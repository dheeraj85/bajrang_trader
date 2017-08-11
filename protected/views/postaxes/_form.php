<?php
/* @var $this PostaxesController */
/* @var $model Postaxes */
/* @var $form BSActiveForm */
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'postaxes-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<div class='row'>
    <div class='col-md-6'>
        <?php echo $form->textFieldControlGroup($model, 'tax_name', array('maxlength' => 50)); ?>
    </div>
    <div class='col-md-6'>
<?php echo $form->textFieldControlGroup($model, 'tax_percent', array('maxlength' => 5)); ?>
    </div>
</div>
<div class='row'>
    <div class='col-md-6'>

<?php echo $form->textFieldControlGroup($model, 'description', array('maxlength' => 200)); ?>
    </div>
    <div class='col-md-6' style="margin-top: 25px;">

<?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
