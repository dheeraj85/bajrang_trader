<?php
/* @var $this ChallanController */
/* @var $model Challan */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'purchase_invoice_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'challan_no'); ?>
    <?php echo $form->textFieldControlGroup($model,'challan_date'); ?>
    <?php echo $form->textFieldControlGroup($model,'purchase_order_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'ex_station',array('maxlength'=>150)); ?>
    <?php echo $form->textFieldControlGroup($model,'truck_wagon_no',array('maxlength'=>255)); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
