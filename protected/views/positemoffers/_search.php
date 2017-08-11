<?php
/* @var $this PositemoffersController */
/* @var $model Positemoffers */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'item_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'offer_dscount'); ?>
    <?php echo $form->textFieldControlGroup($model,'offer_description',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'from_date'); ?>
    <?php echo $form->textFieldControlGroup($model,'to_date'); ?>
    <?php echo $form->textFieldControlGroup($model,'status',array('maxlength'=>6)); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
