<?php
/* @var $this PurchaseorderitemsController */
/* @var $model Purchaseorderitems */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'purchase_order_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'item_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'item_name',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'item_code',array('maxlength'=>50)); ?>
    <?php echo $form->textFieldControlGroup($model,'qty_req',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'qty_scale',array('maxlength'=>25)); ?>
    <?php echo $form->textFieldControlGroup($model,'rate',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'amount',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'req_date'); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
