<?php
if (!empty($sale)) {
    $customer = Customer::model()->findByPk($sale->customer_id);
    ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-2">
                    <img src="<?php echo Yii::app()->baseUrl; ?>/images/logo.jpg" alt="LOGO" style="width:80px;height:80px;">  
                </div>
                <div class="col-xs-10">
                    <h1 style="font-style: italic;font-family: serif;">The Oven Classics</h1> 
                </div>
            </div><br/><br/><br/>
            <div class="row">
                <div class="col-xs-8">
                    <table class="table">
                        <tr>
                            <td style="border-top: none;"><b>Party Name :-&nbsp;&nbsp;<?php echo $customer->full_name; ?></b></td>
                            <td style="border-top: none;"><b>Contact No :-&nbsp;&nbsp;<?php echo $customer->mobile_no; ?></b></td>
                        </tr>
                        <tr>
                            <td style="border-top: none;" colspan="2"><b>Address :-&nbsp;&nbsp;<?php echo $customer->address; ?></b></td>
                        </tr>
                    </table>    
                </div>
                <div class="col-xs-4">
                    <label>Date :-&nbsp;&nbsp;<?php echo date('d-M-Y', strtotime($sale->order_date)); ?></label>
                    <label>Memo No :-&nbsp;&nbsp;<?php echo $sale->memo_number; ?></label>
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
                                <th class="border_on_print">Disc (Rs)</th>                                     
                                <th class="border_on_print">Unit TAX</th>                                     
                                <th class="border_on_print">Amount (Rs.)</th>  
                            </tr>
                            <tbody>
                                <?php
                                $total = 0.00;
                                $count = 1;
                                $total_qty = 0;
                                $total_disc = 0;
                                foreach ($items as $item) {
                                    $item_name = Offshelfsaleitems::getItem($item);
                                    $total = $total + $item->amount;
                                    $total_qty = $total_qty + $item->qty;
                                    $amt = $item->unit_price * $item->qty;
                                    $discount = ($amt * ($item->discount_percent / 100));
                                    $total_disc = $total_disc + $discount;
                                    ?>
                                    <tr>
                                        <td style="width:5%;"><?php echo $count; ?></td>                                        
                                        <td style="width:30%;"><?php echo $item_name; ?></td>                                        
                                        <td style="width:10%;"><?php echo $item->unit_price; ?></td>                                   
                                        <td style="width:10%;">
                                            <?php echo $item->qty; ?>
                                        </td>                                    
                                        <td style="width:10%;">
                                            <?php echo $item->discount_percent; ?>
                                        </td>                                       
                                        <td style="width:10%;">
                                            <?php echo $discount; ?>
                                        </td>                                       
                                        <td style="width:10%;"><?php echo $item->unit_tax; ?></td>                                            
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
                                    <td><b><?php echo $total; ?></b></td>  
                                </tr>
                            </tbody>
                        </table>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<script type="text/javascript">
    window.print();
</script>

