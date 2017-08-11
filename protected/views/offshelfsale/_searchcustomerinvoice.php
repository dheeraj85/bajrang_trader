<?php if (!empty($customer_id)) { ?>
    <table class="table table-bordered">
        <tr>
            <td><b>Invoice No.</b></td>
            <td><b>Invoice Date</b></td>
            <td><b>Total Amount</b></td>
            <td><b>Paid Amount</b></td>
            <td><b>Balance Amount</b></td>
            <td><b>Action</b></td>
        </tr>
        <?php
        $total = 0.00;
        if ($fromdate != "" && $todate != "") {
            $plist = ShelfSale::model()->findAllBySql("select * from off_shelf_sale where order_date between '$fromdate' and '$todate' and txn_type='customer' and customer_id=$customer_id order by id desc");
        } else {
            $plist = ShelfSale::model()->findAllBySql("select * from off_shelf_sale where txn_type='customer' and customer_id=$customer_id order by id desc");
        }
        foreach ($plist as $invlist) {
            if (ShelfSale::getbalance($invlist) > 0) {
                $total = $total + ShelfSale::getbalance($invlist);
                ?>
                <tr>
                    <td><a href="#" onclick="reviewpost(<?php echo $invlist->id; ?>);"><?php echo $invlist->invoice_number; ?></a></td>
                    <td><?php echo $invlist->order_date; ?></td>
                    <td><?php echo ShelfSale::gettotal($invlist); ?></td>
                    <td><?php echo ShelfSale::getpaid($invlist); ?></td>
                    <td><?php echo ShelfSale::getbalance($invlist); ?></td>
                    <td>
                        <a href="#" onclick="paydetails(<?php echo $invlist->id; ?>);" class="btn btn-green">Pay Details</a>
                        <a href="<?php echo $this->createUrl('voucher/create', array('id' => 12, 'receiver_type' => 'customer', 'receiver_id' => $invlist->customer_id)) ?>" class="btn btn-green">Pay Now</a>
                    </td>
                </tr>
                <?php
            }
        }
        ?> 
        <tr>
            <td colspan="4" style="text-align: center;font-weight: bold;"><?php echo 'Total'; ?></td>
            <td><?php echo $total; ?></td>
            <td></td>
        </tr>
    </table>
    <?php
}?>