<?php
/* @var $this VouchertypeController */
/* @var $model Vouchertype */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'voucher_name',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'payment_receiver_type',array('maxlength'=>12)); ?>
    <?php echo $form->textFieldControlGroup($model,'voucher_nature',array('maxlength'=>6)); ?>
    <?php echo $form->textFieldControlGroup($model,'description',array('maxlength'=>100)); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
