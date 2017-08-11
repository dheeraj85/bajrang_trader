<?php if (!empty($list)) { ?>
    <table class="table table-bordered">
        <tr>
            <?php if (empty($voucherid)) { ?> 
                <td>#</td>
            <?php } ?>
            <td><b>Invoice No.</b></td>
            <td><b>Invoice Date</b></td>
            <td><b>Total Amount</b></td>            
            <td><b>Balance Amount</b></td>
            <?php if (empty($voucherid)) { ?>
                <td><b>Pay Amount</b></td>
            <?php } ?>
        </tr>
        <?php
        $c = 0.00;
        foreach ($list as $invlist) {
            if ($invlist->getbalance($invlist) > 0) {
                ?>
                <tr>
                    <?php if (empty($voucherid)) { ?>
                                                                        <!--<td><input type="checkbox" class="allcheckedcategory" onchange="enableinvoice(<?php echo $invlist->getbalance($invlist); ?>,<?php echo $invlist->id; ?>);" id="checked_item_<?php echo $invlist->id; ?>" name="invoice_id[]" value="<?php echo $invlist->id; ?>"></td>-->
                    <?php } ?>
                    <td><?php echo ++$c; ?></td>
                    <td><?php echo $invlist->invoice_number; ?></td>
                    <td><?php echo $invlist->order_date; ?></td>
                    <td><?php echo ShelfSale::gettotal($invlist); ?></td>
                    <td><?php echo ShelfSale::getbalance($invlist); ?></td>
                    <?php if (empty($voucherid)) { ?>
                        <td><input type="text" id="checkamt_<?php echo $c; ?>" onkeyup="checkamount(<?php echo $c; ?>,<?php echo $invlist->getbalance($invlist); ?>, this.value);" name="paid_<?php echo $c; ?>" size="12" class="form-control" value="0" /></td>
                    <?php } ?>
                </tr>
                <input type="hidden" name="invoice_id<?php echo $c; ?>" id="invoice_id_<?php echo $invlist->id; ?>" value="<?php echo $invlist->id; ?>"/>
                <?php
            }
        }
        ?> 
    </table>
<?php }
?>
<input type="hidden" id="count" value="<?php echo $c; ?>" name="count"/>
<input type="hidden" id="invoice_bal" value="0" name="balance"/>
<script type="text/javascript">
    function checkamount(ct, total_bal, entr_amt) {
        var voucher_amount = $("#Voucher_amount").val();
        if (voucher_amount != '') {
            if (entr_amt > total_bal) {
                alert("Payment amount cannot be higher than Invoice Amount or Invoice Balance Amount");
                $("#btnvoucher").attr('disabled', 'disabled');
            } else {
                calculateamount(ct);
            }
        } else {
            alert("First You have to Enter Voucher Amount");
            $("#btnvoucher").attr('disabled', 'disabled');
            $("#checkamt_" + ct).val('0');
        }
    }
    function calculateamount(ct) {
        var voucher_amount = $("#Voucher_amount").val();
        var count = $("#count").val();
        var total = 0.00;
//        var i = 0;
        for (var i = 1; i <= count; i++) {
            var amt = $("#checkamt_" + i).val();
            if (amt != '0') {
                total = parseFloat(total) + parseFloat(amt);
            } else {
                total = parseFloat(total) + 0.00;
            }
        }
        if (!isNaN(total)) {
            if (voucher_amount >= total) {
                $("#invoice_bal").val(total);
                $("#btnvoucher").removeAttr('disabled');
            } else {
                alert("Payment Total Amount cannot be higher than Voucher Amount");
//                $("#btnvoucher").attr('disabled', 'disabled');
                $("#checkamt_" + ct).val('0');
            }
        }
    }
</script>