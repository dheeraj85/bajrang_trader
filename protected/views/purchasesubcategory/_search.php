<?php
/* @var $this PurchasesubcategoryController */
/* @var $model Purchasesubcategory */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'category_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'name',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'type',array('maxlength'=>9)); ?>
    <?php echo $form->textFieldControlGroup($model,'description',array('maxlength'=>200)); ?>
    <?php echo $form->textFieldControlGroup($model,'is_active'); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
