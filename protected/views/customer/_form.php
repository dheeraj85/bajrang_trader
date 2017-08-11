<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'customer-form',
    'enableAjaxValidation' => false,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php // echo $form->errorSummary($model); ?>

<?php echo $form->hiddenField($model, 'type', array('value' => 'party')); ?>
<div class='row'>
    <div class='col-md-3'>
        <?php echo $form->textFieldControlGroup($model, 'gstin_no', array('maxlength' => 20)); ?>
    </div>
    <div class='col-md-3'>
        <?php echo $form->textFieldControlGroup($model, 'full_name', array('maxlength' => 50)); ?>
    </div>
    <div class='col-md-3'>   
        <?php echo $form->textFieldControlGroup($model, 'mobile_no', array('maxlength' => 10)); ?>
    </div>
    <div class='col-md-3'>
        <?php echo $form->textFieldControlGroup($model, 'party_store_name', array('maxlength' => 150)); ?>
    </div>
</div>
<div class='row'>
    <div class='col-md-3'>
        <?php echo $form->textFieldControlGroup($model, 'email_id', array('maxlength' => 150)); ?>
    </div>
    <div class='col-md-3'>
        <?php echo $form->textFieldControlGroup($model, 'landline', array('maxlength' => 150)); ?>
    </div>
    <div class='col-md-3'>
        <label>State</label>
        <?php echo $form->dropDownList($model, 'state_code', CHtml::listData(Gststatecodes::model()->findAll(), 'state_code', 'state_name'), array('class' => 'form-control', 'empty' => '---Select State---')); ?>
        <?php echo $form->error($model, 'state_code'); ?>
    </div> 
    <div class='col-md-3'>
        <?php echo $form->labelEx($model, 'regdate'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'Customer[regdate]',
            'id' => 'Customer_regdate',
            'value' => isset($model->regdate) ? $model->regdate : date('Y-m-d'),
            'options' => array(
                'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
            ),
            'htmlOptions' => array(
                'style' => '',
                //'readonly' => 'readonly'
                'placeholder' => 'Issue Date', 'class' => 'form-control',
            ),
        ));
        ?>
        <?php echo $form->error($model, 'deliver_by'); ?>
        <?php // echo $form->textFieldControlGroup($model,'deliver_by');  ?>
    </div>
</div> 
<div class='row'>
    <div class='col-md-6'>
        <?php echo $form->textFieldControlGroup($model, 'address', array('maxlength' => 150)); ?>
    </div>
    <div class='col-md-3' style="margin-top: 25px;">
        <?php echo BsHtml::submitButton('Save', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>
        <button type="reset" class="btn btn-default">Cancel</button>
    </div>
</div>
<?php $this->endWidget(); ?>
