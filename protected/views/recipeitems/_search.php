<?php
/* @var $this RecipeitemsController */
/* @var $model Recipeitems */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'recipe_category',array('maxlength'=>7)); ?>
    <?php echo $form->textFieldControlGroup($model,'category_name_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'description',array('maxlength'=>200)); ?>
    <?php echo $form->textFieldControlGroup($model,'weight_limit_kg'); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
