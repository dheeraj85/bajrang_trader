<?php
if (!empty($shelf_sale)) {
    ?>    
    <form  id="pay_credit">    
        <table class="table table-bordered">
            <thead>
            <th>Invoice No</th>
            <th>Customer</th>
            <th>Mobile No</th>
            <th>Order Date</th>
            <th>Order Time</th>
            <th>Total Amount</th>
            <th>Paid Amount</th>
            <th>Balance Amount</th>
            <th>Enter Payable Amount</th>
            <th></th>
            </thead>
            <tbody>

                <?php
                $total = 0.00;
                foreach ($shelf_sale as $sale) {
                   
                    $total = $total + $sale['amount'];
                    $bill_id=$sale['id'];
 $str = "SELECT sum(credit_amount) as amount from pos_credit_account where pos_id=$bill_id";
                    $result = Yii::app()->db->createCommand($str)->queryAll();
             //       print_r($result);
                    $paid_amt=isset($result[0]['amount'])?$result[0]['amount']:0.00;
                    ?>
                    <tr>
                        <td><?php echo $sale['invoice_number']; ?></td>
                        <td><?php echo $sale['full_name']; ?></td>
                        <td><?php echo $sale['mobile_no']; ?></td>
                        <td><?php echo $sale['order_date']; ?></td>
                        <td><?php echo $sale['order_time']; ?></td>
                        <td><?php echo $sale['amount']; ?></td>
                        <td><?php echo $paid_amt ?></td>
                        <td><?php echo $sale['amount']-$paid_amt; ?></td>
                        <td>
                            <?php if($paid_amt >=$sale['amount']) { ?>
                            <label class="badge badge-green">Paid</label>
                            <?php } else { ?>
                            <input type="number" name="<?= $sale['id'] ?>" class="form-control">
                            <?php } ?>
                        </td>
                        <td><a href="#" class="btn btn-default" id="view_bill" onclick="ViewMenuBill(<?php echo $sale['id']; ?>);"><i class="fa fa-eye fa-fw"></i>View</a></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="5" style="text-align: right;"><b>Total</b></td>
                    <td colspan="5"><b><?php echo number_format($total); ?></b></td>
                </tr>
                <tr>
                    <td colspan="10">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Payment Mode</label><br>
                                <select maxlength="100" id="payment_mode" class="form-control" name="Voucher[payment_mode]" required>
                                    <!--<option value="" selected="selected">-Select-</option>-->
                                    <option value="cash">Cash</option>
                                    <option value="cheque">Cheque</option>
                                    <option value="dd">DD</option>
                                    <option value="neft">NEFT</option>
                                    <option value="rtgs">RTGS</option>
                                </select>            
                            </div>
                        </div>


                        <div class="col-lg-3 online_trans">
                            <div class="form-group"><label class="control-label" for="Voucher_c_number_t_num_utr_num">Cheque/DD/RTGS/TXN No</label><div><input maxlength="100" name="Voucher[c_number_t_num_utr_num]" id="Voucher_c_number_t_num_utr_num" class="form-control" placeholder="Cheque/DD/RTGS/TXN No" type="text"></div></div>   
                        </div>
                        <div class="col-lg-3 online_trans">
                            <div class="form-group"><label class="control-label" for="Voucher_account_no">Account No</label><div><input maxlength="100" name="Voucher[account_no]" id="Voucher_account_no" class="form-control" placeholder="Account No" type="text"></div></div>       
                        </div>
                        <div class="col-lg-3 online_trans">
                            <div class="form-group"><label class="control-label" for="Voucher_bank_card_name">Bank/Card Name</label><div><input maxlength="100" name="Voucher[bank_card_name]" id="Voucher_bank_card_name" class="form-control" placeholder="Bank/Card Name" type="text"></div></div>  
                        </div>

                    </td>
                </tr>
                <tr>
                    <td colspan="8" id="show_status_msg"></td>
                    <td colspan="2">
                        <button type="button" id="save_credit_amt" class="btn btn-success" onclick="saveCreditPay()">Save</button></td>
                </tr>

            </tbody>

        </table>
    </form>
    <?php
} else {
    ?>
    <div class="alert alert-danger"><h4>No Record Found...!!!</h4></div>
    <?php
}
?>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div id="bill"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $(".online_trans").hide();
        $('#payment_mode').change(function() {
            var pay_mode = $(this).val();
            if (pay_mode == "cash") {
                $(".online_trans").hide();             
            } else {
                $(".online_trans").show();
            }
        });
    });
    function Popup(data) {
        var mywindow = window.open('', 'toc_bill_print', 'height=500,width=700');
        mywindow.document.write('<html><head><title>Print</title>');
        mywindow.document.write('</head><body >');
        //alert(data);
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');
        mywindow.print();
        mywindow.close();
        //return true;

    }


    function ViewMenuBill(id) {
        $.ajax({
            url: '<?php echo $this->createUrl('pos/viewotsbill'); ?>',
            data: {'id': id},
            type: 'post',
            success: function(response) {
                $("#bill").html(response);
                $("#myModal").modal({backdrop: 'static', keyboard: false});
            }
        });
    }

    function saveCreditPay() {
      //  alert($("#pay_credit").serialize());
        var url = '<?php echo $this->createUrl('credit/paycreditbill'); ?>';
        $.post(url, $("#pay_credit").serialize(), function(res) {
            $("#show_status_msg").fadeIn(); 
            var res=jQuery.parseJSON(res);
            if(res.msg=='success'){
                $("#show_status_msg").html('Bill has been paid successfully. Voucher for this amount also generated').addClass('alert alert-success').fadeOut(5000);
            }else{
                 $("#show_status_msg").html('There is something wrong please check and correct bill amount.').addClass('alert alert-success').fadeOut(5000);
            }
        });
    }
</script>
