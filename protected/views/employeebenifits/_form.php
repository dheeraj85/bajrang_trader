<?php
/* @var $this EmployeebenifitsController */
/* @var $model Employeebenifits */
/* @var $form BSActiveForm */
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'employeebenifits-form',
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
    <div class='col-md-6'>
        <?php echo $form->dropDownListControlGroup($model, 'employee_id', CHtml::listData(Employee::model()->findAll(), 'id', 'empname'), array('empty' => '--Select Employee--')); ?>
    </div>
    <div class='col-md-6'>
          <label>Transaction Type</label>
        <?php echo $form->dropdownlist($model, 'txn_type', Utils::transtype(), array('maxlength' => 100, 'id' => 'txn_type', 'class' => 'form-control')); ?>
     </div>
</div>
<div class='row'>    
     <div class='col-md-6'>
        <label>Month</label>
        <?php echo $form->dropdownlist($model, 'month', Utils::year_name(), array('maxlength' => 100, 'id' => 'select', 'class' => 'form-control')); ?>
    </div>
    <div class='col-md-6'>
        <label>Year</label>
         <select id="Employeebenifits_year" name="Employeebenifits[year]" class="form-control">
            <option value="">-Select-</option>
            <?php foreach (Utils::years() as $y) {
            if($model->year==$y){
                ?>
            <option value="<?php echo $y?>" selected="selected"><?php echo $y?></option>
            <?php }else{ ?>
                <option value="<?php echo $y?>"><?php echo $y?></option>
            <?php }}?>    
       </select>
    </div>
</div>
<div style="clear:both"></div><br/>
<div class="row">
       <div class="col-md-4">
            <?php echo $form->textFieldControlGroup($model, 'amount', array('maxlength' => 12)); ?>
        </div>
       <div class='col-md-4' style="display:none;" id="loan_interest">
            <?php echo $form->textFieldControlGroup($model, 'interest', array('maxlength' => 12)); ?>
        </div> 
      <div class='col-md-4'>
      <label>Date<span class="required">*</span></label><br/>
    <?php
    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'name' => 'Employeebenifits[dated]',
        'id' => 'dated',
        'value' => $model->dated,
        'options' => array(
            'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
        ),
        'htmlOptions' => array(
            'style' => '',
            //'readonly' => 'readonly'
            'placeholder' => 'Date','class'=>'form-control',
        ),
    ));
    ?>
    </div>
</div>

<div class='row'>
    <div class='col-md-6'>
        <?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
<script type="text/javascript">
$("#txn_type").change(function(){
   var txn_type=$(this).val();
   if(txn_type=="loan"){
       $("#loan_interest").fadeIn(1000);
   }else{
       $("#loan_interest").fadeOut(1000);
   }
});
</script>