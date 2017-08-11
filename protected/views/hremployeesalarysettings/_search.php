<?php
/* @var $this HremployeesalarysettingsController */
/* @var $model Hremployeesalarysettings */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'employee_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'total_ctc',array('maxlength'=>12)); ?>
    <?php echo $form->textFieldControlGroup($model,'per_day_ctc',array('maxlength'=>12)); ?>
    <?php echo $form->textFieldControlGroup($model,'pf_deduction',array('maxlength'=>12)); ?>
    <?php echo $form->textFieldControlGroup($model,'other_deduction',array('maxlength'=>12)); ?>
    <?php echo $form->textFieldControlGroup($model,'hra',array('maxlength'=>12)); ?>
    <?php echo $form->textFieldControlGroup($model,'earned_leaves'); ?>
    <?php echo $form->textFieldControlGroup($model,'lwp'); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
