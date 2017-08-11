<div class="row">
    <div class="col-md-12">
        <div class="card1">
            <div class="card-head">
                <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a href="<?php echo $this->createUrl("pos/ots_items"); ?>">OTS</a></li>
                    <li><a href="<?php echo $this->createUrl("pos/menu_items"); ?>">MENU  <sup class="badge style-danger"></sup></a></li>
                    <li><a href="<?php echo $this->createUrl("pos/aos_items"); ?>">AOS  <sup class="badge style-danger"></sup></a></li>
                </ul>
            </div><!--end .card-head -->
            <div class="tab-content">
                <div class="tab-pane active" id="first4">
                    <div class="col-md-12 qty_msg">
                        <?php if (Yii::app()->user->hasFlash('ots')) { ?>
                            <div class="alert">
                                <span class="closebtn" ><a onclick="this.parentElement.style.display = 'none';">&times;</a></span> 
                                <?php echo Yii::app()->user->getFlash('ots'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-md-7">
                        <ul class="header-nav">
                            <li class="col-lg-2 col-md-10"><div style="font-size:14px;font-weight:bold;">OTS ITEMS</div></li>
                            <li class="col-lg-10 col-md-10 pull-right">
                                <form action="<?php echo $this->createUrl('pos/addToCart') ?>" class="navbar-search expanded" role="search">
                                    <div class="typeahead__container">
                                        <div class="typeahead__field">
                                            <span class="typeahead__query">
                                                <input style="width:430px;" class="form-control js-typeahead-input"
                                                       name="q"
                                                       id="q" 
                                                       type="search"                                                      
                                                       autocomplete="off">
                                            </span>
                                            <span class="typeahead__button">
                                                <button type="submit">
                                                    <i class="typeahead__search-icon"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        </ul>
                        <div class="card-body no-padding height-6">   
                            <?php
//                            //  print_r($hot_items);
//                            if (!empty($hot_items)) {
//                                foreach ($hot_items as $ht) {
//                                    
                            ?>
                            <!--                                    <div class="col-lg-3 col-md-3 col-xs-6" >
                                                                    <a href="<?php echo $this->createUrl('pos/addToCart') ?>?item=<?php echo $ht['item_id'] ?>">
                                                                        <center>
                                                                            <div class="card">
                                                                                <img class="img-responsive center" style="text-align: center;height:80px;" src="//<?php echo Yii::app()->request->baseUrl; ?>/images/toc-logo.png" alt="" />
                                                                                <div class="card-body small-padding text-center">
                                                                                    <span class="text-default-dark">//<?php echo $ht['item'] ?></span>
                                                                                </div>
                                                                            </div>end .card 
                                                                        </center>
                                                                    </a>
                                                                </div>end .col -->
                            <?php
//                                }
//                            }
                            ?>
                            <div class="col-lg-12" style="height: 600px;overflow: scroll;">
                                <?php
                                //print_r($items); 
                                if (!empty($items)) {
                                    ?>
                                    <table class="table" >
                                        <tr>
                                            <th>Invoice No.</th>
                                            <th>Type</th>
                                            <th>Order Time</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                        <?php
                                        $total = 0.00;
                                        foreach ($items as $i) {
                                            // print_r($i);
                                            ?>
                                            <tr>
                                                <td><?php echo $i->invoice_number; ?></td>
                                                <td><?php echo $i->txn_type; ?></td>
                                                <td><?php echo $i->order_time; ?></td>
                                                <td><?php
                                                    $sum = 0.00;
                                                    foreach ($i->offShelfSaleItems as $s) {
                                                        $sum = $sum + (float) $s->amount;
                                                    } echo $sum;
                                                    ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-sm" id="view_bill" onclick="ViewMenuBill(<?php echo $i->id; ?>);" title="Click to View Bill"><i class="fa fa-eye fa-fw"></i></button>
                                                    <?php if ($i->pay_status == 'Paid') { ?>
                                                        <button type="button" class="btn btn-success btn-sm"  title="Bill Paid"><i class="fa fa-dollar fa-fw"></i></button>
                                                    <?php } else if ($i->pay_status == 'Credit') { ?>
                                                        <button type="button" class="btn btn-success btn-sm"  title="Bill Credited to customer account"><i class="fa fa-credit-card fa-fw"></i></button>
                                                    <?php } else { ?>
                                                        <button type="button" class="btn btn-warning btn-sm" id="pay_bill_<?php echo $i->id; ?>" onclick="billPay(<?php echo $i->id; ?>);" title="Click to Bill Pay"><i class="fa fa-dollar fa-fw"></i></button>
                                                        <button type="button" class="btn btn-success btn-sm" id="credit_bill_<?php echo $i->id; ?>" onclick="creditBill(<?php echo $i->id; ?>);" title="Click to Credit Bill"><i class="fa fa-credit-card fa-fw"></i></button>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php
                                            $total = $total + $sum;
                                        }
                                        ?> 
    <!--                                        <tr>
    <td colspan="3" style="text-align: center;"><b>Total</b></td>
    <td><b><?php //echo $total;              ?></b></td>
    <td></td>
    </tr>-->

                                    </table>
                                    <?php
                                }
                                ?>

                            </div>  
                        </div>  


                    </div>

                    <div class="col-md-5" id="print_bill_ots">
                        <style>
                            .alert {
                                padding: 5px;
                                background-color: #f44336; /* Red */
                                color: white;
                                margin-bottom: 15px;
                                font-size: 16px;
                                text-align: center;
                            }

                            /* The close button */
                            .closebtn {
                                margin-top: 5px;
                                margin-left: 15px;
                                color: white;
                                font-weight: bold;
                                float: right;
                                font-size: 16px;
                                line-height: 20px;
                                cursor: pointer;
                                transition: 0.3s;
                            }

                            /* When moving the mouse over the close button */
                            .closebtn:hover {
                                color: black;
                            }

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
                                    /*overflow: scroll;*/
                                }
                            }

                        </style>
                        <div class="card height-14" id="bill_area" style="height: 400px;overflow: scroll;">
                            <div class="card-head">
                                <table class="table table-bordered">
                                    <tr class="no-print">
                                        <td colspan="7" align="center">
                                            <h4><?php echo Yii::app()->params['company_name']; ?>
                                            </h4>
                                        </td>
                                    </tr>
                                    <tr class="no-screen">
                                        <td colspan="7" class="border_on_print" style="text-align: center;font-weight:bold "></td>
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
                                    <tr>
                                        <td colspan="7" class="border_on_print" style="text-align: center;font-weight:bold ">Tax Invoice</td>
                                    </tr>
                                    <tr>
                                        <th class="border_on_print" colspan="5" style="text-align:left">Dt-<?php echo date('d-m-y h:i A'); ?></th>                   
                                        <th class="border_on_print" colspan="2" style="text-align:right " id="memo_no">Memo #<?php echo $memo_no; ?> </th>
                                        <th class="border_on_print" colspan="2" style="text-align:right;display: none;" id="invoice_no"></th>
                                    </tr>
                                    <tr class="doNotShowOnPrint">
                                        <th class="border_on_print">#</th>
                                        <th class="border_on_print">Item</th>
                                        <th class="border_on_print">Qty</th>                                      
                                        <!--<th class="border_on_print">Rate</th>-->                                      
                                        <th class="border_on_print">ST/CT%</th>                                      
                                        <th class="border_on_print">Amount</th>                                      
                                        <th class="no-print"><a href="#" title="Delete Items">X</a></th>                                      
                                    </tr>
                                    <!--============= for printing purpose open========-->
                                    <tr class="no-screen">
                                        <td colspan="7" class="border_on_print" style="text-align: center;font-weight:bold; "></td>
                                    </tr>
                                    <tr class="no-screen">
                                        <!--<th class="border_on_print">#</th>-->
                                        <th class="border_on_print" colspan="6">Item</th>
                                        <!--<th class="border_on_print">HSN/SAC</th>-->
                                        <th class="border_on_print" style="text-align:right;">Qty</th>
                                    </tr>
                                    <!--============= for printing purpose heads close ========-->                                 
                                    <?php
                                    $count = 1;
                                    $total_amt_ots = 0.00;
                                    $total_qty_ots = 0;
                                    $total_tax_ots = 0;
                                    $items = PosCart::getAll(); //print_r($items);     
                                    if (!empty($items)) {
                                        ?>
                                        <tbody>
                                            <?php
                                            foreach ($items as $item) {
                                                $item_info = $item->getItem();
                                                $sale_price = $item_info->sale_price;
                                                $gst_percent = $item_info->positem->gst_percent;
                                                $cess_tax = $item_info->positem->cess_tax;
                                                $price_without_tax = Utils::excludeTaxFromPrice($gst_percent, $sale_price);
                                                //$cess_without_tax = Utils::excludeTaxFromPrice($cess_tax, $sale_price);
                                                ?>

                                                <!-- for printing purpose start-->
                                                <tr class="no-screen">                                             
                                                    <td colspan="6"><b><?php echo $count; ?>-</b> 
                                                        <?php echo $item_info->positem->itemname; ?> 
                                                        <?php echo isset($item_info->positem->gst_code_type) ? $item_info->positem->gst_code_type . $item_info->positem->gst_code : ''; ?>
                                                    </td>
                                                    <td style="text-align:right"><?php echo $item->qty; ?><?php echo $item_info->positem->item_scale; ?></td>                                                
                                                </tr>
                                                <tr class="no-screen">
                                                    <td colspan="7">
                                                        CT-ST%:<?= $gst_percent; ?>&nbsp;
                                                        <?php
                                                        if ($cess_tax > 0) {
                                                            echo "CESS%:" . $cess_tax;
                                                        }
                                                        ?>
                                                        <span style="float:right;display: inline"> Rs.<?= $sale_price * $item->qty; ?></span>
                                                    </td>    
                                                </tr>

                                                <!-- for printing purpose end -->

                                                <tr class="doNotShowOnPrint">
                                                    <td style="width:5%"><?php echo $count; ?></td>                                        
                                                    <td style="width:48%"><?php echo $item_info->positem->itemname; ?> 
                                                        <?php echo isset($item_info->positem->gst_code_type) ? '/' . $item_info->positem->gst_code_type . '-' . $item_info->positem->gst_code : ''; ?> </td>                                        
                                                    <td style="width:18%">
                                                        <label class="no-screen"><?php echo $item->qty; ?></label>
                                                        <input class="no-print" type="number" name="qty" value="<?php echo $item->qty; ?>" id="qty_<?php echo $item->itemid; ?>"
                                                               style="width:100%"  onkeyup="Javascript: if (event.keyCode == 13 || event.which == 13)
                                                                                   update(<?php echo $item->itemid ?>, this.value);">   
                                                               <?php $total_qty_ots = $total_qty_ots + $item->qty; ?>
                                                    </td>    

                                                <!--                                                    <td style="width:15%" align="right"><?php
                                                    // echo $price_without_tax;
                                                    ?>
                                                                                                    </td>-->

                                                    <td style="width:15%" align="right"><?php
                                                        echo isset($gst_percent) ? $gst_percent . '%' : '';
                                                        ?>
                                                    </td>  

                                                    <td style="width:19%" align="right"><?php
                                                        $price = $sale_price * $item->qty;
                                                        echo isset($price) ? $price : '';
                                                        $total_amt_ots = $total_amt_ots + $price;
                                                        ?>
                                                    </td>       
                                                    <td style="width:5%"  class="no-print">
                                                        <a href="<?php echo $this->createUrl('pos/removeToCart', array('id' => $item->itemid)) ?>">&times;</a>   
                                                    </td>       
                                                </tr>

                                                <?php
                                                $count++;
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="7" class="border_on_print"></td>
                                            </tr>
                                            <tr class="no-screen">

                                                <th colspan="7" style="text-align:right" class="border_on_print">
                                                    Total - Qty : <?php echo $total_qty_ots; ?>
                                                    &emsp;
                                                    Amt :  <?php echo isset($total_amt_ots) ? $total_amt_ots : '0'; ?>
                                                </th>
                                            </tr>
                                            <tr>
                                                <td colspan="7" class="border_on_print"></td>
                                            </tr>
                                            <tr class="no-screen">
                                                <td colspan="7" style="text-align:right;" class="border_on_print">
                                                    <?php
                                                    if (!empty($total_amt_ots)) {
                                                        echo Utils::convert_number_to_words($total_amt_ots); // . ' Only';
                                                    }
                                                    ?>
                                                </td>                                            
                                            </tr>

                                            <tr class="no-screen">
                                                <td colspan="4" style="text-align:left" class="border_on_print">
                                                    Thank You
                                                </td>
                                                <td colspan="3" style="text-align:right" class="border_on_print">
                                                    <label style="text-align:right;font-size:10px "><?php echo "User-" . Yii::app()->session['pos_user'] . '/' . Yii::app()->session['counter'] ?></label>
                                                </td>
                                            </tr>

                                        </tfoot>
                                    <?php } ?>
                                </table>
                            </div>                    
                        </div><!--end .card -->


                        <div class="card height-1 no-print" style="text-align: right;font-weight:bold  " >
                            <div class="row" style="margin:2px  ">
                                Total &emsp;                                   
                                <label style="text-align: right">Qty : <?php echo $total_qty_ots; ?></label>
                                &emsp;
                                <span style="text-align: right">Amt :  <?php echo isset($total_amt_ots) ? $total_amt_ots : '0'; ?></span>
                                <br>
                                <span>
                                    <?php
                                    if (!empty($total_amt_ots)) {
                                        echo Utils::convert_number_to_words($total_amt_ots); // . ' Only';
                                    }
                                    ?>
                                </span>
                            </div>
                        </div>

                        <div class="card height-3 no-print bg-success">
                            <!--<legend>Cash</legend>-->
                            <?php
                            $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                                'id' => 'ots_sale_form',
                                'enableAjaxValidation' => false,
                                    //     'action' => $this->createUrl('pos/ots_items')
                                    //'options'=>array('action'=>'pos/ots_items')
                            ));
                            ?>
                            <div class="row" style="padding:15px ">
                                <!--                                <div class="col-lg-3">
                                                                    <input type="text" name="discount" class="form-control" placeholder="Discount"/>                                
                                                                </div>
                                                                <div class="col-lg-5">
                                                                    <input type="text" name="customer_name" id="customer_name" placeholder="Customer Name" class="form-control"/>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <input type="text" name="customer_mobile" placeholder="Mobile No" class="form-control"/>                            
                                                                </div>-->
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5" style="border-right:1px solid #333;font-size:15px;">
                                <button type="button" class="pull-left btn btn-info" id="print_bill_ots_btn" data-loadng-text="Saving..." onclick="return submitForm();">
                                    <i class="fa fa-print fa-fw"></i>Save & Print</button>
                            </div>  
                            <div id="new_btn" class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="border-right:1px solid #333;font-size:15px;">
                                <button class="pull-left btn btn-primary"><i class="fa fa-edit fa-fw"></i> New
                            </div>
                            <div id="reset_btn" class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="border-right:1px solid #333;font-size:15px;">
                                <a href="<?php echo $this->createUrl('pos/cancelorder') ?>" class="pull-left btn btn-default"><i class="fa fa-remove fa-fw"></i>Clear</a>
                            </div>

                            <!--   <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="font-size:15px;">
                                     <button class="pull-left btn btn-success" type="submit" name="submit" value="paid" data-loading-text="Wait..." id="paid_btn"><i class="fa fa-money fa-fw"></i>PAID </button>
                                    </div>  -->
                        </div>
                        <?php $this->endWidget(); ?>
                    </div><!--end .col -->

                </div>
            </div>
        </div>
    </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div id="bill"></div>
        </div>
    </div>
