<?php
/* @var $this MenuitemsController */
/* @var $model Menuitems */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'p_category_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'p_sub_category_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'barcode',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'brand',array('maxlength'=>200)); ?>
    <?php echo $form->textFieldControlGroup($model,'item_unit',array('maxlength'=>20)); ?>
    <?php echo $form->textFieldControlGroup($model,'item_scale',array('maxlength'=>20)); ?>
    <?php echo $form->textFieldControlGroup($model,'specification',array('maxlength'=>200)); ?>
    <?php echo $form->textFieldControlGroup($model,'unit_price',array('maxlength'=>12)); ?>
    <?php echo $form->textFieldControlGroup($model,'is_active'); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
