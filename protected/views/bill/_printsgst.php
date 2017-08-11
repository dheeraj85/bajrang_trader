
<tr>
    <th class="border_on_print" rowspan="2">#</th>
    <th class="border_on_print" rowspan="2">Item</th>
    <th class="border_on_print" rowspan="2">HSN Code</th>
    <th class="border_on_print" rowspan="2">Rate</th>
    <th class="border_on_print" rowspan="2">Weight</th>                                     
    <th class="border_on_print" rowspan="2">Price</th>    
    <th class="border_on_print" rowspan="2">Total (&#8377;)</th>
    <th class="border_on_print" rowspan="2">Taxable Value (&#8377;)</th>   
    <th colspan="2" style="text-align: center"><b>CGST</b></th>
    <th colspan="2" style="text-align: center"><b>SGST</b></th>                                     
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
    $total_weight = 0;
    $total_tax = 0;
    $sgst_total = 0.00;
    $cgst_total = 0.00;
    $total_amt_without_tax = 0;
    foreach ($items as $item) {
        $item_model = $model->item; //getting from purchase item now
        $total = $total + $item->amount;
        $total_weight = $total_weight + $item->weight;
        $amt = $item->rate * $item->weight;

        $total_tax = $total_tax + $item->tax;

        $amt_without_tax = $item->amount;

        $total_amt_without_tax = $total_amt_without_tax + $amt_without_tax;
        ?>
        <tr>
            <td style="width:3%;"><?php echo $count; ?></td>                                        
            <td style="width:20%;"><?php echo $item_model->itemname . ' (' . $item_model->item_scale . ') '; ?></td>                                        
            <td style="width:8%;"><?php echo $item_model->gst_code; ?></td>                                        
            <td style="width:8%;"><?php echo $item->rate; ?></td>                                   
            <td style="width:5%;">                                                    
                <?php echo $item->weight; ?>                                                        
            </td>                                    
            <td style="width:8%;">
                <?php echo $item->rate * $item->weight; ?>
            </td>                                       

            <td style="width:6%;"><?php echo $item->amount; ?></td> 
            <td style="width:8%;"><?php echo $round_amt = round($amt_without_tax, 2); ?></td>                                            

            <!-- if selling in same state -->
            <?php
            if (!empty($item_model->gst_percent)) {
                $divide_tax = ($round_amt * $item_model->gst_percent) / 100;
            } else {
                $divide_tax = '';
            }
            ?>
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
                if (!empty($divide_tax)) {
                    echo $cgst = round($divide_tax / 2, 2);
                    $cgst_total = $cgst_total + $cgst;
                }
                ?>
            </td>       
            <td style="width:4%;">
                <?php
                if (!empty($item_model->gst_percent)) {
                    echo $item_model->gst_percent / 2;
                }
                ?>
            </td>       
            <td style="width:4%;">
                <?php
                if (!empty($divide_tax)) {
                    echo $sgst = round($divide_tax / 2, 2);
                    $sgst_total = $sgst_total + $sgst;
                }
                ?>
            </td>       


        </tr>
        <?php
        $count++;
    }
    ?>
    <tr>
        <td colspan="4" style="text-align: center;"><b>Total</b></td>                                            
        <td><b><?php echo $total_weight; ?></b></td>       
        <td></td>               
        <td></td>               
        <td><b><?php //echo $total_disc;         ?></b></td> 
        <td><b><?php //echo round($total);     ?></b></td> 
        <td><b><?php echo round($total_amt_without_tax); ?></b></td> 

        <td></td>      
        <td><b><?= $sgst_total ?></b></td>      
        <td></td>      
        <td><b><?= $cgst_total; ?></b></td>      
  

    </tr>
    <?php $grand_total = round($total_amt_without_tax + $sgst_total + $cgst_total); ?>

    <tr>
        <td colspan="10"> Invoice value (In Words)  </td>
        <td colspan="3"><b><?php
                $total = round($grand_total);
                echo '&#8377; ' . $grand_total;
                ?></b></td>
    </tr>
    <tr>
        <td colspan="8" rowspan="6" style="padding-top: 35px;text-align: center;font-size: 12px;font-weight: bold;">
            <?php echo Utils::convert_number_to_words(round($total)) ?>
        </td>
    </tr>


    <tr>
        <td colspan="6"  style="text-align: right;font-size: 14px;font-weight: bold;">
            Invoice Total 
        </td>
        <td colspan="4" style="font-size: 14px;font-weight: bold;">
            &#8377; <?php echo $total; ?>
        </td>
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