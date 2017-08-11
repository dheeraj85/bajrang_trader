<?php
/* @var $this PostaxesController */
/* @var $model Postaxes */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'tax_name',array('maxlength'=>50)); ?>
    <?php echo $form->textFieldControlGroup($model,'tax_percent',array('maxlength'=>5)); ?>
    <?php echo $form->textFieldControlGroup($model,'description',array('maxlength'=>200)); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
