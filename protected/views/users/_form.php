<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form BSActiveForm */
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'users-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php //echo $form->errorSummary($model); ?>

<?php echo $form->textFieldControlGroup($model, 'name', array('maxlength' => 100)); ?>
<?php echo $form->textFieldControlGroup($model, 'mobile', array('maxlength' => 10)); ?>
<?php echo $form->textFieldControlGroup($model, 'email', array('maxlength' => 100)); ?>
<?php echo $form->textFieldControlGroup($model, 'password', array('maxlength' => 100)); ?>
<?php echo $form->textFieldControlGroup($model, 'auth_password', array('maxlength' => 100)); ?>
<label>Role</label>
<?php echo $form->dropdownlist($model, 'role', Utils::roles(), array('maxlength' => 100, 'id' => 'select', 'class' => 'form-control')); ?>
<br/>
<?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY,'id'=>'btnusers')); ?>
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
    $('#btnusers').click(function() {
        $(this).attr('disabled');
        $('#myModal').modal('show');
    });
</script>