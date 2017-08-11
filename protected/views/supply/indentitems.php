<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Inventory Management',
    'View Indent',
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">      
            <div class="box">
                <div class="box-header bg-yellow">
                    <h3 class="panel-title pull-left">Indent No : <?php echo $model->id ?></h3>
                    <a href="#" class="btn btn-default pull-right" id="print_bill"><i class="fa fa-print"></i> Print</a>     
                    <a href="#" onclick="getOrderDone('<?php echo $model->sync_id ?>')" class="btn btn-primary pull-right">Submit for Review</a>
                </div>
                <div class="panel-body">
                    <div class='row'> 
                        <div class="panel-body">

                            <table class="table table-bordered table-condensed bg-blue">
                                <tr>
                                    <th>Indent By </th>
                                    <td><?php echo $model->createdby->name . '(' . ucfirst($model->createdby->role) . ')'; ?></td>
                                    <th>Mobile No </th>
                                    <td><?php echo $model->createdby->mobile; ?></td>
                                    <th>Email</th>
                                    <td><?php echo $model->createdby->email; ?></td>
                                </tr>
                            </table>
                            <div class="table-responsive">

                                <?php
                                if (!empty($model)) {
                                    $item_list = Indentitems::model()->findAllBySql("select * from internal_indent_items where sync_id='$model->sync_id' order by id desc");
                                    //$list = Itemstock::model()->findAllByAttributes(array("p_category_id" => $model->p_category_id, "p_sub_category_id" => $model->p_sub_category_id));
                                    if (!empty($item_list)) {
                                        ?>
                                        <table class='table table-bordered table-responsive'>
                                            <thead>
                                                <tr>
                                                    <th>Item with Scale</th>
                                                    <th>Brand</th>       
                                                    <th>Item Purpose</th>      
                                                    <th>R.Qty.</th>            
                                                    <th>Require Date</th> 
                                                    <th>Action</th>
                                                    <th>Qty Dispatch</th>            

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $c = 1;
                                                foreach ($item_list as $v) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $v->item_name; ?> (<?php echo $v->qty_scale; ?>)</td>
                                                        <td><?php echo $v->item_brand; ?></td>
                                                        <td><?php echo $v->item_purpose; ?></td>
                                                        <td><?php echo $v->qty_required; ?></td>
                                                        <td> <?php echo $v->req_date; ?></td>
                                                        <td> 
                                                            <a href='#' onclick="getStockOfItem('<?php echo $v->item_id; ?>', '<?php echo $v->id; ?>')" class="btn btn-info">Dispatch</a>
                                                        </td>
                                                        <td> <?php echo $v->qty_dispatch; ?></td>

                                                    </tr>    
                                                    <?php
                                                    $c++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div id="myItemModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" id="itemname"></h4>
                            <h4>
                                <span id="req_qty" class="badge badge-warning"></span> &nbsp;&nbsp; | &nbsp;&nbsp;
                                <span id="dispatch_qty" class="badge badge-success"></span>
                            </h4>
                        </div>
                        <div class="modal-body" id="show_item_details">
                        </div>
                    </div>
                </div>
            </div>



            <div style="display:none;" id="printorder">
                <legend><h3 class="panel-title">Indent No : <?php echo $model->id ?></h3></legend>
                Prepared By <?php echo $model->createdby->name; ?> &nbsp;&nbsp;&nbsp;&nbsp; Indent date : <?php echo $model->indent_date; ?>
                <?php
                if (!empty($model)) {
                    $ilist = Indentitems::model()->findAllBySql("select * from internal_indent_items where sync_id='$model->sync_id' order by id desc");
                    //$list = Itemstock::model()->findAllByAttributes(array("p_category_id" => $model->p_category_id, "p_sub_category_id" => $model->p_sub_category_id));
                    if (!empty($ilist)) {
                        ?>
                        <table width="100%">
                            <thead>
                                <tr>
                                    <th style="border:1px solid #ddd;padding:5px;text-align: left;">Item with Scale</th>
                                    <th style="border:1px solid #ddd;padding:5px;text-align: left;">Brand</th>            
                                    <th style="border:1px solid #ddd;padding:5px;text-align: left;">Item Purpose</th>            
                                    <th style="border:1px solid #ddd;padding:5px;text-align: left;">R.Qty.</th>            
                                    <th style="border:1px solid #ddd;padding:5px;text-align: left;">Require Date</th>            
                                    <th style="border:1px solid #ddd;padding:5px;text-align: left;">Dispatch Qty</th>            
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $c = 1;
                                foreach ($ilist as $v) {
                                    ?>
                                    <tr>
                                        <td width="25%" style="border:1px solid #ddd;padding:5px;text-align: left;"><?php echo $v->item_name; ?> (<?php echo $v->qty_scale; ?>)</td>
                                        <td width="15%" style="border:1px solid #ddd;padding:5px;text-align: left;"><?php echo $v->item_brand; ?></td>
                                        <td width="15%" style="border:1px solid #ddd;padding:5px;text-align: left;"><?php echo $v->item_purpose; ?></td>
                                        <td width="15%" style="border:1px solid #ddd;padding:5px;text-align: left;"><?php echo $v->qty_required; ?></td>
                                        <td width="15%" style="border:1px solid #ddd;padding:5px;text-align: left;"><?php echo $v->req_date; ?></td>
                                        <td width="15%" style="border:1px solid #ddd;padding:5px;text-align: left;"><?php echo $v->qty_dispatch; ?></td>

                                    </tr>    
                                    <?php
                                    $c++;
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/bs/js/jquery.js"></script>
<script type="text/javascript">
                                                    $(document).ready(function() {
                                                        $('#print_bill').click(function() {
                                                            Popup($('#printorder').html());
                                                        });
                                                        $('#myItemModal').on('hidden.bs.modal', function() {
                                                            window.location.reload();
                                                        });
                                                    });
                                                    function Popup(data) {
                                                        var mywindow = window.open('', 'toc_print', 'height=500,width=700');
                                                        mywindow.document.write('<html><head><title>Print</title>');
                                                        mywindow.document.write('</head><body >');
                                                        //alert(data);
                                                        mywindow.document.write(data);
                                                        mywindow.document.write('</body></html>');
                                                        mywindow.print();
                                                        mywindow.close();
                                                        //return true;
                                                    }
                                                    function getStockOfItem(item_id, id) {
                                                        var url = '<?php echo $this->createUrl("supply/getStockItem"); ?>';
                                                        $.getJSON(url, {'item_id': item_id, 'id': id}, function(data) {
                                                            $("#itemname").html("Item - " + data.indent_item.item_name);
                                                            $("#req_qty").html("Qty Required : <b>" + data.indent_item.qty_required + "</b>");
                                                            $("#dispatch_qty").html("Qty Dispatched : <b>" + data.indent_item.qty_dispatch + "</b>");
                                                            var content = "";
                                                            content += "<table class='table table-bordered'>";
                                                            if (data.item_stock == '') {
                                                                content += "<tr class='alert alert-danger'>";
                                                                content += "<th colspan='9'>No Stock Available</th> </tr>";
                                                                content += "</table>";
                                                            } else {
                                                                $.each(data.item_stock, function(k, v) {
                                                                    content += "<tr class='alert alert-success'>";
                                                                    content += "<th>ItemName </th>";
                                                                    content += "<th>Brand </th>";
                                                                    content += "<th>Store</th>";
                                                                    content += "<th>Available Qty</th>";
                                                                    content += "<th>Rate</th>";
                                                                    content += "<th>Taxes(%)</th>";
                                                                    //     if (v.is_mrd == 'Yes') {
                                                                    content += "<th>Make Date</th>";
                                                                    content += "<th>Discard Date</th>";
                                                                    //       }
                                                                    content += "<th colspan='2'>Dispatch Qty</th> </tr>";

                                                                    content += " <tr>";
                                                                    content += "<td>" + v.itemname + "</td>";
                                                                    content += "<td>" + v.brand + "</td>";
                                                                    content += "<td>Store1</td>";

                                                                    content += "<td>" + v.stock_qty + "</td>";
                                                                    content += "<td>" + v.rate + "</td>";
                                                                    content += "<td>" + v.tax + "</td>";
                                                                    //  if (v.is_mrd == 'Yes') {
                                                                    content += "<td>" + v.make_date + "</td>";
                                                                    content += "<td>" + v.discard_date + "</td>";
                                                                    //     }
                                                                    content += "<td><input type='number' class='form-control text-box' id='new_qty_" + v.id + "' placeholder='Enter Qty'>";
                                                                    content += "<input type='number' class='form-control text-box' id='sale_price_" + v.id + "' placeholder='Enter Sale Price'>";
                                                                    content += "<input type='number' class='form-control text-box' id='new_tax_" + v.id + "' placeholder='Enter Tax'></td>";
                                                                    content += "<td><button type='button' class='btn btn-info' id='btn_" + v.id + "' onclick=getCheckValue('" + v.stock_qty + "','" + v.id + "','" + id + "','" + item_id + "')>Save</button></td>";
                                                                    content += "</tr>";
                                                                });
                                                                // content += "<tr><td colspan='6' align='right'></tr>";
                                                                content += "</table>";
                                                            }
                                                            //alert(content);
                                                            $("#show_item_details").html(content);
                                                        });

                                                        $("#myItemModal").modal({backdrop: 'static', keyboard: false});
                                                    }

                                                    function getCheckValue(stock_qty, stock_id, indent_id, item_id) {
                                                        //alert(stock_id);                                                  
                                                        var new_qty = $('#new_qty_' + stock_id).val();
                                                        var sale_price = $('#sale_price_' + stock_id).val();
                                                        var new_tax = $('#new_tax_' + stock_id).val();
                                                        //     alert(new_qty);  
                                                        if (new_qty == "") {
                                                            alert('Please fill the Dispatch Qty');
                                                            return;
                                                        }
                                                        if (eval(new_qty) > eval(stock_qty)) {
                                                            alert('Dispatch Qty can\'t be greater than Stock Qty');
                                                            $('#new_qty_' + stock_id).focus().val('');
                                                        } else {
                                                            $("#show_item_details").html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/dist/img/loading_icon.gif">');
                                                            var url = '<?php echo $this->createUrl("supply/saveAllotedStock"); ?>';
                                                            var token = '<?php echo $csrfToken; ?>';
                                                            $.post(url, {'YII_CSRF_TOKEN': token,
                                                                'stock_id': stock_id,
                                                                'dispatch_qty': new_qty,
                                                                'indent_id': indent_id,
                                                                'sale_price': sale_price,
                                                                'new_tax': new_tax
                                                            }, function(data) {
                                                                var data=jQuery.parseJSON(data);
                                                                if (data.msg == 'Success') {
                                                                    $('#new_qty_' + stock_id).val('');
                                                                    getStockOfItem(item_id, indent_id);
                                                                } else if (data.msg == 'less_stock') {
                                                                    alert('Dispatch Qty can\'t be greater than Required Qty');
                                                                    getStockOfItem(item_id, indent_id);
                                                                }
                                                            });
                                                        }
                                                    }//============

                                                    function getOrderDone(indent_id) {
                                                        var c = confirm('Are you sure want to submit for Review ?');
                                                        if (c == true) {
                                                            var url = '<?php echo $this->createUrl("supply/updateOrderStatus"); ?>';
                                                            $.getJSON(url, {'indent_id': indent_id, 'status': '1'}, function(data) {
                                                                if (data.msg == 'Success') {
                                                                    window.location.href = '<?php echo $this->createUrl("supply/viewIndents"); ?>';
                                                                }
                                                            });
                                                        }
                                                    }
</script>