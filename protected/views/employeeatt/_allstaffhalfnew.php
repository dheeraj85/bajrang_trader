<table class="table table-bordered">
    <thead>
    <th>Date</th>
    <th>Employee Code</th>
    <th>Employee Name</th>
    <th>Out Time</th>
</thead>
<tbody>
    <?php foreach ($model as $a) { ?>
        <tr>
            <td><?php echo $a->date; ?></td>
            <td><?php echo $a->employee->empcode; ?></td>
            <td><?php echo $a->employee->empname; ?></td>
            <td><?php echo $a->out_time; ?></td>
        </tr>
<?php } ?>
</tbody>
</table>