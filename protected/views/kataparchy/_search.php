<?php
/* @var $this KataparchyController */
/* @var $model Kataparchy */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'purchase_invoice_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'challan_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'order_no',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'item_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'item_name',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'item_code',array('maxlength'=>50)); ?>
    <?php echo $form->textFieldControlGroup($model,'load_weight',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'net_weight',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'truck_wagon_no',array('maxlength'=>255)); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
