<tr>
    <th class="border_on_print" rowspan="2">#</th>
    <th class="border_on_print" rowspan="5" colspan="4">Item</th>
    <th class="border_on_print" rowspan="2">HSN Code</th>
    <th class="border_on_print" rowspan="2">Rate</th>
    <th class="border_on_print" rowspan="2">Qty</th>                                     
    <th class="border_on_print" rowspan="2">Price</th>                                     
    <th class="border_on_print" rowspan="2">Disc (%)</th>                                     
    <th class="border_on_print" rowspan="2">Disc (&#8377;)</th>   

    <th class="border_on_print" rowspan="2">Total (&#8377;)</th>

    <th class="border_on_print" rowspan="2">Taxable Value (&#8377;)</th>   
    <th colspan="2" style="text-align: center"><b>IGST</b></th>
    <th colspan="2" style="text-align: center"><b>CESS</b></th>
    <?php if (empty($model->invoice_number)) { ?>
        <th class="no-print" rowspan="2">
            <a href="#" title="Delete Items">X</a>
        </th>
    <?php } ?>                                      
</tr>
<tr>
    <th class="border_on_print">Rate (%)</th>                                     
    <th class="border_on_print">Amt (&#8377;)</th>                                     
    <th class="border_on_print">Rate (%)</th>                                     
    <th class="border_on_print">Amt (&#8377;)</th>                                     
   
</tr>
<tbody>
    <?php
    $total = 0.00;
    $count = 1;
    $total_qty = 0;
    $total_disc = 0;
    $total_tax = 0;
    $igst_total = 0.00;
    $cess_total = 0.00;
    $total_amt_without_tax = 0;
    foreach ($items as $item) {
        $item_model = $item->item_model; //getting from purchase item now
        $total = $total + $item->amount;
        $total_qty = $total_qty + $item->qty;
        $amt = $item->unit_price * $item->qty;
        $total_disc = $total_disc + $item->disc_amt;
        $total_tax = $total_tax + $item->tax_amt;
        if ($sale->tax_type == 'INCLUSIVE') {
            $amt_without_tax = Utils::excludeTaxFromPrice($item_model->gst_percent, $item->amount);
        } else {
            $amt_without_tax = $item->amount;
        }
        $total_amt_without_tax = $total_amt_without_tax + $amt_without_tax;
        ?>
        <tr>
            <td style="width:3%;"><?php echo $count; ?></td>                                        
            <td style="width:20%;" colspan="4"><?php echo $item_model->itemname . ' (' . $item_model->item_scale . ') '; ?></td>                                        
            <td style="width:8%;"><?php echo $item_model->gst_code; ?></td>                                        
            <td style="width:8%;"><?php echo $item->unit_price; ?></td>                                   
            <td style="width:5%;">                                                    
                <?php echo $item->qty; ?>                                                        
            </td>                                    
            <td style="width:8%;">
                <?php echo $item->unit_price * $item->qty; ?>
            </td>                                       
            <td style="width:5%;">
                <?php echo $item->discount_percent; ?>
            </td>                                       
            <td style="width:5%;">
                <?php echo $item->disc_amt; ?>
            </td>            
            <td style="width:6%;"><?php echo $item->amount; ?></td> 
            <td style="width:8%;"><?php echo $round_amt = round($amt_without_tax, 2); ?></td>                                            

            <!-- if selling in same state -->
         
            <td style="width:4%;">
                <?php
                if (!empty($item_model->gst_percent)) {
                    $cal = $item_model->gst_percent / 2;
                    echo $cal;
                }
                ?>
            </td>       
            <td style="width:4%;">
                  <?php
                    $divide_tax = ($round_amt * $item_model->gst_percent) / 100;
                    echo $igst = round($divide_tax, 2);
                    $igst_total = $igst_total + $igst;
                    ?>
            </td>          
            <!-- if selling in same state -->

            <td style="width:4%;">     <?php
                if (!empty($item_model->cess_tax)) {
                    echo $cess_tax = $item_model->cess_tax;
                } else {
                    echo $cess_tax = '';
                }
                ?></td>                                            
            <td style="width:4%;"><?php
                if (!empty($item_model->cess_tax)) {
                    $cess_amt = ($round_amt * $item_model->cess_tax) / 100;
                    echo $cess_charge = round($cess_amt, 2);
                    $cess_total = $cess_total + $cess_charge;
                }
                ?></td>                                            


            <td style="width:3%"  class="no-print">
            </td> 

        </tr>
        <?php
        $count++;
    }
    ?>
    <tr>
        <td colspan="7" style="text-align: center;"><b>Total</b></td>                                            
        <td><b><?php echo $total_qty; ?></b></td>       
        <td></td>               
        <td></td>               
        <td><b><?php //echo $total_disc;        ?></b></td> 
        <td><b><?php //echo round($total);    ?></b></td> 
        <td><b><?php echo round($total_amt_without_tax); ?></b></td> 

        <td></td>      
        <td><b><?= $igst_total ?></b></td>      
        <td></td>      
        <td><b><?= $cess_total ?></b></td>  
        <td class="no-print"></td>     

    </tr>
    <?php $grand_total = round($total_amt_without_tax + $igst_total + $cess_total); ?>
       
    <tr>
        <td colspan="14"> Invoice value (In Words)  </td>
        <td colspan="3"><b><?php
                $total = round($grand_total);
                echo '&#8377; ' . $grand_total;
                ?></b></td>
    </tr>
    <?php
    $sale_reverse = $sale->reverse;
//sale is the model and reverse the relation of reverse charge table that is joined in Offshelsale class
    $ch_amt = 0.00;
    foreach ($sale_reverse as $s) {
        $ch_amt = $ch_amt + $s->amount;
    }
    ?>
    <tr>
        <td colspan="8" rowspan="6" style="padding-top: 35px;text-align: center;font-size: 12px;font-weight: bold;">
            <?php echo Utils::convert_number_to_words(round($total + $ch_amt)) ?>
        </td>
    </tr>
    <?php
    $is_model = Invoicesettings::model()->findAllByAttributes(array('type' => 'bill_cost'));
    $c = 0;
    $charges_total = 0.00;
    $rc_taxes_total = 0.00;
    foreach ($is_model as $is) {
        ?>
        <tr>
            <td colspan="6"  style="text-align: right;font-size: 10px;">
                <?= $is->label; ?> ( <?= $is->value; ?> %)
            </td>
            <td colspan="4">
                <?php echo '&#8377;' ?>
                <?php
                $c_amt = isset($sale_reverse[$c]->amount) ? $sale_reverse[$c]->amount : 0.00;
                $charges_total = $charges_total + $c_amt;
                echo $c_amt;
                $rc_taxes_total = $rc_taxes_total + Utils::calculatePercentage($is->value, $c_amt)
                ?>
            </td>
        </tr>
        <?php
        $c++;
    }
    ?>
    <tr>
        <td colspan="6"  style="text-align: right;font-size: 14px;font-weight: bold;">
            Invoice Total 
        </td>
        <td colspan="4" style="font-size: 14px;font-weight: bold;">
            &#8377; <?php echo $total + $charges_total; ?>
        </td>
    </tr>     

    <tr>
        <td colspan="8" style="text-align:right;font-size: 12px;">
            Amount of Tax Subject to Reverse Charge
        </td>
        <td colspan="3"></td>
        <td style="text-align: center;font-size: 10px;">&#8377; <?php echo $rc_taxes_total * Yii::app()->params['sgst_tax_percent_ratio'] / 100; ?></td>
        <td></td>
        <td style="text-align: center;font-size: 10px;">&#8377; <?php echo $rc_taxes_total * Yii::app()->params['cgst_tax_percent_ratio'] / 100; ?></td>
        <td></td>
        <td style="text-align: center;font-size: 10px;">&#8377; 0.00</td>
        <td></td>
    </tr>

    <tr>
        <td colspan="8" style="text-align: center;font-size: 12px;font-weight: bold;">
            TERM & CONDITION OF SALE
        </td>
        <td colspan="9" style="text-align: center;font-size: 12px;font-weight: bold;">
<?php echo Yii::app()->params['company_name']; ?>
        </td>
    </tr>
    <tr>
        <td colspan="8" rowspan="4" style="text-align: center;font-size: 10px;">
            <!--                                1.  TERM & CONDITION OF SALE 1 <br>
                                            2.TERM & CONDITION OF SALE 2 <br>
                                            3. TERM & CONDITION OF SALE 2 <br>-->
        </td>
        <td colspan="9" style="text-align: center;font-size: 10px;">
            Signature:       _________________________________
        </td>
    </tr>
    <tr>
        <td colspan="9" style="text-align: center;font-size: 10px;font-weight: bold;">
            Authorized Signatory
        </td>
    </tr>
    <tr>
        <td colspan="9" style="text-align: left;font-size: 10px;font-weight: bold;">
            Name:
            <br>
            Designation:
        </td>
    </tr>

</tbody>