<?php
/* @var $this ProductionkotitemsController */
/* @var $model Productionkotitems */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'production_kot_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'menu_item_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'qty',array('maxlength'=>15)); ?>
    <?php echo $form->textFieldControlGroup($model,'status',array('maxlength'=>7)); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
