<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'employeesalary-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));
?>
<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<div class='row'>
    <div class='col-md-4'>
        <?php echo $form->dropDownListControlGroup($model, 'employee_id', CHtml::listData(Employee::model()->findAll(), 'id', 'empname'), array('empty' => '--Select Employee--')); ?>
    </div>
    <div class='col-md-4'>
        <label>Month</label>
        <?php echo $form->dropdownlist($model, 'month', Utils::year_name(), array('maxlength' => 100, 'id' => 'salary_month', 'class' => 'form-control')); ?>
    </div>
    <div class='col-md-4'>
        <label>Year</label>
        <select id="Employeesalary_year" name="Employeesalary[year]" class="form-control">
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
<div class='row'>
    <div class='col-md-3'>
        <?php echo $form->textFieldControlGroup($model, 'total_present_days',array('readonly'=>'readonly')); ?>
    </div>
    <div class='col-md-3'>
        <?php echo $form->textFieldControlGroup($model, 'total_absent_days',array('readonly'=>'readonly')); ?>
    </div>
    <div class='col-md-3'>
        <?php echo $form->textFieldControlGroup($model, 'total_leave_days',array('readonly'=>'readonly')); ?>
    </div>    
    <div class='col-md-3'>
        <label>Gross Salary <a class="update" data-title="Details" title="" data-toggle="tooltip" 
data-original-title="(Per day CTC * muliply by Total (Present days + Earned Leave + Medical Leave Available))"><b>?</b></a></label>
        <?php echo $form->textField($model, 'amount', array('maxlength' => 12,'readonly'=>'readonly')); ?>
    </div>
</div>
<div class='row'>
    <div class='col-md-3'>
        <?php echo $form->textFieldControlGroup($model, 'hra', array('maxlength' => 12,'readonly'=>'readonly')); ?>
    </div>
    <div class='col-md-3'>
        <?php echo $form->textFieldControlGroup($model, 'incentive', array('maxlength' => 12)); ?>
    </div>    
    <div class='col-md-3'>
        <?php echo $form->textFieldControlGroup($model, 'ta', array('maxlength' => 12)); ?>
    </div>
    <div class='col-md-3'>
        <?php echo $form->textFieldControlGroup($model, 'da', array('maxlength' => 12)); ?>
    </div>
</div>
<div class='row'>
    <div class='col-md-3'>
        <label>PF</label>
       <input maxlength="12" readonly="readonly" name="pf" id="Employeesalary_pf" class="form-control" placeholder="PF" type="text">
    </div>
     <div class='col-md-3'>
        <?php echo $form->textFieldControlGroup($model, 'advance', array('maxlength' => 12)); ?>
    </div> 
    <div class='col-md-3'>
        <?php echo $form->textFieldControlGroup($model, 'salary_deduction', array('maxlength' => 12)); ?>
    </div>
    <div class='col-md-3'>
        <label>Total Salary <a class="update" data-title="Details" title="" data-toggle="tooltip" 
data-original-title="(Gross Amount + HRA + Incentive + TA + DA - PF -Advance -Salary Deduction)"><b>?</b></a></label>
        <?php echo $form->textField($model, 'total_salary', array('maxlength' => 12,'readonly'=>'readonly')); ?>
    </div>
</div>
<div class="row">    
    <div class='col-md-12'>
        <?php echo $form->textAreaControlGroup($model, 'remark', array('maxlength' => 255)); ?>
    </div>
</div>
<div class='row'>
    <div class='col-md-11'></div>
    <div class='col-md-1 pull-right'>
        <?php echo BsHtml::Button('Save', array('color' => BsHtml::BUTTON_COLOR_PRIMARY,'id'=>'generatesalary')); ?>
    </div>
