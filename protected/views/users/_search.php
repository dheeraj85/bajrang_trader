<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'name',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'mobile',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'email',array('maxlength'=>100)); ?>
            <?php echo $form->textFieldControlGroup($model,'role',array('maxlength'=>14)); ?>
    <?php echo $form->textFieldControlGroup($model,'logged_in'); ?>
    <?php echo $form->textFieldControlGroup($model,'logged_out'); ?>
    <?php echo $form->textFieldControlGroup($model,'is_active'); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
