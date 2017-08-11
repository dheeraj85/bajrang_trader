<?php
/* @var $this DesigncomplexityController */
/* @var $model Designcomplexity */
/* @var $form BSActiveForm */
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'designcomplexity-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

        <?php // echo $form->errorSummary($model);  ?>
<div class='row'>
    <div class='col-md-6'>
<?php echo $form->textFieldControlGroup($model, 'design_code', array('maxlength' => 10)); ?>
<?php echo $form->dropDownListControlGroup($model, 'rate',CHtml::listData(Cakerate::model()->findAll(),'rate','rate'),array('empty'=>'--Select Rate--')); ?>

    </div>
    <div class='col-md-6'>
<?php echo $form->textAreaControlGroup($model, 'description', array('rows' => 4)); ?>

    </div>
</div>
<div class='row'>
    <div class='col-md-6'>
<?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

    </div>
</div>






<?php $this->endWidget(); ?>
