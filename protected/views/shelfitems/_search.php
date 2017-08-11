<?php
/* @var $this ShelfitemsController */
/* @var $model Shelfitems */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'p_category_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'p_sub_category_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'item_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'barcode',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'tax_type',array('maxlength'=>9)); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