</div>
<div id="creditBillModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Cash Customer Credit Management</h4>
            </div>
            <div id="credit_bill_modal_view"></div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $("#paid_btn").click(function() {
            $(this).button('loading');
        });
        //        $(".qty_msg").delay(5000).fadeOut("slow");

//        document.onkeypress = function(evt) {
//            evt = evt || window.event;
//            var charCode = evt.which || evt.keyCode;
//            var charStr = String.fromCharCode(charCode);
//            if (/[a-zA-Z]/i.test(charStr)) {
//                //               if ($("#customer_name").is(':keypress')) {                
//                //            }else{
//                $("#q").focus().val();
//                //      }             }
//            }
//        }


        $('#print_bill_ots_btn').click(function() {
<?php if (!empty($_SESSION['pos_cart'])) { ?>
                ///  submitForm();
<?php } ?>

        });

        ///checking focus of cursor
<?php if (!empty($item_qty_id)) { ?>
            var input = $('#<?php echo $item_qty_id; ?>');
            input.focus().val(input.val());
<?php } else { ?>
            $("#q").focus();
<?php } ?>
    });

    $(document).keyup(function(e) {
        if (e.keyCode == 16) {
<?php // if (!empty($_SESSION['pos_cart'])) {             ?>
            // submitForm();
<?php //}             ?>
        }
    });

    function update(data, value)
    {
        var value = parseFloat(value);
        if (value) {
            var id = data;
            window.location = "<?php echo Yii::app()->request->baseUrl; ?>/pos/updateCart/id/" + id + "/qty/" + value + "/memo_no/" +<?php echo $memo_no; ?>;
        }
    }
