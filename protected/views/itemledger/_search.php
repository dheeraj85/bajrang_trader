<?php
/* @var $this ItemledgerController */
/* @var $model Itemledger */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'item_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'invoice_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'stock_type',array('maxlength'=>8)); ?>
    <?php echo $form->textFieldControlGroup($model,'debit_qty',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'credit_qty',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'balance_qty',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'dated'); ?>
    <?php echo $form->textAreaControlGroup($model,'description',array('rows'=>6)); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
