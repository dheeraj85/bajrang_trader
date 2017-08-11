<div class="modal-body">
    <div id="print_bill_kot">
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
                        <td colspan="2" align="center">
                            <h4>The Oven Classic -  
                                Menu KOT  </h4>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="border_on_print" style="text-align: center;font-weight:bold ">Menu KOT </td>
                    </tr>
                    <tr>                 
                        <th class="border_on_print" style="text-align:left;border-bottom:0px;"> <?php echo Cashcounter::model()->findByPk($kot->counter_id)->counter_name; ?>&emsp;&emsp; </th>                   
                        <th class="border_on_print" style="text-align:right;border-bottom:0px;"> Dt : <?php echo date('d-M-y h:i A'); ?>  </th>
                    </tr>
                    <tr>
                        <th class="border_on_print" style="text-align:left;"> <?php echo Ordertable::model()->findByPk($kot->table_id)->table_no; ?>&emsp;&emsp;</th>                   
                        <th class="border_on_print" style="text-align:right;">KOT NO : <?php echo $kot->kot_no; ?> </th>
                </table>
                <table class="table table-bordered" width="100%">
                    <tr>
                        <th class="border_on_print">#</th>
                        <th class="border_on_print">Item</th>
                        <th class="border_on_print">Qty</th>                                      
                        <th class="no-print"><a href="#" title="Delete Items">X</a></th>                                      
                    </tr>
                    <?php
                    $items = Menukotitems::model()->findAllByAttributes(array('menu_kot_id' => $kot->id));
                    if (!empty($items)) {
                        ?>
                        <tbody>
                            <?php
                            $count = 1;
                            $total_qty = 0;
                            foreach ($items as $item) {
                                $total_qty = $total_qty + $item->qty
                                ?>
                                <tr>
                                    <td style="width:10%"><?php echo $count; ?></td>                                        
                                    <td style="width:50%"><?php echo Menukotitems::getItem($item->menu_item_id)->positem->itemname; ?></td>                                        
                                    <td style="width:30%"><?php echo $item->qty; ?></td>      
                                    <td style="width:10%"  class="no-print">
                                        <?php if ($kot->is_added_to_bill == 0) { ?>
                                            <a href="#" onclick="DeleteItem(<?php echo $item->id; ?>)">&times;</a>   
                                        <?php } ?>
                                    </td>       
                                </tr>
                                <?php
                                $count++;
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="border_on_print"></td>
                            </tr>
                            <tr class="no-screen">
                                <th colspan="4" style="text-align:right" class="border_on_print">
                                    Total -                                  
                                    <label style="text-align: right">Qty : <?php echo $total_qty; ?></label>
                                </th>
                            </tr>
                            <tr class="no-screen">
                                <th colspan="4" style="text-align:left" class="border_on_print">
                                    <label style="text-align:right "><?php echo "User-" . Yii::app()->session['pos_user'] . ' /' . Yii::app()->session['counter'] ?></label>
                                </th>
                            </tr>
                        </tfoot>
                    <?php } ?>
                </table>
            </div>                    
        </div><!--end .card -->
        <div class="card height-1 no-print" style="text-align: right;font-weight:bold  " >
            <div class="row" style="margin-right: 50px;">
                Total &emsp;                                   
                <label style="text-align: right">Qty : <?php echo $total_qty; ?></label>

            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" id="close" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-info" id="print_bill_kot_btn" ><i class="fa fa-print fa-fw"></i>Print</button>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#print_bill_kot_btn').click(function () {
            Popup($('#print_bill_kot').html());
        });
        $('#close').click(function () {
            window.location.href='<?php echo $this->createUrl('pos/menu_items'); ?>'
        });
    });

    function DeleteItem(id) {
        $.ajax({
            url: '<?php echo $this->createUrl('pos/removeKotItems'); ?>',
            data: {'id': id},
            success: function (response) {
                $("#bill").html(response);
            }
        });
    }
</script>