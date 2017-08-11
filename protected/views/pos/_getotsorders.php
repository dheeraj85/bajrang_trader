<?php
if(!empty($shelf_sale)){
?>    
<table class="table table-bordered">
    <thead>
    <th>Invoice No</th>
    <th>Order Date</th>
    <th>Order Time</th>
    <th>Amount</th>
    <th>Action</th>
    </thead>
    <tbody>
        <?php 
        $total = 0.00;
        foreach ($shelf_sale as $sale) { 
            //$amt = 0.00;
            $oss=Offshelfsaleitems::model()->findBySql('select sum(amount) as amount from off_shelf_sale_items where shelf_sale_id='.$sale->id);
            //print_r($oss->amount);
            
            ?>
        <tr>
            <td><?php echo $sale->invoice_number; ?> </td>
            <td><?php echo $sale->order_date; ?></td>
            <td><?php echo $sale->order_time; ?></td>
            <td><?php echo isset($oss->amount)?$oss->amount:0.00; 
            $total=$total+$oss->amount;?></td>
            <td>
                <button type="button" class="btn btn-success" id="view_bill" onclick="ViewMenuBill(<?php echo $sale->id; ?>);"><i class="fa fa-eye fa-fw"></i>View</button>
            <?php if (Yii::app()->user->isSA() == 'sa') { ?>
                <a href="<?php echo $this->createUrl('pos/cancelbill',array('id'=>$sale->id)); ?>" class="btn btn-danger">Cancel Bill</a>
            <?php } ?>
            </td>
        </tr>
       <?php } ?>
        <tr>
            <td colspan="3" style="text-align: right;"><b>Total</b></td>
            <td colspan="2"><b><?php echo number_format($total); ?></b></td>
        </tr>
    </tbody>
</table>
<?php
}else{
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
            type:'post',
            success: function (response) {
                $("#bill").html(response);
                $("#myModal").modal({backdrop: 'static', keyboard: false});
            }
        });
    }
</script>
