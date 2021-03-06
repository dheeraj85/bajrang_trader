<?php
/* @var $this IngredientsController */
/* @var $model Ingredients */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'recipe_item_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'item_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'weight_in_gm'); ?>
    <?php echo $form->textFieldControlGroup($model,'description',array('maxlength'=>200)); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
