<?php
$items = Offshelfsaleitems::model()->findAllByAttributes(array('shelf_sale_id' => $model->id), array('order' => 'id asc')); //print_r($items);     
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
                        <th class="border_on_print" rowspan="2">Qty</th>                                     
                        <th class="border_on_print" rowspan="2">Total</th>                                     
                        <th class="border_on_print" rowspan="2">Disc (%)</th>                                     
                        <th class="border_on_print" rowspan="2">Disc (&#8377;)</th>   

                        <th class="border_on_print" rowspan="2">Amount (&#8377;)</th>

                        <th class="border_on_print" rowspan="2">Taxable Value (&#8377;)</th>   
                        <td colspan="2" style="text-align: center"><b>CGST</b></td>
                        <td colspan="2" style="text-align: center"><b>SGST</b></td>
                        <td colspan="2" style="text-align: center"><b>CESS</b></td>
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
                        $sgst_total = 0.00;
                        $cgst_total = 0.00;
                        $cess_total = 0.00;
                        $total_amt_without_tax = 0;
                        foreach ($items as $item) {

                            $item_model = $item->item_model; //getting from purchase item now
                            $total = $total + $item->amount;
                            $total_qty = $total_qty + $item->qty;
                            $amt = $item->unit_price * $item->qty;
                            $total_disc = $total_disc + $item->disc_amt;
                            $total_tax = $total_tax + $item->tax_amt;
                            if ($model->tax_type == 'INCLUSIVE') {
                                $amt_without_tax = Utils::excludeTaxFromPrice($item_model->gst_percent, $item->amount);
                            } else {
                                $amt_without_tax = $item->amount;
                            }
                            $total_amt_without_tax = $total_amt_without_tax + $amt_without_tax;
                            ?>
                            <tr>
                                <td style="width:5%;"><?php echo $count; ?></td>                                        
                                <td style="width:20%;"><?php echo $item_model->itemname . ' (' . $item_model->item_scale . ') '; ?></td>                                        
                                <td style="width:10%;"><?php echo $item_model->gst_code; ?></td>                                        
                                <td style="width:8%;">                                                        
                                    <?php if (!empty($model->invoice_number)) { ?>
                                        <?php echo $item->unit_price; ?>
                                    <?php } else { ?>
                                        <label class="no-screen"><?php echo $item->unit_price; ?></label>
                                        <input class="no-print checkData" type="number" name="unit_price" value="<?php echo $item->unit_price; ?>" id="unitprice_<?php echo $item->id; ?>"
                                               style="width:100%"  onkeyup="Javascript: if (event.keyCode == 13 || event.which == 13)
                                                           update(<?php echo $item->id ?>, this.value, 'price');"> 
                                           <?php } ?>
                                </td>                                   
                                <td style="width:8%;">
                                    <?php if (!empty($model->invoice_number)) { ?>
                                        <?php echo $item->qty; ?>
                                    <?php } else { ?>
                                        <label class="no-screen"><?php echo $item->qty; ?></label>
                                        <input class="no-print checkData" type="number" name="qty" value="<?php echo $item->qty; ?>" id="qty_<?php echo $item->id; ?>"
                                               style="width:100%"  onkeyup="Javascript: if (event.keyCode == 13 || event.which == 13)
                                                           update(<?php echo $item->id ?>, this.value, 'qty');"> 
                                           <?php } ?>
                                </td>                                    
                                <td style="width:8%;">
                                    <?php echo $item->unit_price * $item->qty; ?>
                                </td>                                       
                                <td style="width:8%;">

                                    <?php if (!empty($model->invoice_number)) { ?>
                                        <?php echo $item->discount_percent; ?>
                                    <?php } else { ?>
                                        <label class="no-screen"><?php echo $item->discount_percent; ?></label>
                                        <input class="no-print checkData" type="number" name="discount" value="<?php echo $item->discount_percent; ?>" id="qty_<?php echo $item->id; ?>"
                                               style="width:100%"  onkeyup="Javascript: if (event.keyCode == 13 || event.which == 13)
                                                           update(<?php echo $item->id ?>, this.value, 'discount');"> 
                                           <?php } ?>
                                </td>                                       
                                <td style="width:8%;">
                                    <?php echo $item->disc_amt; ?>
                                </td>            
                                <td style="width:15%;"><?php echo $item->amount; ?></td> 
                                <td style="width:15%;"><?php echo $round_amt = round($amt_without_tax, 2); ?></td>                                            

                                <!-- if selling in same state -->
                                <?php
                                if (!empty($item_model->gst_percent)) {
                                    $divide_tax = ($round_amt * $item_model->gst_percent) / 100;
                                } else {
                                    $divide_tax = '';
                                }
                                ?>
                                <td style="width:8%;">
                                    <?php
                                    if (!empty($item_model->gst_percent)) {
                                        $cal = $item_model->gst_percent / 2;
                                        echo $cal;
                                    }
                                    ?>
                                </td>       
                                <td style="width:8%;">
                                    <?php
                                    if (!empty($divide_tax)) {
                                        echo $cgst = round($divide_tax / 2, 2);
                                        $cgst_total = $cgst_total + $cgst;
                                    }
                                    ?>
                                </td>       
                                <td style="width:8%;">
                                    <?php
                                    if (!empty($item_model->gst_percent)) {
                                        echo $item_model->gst_percent / 2;
                                    }
                                    ?>
                                </td>       
                                <td style="width:8%;">
                                    <?php
                                    if (!empty($divide_tax)) {
                                        echo $sgst = round($divide_tax / 2, 2);
                                        $sgst_total = $sgst_total + $sgst;
                                    }
                                    ?>
                                </td>       
                                <!-- if selling in same state -->

                                <td style="width:8%;">     <?php
                                    if (!empty($item_model->cess_tax)) {
                                        echo $cess_tax = $item_model->cess_tax;
                                    } else {
                                        echo $cess_tax = '';
                                    }
                                    ?></td>                                            
                                <td style="width:8%;"><?php
                                    if (!empty($item_model->cess_tax)) {
                                        $cess_amt = ($round_amt * $item_model->cess_tax) / 100;
                                        echo $cess_charge = round($cess_amt, 2);
                                        $cess_total = $cess_total + $cess_charge;
                                    }
                                    ?></td>                                            

                                <?php if (empty($model->invoice_number)) { ?>
                                    <td style="width:5%"  class="no-print">
                                        <a href="<?php echo $this->createUrl('offshelfsale/removeitem', array('id' => $item->id)) ?>" onclick="return confirm('Are you sure you want to delete item ?')" title="Delete Item"><span class="label label-danger"><i class="glyphicon glyphicon-remove"></i></span></a> 
                                    </td> 
                                <?php } ?> 
                            </tr>
                            <?php
                            $count++;
                        }
                        ?>
                        <tr>
                            <td colspan="4" style="text-align: center;"><b>Total</b></td>                                            
                            <td><b><?php echo $total_qty; ?></b></td>       
                            <td></td>               
                            <td></td>               
                            <td><b><?php echo '&#8377; ' . $total_disc; ?></b></td> 
                            <td><b><?php //echo $total;      ?></b></td> 
                            <td><b><?php echo '&#8377; ' . round($total_amt_without_tax, 2); ?></b></td> 

                            <td></td>      
                            <td><b><?= '&#8377;' . $sgst_total ?></b></td>      
                            <td></td>      
                            <td><b><?= '&#8377;' . $cgst_total; ?></b></td>      
                            <td></td>      

                            <td><b><?= '&#8377;' . $cess_total ?></b></td>  


                            <?php if (empty($model->invoice_number)) { ?>
                                <td class="no-print"></td>     
                            <?php } ?> 
                        </tr>
                        <?php $grand_total = round($total_amt_without_tax + $sgst_total + $cgst_total + $cess_total); ?>
                        <tr>
                            <td colspan="13"> Invoice value (In Words)  <?php echo Utils::convert_number_to_words($grand_total) ?>

                                <label style="text-align: right" class="pull-right">Total</label></td>
                            <td colspan="4"><b><?php echo '&#8377; ' . $grand_total; ?></b></td>
                        </tr>
                    </tbody>
                </table>
            </div>                    
        </div>
    </div>
    <div class="col-lg-12">
        <form id="reverse_charges">
            <input type="hidden" name="shelf_sale_id" value="<?= $model->id; ?>">
            <label>Amount of Services Subject to Reverse Charge</label> <br>
            <?php
            $is_model = Invoicesettings::model()->findAllByAttributes(array('type' => 'bill_cost'));
            $c = 0;
            foreach ($is_model as $is) {
                ?>
                <div class="col-lg-2">
                    <label> <?= $is->label; ?></label>
                    <input type="number" name="settings[<?= $is->id; ?>]" class="form-control" value="<?= isset($model->reverse[$c]->amount) ? $model->reverse[$c]->amount : 0.00; ?>">
                </div>
                <?php
                $c++;
            }
            ?>
            <div class="col-lg-3" style="margin-top: 25px;">
                <label> </label>
                <button type="button" class="btn btn-sm btn-success" data-loading-text="Saving..." onclick="saveReverseCharges()">Add Charges</button>
                <label id="charges_added"></label>
            </div>
        </form>
    </div>

    <div class="col-lg-12"><br><hr></div>
    <div class="col-lg-12">
        <br>                      
        <?php if (empty($model->invoice_number)) { ?>
           <a  href="<?php echo $this->createUrl('offshelfsale/memo', array('id' => $model->id)); ?>" target="_blank" class="pull-left" id="memo" title="Print Proforma Invoice" ><i class="fa fa-print"></i></a>
            <div class="col-lg-6">Before Leaving this  page make sure you have added all items and click to  "Create Bill" or print as Proforma</div>
        <?php } ?> 

        <?php
        $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
            'action' => Yii::app()->createUrl('offshelfsale/invoice'),
            'method' => 'POST',
             'htmlOptions'=>array(
                                            'target'=>'_blank')
                             
        ));
        ?>
        <input type="hidden" name="id" value="<?= $model->id ?>">
        <button type="submit" class="btn btn-primary btn-lg pull-right" id="invoice" style="margin-left: 5px;"> <?php if (!empty($model->invoice_number)) { ?> Print Bill <?php } else { ?>Create Bill <?php } ?></button>
        <a  href="<?php echo $this->createUrl('offshelfsale/create'); ?>" class="btn btn-default">Back</a>
        <div class="col-lg-3 pull-right">   
            <select name="print_type" class="form-control">
                <?php foreach (Utils::billPrintType() as $k => $v) { ?>
                    <option value="<?= $v; ?>"><?php echo $v; ?></option>
                <?php } ?>
            </select>
        </div>
        <?php $this->endWidget(); ?>
    </div>
<?php } ?> 