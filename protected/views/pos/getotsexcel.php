<?php
if (!empty($shelf_sale)) {
    ?>    
    <table class="table table-bordered" id="excel_table">
    <!--        <thead>
        <th>Invoice No</th>
        <th>Order Date</th>
        <th>Order Time</th>
        <th>Amount</th>
        <th></th>
    </thead>-->
        <tbody>
            <?php
            $total = 0.00;
            $total_tax = 0.00;
            $total_bill_amt = 0.00;
            foreach ($shelf_sale as $sale) {
                ?>
                <tr><th style="text-align: left;font-size:14px " colspan="5">Invoice No/Order Date</th></tr>
                <tr>
                    <th colspan="5" style="text-align: left;font-size:14px "><?php echo $sale->invoice_number; ?> / <?php echo date('d-m-Y', strtotime($sale->order_date)); ?>  <?php echo $sale->order_time; ?></th>
                </tr>
                <tr>
                    <th>Description [Unit Price] </th><th style="text-align: center">Qty</th>
                    <th style="text-align: right">Tax</th>
                    <th style="text-align: right">Price</th>
                    <th style="text-align: right">Amount</th>
                </tr>
                <?php
                $amt = 0.00;
                $tax_amt = 0.00;
                $bill_amt = 0.00;
                foreach (Offshelfsaleitems::model()->findAllByAttributes(array('shelf_sale_id' => $sale->id)) as $items) {
                    $item = Purchaseitem::model()->findByPk($items->item_id);
                    $category_taxes = Categorytaxes::model()->findByAttributes(array('pos_type' => 'OTS', 'p_category_id' => $item->p_category_id, 'p_sub_category_id' => $item->p_sub_category_id));
                    $tax = Postaxes::model()->findByPk($category_taxes->tax_id);
                    ?>
                    <tr>
                        <td><?php echo $items->description; ?> [<?php echo $items->unit_price; ?>] </td>
                        <td style="text-align: center"><?php echo $items->qty; ?></td> 
                        <td style="text-align: right"><?php
                            $amt_without_tax = round((($items->amount * 100) / ($tax->tax_percent + 100)), 2);
                            $taxprice = $items->amount - $amt_without_tax;
                            $tax_amt = $tax_amt + $taxprice;
                             
                            echo  $taxprice;
                            ?></td>
                        <td style="text-align: right"><?php   
                         echo $amt_without_tax;
                            $amt = $amt + $amt_without_tax;
                                                 
                            ?>
                        </td>
                        <td style="text-align: right"><?php
                            $both_amt =$items->amount;
                            echo $both_amt;
                            $bill_amt = $bill_amt + $both_amt;
                           
                            ?>
                        </td>
                    </tr>

                <?php }
                $total_tax = $total_tax + $tax_amt;
                  $total = $total + $amt;  
                   $total_bill_amt = $total_bill_amt + $bill_amt;
                ?>
                <tr>
                    <th colspan="2" style="text-align: right">Total</th>
                    <th style="text-align: right"><?php echo $tax_amt; ?></th>
                    <th style="text-align: right"><?php echo $amt; ?></th>
                    <th style="text-align: right"><?php echo $bill_amt; ?></th>
                </tr>
            <?php }
            ?>
            <tr>
                <td colspan="2" style="text-align: right;"><b>Total</b></td>
                <td  style="text-align: right;"><b><?php echo $total_tax; ?></b></td>
                <td  style="text-align: right;"><b><?php echo $total; ?></b></td>
                <td  style="text-align: right;"><b><?php echo $total_bill_amt; ?></b></td>
            </tr>
        </tbody>
    </table>
    <?php
} else {
    ?>
    <div class="alert alert-danger"><h4>No Record Found...!!!</h4></div>
    <?php
}
?>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/tableexport/jquery.table2excel.js"></script>
<script type="text/javascript">
    $(function() {
        //   $("#export_excel_button").click(function() {
        var currentdate = new Date();
        var formatted = currentdate.getDate() + "-"
                + (currentdate.getMonth() + 1) + "-"
                + currentdate.getFullYear() + "-"
                + currentdate.getHours() + "-"
                + currentdate.getMinutes() + "-"
                + currentdate.getSeconds();
        $("#excel_table").table2excel({
            exclude: "",
            name: "OTS Orders list",
            filename: 'OTS_Orders_List_' + formatted,
            fileext: ".xls",
            exclude_img: true,
            exclude_links: true,
            exclude_inputs: true
        });
        // });
    });
</script>
