<?php
/* @var $this InvoicepayController */
/* @var $model Invoicepay */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'invoice_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'paymode',array('maxlength'=>6)); ?>
    <?php echo $form->textFieldControlGroup($model,'amount',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'dated'); ?>
    <?php echo $form->textFieldControlGroup($model,'cheque_dd_txn_no',array('maxlength'=>20)); ?>
    <?php echo $form->textFieldControlGroup($model,'bankname',array('maxlength'=>50)); ?>
    <?php echo $form->textFieldControlGroup($model,'branch',array('maxlength'=>50)); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