</script>
<script type="text/javascript">
    typeof $.typeahead({input: ".js-typeahead-input",
        minLength: 1,
        order: "asc",
        maxItem: false,
        highlight: false,
        hint: true,
        //    backdrop: {
        //                            "background-color": "#fff"
        //                        },
        backdropOnFocus: true,
        source: {
            ajax: function(query) {
                return {
                    type: "GET",
                    url: '<?php echo $this->createUrl("pos/getItemDetail"); ?>',
                    path: "data",
                    data: {
                        q: "{{query}}"
                    },
                    callback: {
                        done: function(data) {
                            return data;
                        }
                    }
                }
            }
        },
        callback: {
            onClick: function(node, a, item, event) {
                // You can do a simple window.location of the item.href
                //   alert(JSON.stringify(item));
                window.location.href = "<?php echo $this->createUrl('pos/addToCart') ?>?item=" + item.id + "&memo_no=" +<?php echo $memo_no; ?>;
            },
            onSendRequest: function(node, query) {
                console.log('request is sent')
            },
            onReceiveRequest: function(node, query) {
                console.log('request is received')
            }
        },
        debug: true});</script>

<script type="text/javascript">
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
            window.location.href = '<?php echo $this->createUrl('pos/ots_items'); ?>';
        };
    }


    function creditBill(id) {
        $.ajax({
            url: '<?php echo $this->createUrl('pos/paycreditbill'); ?>',
            data: {'id': id},
            type: 'post',
            success: function(response) {
                $("#credit_bill_modal_view").html(response);
                $("#creditBillModal").modal({backdrop: 'static', keyboard: false});
            }
        });
    }

    function ViewMenuBill(id) {
        $.ajax({
            url: '<?php echo $this->createUrl('pos/viewotsbill'); ?>',
            data: {'id': id},
            type: 'post',
            success: function(response) {
                $("#bill").html(response);
                $("#myModal").modal({backdrop: 'static', keyboard: false});
            }
        });
    }

    function submitForm() {
<?php if (!empty($_SESSION['pos_cart'])) { ?>
            $("#print_bill_ots_btn").button('loading');
            $.ajax({
                url: '<?php echo $this->createUrl('pos/ots_items'); ?>',
                data: {'submit': 'paid'},
                type: 'post',
                success: function(response) {
                    $("#print_bill_ots_btn").button('reset');
                    //    var res = $.parseJSON(response);
                    if (response != '') {
                        $("#memo_no").hide();
                        $("#invoice_no").show();
                        $("#invoice_no").html(response);
                        Popup($('#print_bill_ots').html());
                    }
                }
            });
<?php } ?>
    }

    function billPay(id) {
        var c = confirm('Are you sure want to PAID Bill ? ');
        if (c == true) {
            $.ajax({
                url: '<?php echo $this->createUrl('pos/paybill'); ?>',
                data: {'id': id},
                type: 'post',
                success: function(response) {
                    if (response == 'Success') {
                        $("#pay_bill_" + id).addClass('btn-success').removeClass('btn-warning');
                        $("#pay_bill_" + id).prop('title', 'Bill Paid');
                        $("#credit_bill_" + id).hide();

                    }
                }
            });
        }
    }
</script>