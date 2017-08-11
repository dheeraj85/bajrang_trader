<div class="row">
    <?php
    $month = date('m', strtotime($dated));
    $year = date('Y', strtotime($dated));
    $model1 = Attendance::model()->findAllBySql("select * from emp_attendance where MONTH(date)=$month AND YEAR(date)=$year group by employee_id");
    $count = 0;
    foreach ($model1 as $m) {
        $count++;
    }
    $type = array();
    foreach (Attendance::model()->getSundays($year, $month) as $sunday) {
        $type[] = $sunday->format("Y-m-d");
    }
    ?>
        <div class="col-lg-12 col-sm-12 col-xs-12 table-responsive">
            <table class="table table-bordered" style="overflow: scroll;">
                <thead>
                    <tr>
                        <th style="width: 300px;">Employee Name</th>
                        <?php
                        $first = $year."-".$month."-01";
                        $timestamp = mktime(0, 0, 0, $month, 1, $year);
                        $ldate=date("t", $timestamp);
                        $last = $year."-".$month."-".$ldate;
                        $thisTime = strtotime($first);
                        $endTime = strtotime($last);
                        while ($thisTime <= $endTime) {
                            $thisDate = date('d', $thisTime);
                            ?>
                            <th><?php echo $thisDate; ?></th>

                            <?php $thisTime = strtotime('+1 day', $thisTime); // increment for loop
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $c = 0;
                    foreach ($model1 as $md) {
                        ?>
                        <tr>
                 <td style="width: 300px;"><?php
                            $student = Employee::model()->findByPk($md->employee_id);
                            echo $student->empname;
                            ?>
                 </td>
                       <?php
                            $thisTime = strtotime($first);
                            $endTime = strtotime($last);
                            while ($thisTime <= $endTime) {
                                $thisDate = date('d', $thisTime);
                                $newdate = $year . "-" . $month . "-" . $thisDate;
                                $details = Attendance::model()->findByAttributes(array('employee_id' => $md->employee_id, 'date' => $newdate));
                                if (in_array($newdate, $type) && $c == 0) {
                                    ?>
                                    <td rowspan="<?php echo $count; ?>" style="color:#333" class="bg-yellow"><?php
                        echo 'S<br>U<br>N<br>D<br>A<br>Y';
                    } elseif (!in_array($newdate, $type)) {
                                    ?></td>
                 <td <?php if ($details->attendance == 'present') { ?>
                     class="bg-green-active"
                         <?php } elseif ($details->attendance == 'absent') { ?>
                     class="bg-red"
                      <?php } elseif ($details->attendance == 'earned leave') { ?>
                     class="bg-green-gradient"
                      <?php } elseif ($details->attendance == 'leave without pay') { ?>
                     class="bg-red-gradient"
                         <?php } elseif ($details->attendance == 'medical leave') { ?>
                     class="alert alert-info"
                         <?php } else {
                       
                        } ?>><?php
                        if ($details->attendance == 'present') {
                            if ($details->half_day == 1) {
                                echo '<b style="color:#fff;">H</b>';
                            } else {
                                echo 'P';
                            }
                        } elseif ($details->attendance == 'absent') {
                            echo 'A';
                        } elseif ($details->attendance == 'earned leave') {
                            echo 'EL';
                        } elseif ($details->attendance == 'leave without pay') {
                            echo 'LWP';
                        } elseif ($details->attendance == 'medical leave') {
                            echo 'M';
                        } else {

                        }
                    } else {

                    }
                    ?>
                 </td>
                <?php $thisTime = strtotime('+1 day', $thisTime); // increment for loop
            }
            ?>
                        </tr>
                        <?php $c++;
                    } ?>
                </tbody>
            </table>
        </div>
</div>