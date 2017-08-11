<?php
/* @var $this VendorbankdetailsController */
/* @var $model Vendorbankdetails */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'account_name',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'account_no',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'bank_name',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'branch',array('maxlength'=>50)); ?>
    <?php echo $form->textFieldControlGroup($model,'ifsc',array('maxlength'=>20)); ?>
    <?php echo $form->textFieldControlGroup($model,'created_by'); ?>
    <?php echo $form->textFieldControlGroup($model,'created_date'); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
