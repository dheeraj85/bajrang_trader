<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'time-table',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
    'action' => $this->createUrl('/class/admin/attendance/create')
        ));
?>
<div class="row">
    <input type="hidden" id="class" name="Attendance[session]" value="<?php echo $ssid; ?>" />
    <input type="hidden" id="section" name="Attendance[class]" value="<?php echo $ctid; ?>" />
    <input type="hidden" id="ssid" name="Attendance[section]" value="<?php echo $section; ?>" />
    <input type="hidden" id="ssid" name="Attendance[date]" value="<?php echo $dated; ?>" />
    <?php $model1 = Classallotment::model()->findAllByAttributes(array('session_id' => $ssid,'class_id'=>$ctid,'section_id'=>$section)); ?>
    <?php //print_r($model1);    exit();
    if(!empty ($model1)){
    ?>
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="col-lg-3 col-sm-3 col-xs-3"><b>Enroll No.</b></div>
            <div class="col-lg-3 col-sm-3 col-xs-3"><b>Name</b></div>
            <div class="col-lg-6 col-sm-6 col-xs-6"><b>Attendance</b></div>
        </div>        
    </div><br>
    <div class="row hidden-sm hidden-md hidden-lg">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="col-lg-3 col-sm-3 col-xs-3"></div>
            <div class="col-lg-3 col-sm-3 col-xs-3"></div>
            <div class="col-lg-6 col-sm-6 col-xs-6">
                <div class="col-lg-3 col-sm-3 col-xs-3"><b class="badge badge-green">P</b></div>
                <div class="col-lg-3 col-sm-3 col-xs-3"><b class="badge badge-danger">A</b></div>
                <div class="col-lg-3 col-sm-3 col-xs-3"><b class="badge badge-blue">M</b></div>
            </div>
        </div>        
    </div><br>
    <?php
    foreach ($model1 as $md) {
        ?>
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12">
                <div class="col-lg-3 col-sm-3 col-xs-3"><?php
                        echo $md->enrollment_no;
                    ?>
                </div>
                <div class="col-lg-3 col-sm-3 col-xs-3"><?php $stu = Studentmaster::model()->findByPk($md->student_id); 
                echo $stu->student_fname.' '.$stu->student_mname.' '.$stu->student_lname;
                $modelold = Attendance::model()->findByAttributes(array('session'=>$ssid,'class'=>$ctid,'section'=>$section,'student_id'=>$md->student_id,'date'=>$dated));
                ?>
                </div>
                <div class="col-lg-6 col-sm-6 col-xs-6">
                    <div class="col-lg-3 col-sm-3 col-xs-3">
                        <div class="radio">
                            <label>
                                <input name="Attendance[attendance<?php echo $md->id ?>]" value="present" type="radio" class="colored-success" checked="checked" <?php if($modelold->attendance == 'present'){ ?>checked="checked"<?php } ?>>
                                <span class="text"><span class="text hidden-xs">Present</span></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-xs-3">
                        <div class="radio">
                            <label>
                                <input name="Attendance[attendance<?php echo $md->id ?>]" value="absent" type="radio" class="colored-danger" <?php if($modelold->attendance == 'absent'){ ?>checked="checked"<?php } ?>>
                                <span class="text visible-lg-* visible-md-* visible-sm-*"><span class="text hidden-xs"> Absent</span></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4">
                        <div class="radio">
                            <label>
                                <input name="Attendance[attendance<?php echo $md->id ?>]" value="medical leave" type="radio" class="colored-blue" <?php if($modelold->attendance == 'medical leave'){ ?>checked="checked"<?php } ?>>
                                <span class="text visible-lg-* visible-md-* visible-sm-*"><span class="text hidden-xs"> Medical Leave</span></span>
                            </label>
                        </div>
                    </div>
                    </div>
            </div>
        </div><br>
<?php } ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-7"></div>
            <div class="col-lg-2">
                
            </div>
            <div class="col-lg-3"><?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?></div>
        </div>        
        </div>
        <?php }else{ ?>
        <div class="alert alert-danger">No Student Found For This Class</div>
        <?php } ?>
    </div><br>
<?php $this->endWidget(); ?>
    
    <script type="text/javascript">
        $(document).ready(function() {
<?php foreach ($model1 as $md) { ?>
                var ctid = $('#category<?php echo $md->id; ?>').val();
                if(ctid != ""){
                    var classid = $('#class').val();
                    var section = $('#section').val();
                    var session = $('#ssid').val();
                    var subject = $('#subject<?php echo $md->id ?>').val();
                    $.ajax({
                        url: '<?php echo $this->createUrl('/class/admin/subjectTeacher/getsubcategory'); ?>',
                        data: {'ctid': ctid,'classid': classid,'section':section,'session':session,'subject':subject},
                        cache: false,
                        success: function(response) {
                            $('#subcategory<?php echo $md->id; ?>').html(response);
                        }
                    });
                    var classid = $('#class').val();
                    var section = $('#section').val();
                    var session = $('#ssid').val();
                    var subject = $('#subject<?php echo $md->id ?>').val();
                    $.ajax({
                        url: '<?php echo $this->createUrl('/class/admin/subjectTeacher/getteacher'); ?>',
                        data: {'ctid':ctid,'classid': classid,'section':section,'session':session,'subject':subject},
                        cache: false,
                        success: function(response) {
                            $('#stype<?php echo $md->id; ?>').html(response);
                        }
                    });
                    }
                $('#category<?php echo $md->id; ?>').change(function() {
                    var ctid = $('#category<?php echo $md->id; ?>').val();
                    var classid = $('#class').val();
                    var section = $('#section').val();
                    var session = $('#ssid').val();
                    var subject = $('#subject<?php echo $md->id ?>').val();
                    $.ajax({
                        url: '<?php echo $this->createUrl('/class/admin/subjectTeacher/getsubcategory'); ?>',
                        data: {'ctid': ctid,'classid': classid,'section':section,'session':session,'subject':subject},
                        cache: false,
                        success: function(response) {
                            $('#subcategory<?php echo $md->id; ?>').html(response);
                        }
                    });
                });
                $('#subcategory<?php echo $md->id; ?>').change(function() {
                    var sub = $('#subcategory<?php echo $md->id; ?>').val();
                    var classid = $('#class').val();
                    var section = $('#section').val();
                    var session = $('#ssid').val();
                    var subject = $('#subject<?php echo $md->id ?>').val();
                    $.ajax({
                        url: '<?php echo $this->createUrl('/class/admin/subjectTeacher/getteacher'); ?>',
                        data: {'sub': sub,'classid': classid,'section':section,'session':session,'subject':subject},
                        cache: false,
                        success: function(response) {
                            $('#stype<?php echo $md->id; ?>').html(response);
                        }
                    });
                });
<?php } ?>
        });
    </script>