<?php
$this->breadcrumbs = array(
    'Home' => array('pos/ots_items'),
    'Special Customer Sale' => array('internalsale/create'),
    'Special Customer Sale Detail',
);

$customer = Customer::model()->findByPk($model->customer_id);
?>
<div class='row'>
    <div class="col-lg-12">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                    <h3 class="panel-title">Details of Internal Customer Sale &emsp;<b><?php if (empty($model->invoice_number)) { ?><?php echo '( MEMO No. &emsp;:- &emsp;' . $model->memo_number . ')'; ?><?php } else { ?><?php echo '( INVOICE No. &emsp;:- &emsp;' . $model->invoice_number . ')'; ?><?php } ?></b></h3>
                </div>
                <div class="panel-body">
                    <div class='row'>
                        <table class="table" style="background-color: #ff6600;color: #FFF;">
                            <tr>
                                <?php if (empty($model->invoice_number)) { ?>
                                    <td style="border-top: none;"><h4><b>&emsp;Memo Number :- &nbsp;&nbsp;<?php echo $model->memo_number; ?></b></h4></td>
                                <?php } else if (!empty($model->invoice_number)) { ?>
                                    <td style="border-top: none;"><h4><b>&emsp;Invoice Number :- &nbsp;&nbsp;<?php echo $model->invoice_number; ?></b></h4></td>
                                <?php } ?>
                                <td style="border-top: none;"><h4><b>Party Name :-&nbsp;&nbsp;<?php echo $customer->full_name; ?></b></h4></td>
                                <td style="border-top: none;"><h4><b>Contact No :-&nbsp;&nbsp;<?php echo $customer->mobile_no; ?></b></h4></td>
                                <td style="border-top: none;"><h4><b>Store Name :-&nbsp;&nbsp;<?php echo $customer->party_store_name; ?></b></h4></td>
                            </tr>
                            <tr>
                                <td style="border-top: none;"><h4><b>&emsp;Counter :-&nbsp;&nbsp;<?php echo $model->counter->counter_name; ?></b></h4></td>
                                <td style="border-top: none;"><h4><b>Order Date :-&nbsp;&nbsp;<?php echo $model->order_date; ?></b></h4></td>
                                <td style="border-top: none;"><h4><b>Order Time :-&nbsp;&nbsp;<?php echo $model->order_time; ?></b></h4></td>
                                <td style="border-top: none;"><h4><b>Remark :-&nbsp;&nbsp;<?php echo $model->comment; ?></b></h4></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .alert {
            padding: 10px;
            background-color: #f44336; /* Red */
            color: white;
            margin-bottom: 15px;
            font-size: 22px;
            text-align: center;
        }

        /* The close button */
        .closebtn {
            margin-top: 5px;
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        /* When moving the mouse over the close button */
        .closebtn:hover {
            color: black;
        }
    </style>
    <div class="col-lg-12">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-equal">
                    <h3 class="panel-title">Internal Customer Sale Items</h3>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <?php if (Yii::app()->user->hasFlash('special_c')) { ?>
                            <div class="alert">
                                <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                <?php echo Yii::app()->user->getFlash('special_c'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <?php if (empty($model->invoice_number)) { ?>
                        <form id="item" action="<?php echo $this->createUrl('internalsale/additems', array('sid' => $model->id)) ?>" class="navbar-search expanded" role="search" method="post">
                            <div class="typeahead__container">
                                <div class="typeahead__field">
                                    <span class="typeahead__query">
                                        <input style="width:100%;" class="form-control js-typeahead-input"
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
                        </form><br/>
                    <?php } ?> 

                    <?php
                    if (!empty($val)) {
                        $v = Purchaseitem::model()->findByPk($val);
                        //       print_r($item);
                        ?>
                        <table class='table table-bordered table-responsive'>
                            <thead>
                                <tr>
                                    <th>Item with Scale</th>
                                    <th>Brand</th> 
                                    <th>Qty.</th> 
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo $v->itemname; ?> (<?php echo $v->item_scale; ?>)</td>
                                    <td><?php echo $v->brand; ?></td>                                                      
                                    <td></td>                                                        
                                    <td> 
                                        <a href='#' onclick="getStockOfItem('<?php echo $v->id; ?>', 0)" class="btn btn-primary">Add Qty</a>
                                    </td>                                                       
                                </tr>    

                            </tbody>
                        </table>

                    <?php } ?>

                    <?php
                    $items = Offshelfsaleitems::model()->findAllByAttributes(array('shelf_sale_id' => $model->id)); //print_r($items);     
                    if (!empty($items)) {
                        ?>
                        <div class="col-lg-12" id="print_bill_ots">
                            <style>
                                @media print {
                                    .no-print{
                                        display:none; 
                                    }
                                    tr td,th {
                                        font-size:12px;  
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
                                        font-family:monospace; 
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
                                            <th class="border_on_print">#</th>
                                            <th class="border_on_print">Item</th>
                                            <th class="border_on_print">Unit Price</th>
                                            <th class="border_on_print">Qty</th>                                     
                                            <th class="border_on_print">Disc (%)</th>                                     
                                            <th class="border_on_print">Disc (Rs.)</th>                                     
                                            <th class="border_on_print">TAX (%)</th>                                     
                                            <th class="border_on_print">TAX (Rs.)</th>                                     
                                            <th class="border_on_print">Amt without TAX (Rs.)</th>                                     
                                            <th class="border_on_print">Amount (Rs.)</th>
                                            <?php //if (empty($model->invoice_number)) { ?>
    <!--                                                <th class="no-print">
                                                    <a href="#" title="Delete Items">X</a>
                                                </th>-->
                                            <?php //} ?> 
                                        </tr>
                                        <tbody>
                                            <?php
                                            $total = 0.00;
                                            $count = 1;
                                            $total_qty = 0;
                                            $total_disc = 0;
                                            $total_tax = 0;
                                            $total_amt_without_tax = 0;
                                            foreach ($items as $item) {
                                                $item_name = Purchaseitem::model()->findByPk($item->item_id)->itemname;
                                                $total = $total + $item->amount;
                                                $total_qty = $total_qty + $item->qty;
                                                $amt = $item->unit_price * $item->qty;
                                                $total_disc = $total_disc + $item->disc_amt;
                                                $total_tax = $total_tax + $item->tax_amt;
                                                $total_amt_without_tax = $total_amt_without_tax + $item->amt_without_tax;
                                                ?>
                                                <tr>
                                                    <td style="width:5%;"><?php echo $count; ?></td>                                        
                                                    <td style="width:20%;"><?php echo $item_name; ?></td>                                        
                                                    <td style="width:8%;"><?php echo $item->unit_price; ?></td>                                   
                                                    <td style="width:8%;">

                                                        <?php echo $item->qty; ?>

                                                    </td>                                    
                                                    <td style="width:8%;">
                                                        <?php echo $item->discount_percent; ?>
                                                    </td>                                       
                                                    <td style="width:8%;">
                                                        <?php echo $item->disc_amt; ?>
                                                    </td>                                       
                                                    <td style="width:8%;"><?php echo $item->unit_tax; ?></td>                                            
                                                    <td style="width:8%;"><?php echo $item->tax_amt; ?></td>                                            
                                                    <td style="width:15%;"><?php echo $item->amt_without_tax; ?></td>                                            
                                                    <td style="width:15%;"><?php echo $item->amount; ?></td>      
                                                    <?php // if (empty($model->invoice_number)) { ?>
                                                        <!--<td style="width:5%"  class="no-print">-->
                                                            <!--<a href="<?php //echo $this->createUrl('internalsale/removeitem', array('id' => $item->id))  ?>" onclick="return confirm('Are you sure you want to delete item ?')" title="Delete Item"><span class="label label-danger"><i class="glyphicon glyphicon-remove"></i></span></a>--> 
                                                    <!--</td>--> 
                                                    <?php // } ?> 
                                                </tr>
                                                <?php
                                                $count++;
                                            }
                                            ?>
                                            <tr>
                                                <td colspan="3" style="text-align: center;"><b>Total</b></td>                                            
                                                <td><b><?php echo $total_qty; ?></b></td>       
                                                <td></td>               
                                                <td><b><?php echo $total_disc; ?></b></td>        
                                                <td></td>               
                                                <td><b><?php echo $total_tax; ?></b></td>  
                                                <td><b><?php echo $total_amt_without_tax; ?></b></td>  
                                                <td><b><?php echo $total; ?></b></td>  
                                                <?php //if (empty($model->invoice_number)) { ?>
                                                    <!--<td class="no-print"></td>-->     
                                                <?php //} ?> 
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>                    
                            </div>
                        </div>
                        <div class="col-lg-12">

                            <?php if (empty($model->invoice_number)) { ?>
                                <a  href="<?php echo $this->createUrl('internalsale/memo', array('id' => $model->id)); ?>" target="_blank" class="pull-left" id="memo" title="Print Proforma Invoice" ><i class="fa fa-print"></i></a>
                                <div class="col-lg-8">Before Leaving this page make sure you have added all items and click to  "Create Bill" or print as Proforma</div>
                            <?php } ?> 

                            <a href="<?php echo $this->createUrl('internalsale/invoice', array('id' => $model->id)); ?>" target="_blank" class="btn btn-primary btn-lg pull-right" onclick="window.location.reload();" id="invoice" style="margin-left: 5px;"> <?php if (!empty($model->invoice_number)) { ?> Print Bill <?php } else { ?>Create Bill <?php } ?></a>


                        </div>
                    <?php } ?> 
                </div>   
            </div>   
        </div> 
    </div>
</div>

<!-- Modal -->
<div id="myItemModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="itemname"></h4>
                <h4>                            
                    <span id="dispatch_qty" class="label label-success"></span>
                </h4>
            </div>
            <div class="modal-body" id="show_item_details">
            </div>
        </div>
    </div>
</div>

<!-- View Items Modal -->
<div id="myDispatchModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="itemname"></h4>
                <h4>
                    <span id="req_qty" class="badge badge-warning"></span> &nbsp;&nbsp; | &nbsp;&nbsp;
                    <span id="dispatch_qty" class="badge badge-success"></span>
                </h4>
            </div>
            <div class="modal-body" id="show_dispathc_items">
            </div>
        </div>
    </div>
</div>
<?php
$csrfTokenName = Yii::app()->request->csrfTokenName;
$csrfToken = Yii::app()->request->csrfToken;
?>
<script type="text/javascript">
            $(document).ready(function() {
    $(".alert").delay(5000).fadeOut("slow");
            document.onkeypress = function(evt) {
            evt = evt || window.event;
                    var charCode = evt.which || evt.keyCode;
                    var charStr = String.fromCharCode(charCode);
                    if (/[a-zA-Z]/i.test(charStr)) {
            //alert("Letter typed");
            $("#q").focus().val();
            }
            }
    ///checking focus of cursor
<?php if (!empty($val)) { ?>
        var input = $('#<?php echo 'qty_' . $val; ?>');
                input.focus().val(input.val());
<?php } else { ?>
        $("#q").focus();
<?php } ?>
    });
            function updateqty(data, val)
            {
            var value = parseFloat(val);
//         alert(value);
                    if (value) {
            var id = data;
                    window.location = "<?php echo Yii::app()->request->baseUrl; ?>/internalsale/updateqty/id/" + id + "/qty/" + value;
            }
            }

    function updatedisc(data, val)
    {
    var value = parseFloat(val);
            if (value >= 1) {
    var id = data;
            window.location = "<?php echo Yii::app()->request->baseUrl; ?>/internalsale/updatedisc/id/" + id + "/disc/" + value;
    }
    }


    typeof $.typeahead({
    input: ".js-typeahead-input",
            minLength: 1,
            order: "asc",
            maxItem: false,
            highlight: false,
            hint: true,
//                        backdrop: {
//                            "background-color": "#fff"
//                        },
            backdropOnFocus: true,
            source: {
            ajax: function(query) {
            return {
            type: "GET",
                    url: '<?php echo $this->createUrl("internalsale/getItemDetail"); ?>',
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
//                var item = $("#q").val();
//                alert(item);
//                $("#q").focus().val();
            window.location.href = "<?php echo $this->createUrl('internalsale/additems', array('sid' => $model->id)); ?>&item=" + item.id;
            },
                    onSendRequest: function(node, query) {
                    console.log('request is sent')
                    },
                    onReceiveRequest: function(node, query) {
                    console.log('request is received')
                    }
            },
            debug: true
    });
            function getStockOfItem(item_id, id) {
            var url = '<?php echo $this->createUrl("supply/getStockItem"); ?>';
                    $.getJSON(url, {'item_id': item_id, 'id': id}, function(data) {
                    var content = "<table class='table table-bordered'>";
                            //alert(data.item_stock);
                            if (data.item_stock == '') {
                    content += "<tr class='alert alert-danger'>";
                            content += "<th colspan='9'>No Stock Available</th> </tr>";
                            content += "</table>";
                    } else {
                    $.each(data.item_stock, function(k, v) {
                    content += "<tr class='alerts alert-success'>";
                            content += "<th>Invoice #</th>";
                            content += "<th>Vendor</th>";
                            content += "<th>ItemName </th>";
                            content += "<th>Brand </th>";
                            content += "<th>Store</th>";
                            content += "<th>Available Qty</th>";
                            content += "<th>Rate</th>";
                            content += "<th>Taxes(%)</th>";
                            content += "<th>Price</th>";
                            //     if (v.is_mrd == 'Yes') {
                            content += "<th>Make Date</th>";
                            content += "<th>Discard Date</th>";
                            //       }
                            content += "<th colspan='2'>Dispatch Qty</th> </tr>";
                            content += " <tr>";
                            content += "<td>" + v.invoice_no + "</td>";
                            content += "<td>" + v.vendor + "</td>";
                            content += "<td>" + v.itemname + "</td>";
                            content += "<td>" + v.brand + "</td>";
                            content += "<td>Store1</td>";
                            content += "<td>" + v.stock_qty + "</td>";
                            content += "<td>" + v.rate + "</td>";
                            content += "<td>" + v.tax + "</td>";
                            content += "<td>" + v.price + "</td>";
                            //  if (v.is_mrd == 'Yes') {
                            content += "<td>" + v.make_date + "</td>";
                            content += "<td>" + v.discard_date + "</td>";
                            //     }
                            content += "<td><input type='number' class='form-control text-box' id='new_qty_" + v.id + "' placeholder='Enter Qty'>";
                            content += "<input type='number' class='form-control text-box' id='sale_price_" + v.id + "' placeholder='Enter Sale Price'>";
                            //  content += "<input type='number' class='form-control text-box' id='new_tax_" + v.id + "' placeholder='Enter Tax'></td>";
                            content += "<td><button type='button' class='btn btn-info' id='btn_" + v.id + "' onclick=getCheckValue('" + v.stock_qty + "','" + v.id + "','" + id + "','" + item_id + "')>Save</button></td>";
                            content += "</tr>";
                    });
                            // content += "<tr><td colspan='6' align='right'></tr>";
                            content += "</table>";
                    }
                    //   alert(content);
                    $("#show_item_details").html(content);
                    });
                    $("#myItemModal").modal({backdrop: 'static', keyboard: false});
            }

    function getCheckValue(stock_qty, stock_id, indent_id, item_id) {
    //alert(stock_id);                                                  
    var new_qty = $('#new_qty_' + stock_id).val();
            var sale_price = $('#sale_price_' + stock_id).val();
            //    var new_tax = $('#new_tax_' + stock_id).val();
            //     alert(new_qty);  
            if (new_qty == "") {
    alert('Please fill the Sale Qty');
            return;
    } else if (sale_price == "") {
    alert('Please fill the Sale Price');
            return;
    }
    if (eval(new_qty) > eval(stock_qty)) {
    alert('Sale Qty can\'t be greater than Stock Qty');
            $('#new_qty_' + stock_id).focus().val('');
    } else {
    var c = confirm('After dispatching the Qty you will not be able to Revert Back ?');
            if (c) {
    $("#show_item_details").html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/dist/img/loading_icon.gif">');
            var url = '<?php echo $this->createUrl("internalsale/saveItems"); ?>';
            var token = '<?php echo $csrfToken; ?>';
            $.post(url, {'YII_CSRF_TOKEN': token,
                    'stock_id': stock_id,
                    'dispatch_qty': new_qty,
                    'indent_id': indent_id,
                    'sale_price': sale_price,
<?php if (!empty($model->id)) { ?>
                'pid':<?php echo $model->id; ?>,
<?php } ?>
<?php if (!empty($val)) { ?>
                'cid':<?php echo $val; ?>
<?php } ?>

            }, function(data) {
            var data = jQuery.parseJSON(data);
                    if (data.msg == 'Success') {
            $('#new_qty_' + stock_id).val('');
                    getStockOfItem(item_id, indent_id);
                    setTimeout(function(){
                    location.reload();
                    }, 1000);
            } else if (data.msg == 'less_stock') {
            alert('Dispatch Qty can\'t be greater than Required Qty');
                    getStockOfItem(item_id, indent_id);
            }
            });
    } //confirm yes or no 
    }
    }//============

</script>