</div>
<input type="hidden" name="per_day_ctc" id="per_day_ctc">
<input type="hidden" name="pf_deduction" id="pf_deduction">
<input type="hidden" name="earned_leaves" id="earned_leaves">
<input type="hidden" name="medical_leaves" id="medical_leaves">
<input type="hidden" name="lwp" id="lwp">
<?php $this->endWidget(); ?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/bs/js/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#Employeesalary_employee_id").change(function(){
            var employee_id=$("#Employeesalary_employee_id").val();
            var sal_month=$("#salary_month").val();
            var year=$("#Employeesalary_year").val();
            getattendance(employee_id,sal_month,year);
            getbenefitdetails(employee_id);
        });
        $("#salary_month").change(function(){
            var employee_id=$("#Employeesalary_employee_id").val();
            var sal_month=$("#salary_month").val();
            var year=$("#Employeesalary_year").val();
            getattendance(employee_id,sal_month,year);
        });
        $("#Employeesalary_year").change(function(){
            var employee_id=$("#Employeesalary_employee_id").val();
            var sal_month=$("#salary_month").val();
            var year=$("#Employeesalary_year").val();
            getattendance(employee_id,sal_month,year);
        });
        
         $("#Employeesalary_advance").change(function(){
            var salary_ta=$("#Employeesalary_ta").val();
            var salary_da=$("#Employeesalary_da").val();
            var salary_advance=$("#Employeesalary_advance").val();
            var salary_incentive=$("#Employeesalary_incentive").val();
            var salary_hra=$("#Employeesalary_hra").val();
            var salary_deduct=$("#Employeesalary_salary_deduction").val();
            calculatetotal(salary_advance,salary_incentive,salary_hra,salary_deduct,salary_ta,salary_da);
        });
        
         $("#Employeesalary_incentive").change(function(){
            var salary_ta=$("#Employeesalary_ta").val();
            var salary_da=$("#Employeesalary_da").val();
            var salary_advance=$("#Employeesalary_advance").val();
            var salary_incentive=$("#Employeesalary_incentive").val();
            var salary_hra=$("#Employeesalary_hra").val();
            var salary_deduct=$("#Employeesalary_salary_deduction").val();
            calculatetotal(salary_advance,salary_incentive,salary_hra,salary_deduct,salary_ta,salary_da);
        });
        
         $("#Employeesalary_salary_deduction").change(function(){
            var salary_ta=$("#Employeesalary_ta").val();
            var salary_da=$("#Employeesalary_da").val();
            var salary_advance=$("#Employeesalary_advance").val();
            var salary_incentive=$("#Employeesalary_incentive").val();
            var salary_hra=$("#Employeesalary_hra").val();
            var salary_deduct=$("#Employeesalary_salary_deduction").val();
            calculatetotal(salary_advance,salary_incentive,salary_hra,salary_deduct,salary_ta,salary_da);
        });
        
         $("#Employeesalary_ta").change(function(){
            var salary_ta=$("#Employeesalary_ta").val();
            var salary_da=$("#Employeesalary_da").val();
            var salary_advance=$("#Employeesalary_advance").val();
            var salary_incentive=$("#Employeesalary_incentive").val();
            var salary_hra=$("#Employeesalary_hra").val();
            var salary_deduct=$("#Employeesalary_salary_deduction").val();
            calculatetotal(salary_advance,salary_incentive,salary_hra,salary_deduct,salary_ta,salary_da);
        });
        
         $("#Employeesalary_da").change(function(){
            var salary_ta=$("#Employeesalary_ta").val();
            var salary_da=$("#Employeesalary_da").val();
            var salary_advance=$("#Employeesalary_advance").val();
            var salary_incentive=$("#Employeesalary_incentive").val();
            var salary_hra=$("#Employeesalary_hra").val();
            var salary_deduct=$("#Employeesalary_salary_deduction").val();
            calculatetotal(salary_advance,salary_incentive,salary_hra,salary_deduct,salary_ta,salary_da);
        });
        
         $('#generatesalary').click(function() {
            var form = $('#employeesalary-form').serialize();
           // if ($("#payment_mode").val() == "") {
               // alert("Select Payment Mode");
               // $("#payment_mode").focus();
               // return false;
            //} else {
                $("#generatesalary").attr('disabled', 'disabled').html("Submiting...");
                $.ajax({
                    url: '<?php echo $this->createUrl('employeesalary/generatesalary') ?>',
                    data: form + '&YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>',
                    type: 'post',
                    cache: false,
                    success: function(response) {
                        $("#generatesalary").removeAttr('disabled').html('Save');
                        $('#employeesalary-form')[0].reset();
                        setInterval(function() {
                            window.location.href = "<?php echo $this->createUrl('employeesalary/admin') ?>";
                        }, 1000);
                    }
                });
                return true;
            //}
        });
    });
    
    function getattendance(employee_id,sal_month,year){
        $.ajax({
            url: '<?php echo $this->createUrl('employeesalary/getattendance') ?>',
            data: {'employee_id': employee_id,'sal_month': sal_month,'year': year},
            type: 'get',
            dataType: 'JSON',
            cache: false,
            success: function(response) {
                $("#Employeesalary_total_present_days").val(response.present_count);
                $("#Employeesalary_total_absent_days").val(response.absent_count);
                $("#Employeesalary_total_leave_days").val(response.leave);
                calculateamount(response.present_count,response.leave);
            }
        });
    }
    function getbenefitdetails(employee_id){
        $.ajax({
            url: '<?php echo $this->createUrl('employeesalary/getbenefitdetails') ?>',
            data: {'employee_id': employee_id},
            type: 'get',
            dataType: 'JSON',
            cache: false,
            success: function(response) {
                $("#per_day_ctc").val(response.salarysetting.per_day_ctc);
                $("#Employeesalary_hra").val(response.salarysetting.hra);
                $("#Employeesalary_pf").val(response.salarysetting.pf_deduction);
                $("#pf_deduction").val(response.salarysetting.pf_deduction);
                $("#Employeesalary_salary_deduction").val(response.salarysetting.other_deduction);
                $("#earned_leaves").val(response.salarysetting.earned_leaves);
                $("#medical_leaves").val(response.salarysetting.medical_leaves);
                $("#lwp").val(response.salarysetting.lwp);
            }
        });
    }
    function calculateamount(present_count,leave){
        var per_day_ctc=$("#per_day_ctc").val();
        var earned_leaves=$("#earned_leaves").val();
        var medical_leaves=$("#medical_leaves").val();
        var totalleaves=eval(earned_leaves)+eval(medical_leaves);
        var totaldays="";
        var amount="";
        if(totalleaves>0){
            totaldays=eval(present_count)+eval(leave);
            amount=eval(totaldays)*eval(per_day_ctc);
            $("#Employeesalary_amount").val(amount.toFixed(2));
        }else{
            totaldays=eval(present_count);
            amount=eval(totaldays)*eval(per_day_ctc);
            $("#Employeesalary_amount").val(amount.toFixed(2));
        }
    }
    function calculatetotal(salary_advance,salary_incentive,salary_hra,salary_deduct,salary_ta,salary_da){
        var amount=$("#Employeesalary_amount").val();
        var pf_deduction=$("#pf_deduction").val();
        var gtotal=eval(amount)+eval(salary_ta)+eval(salary_da)+eval(salary_hra)+eval(salary_incentive);
        var tamount=eval(gtotal)-eval(pf_deduction)-eval(salary_advance)-eval(salary_deduct);
        $("#Employeesalary_total_salary").val(tamount.toFixed(2));
    }
</script>    