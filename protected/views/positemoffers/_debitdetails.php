<table class="items table table-bordered">
<thead>
<tr>
<th id="voucher-grid_c0"><a class="sort-link">Voucher No</a></th>
<th id="voucher-grid_c1"><a class="sort-link">Voucher Type</a></th>
<th id="voucher-grid_c2"><a class="sort-link">Receiver / Expense Head</a></th>
<th id="voucher-grid_c3"><a class="sort-link">Amount</a></th>
<th id="voucher-grid_c4"><a class="sort-link">Dated</a></th>
<th id="voucher-grid_c5"><a class="sort-link">Payment Mode</a></th>
<th id="voucher-grid_c6"><a class="sort-link">Counter</a></th>
</tr>
</thead>
<tbody>
    <?php
    $total=0.0;
    foreach($list as $l){
    ?>
    <tr>
        <td><?php echo $l['voucher_no'];?></td>
        <td><?php echo $l['voucher_name'];?></td>
        <td><?php if (!empty($l)) {
            if ($l['payment_receiver_type'] == "employee") {
                echo Employee::model()->findByPk($l['receiver_id'])->empname;
            } else if ($l['payment_receiver_type'] == "customer") {
                $cust = Customer::model()->findByPk($l['receiver_id']);
                echo $cust->full_name . '&nbsp;(' . $cust->party_store_name . ')';
            } else if ($l['payment_receiver_type'] == "vendor") {
                $vend = Vendor::model()->findByPk($l['receiver_id']);
                echo $vend->name . '&nbsp;(' . $vend->firm_name . ')';
            } else if ($l['payment_receiver_type'] == "expense_head") {
                echo Expenseheads::model()->findByPk($l['receiver_id'])->name;
            } else if ($l['payment_receiver_type'] == "others") {
                if (!empty($l['receiver_id'])) {
                    $bd = Bankdetails::model()->findByPk($l['receiver_id']);
                    echo $bd->account_holder . " (" . $bd->bank_name . "-" . $bd->branch . ")";
                } else {
                    echo $l['other_name'];
                }
            } else {
                echo $l['other_name'];
            }
        }?></td>
        <td><?php echo $l['amount'];?></td>
        <td><?php echo $l['dated'];?></td>
        <td><?php echo $l['payment_mode'];?></td>
        <td><?php echo $l['counter_name'];?></td>
    </tr>
    <?php 
    $total=$total+$l['amount'];
       }?>
    <tr>
        <td colspan="3"></td>
        <td><b><?php echo $total;?>.00</b></td>
        <td colspan="3"></td>
    </tr>
</tbody>
</table>