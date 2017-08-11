<?php
/* @var $this HremployeesalarysettingsController */
/* @var $model Hremployeesalarysettings */
/* @var $form BSActiveForm */
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'employeesalarysettings-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

        <?php // echo $form->errorSummary($model);  ?>
<div class='row'>
    <div class='col-md-4'>
        <label>Employee</label>
        <select class="form-control" name="Employeesalarysettings[employee_id]" id="Employeesalarysettings_employee_id">
            <option value="">--Select Employee--</option>
            <?php foreach(Employee::model()->findAll() as $emp){
            if($model->employee_id==$emp->id){
            ?>
            <option value="<?php echo $emp->id?>" selected><?php echo $emp->empname?> (<?php echo $emp->designation->name?>)</option>
            <?php }else{?>
            <option value="<?php echo $emp->id?>"><?php echo $emp->empname?> (<?php echo $emp->designation->name?>)</option>
            <?php }}?>
        </select>
    </div>
    <div class='col-md-4'>
<?php echo $form->textFieldControlGroup($model, 'total_ctc', array('maxlength' => 12)); ?>
    </div>
        <div class='col-md-4'>
          <label>Per Day CTC <a class="update" data-title="Details" title="" data-toggle="tooltip" 
data-original-title="Per day CTC (Total CTC/divided by 30)"><b>?</b></a></label>   
        <?php echo $form->textField($model, 'per_day_ctc', array('maxlength' => 12,'readOnly'=>"readonly")); ?>
    </div>
</div>
<div class='row'>
    <div class='col-md-4'>
<?php echo $form->textFieldControlGroup($model, 'pf_deduction', array('maxlength' => 12)); ?>
    </div>
    <div class='col-md-4'>
        <?php echo $form->textFieldControlGroup($model, 'other_deduction', array('maxlength' => 12)); ?>
    </div>
    <div class='col-md-4'>
<?php echo $form->textFieldControlGroup($model, 'hra', array('maxlength' => 12)); ?>
    </div>
</div>
<div class='row'>
    <div class='col-md-4'>
        <?php echo $form->textFieldControlGroup($model, 'earned_leaves'); ?>
    </div>
    <div class='col-md-4'>
        <?php echo $form->textFieldControlGroup($model, 'medical_leaves'); ?>
    </div>
    <div class='col-md-4'>
<?php echo $form->textFieldControlGroup($model, 'lwp'); ?>
    </div>
</div>
<div class='row'>
    <div class='col-md-4'>
<?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/bs/js/jquery.js"></script>
<script type="text/javascript">
$("#Employeesalarysettings_total_ctc").change(function(){
   var total_ctc=$(this).val();
   var p_ctc=eval(total_ctc/30);
   $("#Employeesalarysettings_per_day_ctc").val(p_ctc.toFixed(2));
});
</script>