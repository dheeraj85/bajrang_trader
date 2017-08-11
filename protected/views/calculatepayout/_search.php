<?php
/* @var $this CalculatepayoutController */
/* @var $model Calculatepayout */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'kata_parchy_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'customer_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'load_wgt',array('maxlength'=>12)); ?>
    <?php echo $form->textFieldControlGroup($model,'amount',array('maxlength'=>20)); ?>
    <?php echo $form->textFieldControlGroup($model,'payment_mode',array('maxlength'=>6)); ?>
    <?php echo $form->textFieldControlGroup($model,'payment_date'); ?>
    <?php echo $form->textFieldControlGroup($model,'c_number_t_num_utr_num',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'account_no',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'bank_card_name',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'remark',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'dated'); ?>
    <?php echo $form->textFieldControlGroup($model,'is_paid'); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
