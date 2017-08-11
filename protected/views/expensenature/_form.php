<?php
/* @var $this ExpensenatureController */
/* @var $model Expensenature */
/* @var $form BSActiveForm */
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'expensenature-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

        <?php // echo $form->errorSummary($model); ?>
<div class='row'>
    <div class='col-md-8'>
        <?php echo $form->textFieldControlGroup($model, 'name', array('maxlength' => 100)); ?>
    </div>
    <div class='col-md-4' style="margin-top: 25px;">
<?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
