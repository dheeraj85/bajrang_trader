<?php

/* @var $this InvoicesettingsController */
/* @var $model Invoicesettings */
/* @var $form BSActiveForm */
?>

<?php

$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'invoicesettings-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php //echo $form->errorSummary($model); ?>
<?php echo $form->dropdownlistControlGroup($model, 'type', Utils::taxtypes(), array('maxlength' => 100, 'id' => 'select', 'class' => 'form-control')); ?>
<label>GST Tax Percentage<a class="update" data-title="Details" title="" data-toggle="tooltip" 
data-original-title="For Eg:- 5%"><b>?</b></a></label>
<?php echo $form->textField($model, 'label', array('maxlength' => 20)); ?>
<br/>
<?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_AQUA,'id'=>'btninvoice')); ?>
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
    $('#btninvoice').click(function() {
        $(this).attr('disabled');
        $('#myModal').modal('show');
    });
</script>