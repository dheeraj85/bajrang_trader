<?php 
if(!empty($invoice_details)){
?><br/>
<table class="table table-bordered">
    <tr>
        <th id="purchaseinvoice-grid_c3">Date</th>
        <th id="purchaseinvoice-grid_c0">Name of Farmer & their Father</th>
        <th id="purchaseinvoice-grid_c1">Address of Farmer</th>
        <th id="purchaseinvoice-grid_c1">Item</th>
        <th id="purchaseinvoice-grid_c1">Net Weight in MT</th>
    </tr>
    <tr>
        <td><?php echo $invoice_details->invoice_date ?></td>
        <td><?php echo $invoice_details->vendor_name . "<br/>" . $invoice_details->land_owner; ?></td>
        <td>Vill.-<?php echo $invoice_details->village ?><br/>
            Dist.-<?php echo $invoice_details->district ?> <?php echo $invoice_details->state ?></td>
        <td>
            <?php echo $kataparchy->item_name; ?>
        </td>
        <td>
            <?php echo $kataparchy->net_weight; ?>
        </td>
    </tr>
</table>
<?php }?>