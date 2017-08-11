<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
        ));
?>
<div class='row'>
    <div class='col-md-4'>
    <?php echo $form->dropDownListControlGroup($model, 'expense_heads_id', CHtml::listData(Expenseheads::model()->findAll(), 'id', 'name'), array('empty' => '--Select--')); ?>
    </div>
    <div class='col-md-4'>
        <?php echo $form->textFieldControlGroup($model, 'mobile', array('maxlength' => 10)); ?>
    </div>
    <div class='col-md-4'>
        <?php echo $form->textFieldControlGroup($model, 'gstin_no', array('maxlength' => 20)); ?>
    </div>
</div>
<div class="form-actions pull-right">
<?php echo BsHtml::submitButton('Search', array('color' => BsHtml::BUTTON_COLOR_PRIMARY,)); ?>
</div>
<div style="clear:both"></div><br/>
<?php $this->endWidget(); ?>
