<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
        ));
?>
<div class="row">
    <div class="col-lg-3">
          <label>Expense Head</label><br/>
        <?php echo $form->dropDownList($model, 'expense_head_id', CHtml::listData(Expenseheads::model()->findAll(), 'id', 'name'), array('class' => 'form-control', 'empty' => '--Select--')); ?>
    </div>
    <div class="col-lg-3">
        <?php echo $form->textFieldControlGroup($model, 'voucher_no', array('maxlength' => 50)); ?>
    </div>  
    <div class="col-lg-3">
        <label>Voucher Date</label><br/>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'Expenseinfo[voucher_date]',
            'id' => 'Expenseinfo_voucher_date',
            'value' => $model->voucher_date,
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
    <div class="col-lg-3" style="margin-top:22px;">
        <?php echo BsHtml::submitButton('Search', array('color' => BsHtml::BUTTON_COLOR_PRIMARY,)); ?>
        <a href="#" onclick="authpurchasereview(<?php echo $data->id;?>)"><button type='button' class='btn btn-warning'>Transaction Password</button></a>
    </div>
</div>
<?php $this->endWidget(); ?>