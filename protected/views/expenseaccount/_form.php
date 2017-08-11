<?php

$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'expenseaccount-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php //echo $form->errorSummary($model); ?>
<div class='row'>
    <div class='col-md-6'>
    <?php echo $form->dropDownListControlGroup($model, 'expense_heads_id', CHtml::listData(Expenseheads::model()->findAll(), 'id', 'name'), array('empty' => '--Select--')); ?>
    </div>
    <div class='col-md-6'>
        <?php echo $form->textFieldControlGroup($model, 'firm_name', array('maxlength' => 50)); ?> 
    </div>
</div>
<div class='row'>
    <div class='col-md-6'>
        <?php echo $form->textFieldControlGroup($model, 'mobile', array('maxlength' => 10)); ?>   
    </div>
    <div class='col-md-6'>
        <?php echo $form->textFieldControlGroup($model, 'contact_no', array('maxlength' => 12)); ?> 
    </div>
</div>
<div class='row'>
    <div class='col-md-6'>
        <?php echo $form->textFieldControlGroup($model, 'email', array('maxlength' => 100)); ?>  
    </div>
    <div class='col-md-6'>
        <?php echo $form->textFieldControlGroup($model, 'gstin_no', array('maxlength' => 20)); ?>  
    </div>
</div>

<div class='row'>
    <div class='col-md-6'>
        <?php echo $form->textFieldControlGroup($model, 'pan_no', array('maxlength' => 10)); ?>  
    </div>
    <div class='col-md-6'>
        <?php echo $form->textFieldControlGroup($model, 'address', array('maxlength' => 100)); ?>  
    </div>
</div>
<?php //echo $form->textFieldControlGroup($model, 'expense_heads_id'); ?>
<?php echo $form->textAreaControlGroup($model, 'description', array('rows' => 6)); ?>
<?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY,'id'=>'btnaccount')); ?>
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
    $('#btnaccount').click(function() {
        $(this).attr('disabled');
        $('#myModal').modal('show');
    });
</script>