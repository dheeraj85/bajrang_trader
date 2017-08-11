<?php
/* @var $this CustomerController */
/* @var $model Customer */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'type',array('maxlength'=>8)); ?>
    <?php echo $form->textFieldControlGroup($model,'full_name',array('maxlength'=>50)); ?>
    <?php echo $form->textFieldControlGroup($model,'mobile_no',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'address',array('maxlength'=>150)); ?>
    <?php echo $form->textFieldControlGroup($model,'party_store_name',array('maxlength'=>150)); ?>
    <?php echo $form->textFieldControlGroup($model,'landline',array('maxlength'=>150)); ?>
    <?php echo $form->textFieldControlGroup($model,'email_id',array('maxlength'=>150)); ?>
    <?php echo $form->textFieldControlGroup($model,'regdate'); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
