<?php
/* @var $this OffshelfsaleController */
/* @var $model Offshelfsale */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'invoice_number',array('maxlength'=>32)); ?>
    <?php echo $form->textFieldControlGroup($model,'memo_number',array('maxlength'=>32)); ?>
    <?php echo $form->textFieldControlGroup($model,'txn_type',array('maxlength'=>8)); ?>
    <?php echo $form->textFieldControlGroup($model,'customer_name',array('maxlength'=>50)); ?>
    <?php echo $form->textFieldControlGroup($model,'customer_mobile',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'customer_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'counter_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'created_by'); ?>
    <?php echo $form->textFieldControlGroup($model,'order_date'); ?>
    <?php echo $form->textFieldControlGroup($model,'order_time'); ?>
    <?php echo $form->textAreaControlGroup($model,'comment',array('rows'=>6)); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
