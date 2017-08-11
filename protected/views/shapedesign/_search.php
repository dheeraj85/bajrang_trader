<?php
/* @var $this ShapedesignController */
/* @var $model Shapedesign */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'shape_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'design_name',array('maxlength'=>150)); ?>
    <?php echo $form->textFieldControlGroup($model,'design_img',array('maxlength'=>50)); ?>
    <?php echo $form->textFieldControlGroup($model,'design_description',array('maxlength'=>250)); ?>
    <?php echo $form->textFieldControlGroup($model,'design_added_by',array('maxlength'=>8)); ?>
    <?php echo $form->textFieldControlGroup($model,'added_by_id'); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
