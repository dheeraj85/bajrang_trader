<?php
if (!empty($sale)) {
    $customer = Customer::model()->findByPk($sale->customer_id);
    ?>
    <div class="row">
        <div class="col-xs-12" width="50%">
            <div class="row">
                <table width="100%">
                    <tbody>
                        <tr>
                            <td width="15%" align="left"> 
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/bg-logo.png" class="img-circle" style="width:100%;">
                            </td>
                            <td width="10%"></td>
                            <td width="30%"><h3><u>Invoice</u></h3></td>
                            <td width="35%" align="right">
                               <?php echo Yii::app()->params['kasa_addr']; ?>
                            </td>
                        </tr> 
                </table>
            </div><br/>
            <div class="row">
                <div class="col-xs-8">
                    <table class="table">
                        <tr>
                            <td style="border-top: none;"><b>Name :-&nbsp;&nbsp;<?php echo $customer->full_name; ?></b></td>
                        </tr>
                        <tr>
                            <td style="border-top: none;"><b>Contact No :-&nbsp;&nbsp;<?php echo $customer->mobile_no; ?></b></td>
                        </tr>
                        <tr>
                            <td style="border-top: none;" colspan="2"><b>Address :-&nbsp;&nbsp;<?php echo $customer->address; ?></b></td>
                        </tr>
                    </table>    
                </div>
                <div class="col-xs-4 pull-right">
                    <table class="table">
                        <tr>
                            <td style="border-top: none;"><b>Date :- &nbsp;&nbsp; <?php echo date('d-M-Y', strtotime($sale->order_date)); ?></b></td>
                        </tr>
                        <tr>
                            <td style="border-top: none;"><b>Invoice No :-&nbsp;&nbsp;<?php echo $sale->invoice_number; ?></b></td>
                        </tr>
                    </table>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-xs-12">
                    <?php
                    $items = Offshelfsaleitems::model()->findAllByAttributes(array('shelf_sale_id' => $sale->id)); //print_r($items);     
                    if (!empty($items)) {
                        ?>
                        <table class="table table-bordered">
                            <tr>
                                <th class="border_on_print">#</th>
                                <th class="border_on_print">Item</th>
                                <th class="border_on_print">Unit Price</th>
                                <th class="border_on_print">Qty</th>                                     
                                <th class="border_on_print">Disc (%)</th>                                     
                                <th class="border_on_print">Disc (Rs.)</th>                                     
                                <th class="border_on_print">TAX (%)</th>                                     
                                <th class="border_on_print">TAX (Rs.)</th>                                     
                                <!--<th class="border_on_print">Amt without TAX (Rs.)</th>-->                                     
                                <th class="border_on_print">Amount (Rs.)</th>
                            </tr>
                            <tbody>
                                <?php
                                $total = 0.00;
                                $count = 1;
                                $total_qty = 0;
                                $total_disc = 0;
                                $total_tax = 0;
                                $total_amt_without_tax = 0;
                                foreach ($items as $item) {
                                    $item_mdl = Purchaseitem::model()->findByPk($item->item_id);
                                    $total = $total + $item->amount;
                                    $total_qty = $total_qty + $item->qty;
                                    $amt = $item->unit_price * $item->qty;
                                    $total_disc = $total_disc + $item->disc_amt;
                                    $total_tax = $total_tax + $item->tax_amt;
                                    $total_amt_without_tax = $total_amt_without_tax + $item->amt_without_tax;
                                    ?>
                                    <tr>
                                        <td style="width:5%;"><?php echo $count; ?></td>                                        
                                        <td style="width:20%;"><?php echo $item_mdl->itemname; ?></td>                                        
                                        <td style="width:8%;"><?php echo $item->unit_price; ?></td>                                   
                                        <td style="width:8%;"><?php echo $item->qty; ?></td>                                    
                                        <td style="width:8%;"><?php echo $item->discount_percent; ?></td>                                       
                                        <td style="width:8%;"><?php echo $item->disc_amt; ?></td>                                       
                                        <td style="width:8%;"><?php echo $item->unit_tax; ?></td>                                            
                                        <td style="width:8%;"><?php echo $item->tax_amt; ?></td>                                            
                                        <!--<td style="width:15%;"><?php // echo $item->amt_without_tax;  ?></td>-->                                            
                                        <td style="width:15%;"><?php echo $item->amount; ?></td> 
                                    </tr>
                                    <?php
                                    $count++;
                                }
                                ?>
                                <tr>
                                    <td colspan="3" style="text-align: center;"><b>Total</b></td>                                            
                                    <td><b><?php echo $total_qty; ?></b></td>       
                                    <td></td>               
                                    <td><b><?php echo $total_disc; ?></b></td>        
                                    <td></td>               
                                    <td><b><?php echo $total_tax; ?></b></td>  
                                    <!--<td><b><?php // echo $total_amt_without_tax;  ?></b></td>-->  
                                    <td><b><?php echo $total; ?></b></td> 
                                </tr>
                            </tbody>
                        </table>
                    <?php } ?>
                </div>
            </div>
            <div class="row">

                <table width="100%">
                    <tbody>
                        <tr>

                            <td width="45%" align="left">
                                Prepared By :  <?php echo $sale->createdby->name; ?>

                            </td>

                            <td width="55%" align=right">
                           Amount in Words : <?php echo Utils::convert_number_to_words($total); ?> Only
                       
                            </td>
                            
                        </tr> 
                </table>
            </div>
        </div>
    </div>
<?php } ?>
<script type="text/javascript">
    window.print();
</script>

