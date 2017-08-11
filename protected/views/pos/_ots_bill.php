<?php
if (!empty($shelf_sale)) {
    ?>
    <div class="modal-body">
        <div class='row'>
            <div class='col-md-12' >
                <div id="print_menu_bill">
                    <style>
                        @media print {
                            .no-print{
                                display:none; 
                            }
                            tr td,th {
                                font-size:12px;  
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

                        @media only screen{
                            .no-screen{
                                display:none; 
                            }
                            #bill_area {
                                overflow: scroll;
                            }
                        }

                    </style>             
                    <div class="card height-14" id="bill_area">
                        <div class="card-head">
                            <table class="table" width="100%">
                                <tr class="no-print">
                                    <td colspan="7" align="center" style="text-align: center">
                                        <?php echo Yii::app()->params['company_name']; ?>
                                        <br>
                                        <?php echo Yii::app()->params['company_addr1']; ?>
                                    </td>
                                </tr>
                                <tr class="no-screen print_border">
                                    <td colspan="7" align="left" class="border_on_print">
                                       <b style="font-family: cursive;font-size:16px"><?php echo Yii::app()->params['company_name']; ?></b>
                            <br>
                            <?php echo Yii::app()->params['company_addr1']; ?>
                            <br>
                            <?php echo Yii::app()->params['company_addr2']; ?>
                            <br>
                            &phone;
                            <?php echo Yii::app()->params['company_contact']; ?>
                            <br>
                            GSTIN : <?php echo Yii::app()->params['company_gstin']; ?>
                                    </td>
                                </tr>

                                <tr class="no-screen">
                                    <td colspan="7" class="border_on_print" style="text-align: center;font-weight:bold ">Tax Invoice</td>
                                </tr>
                                <tr class="no-screen">
                                    <td colspan="7" class="border_on_print" style="text-align: center;font-weight:bold "></td>
                                </tr>
                                <tr>                 
                                    <th colspan="7" class="border_on_print"><?php echo date('d-M-y', strtotime($shelf_sale->order_date)) . ' ' . $shelf_sale->order_time; ?>
                                        &emsp;&emsp; Invoice No : <?php echo $shelf_sale->invoice_number; ?> </th>
                                </tr>
                                <tr class="no-screen">
                                    <th class="border_on_print" colspan="6">Item</th>                                  
                                    <th class="border_on_print" style="text-align:right;">Qty</th>
                                </tr>
                                 
                                <tr class="doNotShowOnPrint">
                                    <th>S No.</th>
                                    <th>Item</th>
                                    <th>Qty</th>
                                    <th>Rate in (Rs.)</th>
                                    <th>CT-ST %</th>
                                    <th>Amount in (Rs.)</th>
                                </tr>
                                <?php
                                $c = 1;
                                $shelf_item_amt = 0.00;
                                $shelf_item_qty = 0.00;
                                foreach (ShelfSaleItems::model()->findAllByAttributes(array('shelf_sale_id' => $shelf_sale->id)) as $shelf_sale_items) {
                                    $item_info = Purchaseitem::model()->findByPk($shelf_sale_items->item_id);
                                    $shelf_item_amt = $shelf_item_amt + $shelf_sale_items->amount;
                                    $shelf_item_qty = $shelf_item_qty + $shelf_sale_items->qty;
                                    $gst_percent = $item_info->gst_percent;
                                    $cess_tax = $item_info->cess_tax;
                                    ?>
                                    <!-- ===== for printing purpose start-->
                                    <tr class="no-screen">                                             
                                        <td colspan="6"><b><?php echo $c; ?>-</b> 
                                            <?php echo $item_info->itemname; ?> 
                                            <?php echo isset($item_info->gst_code_type) ? $item_info->gst_code_type . $item_info->gst_code : ''; ?>
                                        </td>
                                        <td style="text-align:right"><?php echo $shelf_sale_items->qty; ?><?php echo $item_info->item_scale; ?></td>                                                
                                    </tr>
                                    <tr class="no-screen">
                                        <td colspan="7">
                                            CT-ST%:<?= $gst_percent; ?>&nbsp;
                                            <?php
                                            if ($cess_tax > 0) {
                                                echo "CESS%:" . $cess_tax;
                                            }
                                            ?>
                                            <span style="float:right;display: inline">&#8377;<?= $shelf_sale_items->unit_price * $shelf_sale_items->qty; ?></span>
                                        </td>    
                                    </tr>

                                    <!-- ===for printing purpose end ======-->
                                    <tr class="doNotShowOnPrint">
                                        <td><?php echo $c++; ?></td>
                                        <td><?php echo $item_info->itemname; ?></td>
                                        <td><?php echo $shelf_sale_items->qty; ?></td>
                                        <td><?php echo $item_info->gst_percent;?></td>
                                        <td style="text-align: right;"><?php echo $shelf_sale_items->unit_price; ?></td>
                                        <td style="text-align: right;"><?php echo $shelf_sale_items->amount; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                <tr class="no-screen">
                                    <td colspan="7" class="border_on_print" style="text-align: center;font-weight:bold "></td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;" colspan="7">
                                        <b>Total</b> &emsp;&emsp;
                                        <b>Qty : <?php echo $shelf_item_qty; ?></b>
                                        &emsp;&emsp; Amt :
                                        <b><?php echo '&#8377;' . $shelf_item_amt; ?></b></td>
                                </tr>
                                <tr class="no-screen">
                                    <td colspan="7" class="border_on_print" style="text-align: center;font-weight:bold "></td>
                                </tr>
                                <tr class="no-screen">
                                    <td colspan="7" style="text-align:right;">
                                        <?php
                                        if (!empty($shelf_item_amt)) {
                                            echo Utils::convert_number_to_words($shelf_item_amt); // . ' Only';
                                        }
                                        ?>
                                    </td>                                            
                                </tr>
                                </tr>
                                <tr class="no-screen">
                                    <td colspan="7" class="border_on_print" style="text-align: center;font-weight:bold "></td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        Thank You
                                    </td>
                                    <td colspan="4">   
    <?php echo Cashcounter::model()->findByPk($shelf_sale->counter_id)->counter_name; ?>&emsp;                      
                                    </td>

                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" id="close" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="print_menu_bill_btn" ><i class="fa fa-money fa-fw"></i>Print Bill</button>
    </div>
<?php } ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#print_menu_bill_btn').click(function() {
            Popup($('#print_menu_bill').html());
        });
    });
</script>
