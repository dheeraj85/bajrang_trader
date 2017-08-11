<?php
if (!empty($model)) {
    $customer = Customer::model()->findByPk($model->customer_id);
    ?>
    <style>
        @media print {
            * {
                font-size: 11px;
            }
            table td,th {
                font-size:10px;  
                border-collapse: collapse;border-spacing:0;
            }
            #bill_area {
                overflow: no-display;
            }
            .border_on_print{
                border-bottom:1px dotted #000; 
            }
            .border_on_print_tb{
                border-bottom:1px dotted #000; 
                border-top: 1px dotted #000; 
            }
            *{
                font-family:monospace; 
            }
            .doNotShowOnPrint{
                display:none; 
            }
        }
    </style>

    <div class="row">
        <div class="col-xs-12">
            <?php
            if (!empty($items)) {
                ?>
                <table class="table table-bordered">
                    <tr>
                        <td colspan="3" style="text-align: center">
                            <img src="<?php echo Yii::app()->baseUrl; ?>/images/bg-logo.png" alt="LOGO" style="width:110px;height:125px;">  
                        </td>
                        <td colspan="10" style="text-align: center;">
                            <b style="font-size: 18px;">
                                <?php echo Globalpreferences::getValueByParamName('company_name'); ?>
                            </b>
                            <br>
                            <?php echo Globalpreferences::getValueByParamName('company_addr1'); ?>                           
                            <br>
                            <?php echo Globalpreferences::getValueByParamName('company_addr2'); ?>                        

                            &emsp;&phone; 
                            <?php echo Globalpreferences::getValueByParamName('company_contact'); ?>  
                        </td>
                    </tr>


                    <tr>
                        <th colspan="13" style="text-align: center;font-size: 16px;">Tax Invoice    (<?php
                            if ($model->bill_type == 'incremental_bill') {
                                echo "Incremental Bill";
                            } else {
                                echo "Cost Bill";
                            }
                            ?>)</th>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <table style="width: 100%;" class="table table-bordered">
                                <tr>
                                    <td>GSTIN</td>
                                    <td> <?php echo Globalpreferences::getValueByParamName('company_gstin'); ?></td>
                                </tr>
                                <tr>
                                    <td>PAN:</td>
                                    <td>        
                 <?php echo Globalpreferences::getValueByParamName('company_pan_card'); ?>
                                    </td>                              
                                </tr> 
                                <tr>
                                    <td>Invoice No /Date </td>
                                    <td> <?php echo $model->bill_no; ?> / <?php echo date('d-m-Y', strtotime($model->bill_date)); ?></td>
                                </tr>

                            </table>
                        </td>
                        <td colspan="8">
                            <table style="width: 100%" class="table table-bordered">
                                <tr>
                                    <td>Place of Supply State code</td>
                                    <td> <?php echo Yii::app()->params['company_state_code']; ?></td>
                                </tr>
                                <tr>
                                    <td>Place of Supply State </td>
                                    <td> <?php echo Yii::app()->params['company_state']; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        Period:-&emsp;From : &emsp;<?php echo Utils::yyyymmdd_to_ddmmyyyy($model->bill_from_date); ?>
                                        &emsp;
                                        To : &emsp;<?php echo Utils::yyyymmdd_to_ddmmyyyy($model->bill_to_date); ?>
                                    </td>

                                </tr>

                            </table>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="13" style="text-align: center;font-size: 13px;font-weight: bold;background: #babdb6">Details of Receiver (Billed to)</td>
                    </tr>

                    <tr>
                        <td colspan="13">   
                            <table style="width: 100%;border:0px;border-collapse: collapse" class="table table-bordered">
                                <tr>
                                    <td style="font-size: 10px;font-weight: bold">Name:</td>
                                    <td style="font-size: 10px;font-weight: bold"><?php echo $customer->full_name; ?></td>
                                </tr>
                                <tr>
                                    <td style="font-size: 10px;font-weight: bold">Address:</td>
                                    <td style="font-size: 10px;font-weight: bold"> <?php echo $customer->address; ?></td>
                                </tr>
                                <tr>
                                    <td style="font-size: 10px;font-weight: bold">State:</td>
                                    <td style="font-size: 10px;font-weight: bold"> <?php echo $customer->state; ?></td>
                                </tr>
                                <tr>
                                    <td style="font-size: 10px;font-weight: bold">State Code:</td>
                                    <td style="font-size: 10px;font-weight: bold"> <?php echo $customer->state_code; ?></td>
                                </tr>                                               
                                <tr>
                                    <td style="font-size: 10px;font-weight: bold">GSTIN:</td>
                                    <td style="font-size: 10px;font-weight: bold"> <?php echo $customer->gstin_no; ?></td>
                                </tr>          
         
                                <?php if ($model->bill_type == 'incremental_bill') { ?>
                                    <tr>
                                        <td style="font-size: 10px;font-weight: bold">Purchase Order/ Supply From :</td>
                                        <td style="font-size: 10px;font-weight: bold"> <?php
                                            if (!empty($poi)) {
                                                foreach ($poi as $po) {
                                                    echo $po['order_no'] . "/" . $po['place'].',&emsp;';
                                                }
                                            }
                                            ?> </td>
                                    </tr> 
                                <?php } else { ?>
                                    <tr>
                                        <td style="font-size: 10px;font-weight: bold">Weight Report No. :</td>
                                        <td style="font-size: 10px;font-weight: bold"> <?php echo $model->particulars; ?> </td>
                                    </tr>                                               
                                    <tr>
                                        <td style="font-size: 10px;font-weight: bold">Purchase Order/ Supply From :</td>
                                        <td style="font-size: 10px;font-weight: bold"> <?php
                                            $po = $model->purchaseOrder;
                                            echo $po->order_no . "/" . $po->place;
                                            ?> </td>
                                    </tr>  
                                <?php } ?>
                            </table>
                        </td>

                    </tr>

                    <tr>
                        <th class="border_on_print" rowspan="2">#</th>
                        <th class="border_on_print" rowspan="2">Item</th>
                        <th class="border_on_print" rowspan="2">HSN Code</th>
                        <th class="border_on_print" rowspan="2">Weight</th>       
                        <th class="border_on_print" rowspan="2">Rate</th>                                                      
                        <!--<th class="border_on_print" rowspan="2">Price</th>-->    
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
                                <td style="width:20%;"><?php echo $item_model->itemname . ' (' . $item_model->item_scale . ') '; ?>
                                    <br>

                                </td>                                        
                                <td style="width:8%;"><?php echo $item_model->gst_code; ?></td>                                        

                                <td style="width:5%;">                                                    
                                    <?php echo $item->weight; ?>                                                        
                                </td>     
                                <td style="width:8%;"><?php echo $item->rate; ?></td>        
                                <td style="width:8%;">
                                    <?php echo $item->rate * $item->weight; ?>
                                </td>                                       

                                                                                                        <!--<td style="width:6%;"><?php //echo $item->amount;       ?></td>--> 
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
                            <td colspan="3" style="text-align: center;"><b>Total</b></td>                                            
                            <td><b><?php echo $total_weight; ?></b></td>       
                            <td></td>               
                            <td></td>               
                            <td><b><?php echo round($total_amt_without_tax); ?></b></td> 

                            <td></td>      
                            <td><b><?= $sgst_total ?></b></td>      
                            <td></td>      
                            <td><b><?= $cgst_total; ?></b></td>      


                        </tr>
                        <?php $grand_total = round($total_amt_without_tax + $sgst_total + $cgst_total); ?>

                        <tr>
                            <td colspan="9"> Invoice value (In Words)  
                                <span class="pull-right">Grand Total</span>
                            </td>
                            <td colspan="3" style="text-align: right"><b><?php
                                    $total = round($grand_total);
                                    echo '&#8377; ' . $grand_total;
                                    ?></b>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="4" rowspan="6" style="padding-top: 35px;text-align: center;font-size: 14px;font-weight: bold;">
                                <?php echo Utils::convert_number_to_words(round($total)) ?>
                            </td>
                        </tr>


                        <tr style="height: 60px;">
                            <td colspan="4"  style="text-align: right;font-size: 14px;font-weight: bold;">
                                Invoice Total 
                            </td>
                            <td colspan="4" style="font-size: 14px;font-weight: bold;">
                                &#8377; <?php echo $total; ?>
                            </td>
                        </tr>    

                        <tr>

                            <td colspan="8" style="text-align: center;font-size: 14px;font-weight: bold;">
                                <?php echo "For M/s. " . Globalpreferences::getValueByParamName('company_name'); ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="8" style="text-align: center;font-size: 10px;">
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


                </table>
            <?php } ?>
        </div>
    </div>


<?php } ?>
<script type="text/javascript">
      window.print();
</script>

