<?php

/* @var $this DesignationController */
/* @var $model Designation */
/* @var $form BSActiveForm */
?>

<?php

$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'designation-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php //echo $form->errorSummary($model);  ?>

<?php echo $form->textFieldControlGroup($model, 'name', array('maxlength' => 100)); ?>
<?php echo $form->textAreaControlGroup($model, 'description', array('maxlength' => 200)); ?>

<?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_AQUA,'id'=>'btndesignation')); ?>
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
    $('#btndesignation').click(function() {
        $(this).attr('disabled');
        $('#myModal').modal('show');
    });
</script>