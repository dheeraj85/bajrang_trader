<?php
$c = 1;
foreach ($attendance as $at) {
    $c++;
}
?>
<div class="col-lg-12 col-sm-12 col-xs-12">
<div class="row">
    <span class="pull-right">
        <form action="<?php echo $this->createUrl('/staff/admin/staffattendance/getExcelReport'); ?>">
            <input type="hidden" id="ssid" name="ssid" value="<?php echo $ssid; ?>" />
            <input type="hidden" id="scid" name="scid" value="<?php echo $scid; ?>" />
            <input type="hidden" id="fd" name="fd" value="<?php echo $fd; ?>" />
            <input type="hidden" id="td" name="td" value="<?php echo $td; ?>" />
            <button type="submit" class="btn btn-info"><i class="fa fa-download"></i> Download Excel</button>
        </form>
    </span>
    </div><br/>
    <div class="" style="overflow: auto;">
        <table class="table table-bordered">
            <thead>
            <th style="width: 300px;"> Staff Member Name</th>
            <?php
            foreach ($array as $v) {
                $day = date('D', strtotime($v)) . 'day';
                if ($day == 'Sunday') {
                    ?>
                    <th style="color: red;"><?php echo date('M', strtotime($v)); ?><br/><?php echo date('d', strtotime($v)); ?></th>
                <?php } else { ?>
                    <th><?php echo date('M', strtotime($v)); ?><br/><?php echo date('d', strtotime($v)); ?></th>
                    <?php
                }
            }
            ?>
            </thead>
            <tbody>
                <?php
                $count = 1;
                foreach ($attendance as $a) {
                    $staff = Staffmaster::model()->findByPk($a->staff_id);
                    ?>
                <tr>
                        <td style="width: 300px;"><?php echo $staff->staff_fname . ' ' . $staff->staff_mname . ' ' . $staff->staff_lname; ?></td>
                        <?php
                        foreach ($array as $v) {
                            $newdate = date('Y-m-d', strtotime($v));
                            $details = Staffattendance::model()->findByAttributes(array('session' => $a->session_id, 'subcategory' => $a->sub_category_id, 'staff_id' => $a->staff_id, 'date' => $newdate));
                            if ($details->attendance == 'present') {
                                if($details->half_day==0){
                                $att = '<b style="color: green;">P</b>';
                                }else if($details->half_day==1){
                                $att = '<b style="color: #006666;">H</b>';
                                }
                            } else if ($details->attendance == 'absent') {
                                $att = '<b style="color: red;">A</b>';
                            } else if ($details->attendance == 'medical leave') {
                                $att = '<b style="color: blue;">M</b>';
                            }
                            if (!empty($details)) {
                                ?>
                                <td><?php
                                    echo $att;
                                    ?></td>
                                <?php
                            } else if (empty($details)) {
                                $day = date('D', strtotime($v)) . 'day';
                                if ($day == 'Sunday' && $count == 1) {
                                    ?>
                                    <td rowspan="<?php echo $c; ?>"class="alert alert-warning"><?php echo 'S<br>U<br>N<br>D<br>A<br>Y'; ?></td>
                                <?php } else if ($day != 'Sunday') {
                                    ?>
                                    <td><?php
                                        echo '';
                                        ?></td>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </tr>
                    <?php
                    $count++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>