<?php
/* @var $this LoantransactionController */
/* @var $model Loantransaction */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'employee_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'employee_benifits_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'amount',array('maxlength'=>12)); ?>
    <?php echo $form->textFieldControlGroup($model,'dated'); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
