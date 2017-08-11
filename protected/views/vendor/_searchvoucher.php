<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
        ));
?>
<div class="row">
    <div class="col-lg-3">
        <label>Voucher Type</label><br/>
<?php echo $form->dropDownList($model, 'voucher_type_id', CHtml::listData(Vouchertype::model()->findAll(), 'id', 'voucher_name'), array('class' => 'form-control', 'empty' => '--Select--')); ?>
    </div>
    <div class="col-lg-3">
        <label>Expense Nature</label><br/>
<?php echo $form->dropDownList($model, 'expense_nature_id', CHtml::listData(Expensenature::model()->findAll(), 'id', 'name'), array('class' => 'form-control', 'empty' => '--Select--')); ?>
    </div>
    <div class="col-lg-3">
        <label>Voucher Date</label><br/>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'Voucher[dated]',
            'id' => 'voucher_date',
            'value' => $model->dated,
            'options' => array(
                'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
            ),
            'htmlOptions' => array(
                'style' => '',
                //'readonly' => 'readonly'
                'placeholder' => 'Voucher Date', 'class' => 'form-control',
            ),
        ));
        ?>
    </div>
    <div class="col-lg-3" style="margin-top:20px;">
<?php echo BsHtml::submitButton('Search', array('color' => BsHtml::BUTTON_COLOR_PRIMARY,)); ?>  
    </div>
    <div style="clear:both"></div><br/>
</div>
<?php $this->endWidget(); ?>
