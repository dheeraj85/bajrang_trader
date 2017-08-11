<?php
if (!empty($menu_sale)) {
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
                                    <td colspan="5" align="center">
                                        <h4>The Oven Classic -  
                                            Retail Invoice  </h4>
                                    </td>
                                </tr>
                                <tr class="no-screen print_border">
                                    <td colspan="6" align="left" class="border_on_print">The Oven Classics <br>
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
                                    <th class="border_on_print" style="text-align:left;border-bottom:0px;"> <?php echo Cashcounter::model()->findByPk($menu_sale->counter_id)->counter_name; ?>&emsp; </th>                     
                                    <th class="border_on_print" style="text-align:left;border-bottom:0px;"> Name : <?php echo $menu_sale->customer_name; ?></th>
                                </tr>
                                <tr>
                                    <th class="border_on_print" style="text-align:left;border-bottom:0px;"> <?php echo Ordertable::model()->findByPk($menu_sale->table_id)->table_no; ?>&emsp;</th>
                                    <th class="border_on_print" style="text-align:right;border-bottom:0px;"></th> 
                                </tr>
                                <tr>
                                    <th class="border_on_print" style="text-align:left;"> <?php echo date('d-M-y', strtotime($menu_sale->order_date)) . ' ' . $menu_sale->order_time; ?>&emsp;</th>
                                    <th class="border_on_print" style="text-align:right;">Invoice NO : <?php echo $menu_sale->invoice_number; ?> </th>
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
                                $menu_item_qty = 0.00;
                                foreach (Menusaleitems::model()->findAllByAttributes(array('menu_sale_id' => $menu_sale->id)) as $menu_sale_items) {
                                    $item_name = Purchaseitem::model()->findByPk($menu_sale_items->item_id);
                                    $menu_item_qty = $menu_item_qty + $menu_sale_items->qty;
                                    ?>
                                    <tr>
                                        <td><?php echo $c++; ?></td>
                                        <td><?php echo $item_name->itemname; ?></td>
                                        <td><?php echo $menu_sale_items->qty; ?></td>
                                        <td style="text-align: right;"><?php echo $menu_sale_items->unit_price; ?></td>
                                        <td style="text-align: right;"><?php echo $menu_sale_items->amount; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                <tr>
                                    <td colspan="2"><b>Sub Total</b></td>
                                    <td><b><?php echo $menu_item_qty; ?></b></td>
                                    <td></td>
                                    <td style="text-align: right;"><b><?php echo $menu_sale->sub_total; ?></b></td>
                                </tr>
                                <?php
                                if (!empty($menu_sale->tax_name)) {
                                    $tax_name = implode('\n', unserialize($menu_sale->tax_name));
                                    $tax_percent = implode('\n', unserialize($menu_sale->tax_percent));
                                } else {
                                    $tax_name = '';
                                    $tax_percent = '';
                                }
                                $tax_percent_array = explode('\n', $tax_percent);
                                ?>
                                <tr>
                                    <td colspan="1" style="border-right: 0px;"><?php echo $tax_name; ?></td>
                                    <td colspan="3"><?php echo $tax_percent . ' %'; ?></td>
                                    <td style="text-align: right;"><?php
                                        $tax_amt = 0.00;
                                        if (!empty($menu_sale->tax_percent)) {
                                            foreach (unserialize($menu_sale->tax_percent) as $t) {
                                                $tax_amt = $menu_sale->sub_total * ($t / 100);
                                                echo $tax_amt . '<br/>';
                                            }
                                        }
                                        ?></td>
                                </tr>
                                <tr>
                                    <td colspan="4">Discount (<?php echo $menu_sale->discount_percent; ?>%)</td>
                                    <td style="text-align: right;"><?php echo ($menu_sale->sub_total * ($menu_sale->discount_percent / 100)); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><b>Total</b></td>
                                    <td style="text-align: right;"><b id="total_amount"><?php echo 'Rs. ' . $menu_sale->total_amount; ?></b></td>
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
    $(document).ready(function () {
        $('#print_menu_bill_btn').click(function () {
            Popup($('#print_menu_bill').html());
        });
        $('#close').click(function () {
<?php if (empty($val)) { ?>
                window.location.href = '<?php echo $this->createUrl('pos/menu_items'); ?>';
<?php } ?>
        });
    });
</script>
