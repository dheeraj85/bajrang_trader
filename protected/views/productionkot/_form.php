<?php
/* @var $this ProductionkotController */
/* @var $model Productionkot */
/* @var $form BSActiveForm */
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'productionkot-form',
//            'action' => $this->createUrl('productionkot/create'),
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));

$today = date('Y-m-d');
$pkot = Productionkot::model()->findByAttributes(array('kot_date' => $today),array('order'=>'id desc','limit'=>1));
if (!empty($pkot)) {
    $kot = $pkot->kot_no + 1;
} else {
    $kot = '01';
}
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php // echo $form->errorSummary($model);  ?>

<div class='row'>
    <!--<div class='col-md-3'>-->
        <?php 
        if(!empty($model->kot_no)){
        echo $form->hiddenField($model, 'kot_no', array('maxlength' => 20));     
        }else{
        echo $form->hiddenField($model, 'kot_no', array('maxlength' => 20, 'value' => sprintf("%03d", $kot))); 
        }
        ?>
    <!--</div>-->
         <div class='col-md-3'>
    <?php echo $form->dropDownListControlGroup($model, 'delivery_status', array('Regular' => 'Regular', 'Urgent' => 'Urgent')); ?>
        </div>
    <!--    <div class='col-md-3'>
    <?php // echo $form->textFieldControlGroup($model,'kot_date');  ?>
                </div>-->
    <!--    <div class='col-md-3'>
    <?php //echo $form->dropDownListControlGroup($model, 'status', array('' => '--Select--', 'pending' => 'Pending', 'accept' => 'Accept', 'reject' => 'Reject', 'done' => 'Done')); ?>
        </div>-->
    <div class='col-md-3'>
        <?php echo $form->labelEx($model, 'deliver_by'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'Productionkot[deliver_by]',
            'id' => 'Productionkot_deliver_by',
            'value' => $model->deliver_by,
            'options' => array(
                'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
            ),
            'htmlOptions' => array(
                'style' => '',
                //'readonly' => 'readonly'
                'placeholder' => 'Delivery Date', 'class' => 'form-control',
            ),
        ));
        ?>
        <?php echo $form->error($model, 'deliver_by'); ?>
        <?php // echo $form->textFieldControlGroup($model,'deliver_by');  ?>
    </div>
    <div class='col-md-3' style="margin-top: 25px;">
        <?php echo BsHtml::submitButton('Generate PKOT', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $("#productionkot-form").submit(function() {
            $(".btn").attr('disabled', 'disabled');
        });
        $(".delete").click(function() {
            return confirm("Are you sure you want to delete this data?");
        });
    });
</script>
