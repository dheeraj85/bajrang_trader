<?php
/* @var $this OffshelfsaleController */
/* @var $model Offshelfsale */
/* @var $form BSActiveForm */
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'offshelfsale-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));

$sale = Offshelfsale::model()->findByAttributes(array(), array('order' => 'id desc', 'limit' => 1));
if (!empty($sale)) {
    $memo = $sale->memo_number + 1;
} else {
    $memo = '01';
}
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php // echo $form->errorSummary($model);   ?>

<?php echo $form->hiddenField($model, 'txn_type', array('maxlength' => 32)); ?>
<?php
if (!empty($model->memo_number)) {
    echo $form->hiddenField($model, 'memo_number', array('maxlength' => 32));
} else {
    echo $form->hiddenField($model, 'memo_number', array('maxlength' => 32, 'value' => sprintf("%04d", $memo)));
}
?>
<div class='row'>
    <div class='col-md-3'>
        <?php echo $form->dropDownListControlGroup($model, 'customer_id', CHtml::listData(Customer::model()->findAllByAttributes(array('type' => 'party')), 'id', 'full_name'), array('empty' => '--Select Internal Customer--')); ?>
    </div>
    <div class='col-md-5'>
        <?php echo $form->textAreaControlGroup($model, 'comment', array('rows' => 1)); ?>
    </div>
    <div class='col-md-1' style="margin-top: 25px;">  
        <?php echo BsHtml::submitButton('Generate Bill', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
