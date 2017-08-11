<div class="row">
    <div class="col-md-12">
        <div class="card1">
            <div class="card-head">
                <ul class="nav nav-tabs nav-justified">
                    <li><a href="<?php echo $this->createUrl("pos/ots_items"); ?>">OTS</a></li>
                    <li class="active"><a href="<?php echo $this->createUrl("pos/menu_items"); ?>">MENU </a></li>
                    <li><a href="<?php echo $this->createUrl("pos/aos_items"); ?>">AOS  <sup class="badge style-danger"></sup></a></li>
                </ul>
            </div><!--end .card-head -->
            <?php
            $cash_drawer = Cashdrawer::model()->findByAttributes(array('date' => date('Y-m-d'), 'user_to' => Yii::app()->user->id), array('order' => 'id desc', 'limit' => 1));
            $cash_counter = Cashcounter::model()->findByPk($cash_drawer->counter_id);
            ?>    
            <div class="tab-content">
                <div class="tab-pane active" id="first4">
                    <div class="col-md-8">
                        <ul class="header-nav">
                            <li class="col-lg-2"><div style="font-size:14px;font-weight:bold;">MENU ITEMS</div></li>
                            <li class="col-lg-2">
                                <select id="tid" name="tid" class="form-control">
                                    <option value=""> Select Table </option>
                                    <?php
                                    foreach (Ordertable::model()->findAll() as $table) {
                                        if ($_SESSION['table_id'] == $table->id) {
                                            ?>
                                            <option value="<?php echo $table->id; ?>" selected="selected"><?php echo $table->table_no; ?></option>  
                                        <?php } else { ?>
                                            <option value="<?php echo $table->id; ?>"><?php echo $table->table_no; ?></option>  
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </li>
                            <li class="col-lg-8 pull-right">
                                <form action="#<?php // echo $this->createUrl('pos/addToMenuKot')     ?>" class="navbar-search expanded" role="search">
                                    <div class="typeahead__container">
                                        <div class="typeahead__field">
                                            <span class="typeahead__query">
                                                <input style="width:400px;" class="form-control js-typeahead-input"
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
                        <legend></legend>
                        <div class="col-md-7" >
                            <div class="card-body no-padding height-6">  
                                <h5>Running Table Order</h5>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Table No.</th>
                                        <th>KOT No</th>
                                        <th>Amount</th>
                                        <th></th>
                                    </tr>
                                    <?php
                                    foreach (Ordertable::model()->findAllByAttributes(array('is_running' => 'yes')) as $t) {
                                        $kot_item_amt = 0.00;
                                        $menu_kot = '';
                                        foreach (Menukot::model()->findAllByAttributes(array('table_id' => $t->id, 'counter_id' => $cash_counter->id, 'is_added_to_bill' => 0)) as $mk) {
                                            $menu_kot .= $mk->kot_no . ',';
                                            foreach (Menukotitems::model()->findAllByAttributes(array('menu_kot_id' => $mk->id)) as $kot_items) {
                                                $kot_item_amt = $kot_item_amt + $kot_items->price;
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <td><?php echo $t->table_no; ?></td>
                                            <td><?php echo $menu_kot; ?></td>
                                            <td><?php echo $kot_item_amt; ?></td>
                                            <td><a class="pull-left btn btn-success" href="#" onclick="GenerateMenuBill(<?php echo $t->id; ?>);"><i class="fa fa-money fa-fw"></i>Finish </a></td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>  
                        </div>  
                        <div class="col-md-5">
                            <table class="table table-bordered">
                                <h5>Un Paid KOT Order's</h5>
                                <tr>
                                    <th>KOT No</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                <?php
                                $total1 = 0.00;
                                foreach (Menukot::model()->findAllByAttributes(array('counter_id' => $cash_counter->id, 'is_added_to_bill' => 0), array('order' => 'id desc', 'limit' => 10)) as $mk) {
                                    $amt = 0.00;
                                    foreach(Menukotitems::model()->findAllByAttributes(array('menu_kot_id'=>$mk->id)) as $item){
                                    $amt = $amt +$item->price;
                                    }
                                    $total1 = $total1 + $amt;
                                    ?>
                                    <tr>
                                        <td><?php echo $mk->kot_no; ?></td>
                                        <td><?php echo $mk->kot_date; ?></td>
                                        <td><?php echo $amt; ?></td>
                                        <td>Un Paid</td>
                                        <td><a class="btn btn-success" href="#" onclick="ViewKot(<?php echo $mk->id; ?>);"><i class="fa fa-eye fa-fw"></i>View </a></td>
                                    </tr>
                                <?php } ?>
                                    <tr>
                                        <td colspan="2" style="text-align: center;"><b>Total</b></td>
                                        <td><b><?php echo $total1; ?></b></td>
                                        <td colspan="2"></td>
                                    </tr>
                            </table>
                        </div>

                        
                                                 <div class="col-md-12" style="height: 500px;overflow: scroll;">
                            <table class="table table-bordered">
                                <h5>Today's Paid KOT Order's</h5>
                                <tr>
                                    <th>KOT No</th>
                                    <th>Table</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                <?php
                                $total = 0.00;
                                foreach (Menukot::model()->findAllByAttributes(array('counter_id' => $cash_counter->id, 'is_added_to_bill' => 1,'kot_date'=>date('Y-m-d')), array('order' => 'id desc')) as $mk) {
                                    $amt = 0.00;
                                    foreach(Menukotitems::model()->findAllByAttributes(array('menu_kot_id'=>$mk->id)) as $item){
                                    $amt = $amt + $item->price;
                                    }
                                    $total = $total + $amt;
                                    ?>
                                    <tr>
                                        <td><?php echo $mk->kot_no; ?></td>
                                        <td><?php echo Ordertable::model()->findByPk($mk->table_id)->table_no; ?></td>
                                        <td><?php echo $mk->kot_date; ?></td>
                                        <td><?php echo $amt; ?></td>
                                        <td>Paid</td>
                                        <td><a class="btn btn-success" href="#" onclick="ViewKot(<?php echo $mk->id; ?>);"><i class="fa fa-eye fa-fw"></i>View </a></td>
                                    </tr>
                                <?php } ?>
                                    <tr>
                                        <td colspan="3" style="text-align: center;"><b>Total</b></td>
                                        <td><b><?php echo $total; ?></b></td>
                                        <td colspan="2"></td>
                                    </tr>
                            </table>
                        </div>
                    </div> <!-- col 8-->

                    <div class="col-md-4" id="print_bill_ots">
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
                                        <th class="border_on_print" style="text-align:left;border-bottom:0px;"> <?php echo $cash_counter->counter_name; ?>&emsp;&emsp; </th>                   
                                        <th class="border_on_print" style="text-align:right;border-bottom:0px;"> Dt : <?php echo date('d-M-y h:i A'); ?>  </th>
                                    </tr>
                                    <tr>
                                        <th class="border_on_print" style="text-align:left;"> <?php echo Ordertable::model()->findByPk($_SESSION['table_id'])->table_no; ?>&emsp;&emsp;</th>                   
                                        <th class="border_on_print" style="text-align:right;">KOT NO : <?php echo $_SESSION['mkot_no']; ?> </th>
                                </table>
                                <table class="table table-bordered" width="100%">
                                    <tr>
                                        <th class="border_on_print">#</th>
                                        <th class="border_on_print">Item</th>
                                        <th class="border_on_print">Qty</th>                                      
                                        <th class="no-print"><a href="#" title="Delete Items">X</a></th>                                      
                                    </tr>
                                    <?php
                                    $items = Menukotitems::model()->findAllByAttributes(array('menu_kot_id' => $_SESSION['mkot_id']));
                                    if (!empty($items)) {
                                        ?>
                                        <tbody>
                                            <?php
                                            $count = 1;
                                            $total_amt_ots = 0.00;
                                            $total_qty_ots = 0;
                                            foreach ($items as $item) {
                                                ?>
                                                <tr>
                                                    <td style="width:10%"><?php echo $count; ?></td>                                        
                                                    <td style="width:50%"><?php echo Menukotitems::getItem($item->menu_item_id)->positem->itemname; ?></td>                                        
                                                    <td style="width:30%">
                                                        <label class="no-screen"><?php echo $item->qty; ?></label>
                                                        <input class="no-print" type="number" name="qty" value="<?php echo $item->qty; ?>" id="qty_<?php echo $item->id; ?>"
                                                               style="width:100%"  onkeyup="Javascript: if (event.keyCode == 13 || event.which == 13)
                                                                           update(<?php echo $item->id ?>, this.value);">   
                                                               <?php $total_qty_ots = $total_qty_ots + $item->qty; ?>
                                                    </td>      
                                                    <td style="width:10%"  class="no-print">
                                                        <a href="<?php echo $this->createUrl('pos/removeToMenuKot', array('id' => $item->id)) ?>">&times;</a>   
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
                                                    <label style="text-align: right">Qty : <?php echo $total_qty_ots; ?></label>
                                                </th>
                                            </tr>
                                            <tr class="no-screen">
                                                <th colspan="4" style="text-align:left" class="border_on_print">
                                                    <label style="text-align:right "><?php echo "User-" . Yii::app()->session['pos_user'] . ' /' . Yii::app()->session['counter'] ?></label>
                                                </th>
                                            </tr>
                                            <tr class="no-screen">
                                                <td colspan="6" style="text-align:right;" class="border_on_print">
                                                    <?php
                                                    if (!empty($total_amt_ots)) {
                                                        echo Utils::convert_number_to_words($total_amt_ots); // . ' Only';
                                                    }
                                                    ?>
                                                </td>                                            
                                            </tr>
                                        </tfoot>
                                    <?php } ?>
                                </table>
                            </div>                    
                        </div><!--end .card -->


                        <div class="card height-1 no-print" style="text-align: right;font-weight:bold  " >
                            <div class="row" style="margin-right: 50px;">
                                Total &emsp;                                   
                                <label style="text-align: right">Qty : <?php echo $total_qty_ots; ?></label>
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
                                'action' => $this->createUrl('pos/menu_items')
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

                            <div id="new_btn" class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="border-right:1px solid #333;font-size:15px;">
                                <a href="#" class="pull-left btn btn-primary" onclick="NewKot();"><i class="fa fa-edit fa-fw"></i>New</a>
                            </div>
                            <div id="reset_btn" class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="border-right:1px solid #333;font-size:15px;">
                                <a href="<?php echo $this->createUrl('pos/cancelMenuKot') ?>" class="pull-left btn btn-default"><i class="fa fa-remove fa-fw"></i>Clear</a>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="border-right:1px solid #333;font-size:15px;">
                                <button type="submit" data-loading-text="Loading Please Wait..." class="pull-left btn btn-info" id="print_bill_ots_btn" onclick="GenerateKot();"><i class="fa fa-print fa-fw"></i>Save & Print</button>
                            </div>   
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
<script type="text/javascript">
    $(document).ready(function () {

//        document.onkeypress = function (evt) {
//            evt = evt || window.event;
//            var charCode = evt.which || evt.keyCode;
//            var charStr = String.fromCharCode(charCode);
//            if (/[a-zA-Z]/i.test(charStr)) {
//                //               if ($("#customer_name").is(':keypress')) {                
//                //            }else{
//                $("#q").focus().val();
//                //      }
//            }
//        };

        $('#close').click(function () {
            window.location.href = '<?php echo $this->createUrl('pos/menu_items'); ?>'
        });

        ///checking focus of cursor
<?php if (!empty($val)) { ?>
            var input = $('#<?php echo $val; ?>');
            input.focus().val(input.val());
<?php } else { ?>
            $("#q").focus();
<?php } ?>
    });
    function update(data, value)
    {
        var value = parseInt(value);
        if (value >= 1) {
            var id = data;
            window.location = "<?php echo Yii::app()->request->baseUrl; ?>/pos/updateMenuKot/id/" + id + "/qty/" + value;
        }
    }
</script>
<script type="text/javascript">
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
            ajax: function (query) {
                return {
                    type: "GET",
                    url: '<?php echo $this->createUrl("pos/getItemDetailMenu"); ?>',
                    path: "data",
                    data: {
                        q: "{{query}}"
                    },
                    callback: {
                        done: function (data) {
                            return data;
                        }
                    }
                }
            }

        },
        callback: {
            onClick: function (node, a, item, event) {
                // You can do a simple window.location of the item.href
                //   alert(JSON.stringify(item));
                var table = $("#tid").val();
                if (table == '') {
                    alert("Please Select Table For Order...!!!");
                    window.location.href = "<?php echo $this->createUrl('pos/menu_items') ?>";
                } else {
                    window.location.href = "<?php echo $this->createUrl('pos/addToMenuKot') ?>?item=" + item.id + "&table=" + table;
                }
            },
            onSendRequest: function (node, query) {
                console.log('request is sent')
            },
            onReceiveRequest: function (node, query) {
                console.log('request is received')
            }
        },
        debug: true
    });</script>

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

    }

    function GenerateKot() {
        var $btn = $("#print_bill_ots_btn").button('loading');
        $.ajax({
            url: '<?php echo $this->createUrl('pos/generateMenuKot'); ?>',
            data: '',
            success: function (response) {
                Popup($('#print_bill_ots').html());
                window.location.href = "<?php echo $this->createUrl('pos/menu_items') ?>";
                $btn.button('reset');
            }
        });
    }

    function NewKot() {
        $.ajax({
            url: '<?php echo $this->createUrl('pos/generateMenuKot'); ?>',
            data: '',
            success: function (response) {
                window.location.href = "<?php echo $this->createUrl('pos/menu_items') ?>";
            }
        });
    }

    function ViewKot(kid) {
        $.ajax({
            url: '<?php echo $this->createUrl('pos/viewkot'); ?>',
            data: {'kid': kid},
            success: function (response) {
                $("#bill").html(response);
                $("#myModal").modal({backdrop: 'static', keyboard: false});
            }
        });
    }

    function GenerateMenuBill(tid) {
        $.ajax({
            url: '<?php echo $this->createUrl('pos/generatemenubill'); ?>',
            data: {'tid': tid},
            success: function (response) {
                $("#bill").html(response);
                $("#myModal").modal({backdrop: 'static', keyboard: false});
            }
        });
    }
</script>

