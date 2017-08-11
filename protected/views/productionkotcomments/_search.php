<?php
/* @var $this ProductionkotcommentsController */
/* @var $model Productionkotcomments */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'production_kot_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'from_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'to_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'comments',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'dated'); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
