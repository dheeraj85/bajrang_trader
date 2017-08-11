<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'time-table',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
    'action' => $this->createUrl('employeeatt/create')
        ));
?>
    <input type="hidden" id="ssid" name="Attendance[date]" value="<?php echo $dated; ?>" />
    <?php $model1 = Employee::model()->findAll(); ?>
    <?php
    if (!empty($model1)) {
        ?>
    <div style="overflow-y:scroll;height:250px">
        <table class="table table-bordered">
            <tr>
                <td><b>Emp No.</b></td>
                <td><b>Name</b></td>
                <td><b>Attendance</b></td>
            </tr>     
            <?php
            foreach ($model1 as $md) {
                ?>
                <tr>
                    <td><b><?php echo $md->empcode; ?></b></td>
                    <td><b><?php
                            echo $md->empname;
                            $modelold = Attendance::model()->findByAttributes(array('employee_id' => $md->id, 'date' => $dated));
                            ?></b></td>
                    <td> 
                        <table>
                            <tr>
                                <td>
                                    <label>
                                        <input name="Attendance[attendance<?php echo $md->id ?>]" value="present" type="radio" class="colored-success" <?php if ($modelold->attendance == 'present') { ?>checked="checked"<?php } ?>>
                                       <span class="text hidden-xs">Present</span>
                                    </label>
                                </td>
                                <td width="20"></td>
                                <td>
                                    <label>
                                        <input name="Attendance[attendance<?php echo $md->id ?>]" value="absent" type="radio" class="colored-danger" <?php if ($modelold->attendance == 'absent') { ?>checked="checked"<?php } ?>>
                                        <span class="text hidden-xs"> Absent</span>
                                    </label>
                                </td>
                                 <td width="20"></td>    
                                <td>
                                    <label>
                                        <input name="Attendance[attendance<?php echo $md->id ?>]" value="earned leave" type="radio" class="colored-blue" <?php if ($modelold->attendance == 'earned leave') { ?>checked="checked"<?php } ?>>
                                       <span class="text hidden-xs">Earned Leave</span>
                                    </label>
                                </td>
                                 <td width="20"></td>    
                                <td>
                                    <label>
                                        <input name="Attendance[attendance<?php echo $md->id ?>]" value="medical leave" type="radio" class="colored-blue" <?php if ($modelold->attendance == 'medical leave') { ?>checked="checked"<?php } ?>>
                                       <span class="text hidden-xs"> Medical Leave</span>
                                    </label>
                                </td>
                                <td width="20"></td>    
                                <td>
                                    <label>
                                        <input name="Attendance[attendance<?php echo $md->id ?>]" value="leave without pay" type="radio" class="colored-blue" <?php if ($modelold->attendance == 'leave without pay') { ?>checked="checked"<?php } ?>>
                                       <span class="text hidden-xs"> Leave Without Pay</span>
                                    </label>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
     <table class="table table-bordered">
            <tr>
                <td align="right"><?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?></td>
            </tr>
    </table>
    <?php } else { ?>
        <div class="alert bg-red">No Detail Found</div>
    <?php } ?>
<?php $this->endWidget(); ?>