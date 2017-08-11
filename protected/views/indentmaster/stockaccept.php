<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Indents',
    'Process Dispatch Order',
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">      
            <div class="box">
                <div class="box-header bg-red">
                    <h3 class="panel-title pull-left">Processed Indent No : <?php echo $model->id ?> (<?php echo $model->sync_id ?>)</h3>
                    <a href="#" class="btn btn-default pull-right" id="print_bill"><i class="fa fa-print"></i> Print</a>     
                </div>
                <div class="panel-body">
                    <div class='row'> 
                        <div class="panel-body">
                            <legend>Indent No : <?php echo $model->id ?> (<?php echo $model->sync_id ?>) Processed by CDS</legend>
                            <legend>Item With Invoice</legend>                               
                            <div class="table-responsive">
                                <?php
                                if (!empty($model)) {
                                    $item_list = Indentitems::model()->findAllBySql("select * from internal_indent_items where sync_id='$model->sync_id' and item_purpose='Resale' and dispatch_date!='' order by id desc");
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
                                                    <th>Qty Dispatch</th>            
                                                    <th>Dispatch Date</th>            
                                                    <th>Qty. in Stock</th>  
                                                    <th>Invoice No.</th>    
                                                    <th>Action</th>                                                   
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
                                                        <td> <?php echo $v->qty_dispatch; ?></td>
                                                        <td> <?php echo $v->dispatch_date; ?></td>
                                                        <td> <?php echo $v->qty_for_sale; ?></td>
                                                        <th>Invoice No.</th>    
                                                        <td> 
                                                            <?php if ($v->item_accepted_by_pos == 0) {
                                                                ?>
                                                                <a href='#' onclick="acceptStockItem(<?php echo $v->id; ?>)" class="btn btn-green">Update Stock Status</a>
                                                            <?php } else { ?>
                                                                <label class="badge badge-success">Accepted</label>
                                                            <?php } ?>  
                                                        </td>
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
                            <legend>Item With Chalan</legend> 
                             <div class="table-responsive">
                                <?php
                                if (!empty($model)) {
                                    $item_list = Indentitems::model()->findAllBySql("select * from internal_indent_items where sync_id='$model->sync_id' and item_purpose='Supply' and dispatch_date!='' order by id desc");
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
                                                    <th>Qty Dispatch</th>            
                                                    <th>Dispatch Date</th>            
                                                    <th>Qty. in Stock</th> 
                                                    <th>Chalan No.</th>
                                                    <th>Action</th>                                                   
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
                                                        <td> <?php echo $v->qty_dispatch; ?></td>
                                                        <td> <?php echo $v->dispatch_date; ?></td>
                                                        <td> <?php echo $v->qty_for_sale; ?></td>
                                                         <th>Chalan No.</th>
                                                        <td> 
                                                            <?php if ($v->item_accepted_by_pos == 0) {
                                                                ?>
                                                                <a href='#' onclick="acceptStockItem(<?php echo $v->id; ?>)" class="btn btn-green">Update Stock Status</a>
                                                            <?php } else { ?>
                                                                <label class="badge badge-success">Accepted</label>
                                                            <?php } ?>  
                                                        </td>
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
            </div>

            <!-- Modal -->
            <div id="myacceptItemModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" id="itemname">Stock Status Update</h4>                            
                        </div>
                        <div class="modal-body">
                            <?php
                            $model1 = new Indentitems();
                            $form1 = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                                'id' => 'indentitemform',
                            ));
                            ?>
                            <input type="hidden" id="indent_itemid" name="indent_itemid">
                            <div class='row'> 
                                <div class='col-md-6'>
                                    <label>Accept Quantity</label>
                                    <?php echo $form1->textField($model1, 'qty_in_stock', array('maxlength' => 100,'placeholder'=>'Accept Quantity')); ?>
                                </div>
                            </div>
                            <br/>                            
                                <p>Please review the quantity twice once you update the quantity will never update again.</p>
                            <div class="form-group">
                                <button type="button" id="acceptorder" class="btn btn-green">Accept</button>
                            </div>
                            <?php $this->endWidget(); ?>
                        </div>      
                    </div>
                </div>
            </div>
            <div style="display:none;" id="printorder">
                <legend><h3 class="panel-title">Processed Indent No : <?php echo $model->id ?> (<?php echo $model->sync_id ?>)</h3></legend>
                Prepared By <?php echo $model->createdby->name; ?> &nbsp;&nbsp;&nbsp;&nbsp; Indent date : <?php echo $model->indent_date; ?><br/>
                <legend>Indent No : <?php echo $model->id ?> (<?php echo $model->sync_id ?>) Processed by CDS</legend>
                <legend>Item With Invoice</legend> <hr/>                              
                <?php
                if (!empty($model)) {
                    $ilist = Indentitems::model()->findAllBySql("select * from internal_indent_items where sync_id='$model->sync_id' and item_purpose='Resale' and dispatch_date!='' order by id desc");
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
                                    <th style="border:1px solid #ddd;padding:5px;text-align: left;">Dispatch Date</th>            
                                    <th style="border:1px solid #ddd;padding:5px;text-align: left;">Qty in Stock</th>            
                                    <th style="border:1px solid #ddd;padding:5px;text-align: left;">Invoice No.</th>            
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $c = 1;
                                foreach ($ilist as $v) {
                                    ?>
                                    <tr>
                                        <td width="20%" style="border:1px solid #ddd;padding:5px;text-align: left;"><?php echo $v->item_name; ?> (<?php echo $v->qty_scale; ?>)</td>
                                        <td width="10%" style="border:1px solid #ddd;padding:5px;text-align: left;"><?php echo $v->item_brand; ?></td>
                                        <td width="10%" style="border:1px solid #ddd;padding:5px;text-align: left;"><?php echo $v->item_purpose; ?></td>
                                        <td width="10%" style="border:1px solid #ddd;padding:5px;text-align: left;"><?php echo $v->qty_required; ?></td>
                                        <td width="10%" style="border:1px solid #ddd;padding:5px;text-align: left;"><?php echo $v->req_date; ?></td>
                                        <td width="10%" style="border:1px solid #ddd;padding:5px;text-align: left;"><?php echo $v->qty_dispatch; ?></td>
                                        <td width="10%" style="border:1px solid #ddd;padding:5px;text-align: left;"><?php echo $v->dispatch_date; ?></td>
                                        <td width="10%" style="border:1px solid #ddd;padding:5px;text-align: left;"><?php echo $v->qty_for_sale; ?></td>
                                        <td width="10%" style="border:1px solid #ddd;padding:5px;text-align: left;">Invoice No.</td>            
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
                <legend>Item With Chalan</legend> <hr/>
                <?php
                if (!empty($model)) {
                    $ilist = Indentitems::model()->findAllBySql("select * from internal_indent_items where sync_id='$model->sync_id' and item_purpose='Supply' and dispatch_date!='' order by id desc");
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
                                    <th style="border:1px solid #ddd;padding:5px;text-align: left;">Dispatch Date</th>            
                                    <th style="border:1px solid #ddd;padding:5px;text-align: left;">Qty in Stock</th>    
                                    <th style="border:1px solid #ddd;padding:5px;text-align: left;">Chalan No.</th>            
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $c = 1;
                                foreach ($ilist as $v) {
                                    ?>
                                    <tr>
                                        <td width="20%" style="border:1px solid #ddd;padding:5px;text-align: left;"><?php echo $v->item_name; ?> (<?php echo $v->qty_scale; ?>)</td>
                                        <td width="10%" style="border:1px solid #ddd;padding:5px;text-align: left;"><?php echo $v->item_brand; ?></td>
                                        <td width="10%" style="border:1px solid #ddd;padding:5px;text-align: left;"><?php echo $v->item_purpose; ?></td>
                                        <td width="10%" style="border:1px solid #ddd;padding:5px;text-align: left;"><?php echo $v->qty_required; ?></td>
                                        <td width="10%" style="border:1px solid #ddd;padding:5px;text-align: left;"><?php echo $v->req_date; ?></td>
                                        <td width="10%" style="border:1px solid #ddd;padding:5px;text-align: left;"><?php echo $v->qty_dispatch; ?></td>
                                        <td width="10%" style="border:1px solid #ddd;padding:5px;text-align: left;"><?php echo $v->dispatch_date; ?></td>
                                        <td width="10%" style="border:1px solid #ddd;padding:5px;text-align: left;"><?php echo $v->qty_for_sale; ?></td>
                                        <td width="10%" style="border:1px solid #ddd;padding:5px;text-align: left;">Chalan No.</td> 

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
    $("#acceptorder").click(function(){
        var form = $('#indentitemform').serialize();
        $("#acceptorder").attr('disabled', 'disabled').html("Submiting...");
        $.ajax({
            url: '<?php echo $this->createUrl('indentmaster/acceptorder') ?>',
            data: form+'&YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>',
            type: 'post',
            cache: false,
            success: function(response) {
                $("#acceptorder").removeAttr('disabled').html('Accept');
                $('#indentitemform')[0].reset();
                window.location.reload();
            }
        });
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
function acceptStockItem(id) {
    $("#indent_itemid").val(id);
    $("#myacceptItemModal").modal('show');
}

function getCheckValue(stock_qty, stock_id, indent_id, item_id) {
    //alert(stock_id);                                                  
    var new_qty = $('#new_qty_' + stock_id).val();
    //     alert(new_qty);  
    if (eval(new_qty) > eval(stock_qty)) {
        alert('Dispatch Qty can\'t be greater than Stock Qty');
        $('#new_qty_' + stock_id).focus().val('');
    } else {
        $("#show_item_details").html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/dist/img/loading_icon.gif">');
        var url = '<?php echo $this->createUrl("supply/saveAllotedStock"); ?>';
        $.getJSON(url, {'stock_id': stock_id, 'dispatch_qty': new_qty, 'indent_id': indent_id}, function(data) {
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
    var c = confirm('Are you sure want to submit to Supply Items ?');
    if (c == true) {
        var url = '<?php echo $this->createUrl("supply/updateOrderStatus"); ?>';
        $.getJSON(url, {'indent_id': indent_id, 'status': '2'}, function(data) {
            if (data.msg == 'Success') {
                window.location.href = '<?php echo $this->createUrl("supply/viewIndents"); ?>';
            }
        });
    }
}
</script>