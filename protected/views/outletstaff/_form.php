<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'outletstaff-form',
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
        <?php echo $form->textFieldControlGroup($model, 'first_name', array('maxlength' => 50)); ?>
    </div>
    <div class='col-md-6'>
        <?php echo $form->textFieldControlGroup($model, 'last_name', array('maxlength' => 50)); ?>
    </div>
</div>
<div class='row'>
    <div class='col-md-6'>
        <?php echo $form->textFieldControlGroup($model, 'mobile_no', array('maxlength' => 10)); ?>
    </div>
    <div class='col-md-6'>
        <?php echo $form->textFieldControlGroup($model, 'address', array('maxlength' => 50)); ?>
    </div>
</div>
<div class='row'>
    <div class='col-md-6'>
        <?php echo $form->textFieldControlGroup($model, 'loginid', array('maxlength' => 50)); ?>
    </div>
    <div class='col-md-6'>
        <?php echo $form->passwordFieldControlGroup($model, 'password', array('maxlength' => 50)); ?>
    </div>
</div>
<div class='row'>
    <div class='col-md-6'>
        <label>Staff Role</label>
            <?php echo $form->dropdownlist($model, 'staff_role', Utils::staffrole(), array('maxlength' => 100, 'id' => 'select', 'class' => 'form-control')); ?>
    </div>
</div><br/>
<div class='row'>
    <div class='col-md-12'>
            <?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY, 'id' => 'btnstaff')); ?>
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
    $('#btnstaff').click(function() {
        $(this).attr('disabled');
        $('#myModal').modal('show');
    });
</script>