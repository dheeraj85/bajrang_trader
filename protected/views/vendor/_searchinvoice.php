<?php if (!empty($vendor_id)) { ?>
<form action="<?php echo $this->createUrl('vendor/paypartyinvoice', array('id' => 2)) ?>" class="vendorpayment">
 <button class="btn btn-green">Pay Now</button><br/><br/>   
 <table class="table table-bordered">
        <tr>
            <td><input type="checkbox" id="select_all" /></td>
            <td><b>Invoice No.</b></td>
            <td><b>Invoice Date</b></td>
            <td><b>Total Amount</b></td>
            <td><b>Paid Amount</b></td>
            <td><b>Balance Amount</b></td>
            <td><b>Action</b></td>
        </tr>
        <?php
        if ($todate != "") {
            if($vendor_id=="1"){
            $alist = Purchaseinvoice::model()->findAllBySql("select * from purchase_invoice where invoice_date <='$todate' and total_amount!=0.00 and invoice_type='cash' and is_reviewed=1 order by id desc");
            }else{
            $alist = Purchaseinvoice::model()->findAllBySql("select * from purchase_invoice where invoice_date <='$todate' and total_amount!=0.00 and vendor_id=$vendor_id and is_reviewed=1 order by id desc");    
            }
        }
        foreach ($alist as $invlist) {
           if($invlist->getbalance($invlist)>0){?>
            <tr>
                <td>
                    <input type="checkbox" class="checkbox allcheckedcategory" id="checked_item_<?php echo $invlist->id; ?>" name="invoice_id[]" value="<?php echo $invlist->id; ?>">
                </td>
                <td><a href="#" onclick="reviewpost(<?php echo $invlist->id; ?>);"><?php echo $invlist->invoice_no; ?></a></td>
                <td><?php echo $invlist->invoice_date; ?></td>
                <td><?php echo $invlist->total_amount; ?></td>
                <td><?php echo $invlist->getamount($invlist); ?></td>
                <td><?php echo $invlist->getbalance($invlist); ?></td>
                <td>
                    <a href="#" onclick="paydetails(<?php echo $invlist->id; ?>);" class="btn btn-green">Pay Details</a>
                </td>
                </tr>
                <?php
                $tamt = $tamt + $invlist->total_amount;
                $bamt = $bamt + $invlist->getbalance($invlist);
            }
 }?>
            <tr>
                <td colspan="3"><b>Total</b></td>
                <td><b><?php echo $tamt; ?></b></td>
                <td></td>
                <td><b><?php echo $bamt; ?></b></td>
                <td></td>
            </tr>
     </table>
    <input type="hidden" name="receiver_type" value="vendor"/>
    <input type="hidden" name="receiver_id" value="<?php echo $vendor_id;?>"/>
    <input type="hidden" name="date" value="<?php echo $todate;?>"/>
    <button class="btn btn-green">Pay Now</button>
    </form>
    <?php
}?>

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