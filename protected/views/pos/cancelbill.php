<?php
if (!empty($shelf_sale)) {
    ?>
    <div class="modal-body">
        <div class='row'>
            <div class='col-md-12' >
                <div id="print_menu_bill">                  
                    <div class="card height-14" id="bill_area">
                        <div class="card-head">
                            <table class="table" width="100%">
                                <tr class="no-screen print_border">
                                    <td colspan="6" align="left" class="border_on_print"><b>The Oven Classics</b> <br>
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
                                    <th class="border_on_print" style="text-align:left;border-bottom:0px;"> <?php echo Cashcounter::model()->findByPk($shelf_sale->counter_id)->counter_name; ?>&emsp; </th>                     
                                    <th class="border_on_print" style="text-align:right;border-bottom:0px;"><?php echo date('d-M-y', strtotime($shelf_sale->order_date)) . ' ' . $shelf_sale->order_time; ?></th>
                                </tr>
                                <tr>
                                    <th class="border_on_print" style="text-align:left;"> &emsp;</th>
                                    <th class="border_on_print" style="text-align:right;">Invoice NO : <?php echo $shelf_sale->invoice_number; ?> </th>
                                </tr>
                            </table><br/>
                            <?php if ($shelf_sale->cancel_bill == 1) { ?>
                                <div class="col-lg-12 alert alert-danger">Bill has been canceled</div>
                            <?php } ?>
                            <form id="cancel_bill">
                                <input type="hidden" name="id" value="<?php echo $shelf_sale->id; ?>">
                                <table class="table table-bordered" width="100%">
                                    <tr>
                                        <th>Select</th>
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
                                    foreach (ShelfSaleItems::model()->findAllByAttributes(array('shelf_sale_id' => $shelf_sale->id)) as $shelf_sale_items) {
                                        $item_name = Purchaseitem::model()->findByPk($shelf_sale_items->item_id);
                                        $shelf_item_amt = $shelf_item_amt + $shelf_sale_items->amount;
                                        $shelf_item_qty = $shelf_item_qty + $shelf_sale_items->qty;
                                        ?>

                                        <tr>
                                            <td>
                                                <?php if ($shelf_sale_items->cancel_item == 0) { ?>
                                                <input type="checkbox" name="cancel_item[]" value="<?php echo $shelf_sale_items->id; ?>">
                                                <?php } ?>
                                            </td>
                                            <td><?php echo $c++; ?></td>
                                            <td><?php echo $item_name->itemname; ?>/ <?php echo $shelf_sale_items->item_id; ?></td>
                                            <td><?php echo $shelf_sale_items->qty; ?></td>
                                            <td style="text-align: right;"><?php echo $shelf_sale_items->unit_price; ?></td>
                                            <td style="text-align: right;"><?php echo $shelf_sale_items->amount; ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="2"><b>Total</b></td>
                                        <td><b><?php echo $shelf_item_qty; ?></b></td>
                                        <td></td>
                                        <td></td>
                                        <td style="text-align: right;"><b><?php echo 'Rs. ' . $shelf_item_amt; ?></b></td>
                                    </tr>
                                </table>

                                <div class="pull-left">
                                    <a href="javascript:history.back();" class="btn btn-default" >Back</a>
                                   
                                        <button type="button" data-loading-text="loading..." class="btn btn-primary" id="print_menu_bill_btn" onclick="cancelBill()">
                                            Cancel Bill</button>
                               

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } ?>
<?php
$csrfTokenName = Yii::app()->request->csrfTokenName;
$csrfToken = Yii::app()->request->csrfToken;
?>
<script type="text/javascript">
    function cancelBill(id) {
        var c = confirm('Are you sure want to cancel complete bill');
        if (c) {
            $('#print_menu_bill_btn').button('loading');
            //alert(id);
            var url = '<?php echo $this->createUrl("pos/ajaxcancelbill"); ?>';
            //var token = '<?php echo $csrfToken; ?>';
            var form_data=$("#cancel_bill").serialize();
            $.post(url, form_data, function(data) {
                var data = jQuery.parseJSON(data);
                $('#print_menu_bill_btn').button('reset');
                if (data.msg === 'success') {
                    window.location.reload();
                }
                else if (data.msg === 'fail') {
                    alert('There is something wrong, Please check correct Item checkbox to cancel')
                }
            });
        }
    }
</script>
