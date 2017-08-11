<?php
/* @var $this DesigncomplexityController */
/* @var $model Designcomplexity */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'design_code',array('maxlength'=>10)); ?>
    <?php echo $form->textAreaControlGroup($model,'description',array('rows'=>6)); ?>
    <?php echo $form->textFieldControlGroup($model,'rate'); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
