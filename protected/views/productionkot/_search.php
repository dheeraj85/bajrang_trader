<?php
/* @var $this ProductionkotController */
/* @var $model Productionkot */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'kot_no',array('maxlength'=>20)); ?>
    <?php echo $form->textFieldControlGroup($model,'kot_date'); ?>
    <?php echo $form->textFieldControlGroup($model,'status',array('maxlength'=>7)); ?>
    <?php echo $form->textFieldControlGroup($model,'deliver_by'); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
