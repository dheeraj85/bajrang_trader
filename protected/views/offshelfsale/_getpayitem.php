<div class="row">
    <table class="table table-bordered">
        <tr>
            <th>Invoice Number</th>
            <th> Txn Type</th>
            <th> Date Time</th>
        </tr>
        <tr>
            <td><?= $sale->invoice_number; ?></td>
            <td><?= $sale->txn_type; ?></td>
            <td><?= $sale->order_date . ' ' . $sale->order_time; ?></td>
        </tr>
        </table>


</div>
<div class="row">
    <table class="table table-bordered">
        <tr>
            <th>Voucher Number </th>
            <th>Amount</th>                         
            <th> Date</th>
            <th>Remark</th>
        </tr>
        <?php $total=0.00;
        foreach ($payments as $p) { ?>
        <tr>
            <td><?= $p->voucher_no; ?></td>
            <td><?= $p->credit_amount; ?></td>
            <td><?= $p->dated; ?></td>
            <td><?= $p->remark; ?></td>
        </tr>
        <?php
         $total=$total+$p->credit_amount;
         
        } ?>
        <tr>
            <td></td>
            <td></td>
                
        </tr>
        </table>


</div>

