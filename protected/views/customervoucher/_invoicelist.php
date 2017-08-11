<?php if (!empty($list)) { ?>
    <table class="table table-bordered">
        <tr>
            <?php if (empty($voucherid)) { ?> 
            <td><input type="checkbox" id="select_all" /></td>
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
        $tamt=0.0;
        foreach ($list as $invlist) {
            if($invlist->getbalance($invlist)>0){
            ?>
            <tr>
                <?php if (empty($voucherid)) { ?>
                    <td><input type="checkbox" class="checkbox allcheckedcategory" onchange="enableinvoice(<?php echo $invlist->getbalance($invlist); ?>,<?php echo $invlist->id; ?>);" id="checked_item_<?php echo $invlist->id; ?>" name="invoice_id[]" value="<?php echo $invlist->id; ?>"></td>
                <?php } ?>
                <td><?php echo $invlist->invoice_no; ?></td>
                <td><?php echo $invlist->invoice_date; ?></td>
                <td><?php echo $invlist->total_amount; ?></td>
                <td><?php echo $invlist->getbalance($invlist); ?></td>
                <?php if (empty($voucherid)) { ?>
                    <td><input type="text" id="checkamt_<?php echo $invlist->id; ?>" onchange="checkamount(<?php echo $invlist->getbalance($invlist); ?>, this.value);" name="paid_<?php echo $invlist->id; ?>" value="<?php echo $invlist->getbalance($invlist); ?>" size="12" class="amount_paid form-control" readonly/></td>
                <?php } ?>
            </tr>
            <input type="hidden" name="invoice_id_<?php echo $invlist->id; ?>" id="invoice_id_<?php echo $invlist->id; ?>" value="<?php echo $invlist->id; ?>"/>
            <?php 
            $tamt=$tamt+$invlist->total_amount;
                }} ?> 
            <tr>
                <td colspan="4"><b>Total</b></td>
                <td><b><?php echo $tamt; ?></b></td>
                <td></td>
            </tr>
    </table>
    <?php }
?>
<input type="hidden" id="invoice_bal" value="<?php echo $tamt; ?>"/>
<script type="text/javascript">
    function checkamount(amt1, amt2) {
        var vamount = $("#Voucher_amount").val();
        var invoice_amt = 0.00;
    <?php
    foreach ($list as $invlist) {
        ?>
            var invoice = $("#checkamt_<?php echo $invlist->id; ?>").val();
            if (invoice != "") {
                invoice_amt = parseFloat(invoice_amt) + parseFloat(invoice);
            } else {
                invoice_amt = parseFloat(invoice_amt) + 0.00;
            }
    <?php } ?>
     $("#invoice_bal").val(vamount-invoice_amt);
        if (amt1 < amt2) {
            alert("Payment amount cannot be higher than Invoice Amount or Invoice Balance Amount");
            $("#btnvoucher").attr('disabled', 'disabled');
        } else if (vamount < invoice_amt) {
            alert("Payment Total Amount cannot be higher than Voucher Amount");
            $("#btnvoucher").attr('disabled', 'disabled');
        } else {
            $("#btnvoucher").removeAttr('disabled');
        }
    }
//    function enableinvoice(value1,value) {
//        var balamount = $("#invoice_bal").val();
//        $("#checkamt_" + value).removeAttr('readonly');
//        $("#checkamt_" + value).val(balamount);
//        checkamount(value1,balamount);
//    }
</script>
<script type="text/javascript">
$(document).ready(function(){
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
                $('.amount_paid').removeAttr('readonly');
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
                $('.amount_paid').attr('readonly','readonly');
            });
        }
    });
    
    $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#select_all').prop('checked',true);
        }else{
            $('#select_all').prop('checked',false);
        }
    });
});
</script>