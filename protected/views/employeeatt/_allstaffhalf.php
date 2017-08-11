<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'time-table',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
    'action' => $this->createUrl('employeeatt/puthalf')
        ));
?>
    <?php $model1 = Attendance::model()->findAllByAttributes(array('date' => $dated, 'attendance' => 'present')); ?>
    <?php
    //print_r($model1);    exit();
    if (!empty($model1)) {
        ?>
        <div style="overflow-y:scroll;height:250px">
            <table class="table table-bordered">
                <tr>
                    <td>
                          <input type="checkbox" value="1" id="Allcheck2"><b>Select All</b>
                    </td>
                    <td><b>Emp No.</b></td>
                    <td><b>Name</b></td>
                    <td><b>Attendance</b></td>
                </tr>
                <?php
                $count = 1;
                foreach ($model1 as $md) {
                    $staff = Employee::model()->findByPk($md->employee_id);
                    ?>
                    <tr>
                        <td>
                            <input type="checkbox" value="<?php echo $md->id; ?>" name="check[]" id="<?php echo $md->id; ?>" class="allchecked2 singlecheck">
                        </td>
                        <td><b><?php echo $staff->empcode; ?></b></td>
                        <td>
                            <b><?php
                                echo $staff->empname;
                                $modelold = Attendance::model()->findByAttributes(array('employee_id' => $staff->id, 'date' => $dated));
                                ?>
                            </b>
                        </td>
                        <td> 
                            <input class="form-control" type="text" id="timepicker_<?php echo $md->id; ?>" name="<?php echo $md->id; ?>attendance[out_time]"/>
                        </td>
                    </tr>
                    <?php $count++;
                }
                ?>
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
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/dist/js/bootstrap-timepicker.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.singlecheck').click(function(event) {
        if (this.checked) {
            //alert('check');
            var id = $(this).prop('id');
            $("#timepicker_" + id).show();
        } else {
            var id = $(this).prop('id');
            $("#timepicker_" + id).hide();
        }
    });
    <?php
$countn = 1;
foreach ($model1 as $md) {
?>
    $('#timepicker_<?php echo $md->id; ?>').timepicker();
    $('#timepicker_<?php echo $md->id; ?>').hide();
<?php $countn++;
} ?>
    $('#Allcheck2').click(function(event) {
        if (this.checked) {
            $('.allchecked2').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"
                var id = $(this).prop('id');
                $("#timepicker_" + id).show();
            });
        } else {
            $('.allchecked2').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"
                var id = $(this).prop('id');
                $("#timepicker_" + id).hide();
            });
        }
    });

});
</script>