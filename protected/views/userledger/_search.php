<?php
/* @var $this UserledgerController */
/* @var $model Userledger */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'type',array('maxlength'=>8)); ?>
    <?php echo $form->textFieldControlGroup($model,'user_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'debit_amt',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'credit_amt',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'balance_amt',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'dated'); ?>
    <?php echo $form->textAreaControlGroup($model,'description',array('rows'=>6)); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
