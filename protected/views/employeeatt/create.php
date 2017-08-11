<?php
/* @var $this StaffattendanceController */
/* @var $model Staffattendance */
?>

<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Human Resource' => array('employee/index'),
    'Employee Attendance',
);
$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Staffattendance', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Staffattendance', 'url' => array('admin')),
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                    <h3 class="panel-title">Employee Attendance</h3>
                </div>
                <div class="panel-body">
                <?php
                $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                    'id' => 'attendance-form',
                    'enableAjaxValidation' => false,
                ));
                ?>
                <div class="row">
                    <div class="col-lg-2 col-sm-2 col-xs-12">
                        <label>Attendance Date<span class="required">*</span></label><br/>
                        <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => 'Attendance[date]',
                            'id' => 'date',
                            'value' => isset($model->date) ? $model->date : date('Y-m-d'),
                            'options' => array(
                                'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
                            ),
                            'htmlOptions' => array(
                                'style' => '',
                                //'readonly' => 'readonly'
                                'placeholder' => 'Attendance Date', 'class' => 'form-control',
                            ),
                        ));
                        ?>
                        <?php echo $form->error($model, 'date'); ?>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-xs-12" style="margin-top: 25px;">
                        <div class="col-lg-3 col-sm-3 col-xs-3">
                            <input type="button" class="btn btn-primary" value="Start" id="next"/>
                        </div>
                        <div class="col-lg-3 col-sm-3 col-xs-3" id="change">
                            <input type="button" class="btn btn-primary" value="Sheet" id="change"/>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-xs-6" id="change">
                            <a href="#" class="btn btn-primary" id="half">Half Day</a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-sm-7 col-xs-12" style="margin-top:20px;">
                        <table class="tabled">
                            <tr>
                                <td>Present</td>
                                <td><div class="bg-green-active colorcode">P</div></td>  
                                <td style="border:none;" width="10"></td>
                               <td>Absent</td>
                                <td><div class="bg-red colorcode">A</div></td>
                               <td style="border:none;" width="10"></td>
                                <td>Earned Leave</td>
                                <td><div class="bg-green-gradient colorcode">EL</div></td> 
                               <td style="border:none;" width="10"></td>
                               <td>Medical Leave</td>
                                <td><div class="bg-info colorcode">ML</div></td> 
                                <td style="border:none;" width="10"></td>
                                <td>Leave Without Pay</td>
                                <td><div class="bg-red-gradient colorcode">LWP</div></td>
                            </tr>
                        </table>
                    </div>
                </div><br/>
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-xs-12" id="parseform">
                    <?php if (Yii::app()->user->hasFlash('successatt')) { ?>
                            <div class="alert1 alert-success">
                                <?php echo Yii::app()->user->getFlash('successatt'); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-xs-12" id="parsehalf">
                        <?php if (Yii::app()->user->hasFlash('successhalf')) { ?>
                            <div class="alert1 alert-success">
                                <?php echo Yii::app()->user->getFlash('successhalf'); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <?php $this->endWidget(); ?>
            </div>
            </div>     
        </div>  
    </div> 
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#pre_session').hide();
        $('#lgd').hide();
        $('#ses').click(function() {
            if ($('#ses').is(':checked')) {
                $('#pre_session').show();
            } else {
                $('#pre_session').hide();
            }
        });       
        $('#next').click(function() {
            if($('#date').val().trim()!=""){
            var dated = $('#date').val();
            Next(dated);
            }else{
             alert("Date Required");
             $('#date').focus();
            }
        });
        $('#change').click(function() {
           if($('#date').val().trim()!=""){
            var dated = $('#date').val();
            Change(dated);
            }else{
             alert("Date Required");
             $('#date').focus();
            }
        });
        $('#half').click(function() {
            if($('#date').val().trim()!=""){
            var dated = $('#date').val();
            Half(dated);
            Gethalf(dated);
            }else{
             alert("Date Required");
             $('#date').focus();
            }
        });
    });
    function Next(dated) {
        $('#parseform').html("<center><img src='<?php echo Yii::app()->baseUrl ?>/dist/img/loading_icon.gif'/></center>");
        $.ajax({
            url: '<?php echo $this->createUrl('employeeatt/getnext'); ?>',
            data: {'dated': dated},
            success: function(response) {
                $('#parseform').html(response);
                $('#parsehalf').hide();
            }
        });
    }
    function Change(dated) {
        $('#parseform').html("<center><img src='<?php echo Yii::app()->baseUrl ?>/dist/img/loading_icon.gif'/></center>");
        $.ajax({
            url: '<?php echo $this->createUrl('employeeatt/getsheet'); ?>',
            data: {'dated': dated},
            success: function(response) {
                $('#parseform').html(response);
                $('#parsehalf').hide();
            }
        });
    }
    function Half(dated) {
        $('#parseform').html("<center><img src='<?php echo Yii::app()->baseUrl ?>/dist/img/loading_icon.gif'/></center>");
        $.ajax({
            url: '<?php echo $this->createUrl('employeeatt/puthalf'); ?>',
            data: {'dated': dated},
            success: function(response) {
                $('#parseform').html(response);
                $('#parsehalf').show();
            }
        });
    }
    function Gethalf(dated) {
        $.ajax({
            url: '<?php echo $this->createUrl('employeeatt/gethalf'); ?>',
            data: {'dated': dated},
            success: function(response) {
                $('#parsehalf').html(response);
            }
        });
    }
</script>