<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'vouchertype-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldControlGroup($model, 'voucher_name', array('maxlength' => 100)); ?>
<label>Payment Receiver Type</label><br/>
<?php echo $form->dropdownlist($model, 'payment_receiver_type', Utils::payment_receiver_type(), array('maxlength' => 100, 'id' => 'select', 'class' => 'form-control')); ?><br/>
<label>Voucher Nature</label><br/>
<?php echo $form->dropdownlist($model, 'voucher_nature', Utils::vnature(), array('maxlength' => 100, 'id' => 'select', 'class' => 'form-control')); ?><br/>
<label>User Role</label><br/>
<?php echo $form->dropdownlist($model, 'user_role', Utils::vroles(), array('maxlength' => 100, 'id' => 'select', 'class' => 'form-control')); ?><br/>
<?php echo $form->textAreaControlGroup($model, 'description', array('maxlength' => 100)); ?>

<?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY,'id'=>'btnvtype')); ?>

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
    $('#btnvtype').click(function() {
        $(this).attr('disabled');
        $('#myModal').modal('show');
    });
</script>