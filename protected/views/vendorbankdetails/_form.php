<?php
/* @var $this VendorbankdetailsController */
/* @var $model Vendorbankdetails */
/* @var $form BSActiveForm */
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'vendorbankdetails-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php //echo $form->errorSummary($model);  ?>
<input type="hidden" name="Vendorbankdetails[vendor_id]" value="<?php echo $vid ?>"/>
<div class='row'>
    <div class='col-md-4'>
        <?php echo $form->textFieldControlGroup($model, 'account_name', array('maxlength' => 100)); ?>
    </div>
    <div class='col-md-4'>
        <?php echo $form->textFieldControlGroup($model, 'account_no', array('maxlength' => 100)); ?>
    </div>
    <div class='col-md-4'>
        <?php echo $form->textFieldControlGroup($model, 'bank_name', array('maxlength' => 100)); ?>
    </div>
</div>
<div class='row'>    
    <div class='col-md-4'>
        <?php echo $form->textFieldControlGroup($model, 'branch', array('maxlength' => 50)); ?>
    </div>
    <div class='col-md-4'>
        <?php echo $form->textFieldControlGroup($model, 'ifsc', array('maxlength' => 20)); ?>
    </div>
</div>
<?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_GREEN,'id'=>'btnbankdetails')); ?>
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
    $('#btnbankdetails').click(function() {
        $(this).attr('disabled');
        $('#myModal').modal('show');
    });
</script>