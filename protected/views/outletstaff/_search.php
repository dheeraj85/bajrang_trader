<?php
/* @var $this OutletstaffController */
/* @var $model Outletstaff */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'created_by'); ?>
    <?php echo $form->textFieldControlGroup($model,'first_name',array('maxlength'=>50)); ?>
    <?php echo $form->textFieldControlGroup($model,'last_name',array('maxlength'=>50)); ?>
    <?php echo $form->textFieldControlGroup($model,'mobile_no',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'address',array('maxlength'=>50)); ?>
    <?php echo $form->textFieldControlGroup($model,'loginid',array('maxlength'=>50)); ?>
        <?php echo $form->textFieldControlGroup($model,'staff_role',array('maxlength'=>9)); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
