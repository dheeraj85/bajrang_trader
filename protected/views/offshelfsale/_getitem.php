<?php
if (!empty($sale)) {
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
                                    <td colspan="5" align="center" >
                                        <b>The Oven Classics </b><br>
                                        A unit of Kasa Fine Foods, 309/3, NH30 Tilhari, Jabalpur (MP), 482020 <br>
                                        TIN No- 23269160358, Ph : 0761-2606311
                                    </td>
                                </tr>
                                <tr class="no-screen print_border"  >
                                    <td colspan="6" align="left" class="border_on_print" style="text-align: center;font-weight:bold">The Oven Classics <br>
                                        A unit of Kasa Fine Foods <br>
                                        309/3, NH30 Tilhari <br>
                                        Jabalpur (MP), 482020 <br>
                                        TIN No- 23269160358 <br>
                                        Ph : 0761-2606311<br>                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="border_on_print" style="text-align: center;font-weight:bold ">Retail Invoice</td>
                                </tr>
                                <tr>                 
                                    <th class="border_on_print" style="text-align:left;border-bottom:0px;"> <?php echo Cashcounter::model()->findByPk($sale->counter_id)->counter_name; ?>&emsp; </th>                     
                                    <th class="border_on_print" style="text-align:right;border-bottom:0px;"><?php echo date('d-M-y', strtotime($sale->order_date)) . ' ' . $sale->order_time; ?></th>
                                </tr>
                                <tr>
                                    <th class="border_on_print" style="text-align:left;"> &emsp;</th>
                                    <th class="border_on_print" style="text-align:right;">Invoice NO : <?php echo $sale->invoice_number; ?> </th>
                                </tr>
                            </table><br/>
                            <table class="table table-bordered" width="100%">
                                <tr>
                                    <th>S No.</th>
                                    <th>Item</th>
                                    <th>Qty</th>
                                    <th>Rate in (Rs.)</th>
                                    <th>Amount in (Rs.)</th>
                                </tr>
                                <?php
                                $c = 1;
                                $shelf_item_amt = 0.00;
                                $shelf_item_qty = 0.00;
                                foreach (ShelfSaleItems::model()->findAllByAttributes(array('shelf_sale_id' => $sale->id)) as $shelf_sale_items) {
                                    //for some reaseon purchase item se item name nahi le rahe hai 
                                    //commented below that part
                                   // $item_name = Purchaseitem::model()->findByPk($shelf_sale_items->item_id);
                                    $shelf_item_amt = $shelf_item_amt + $shelf_sale_items->amount;
                                    $shelf_item_qty = $shelf_item_qty + $shelf_sale_items->qty;
                                    ?>
                                    <tr>
                                        <td><?php echo $c++; ?></td>
                                        <td><?php echo $shelf_sale_items->description; ?></td>
                                        <!--<td><?php //echo $item_name->itemname; ?></td>-->
                                        <td><?php echo $shelf_sale_items->qty; ?></td>
                                        <td style="text-align: right;"><?php echo $shelf_sale_items->unit_price; ?></td>
                                        <td style="text-align: right;"><?php echo $shelf_sale_items->amount; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                    <tr>
                                        <th class="border_on_print" colspan="5"  style="text-align:left;"> &emsp;</th>
                                    </tr>
                                <tr>
                                    
                                    <td colspan="2"><b>Total</b></td>
                                    <td><b><?php echo $shelf_item_qty; ?></b></td>
                                    <td></td>
                                    <td style="text-align: right;"><b><?php echo 'Rs. ' . $shelf_item_amt; ?></b></td>
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

    function Popup(data) {
        var mywindow = window.open('', 'toc_bill_print', 'height=500,width=700');
        mywindow.document.write('<html><head><title>Print</title>');
        mywindow.document.write('</head><body >');
        //alert(data);
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');
        mywindow.print();
        mywindow.close();
        //return true; 
        window.onfocus = function() {
            window.close();

        };
    }
</script>
