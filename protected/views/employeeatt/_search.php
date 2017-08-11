<?php
/* @var $this StaffattendanceController */
/* @var $model Staffattendance */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'session'); ?>
    <?php echo $form->textFieldControlGroup($model,'subcategory'); ?>
    <?php echo $form->textFieldControlGroup($model,'staff_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'attendance',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'in_time'); ?>
    <?php echo $form->textFieldControlGroup($model,'out_time'); ?>
    <?php echo $form->textFieldControlGroup($model,'half_day'); ?>
    <?php echo $form->textFieldControlGroup($model,'teacher_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'date'); ?>
    <?php echo $form->textFieldControlGroup($model,'is_approved'); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
