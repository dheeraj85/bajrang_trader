<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
        ));
?>
<div class="row">
       <div class='col-md-3'>
        <label>From Date</label>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'from_date',
            'id' => 'from_date',
            'value'=>isset(Yii::app()->request->cookies['fdate']->value)?Yii::app()->request->cookies['fdate']->value:"",
            'options' => array(
                'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
            ),
            'htmlOptions' => array(
                'style' => '',
                //'readonly' => 'readonly'
                'placeholder' => 'From Date', 'class' => 'form-control',
            ),
        ));
        ?>
    </div>
    <div class='col-md-3'>
        <label>To Date</label>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'to_date',
            'id' => 'to_date',
            'value'=>isset(Yii::app()->request->cookies['tdate']->value)?Yii::app()->request->cookies['tdate']->value:"",
            'options' => array(
                'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
            ),
            'htmlOptions' => array(
                'style' => '',
                //'readonly' => 'readonly'
                'placeholder' => 'To Date', 'class' => 'form-control',
            ),
        ));
        ?>
    </div>
    <div class="col-lg-3">
        <label>Voucher Type</label><br/>
        <?php echo $form->dropDownList($model, 'voucher_type_id', CHtml::listData(Vouchertype::model()->findAll(), 'id', 'voucher_name'), array('class' => 'form-control', 'empty' => '--Select--')); ?>
    </div>
    <div class="col-lg-3" style="margin-top:20px;">
        <?php echo BsHtml::submitButton('Search', array('color' => BsHtml::BUTTON_COLOR_PRIMARY,)); ?>  
    </div>
    <div style="clear:both"></div><br/>
</div>
<?php $this->endWidget(); ?>
