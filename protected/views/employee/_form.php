<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'employee-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));
?>
<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php //echo $form->errorSummary($model); ?>
<legend class="headline">Personal Information</legend>
<div class='row'>
    <div class='col-md-4'>
        <?php echo $form->textFieldControlGroup($model, 'empcode', array('maxlength' => 50)); ?>
    </div>
    <div class='col-md-4'>
        <?php echo $form->textFieldControlGroup($model, 'empname', array('maxlength' => 100)); ?>
    </div>
    <div class='col-md-4'>
       <?php echo $form->textFieldControlGroup($model, 'fname', array('maxlength' => 100)); ?>
    </div>
</div>
<div class='row'>
    <div class='col-md-4'>
      <label>Date of Birth<span class="required">*</span></label><br/>
<?php
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name' => 'Employee[dob]',
    'id' => 'dob',
    'value' => $model->dob,
    'options' => array(
        'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
    ),
    'htmlOptions' => array(
        'style' => '',
        //'readonly' => 'readonly'
        'placeholder' => 'Date of Birth','class'=>'form-control',
    ),
));
?>
<?php echo $form->error($model, 'dob'); ?>
    </div>
    <div class='col-md-4'>
        <label>Martial Status</label>
        <?php echo $form->dropdownlist($model, 'martial_status', Utils::martial(), array('maxlength' => 100, 'id' => 'select', 'class' => 'form-control')); ?>
    </div>
</div>
<br/>
<legend class="headline">Contact Information</legend>
<div class='row'>
    <div class='col-md-6'>
        <?php echo $form->textFieldControlGroup($model, 'contact', array('maxlength' => 10)); ?>
    </div>
    <div class='col-md-6'>
       <?php echo $form->textFieldControlGroup($model, 'alter_contact', array('maxlength' => 50)); ?>
    </div>
        <div class='col-md-12'>
     <?php echo $form->textAreaControlGroup($model, 'address', array('maxlength' => 200)); ?>
    </div>
</div><br/>
<legend class="headline">Official Information</legend>
<div class='row'>
    <div class='col-md-6'>
        <?php echo $form->textAreaControlGroup($model, 'qualification', array('maxlength' => 200)); ?>
    </div>
     <div class='col-md-6'>
        <?php echo $form->textAreaControlGroup($model, 'experience', array('maxlength' => 200)); ?>
    </div>
</div>
<div class='row'>   
    <div class='col-md-4'>
       <?php echo $form->textFieldControlGroup($model, 'speciality', array('maxlength' => 50)); ?>
    </div>
    <div class='col-md-4'>
           <?php echo $form->dropDownListControlGroup($model, 'designation_id', CHtml::listData(Designation::model()->findAll(), 'id', 'name'), array('class' => 'form-control', 'empty' => '---Select Designation---')); ?>
    </div>
    <div class='col-md-4'>
            <?php echo $form->dropDownListControlGroup($model, 'emptype_id', CHtml::listData(Emptype::model()->findAll(), 'id', 'type'), array('class' => 'form-control', 'empty' => '---Select Type---')); ?>
    </div>
</div>
<div class='row'>
    <div class='col-md-4'>
       <?php echo $form->textFieldControlGroup($model, 'reference_by', array('maxlength' => 50)); ?>
    </div>
    <div class='col-md-4'>
       <?php echo $form->textFieldControlGroup($model, 'aadhar_no', array('maxlength' => 16)); ?>    
    </div>
      <div class='col-md-4'>
       <?php echo $form->textFieldControlGroup($model, 'license_no', array('maxlength' => 50)); ?>
    </div>
</div>
<div class='row'>  
    <div class='col-md-4'>
       <?php echo $form->textFieldControlGroup($model, 'pan_no', array('maxlength' => 10)); ?>
    </div>
</div>
<br/>
<legend class="headline">Bank Information</legend>
<div class="row">
    <div class='col-md-6'>
        <?php echo $form->textFieldControlGroup($model, 'account_no', array('maxlength' => 100)); ?>
    </div>
    <div class='col-md-6'>
        <?php echo $form->textFieldControlGroup($model, 'bank_name', array('maxlength' => 100)); ?>
    </div>
</div>
<div class='row'>    
    <div class='col-md-6'>
        <?php echo $form->textFieldControlGroup($model, 'branch', array('maxlength' => 50)); ?>
    </div>
    <div class='col-md-6'>
        <?php echo $form->textFieldControlGroup($model, 'ifsc', array('maxlength' => 20)); ?>
    </div>
</div>
<?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY,'id'=>'btnemployee')); ?>
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
    $('#btnemployee').click(function() {
        $(this).attr('disabled');
        $('#myModal').modal('show');
    });
</script>