<?php
/* @var $this InvoicesettingsController */
/* @var $model Invoicesettings */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'type',array('maxlength'=>12)); ?>
    <?php echo $form->textFieldControlGroup($model,'label',array('maxlength'=>20)); ?>
    <?php echo $form->textFieldControlGroup($model,'value',array('maxlength'=>5)); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
