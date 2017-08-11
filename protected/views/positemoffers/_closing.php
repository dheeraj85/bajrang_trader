<?php
$total_sale = 0.00;
$total_debit = 0.00;
$total_credit = 0.00;
$grand_closing = 0.00;
if (!empty($voucher)) {
    foreach ($voucher as $v) {
        $v_type = Vouchertype::model()->findByPk($v->voucher_type_id);
        if ($v_type->voucher_nature == 'debit') {
            $total_debit = $total_debit + $v->amount;
        } else if ($v_type->voucher_nature == 'credit') {
            $total_credit = $total_credit + $v->amount;
        }
    }
}

if (!empty($ots)) {
    $ots_amt = 0.00;
    foreach ($ots as $o) {
        $ots_item = Offshelfsaleitems::model()->findAllByAttributes(array('shelf_sale_id' => $o->id));
        foreach ($ots_item as $item) {
            $ots_amt = $ots_amt + $item->amount;
        }
    }
}

if (!empty($menu)) {
    $menu_amt = 0.00;
    foreach ($menu as $m) {
            $menu_amt = $menu_amt + $m->total_amount;
    }
}

if (!empty($cake_adv)) {
    $total_adv = 0.00;
    foreach ($cake_adv as $adv) {
        $total_adv = $total_adv + ($adv->amount - $adv->balance_amount);
    }
}

if (!empty($cake_payment)) {
    $total_payment = 0.00;
    foreach ($cake_payment as $payment) {
        if ($payment->balance_amount == 0.00) {
            $total_payment = $total_payment + $payment->amount;
        }
    }
}
$total_sale = $total_adv + $total_payment + $ots_amt + $menu_amt;
$grand_closing = $drawer->cash + $total_sale + $total_credit - $total_debit;
?>
<form id="counter_closing">
    <div class="row">
        <div class="col-lg-12">
            <input type="hidden" id="date" name="date" value="<?php echo $date; ?>">
            <input type="hidden" id="counter_id" name="counter_id" value="<?php echo $cid; ?>">
            <input type="hidden" id="g_closing" value="<?php echo $grand_closing; ?>">
            <table class='table' style="font-size: 16px;">
                <tbody>
                    <tr>
                        <td><b>Day Opening Cash</b></td>
                        <td><b><?php echo $drawer->cash; ?></b></td>
                    </tr>
                    <tr>
                        <td><b>Day Voucher Debit Type </b></td>
                        <td><b><a href="#" onclick="getdetails('<?php echo $date; ?>',<?php echo $cid; ?>,<?php echo $v->voucher_type_id?>)"><?php echo $total_debit; ?></a></b></td>
                    </tr>
                    <tr>
                        <td><b>Day Voucher Receipt Type</b></td>
                        <td><b><?php echo $total_credit; ?></b></td>
                    </tr>
                    <tr>
                        <td><b>Total Day Sales</b></td>
                        <td><b><?php echo $total_sale; ?></b></td>
                    </tr>
                    <tr>
                        <td><b>Grand Closing</b></td>
                        <td><input type="text" class="form-control" style="width:200px;" placeholder="Grand Closing" id="grand_closing" name="grand_closing" value="<?php echo $grand_closing; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td><b>Counter wise change (Closing)</b></td>
                        <td><input type="text" class="form-control" style="width:200px;" placeholder="Counter wise change" id="change" name="closing"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-lg-12">
            <button type="button" class="btn btn-success" id="save">Save Closing</button>
        </div>
    </div>
</form>
<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Debit Voucher List</h4>
      </div>
      <div class="modal-body" id="getdebitvoucherlist">     
          
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#change').keyup(function () {
            var remaining = 0.00;
            var cls = $(this).val();
            var total = $("#g_closing").val();
            if (cls == '') {
                remaining = parseFloat(total) - 0.00;
            } else {
                remaining = parseFloat(total) - parseFloat(cls);
            }
            if (!isNaN(remaining)) {
                $("#grand_closing").val(remaining);
            }
        });


        $('#save').click(function () {
            var datastring = $('#counter_closing').serialize();
            $.ajax({
                url: "<?php echo $this->createUrl('positemoffers/saveclosing'); ?>",
                data: datastring,
                type: 'post',
                success: function (data) {
                    $('#counter_closing').empty();
                    if (data == '1') {
                        GetContraVoucher();
//                        window.location.reload();
                    }
                }
            });
        });
    });
    function getdetails(date,counter_id,vtype){
    $.ajax({
            url: '<?php echo $this->createUrl('positemoffers/debitdetails') ?>',
            data: "date="+date+"&counter_id="+counter_id+"&vtype="+vtype,
            cache: false,
            success: function(response) {
                $("#myModal4").modal('show');
                $("#getdebitvoucherlist").html(response);
            }
        });
    }
</script>
