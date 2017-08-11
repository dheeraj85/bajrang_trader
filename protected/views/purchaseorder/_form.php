<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'purchaseorder-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php //echo $form->errorSummary($model);  ?>
<div class='row'>
    <div class='col-md-6'>
        <?php echo $form->textFieldControlGroup($model, 'order_no', array('maxlength' => 50)); ?> 
    </div>
    <div class='col-md-6'>
        <?php echo $form->textFieldControlGroup($model, 'gst_no', array('maxlength' => 50)); ?> 
    </div>
</div>
<div class='row'>
    <div class='col-md-6'>
       <label>Delivery Period From</label><br/>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'Purchaseorder[delivery_form]',
            'id' => 'Purchaseorder_delivery_form',
            'value' => isset($model->delivery_form) ? $model->delivery_form : date('Y-m-d'),
            'options' => array(
                'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
            ),
            'htmlOptions' => array(
                'style' => '',
                //'readonly' => 'readonly'
                'placeholder' => 'Delivery Period From', 'class' => 'form-control',
            ),
        ));
        ?>
    </div>
    <div class='col-md-6'>
       <label>Delivery Period To</label><br/>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'Purchaseorder[delivery_to]',
            'id' => 'Purchaseorder_delivery_to',
            'value' => isset($model->delivery_to) ? $model->delivery_to : date('Y-m-d'),
            'options' => array(
                'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
            ),
            'htmlOptions' => array(
                'style' => '',
                //'readonly' => 'readonly'
                'placeholder' => 'Delivery Period To', 'class' => 'form-control',
            ),
        ));
        ?>
    </div>
</div><br/>
<div class='row'>
    <div class='col-md-6'>
        <label>State</label>
        <?php echo $form->dropDownList($model, 'state_code', CHtml::listData(Gststatecodes::model()->findAll(), 'state_code', 'state_name'), array('class' => 'form-control', 'empty' => '--Select--')); ?>
     </div>
    <div class='col-md-6 pull-right' style="margin-top:25px;">
       <?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_GREEN,'id'=>'btnpo')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
<div id="myModal" style="padding:30px " class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body btn btn-info">
                Please wait while we are saving information. 
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#btnpo').click(function() {
        $(this).attr('disabled');
        $('#myModal').modal('show');
    });
</script>