<?php
if (!empty($items)) {
    ?>
    <div class="col-lg-12" id="print_bill_ots">
        <style>
            @media print {
                .no-print{
                    display:none; 
                }
                tr td,th {
                    font-size:11px;  
                }
                #bill_area {
                    /*overflow: no-display;*/
                }
                .border_on_print{
                    border-bottom:1px dotted #000; 
                }
                .border_on_print_tb{
                    border-bottom:1px dotted #000; 
                    border-top: 1px dotted #000; 
                }
                *{
                    font-family:arial; 
                }
            }

            @media only screen{
                .no-screen{
                    display:none; 
                }
                #bill_area {
                    /*overflow: scroll;*/
                }
            }
        </style>
        <div class="card height-14" id="bill_area">
            <div class="card-head">
                <table class="table table-bordered">
                    <tr>
                        <th class="border_on_print" rowspan="2">#</th>
                        <th class="border_on_print" rowspan="2">Item</th>
                        <th class="border_on_print" rowspan="2">HSN Code</th>
                        <th class="border_on_print" rowspan="2">Rate</th>
                        <th class="border_on_print" rowspan="2">Weight</th>                                     
                        <th class="border_on_print" rowspan="2">Total</th>   
                        <th class="border_on_print" rowspan="2">Amount (&#8377;)</th>
                        <th class="border_on_print" rowspan="2">Taxable Value (&#8377;)</th>   
                        <td colspan="2" style="text-align: center"><b>CGST</b></td>
                        <td colspan="2" style="text-align: center"><b>SGST</b></td>                                      
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
                        $total_disc = 0;
                        $total_tax = 0;
                        $sgst_total = 0.00;
                        $cgst_total = 0.00;
                        $cess_total = 0.00;
                        $total_amt_without_tax = 0;
                        foreach ($items as $item) {

                            $item_model = $model->item; //getting from purchase item now
                            $total = $total + $item->amount;
                            $total_weight = $total_weight + $item->weight;
                            $amt = $item->amount;
                           
                            $total_tax = $total_tax + $item->tax;
                     
                                $amt_without_tax = $item->amount;
                          
                            $total_amt_without_tax = $total_amt_without_tax + $amt_without_tax;
                            ?>
                            <tr>
                                <td style="width:5%;"><?php echo $count; ?></td>                                        
                                <td style="width:20%;"><?php echo $item_model->itemname . ' (' . $item_model->item_scale . ') '; ?></td>                                        
                                <td style="width:10%;"><?php echo $item_model->gst_code; ?></td>                                        
                                <td style="width:8%;">                                                        
                                   
                                        <?php echo $item->rate; ?>
                        
                                </td>                                   
                                <td style="width:7%;">
                                    
                                        <?php echo $item->weight; ?>
                     
                                </td>                                    
                                <td style="width:8%;">
                                    <?php echo $item->rate * $item->weight; ?>
                                </td>
                                <td style="width:11%;"><?php echo $item->amount; ?></td> 
                                <td style="width:11%;"><?php echo $round_amt = round($amt_without_tax, 2); ?></td>                                            

                                <!-- if selling in same state -->
                                <?php
                                if (!empty($item_model->gst_percent)) {
                                    $divide_tax = ($round_amt * $item_model->gst_percent) / 100;
                                } else {
                                    $divide_tax = '';
                                }
                                ?>
                                <td style="width:10%;">
                                    <?php
                                    if (!empty($item_model->gst_percent)) {
                                        $cal = $item_model->gst_percent / 2;
                                        echo $cal;
                                    }
                                    ?>
                                </td>       
                                <td style="width:10%;">
                                    <?php
                                    if (!empty($divide_tax)) {
                                        echo $cgst = round($divide_tax / 2, 2);
                                        $cgst_total = $cgst_total + $cgst;
                                    }
                                    ?>
                                </td>       
                                <td style="width:10%;">
                                    <?php
                                    if (!empty($item_model->gst_percent)) {
                                        echo $item_model->gst_percent / 2;
                                    }
                                    ?>
                                </td>       
                                <td style="width:10%;">
                                    <?php
                                    if (!empty($divide_tax)) {
                                        echo $sgst = round($divide_tax / 2, 2);
                                        $sgst_total = $sgst_total + $sgst;
                                    }
                                    ?>
                                </td>       
                                <!-- if selling in same state -->
                   
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
                          
                          
                            <td><b><?php echo '&#8377; ' . round($total_amt_without_tax, 2); ?></b></td> 

                            <td></td>      
                            <td><b><?= '&#8377;' . $sgst_total ?></b></td>      
                            <td></td>      
                            <td><b><?= '&#8377;' . $cgst_total; ?></b></td>      
                                               </tr>
                        <?php $grand_total = round($total_amt_without_tax + $sgst_total + $cgst_total); ?>
                        <tr>
                            <td colspan="10"> Invoice value (In Words)  <?php echo Utils::convert_number_to_words($grand_total) ?>

                                <label style="text-align: right" class="pull-right">Total</label></td>
                            <td colspan="5"><b><?php echo '&#8377; ' . $grand_total; ?></b></td>
                        </tr>
                    </tbody>
                </table>
            </div>                    
        </div>
    </div>
    

    <div class="col-lg-12"><br><hr></div>
    <div class="col-lg-12">
        <br>                     


        <a target="_blank" href="<?php echo $this->createUrl('bill/invoice',array('id'=>$model->id)); ?>" class="btn btn-primary btn-lg pull-right" id="invoice" style="margin-left: 5px;"> Print Bill</button>
        <a  href="<?php echo $this->createUrl('bill/create'); ?>" class="btn btn-default">Back</a>

    </div>
<?php } ?> 