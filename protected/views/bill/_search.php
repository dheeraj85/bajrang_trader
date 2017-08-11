<?php
/* @var $this BillController */
/* @var $model Bill */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'bill_no',array('maxlength'=>20)); ?>
    <?php echo $form->textFieldControlGroup($model,'bill_date'); ?>
    <?php echo $form->textFieldControlGroup($model,'bill_from_date'); ?>
    <?php echo $form->textFieldControlGroup($model,'bill_to_date'); ?>
    <?php echo $form->textFieldControlGroup($model,'customer_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'purchase_order_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'bill_type',array('maxlength'=>16)); ?>
    <?php echo $form->textFieldControlGroup($model,'print_type',array('maxlength'=>17)); ?>
    <?php echo $form->textFieldControlGroup($model,'added_on'); ?>
    <?php echo $form->textFieldControlGroup($model,'particulars',array('maxlength'=>255)); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
