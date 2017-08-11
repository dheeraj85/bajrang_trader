<?php
$order = Cakeorder::model()->findByPk($id);
$customers = Customer::model()->findByPk($order->customer_id);
$flavor = Cakeflavour::model()->findByPk($order->flavour_id);
$design = Shapedesign::model()->findByPk($order->design_id);
$shape = Cakeshape::model()->findByPk($design->shape_id);
$orderid = Cakeorder::model()->count();
$frate = $order->rate;
$val = Categorytaxes::model()->findByAttributes(array('pos_type' => 'aos'));
$tax = Postaxes::model()->findByPk($val->tax_id);
?>
<div id="myOrderModal" class="modal fade" role="dialog" style="margin-top: -120px;">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Order Detail</h4>
            </div>
            <div class="modal-body">
                <div class="section-body">
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-md-10"> 
                            <div class="card card-printable" id="printorder">  
                                <strong>Bill No : <?php echo $order->invoice_no; ?></strong>
                            <div class="card-head message-font-big" style="background-color:#d3222a;color:#fff;padding-left:10px;">
                                    <h4><strong>Special Comments : </strong> <?php echo $order->special_remark; ?></h4>
                                </div>  
                                <div class="card">    
                                    <table class="table no-margin">
                                        <tbody>
                                            <tr>
                                                <td width="12%"><b>Order Date :</b> </td>
                                                <td width="15%" align="left"><?php echo date('d-M-Y', $order->order_date); ?></td>
                                                <td width="19%" align="right"><b>Design No/Order No :</b> </td>
                                                <td width="10%">TOC-<?php echo $order->id; ?></td>
                                                <td width="15%"><b>Delivery Type : </b> </td>
                                                <td width="20%">
                                                    <?php
                                                    if ($order->delivery_status == "deliver") {
                                                        echo "Home Delivery";
                                                    } else {
                                                        echo "Counter Collect";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>  
                                            <tr>
                                                <td width="12%"><b>Party Name : </b></td>
                                                <td width="15%" align="left"><?php echo isset($customers->full_name) ? ucfirst($customers->full_name) : ""; ?></td>
                                                <td width="19%" align="right"><b>Mobile No : </b></td>
                                                <td width="10%"><?php echo isset($customers->mobile_no) ? ucfirst($customers->mobile_no) : ""; ?></td>
                                                <td width="15%"><b>Delivery Date : </b> </td>
                                                <td width="20%"><?php echo isset($order->delivery_datetime) ? ucfirst($order->delivery_datetime) : ""; ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" align="left"><b>Cake Status : </b></td>
                                                <td colspan="2" align="left"><?php
                                                    if ($order->cake_status == 'pending') {
                                                        echo 'PENDING';
                                                    } else if ($order->cake_status == 'p_accepted') {
                                                        echo 'ACCEPTED BY POS';
                                                    } else if ($order->cake_status == 'k_accepted') {
                                                        echo 'ACCEPTED BY KITCHEN USER';
                                                    } else if ($order->cake_status == 'processing') {
                                                        echo 'UNDER PROCESSING';
                                                    } else if ($order->cake_status == 'finished') {
                                                        echo 'COMPLETED';
                                                    } else if ($order->cake_status == 'delivered') {
                                                        echo 'DELIVERED';
                                                    }
                                                    ?></td>
                                                <td align="left"><b>Payment Status : </b></td>
                                                <td align="left"><b><?php if ($order->cake_status == 'delivered') { ?> PAID <?php } else { ?> UNPAID <?php } ?></b></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane" id="activity">   
                                    <table class="table col-md-12 col-xs-12" style="width: 100%;">
                                        <tr>
                                            <td class="col-md-4 col-xs-4" style="width: 33%;">
                                                <div class="card">
                                                    <div class="card-head">
                                                        <header style="font-size: 16px;line-height: 15px;">Flavor : <?php echo isset($flavor->flavour_name) ? ucfirst($flavor->flavour_name) : ""; ?></header>
                                                    </div>
                                                    <div class="card-body text-center height-4">
                                                        <?php if (!empty($flavor)) { ?>
                                                            <img width="175" height="138" src="<?php echo Yii::app()->request->baseUrl; ?>/uploads/Flavorimage/<?php echo $flavor->img; ?>" style="margin-top: 10px;"/>
                                                        <?php } ?> 
                                                    </div>
                                                </div><!--end .card -->
                                            </td>
                                            <td class="col-md-4 col-xs-4" style="width: 33%;">
                                                <div class="card">
                                                    <div class="card-head">
                                                        <header style="font-size: 16px;line-height: 15px;">Shape : <?php echo isset($shape->shape_name) ? ucfirst($shape->shape_name) : ""; ?></header>
                                                    </div>
                                                    <div class="card-body text-center height-4">
                                                        <?php if (!empty($shape)) { ?>
                                                            <img width="175" height="138" src="<?php echo Yii::app()->request->baseUrl; ?>/uploads/Shapeimage/<?php echo $shape->image; ?>" style="margin-top: 10px;"/>
                                                        <?php } ?>
                                                    </div>
                                                </div><!--end .card -->
                                            </td>
                                            <td class="col-md-4 col-xs-4" style="width: 33%;">
                                                <div class="card">
                                                    <div class="card-head">
                                                        <header style="font-size: 16px;line-height: 15px;">Design : <?php echo isset($design->design_name) ? ucfirst($design->design_name) : ""; ?></header>
                                                    </div>
                                                    <div class="card-body text-center height-4">
                                                        <?php
                                                        if (!empty($design)) {
                                                            if ($design->shape_id == 1) {
                                                                ?>
                                                                <img width="175" height="138" src="<?php echo Yii::app()->request->baseUrl; ?>/uploads/custom_design/<?php echo $design->design_img; ?>" style="margin-top: 10px;"/>
                                                            <?php } else { ?>
                                                                <img width="175" height="138" src="<?php echo Yii::app()->request->baseUrl; ?>/uploads/Shapeimage/design/<?php echo $design->design_img; ?>" style="margin-top: 10px;"/>
                                                                <?php
                                                            }
                                                        }
                                                        ?>  
                                                    </div>
                                                </div><!--end .card -->
                                            </td>
                                        </tr>
                                    </table>
                                    <div style="clear:both"></div>
                                    <div class="card style-default-light">
                                        <div class="card-body small-padding">
                                            <div class="col-lg-12">
                                                <?php
                                                $list = Cakeorderaddons::model()->findAllByAttributes(array('cake_order_id' => $order->id));
                                                if (!empty($list)) {
                                                    ?>
                                                    <table class="table no-margin">
                                                        <tbody>
                                                            <tr>
                                                                <td><b>Add On's</b></td>
                                                                <td>Add on Name</td>
                                                                <td>Unit</td>
                                                                <td>Rate (Rs.)</td>
                                                                <td>Qty</td>
                                                                <td class="text-right">Amount (Rs.)</td>
                                                            </tr>
                                                            <?php
                                                            $atotal = 0.00;
                                                            foreach ($list as $cf1) {
                                                                $addon = Cakeaddons::model()->findByPk($cf1->addons_id)
                                                                ?>
                                                                <tr>
                                                                    <td rowspan="1" text-align="center"></td>
                                                                    <td><?php echo $addon->addon_name; ?></td>
                                                                    <td><?php echo $addon->unit; ?> <?php echo $addon->scale; ?></td>
                                                                    <td><?php echo $addon->rate; ?></td>
                                                                    <td><?php echo $cf1->unit; ?></td>
                                                                    <td class="text-right"><?php echo $cf1->rate; ?></td>
                                                                </tr>  
                                                                <?php
                                                                $atotal = $atotal + $cf1->rate;
                                                            }
                                                            ?> 
    <!--                                                            <tr>
                                                    <td colspan="4">Total Add on Amount (Rs.)</td>
                                                    <td class="text-right"><?php // echo $atotal;    ?></td>
                                                </tr>-->
                                                            <tr>
                                                                <td rowspan="2"><b>Cake</b></td>
                                                                <td>Cake Rate </td>
                                                                <td>Cake Weight </td>
                                                                <td colspan="2">Cake Amount (Rate X Weight)</td>                        
                                                                <td class="text-right"></td>
                                                            </tr> 
                                                            <tr>                                                     
                                                                <td><?php echo $order->rate; ?></td>                                                   
                                                                <td><?php echo $order->weight; ?> KG</td>                                                   
                                                                <td colspan="2"><?php echo $order->rate . '&emsp;X&emsp;' . $order->weight; ?></td>                                                   
                                                                <td class="text-right"><?php
                                                                    $trate = $order->weight * $order->rate;
                                                                    echo $trate;
                                                                    ?></td>
                                                            </tr> 
                                                                         <tr>
                                                                <td rowspan="2" ><b>Complexity</b></td>
                                                                <td>Type </td>
                                                                <td></td>
                                                                <td colspan="2"></td>                        
                                                                <td class="text-right">
                                                         
                                                                </td>
                                                            </tr> 
                                                            <tr> 
                                                                <?php $cp_rate = Designcomplexity::model()->findByPk($order->design_complexity_id);?>
                                                                <td><?php echo  $cp_rate->design_code; ?></td>                                                   
                                                                <td></td>                                                   
                                                                <td colspan="2"></td>                                                   
                                                                <td class="text-right">           <?php 
                                                                    echo   $complex_rate=isset($order->design_complexity_rate)?$order->design_complexity_rate:0;
                                                                    ?></td>
                                                            </tr> 
                                                        </tbody>
                                                    </table>
                                                <?php } ?> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card style-default-light">
                                        <div class="card-body small-padding">
                                            <div class="col-lg-12">
                                                <?php
                                                if (!empty($list)) {
                                                    $order_amt = $atotal + $trate+$order->design_complexity_rate;
                                                    ?>
                                                    <table class="table no-margin">
                                                        <tbody>  
                                                            <tr>
                                                                <td colspan="4"><b>Total Order Amount (Rs.)</b></td>
                                                                <td class="text-right"><b><?php echo $order_amt; ?></b></td>
                                                            </tr>
                                                            <?php
                                                            $net_amt = $order_amt + $order->delivery_charges + $order->extra_charges ;
                                                            $tax_amt = 0.00;
                                                            $total_amt = $net_amt + $tax_amt;
                                                            $bal_amt = $total_amt - $order->advance_amount;
                                                            ?>
                                                            <?php if ($order->cake_status == 'finished' && Yii::app()->user->isPOS() == 'pos') { ?> 
                                                                <tr>
                                                                    <td colspan="5">
                                                                        <form id="bill">
                                                                            <div class="row">
                                                                                <input type="hidden" id="id" name="id" value="<?php
                                                                                if (!empty($order->id)) {
                                                                                    echo $order->id;
                                                                                }
                                                                                ?>">
                                                                                <div class="col-lg-3">
                                                                                    <label>Design Complexity</label>
                                                                                    <select name="design_complexity_id" id="design_complexity_id" onchange="getamt();" class="form-control" >
                                                                                        <option value="">--Design Code--</option>
                                                                                        <?php foreach (Designcomplexity::model()->findAll() as $design) { ?>
                                                                                            <option value="<?php echo $design->id; ?>"><?php echo $design->design_code; ?></option>                                                
                                                                                        <?php } ?>  
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-lg-3">
                                                                                    <label>Design Amt (Rs.)</label>
                                                                                    <input type="text" name="design_complexity_rate" id="design_complexity_rate" class="col-lg-12" placeholder="Design Complexity Rate" value="<?php
                                                                                    if (!empty($order->design_complexity_rate)) {
                                                                                        echo $order->design_complexity_rate;
                                                                                    }
                                                                                    ?>" readonly>
                                                                                </div>
                                                                                <div class="col-lg-3">
                                                                                    <label>Extra Charges (Rs.)</label>
                                                                                    <input type="text" name="extra_charges" id="extra_charges" onkeyup="Payable();" class="col-lg-12" placeholder="Extra Charges" value="<?php
                                                                                    if (!empty($order->extra_charges)) {
                                                                                        echo $order->extra_charges;
                                                                                    }
                                                                                    ?>">
                                                                                </div>
                                                                                <div class="col-lg-3">
                                                                                    <label>Tax (Rs.)</label>
                                                                                    <select name="tax" id="tax" onchange="Cal($(this).val());" class="form-control" placeholder="Tax">
                                                                                        <?php
                                                                                        foreach (Categorytaxes::model()->findAllByAttributes(array('pos_type' => 'aos')) as $val) {
                                                                                            $tax = Postaxes::model()->findByPk($val->tax_id);
                                                                                            ?>
                                                                                            <option value="<?php echo $tax->tax_percent; ?>"><?php echo $tax->tax_name . '&emsp; - &emsp;' . $tax->tax_percent . ' %'; ?></option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </div>
                                                                                <div style="clear:both"></div>
                                                                                <div class="col-lg-3">
                                                                                    <label>Delivery Charges (Rs.)</label>
                                                                                    <input type="text" name="delivery_charges" id="delivery_charges" onkeyup="Payable();" placeholder="Delivery Charges" class="col-lg-12" value="<?php
                                                                                    if (!empty($order->delivery_charges)) {
                                                                                        echo $order->delivery_charges;
                                                                                    }
                                                                                    ?>">
                                                                                </div>
                                                                                <div class="col-lg-3">
                                                                                    <label>Discount (Rs.)</label>
                                                                                    <input type="text" name="discount" id="discount" onkeyup="Payable();" class="col-lg-12" placeholder="Discount" value="<?php
                                                                                    if (!empty($order->discount)) {
                                                                                        echo $order->discount;
                                                                                    }
                                                                                    ?>">
                                                                                </div>
                                                                                <div class="col-lg-3">
                                                                                    <label>Payable Amount (Rs.)</label>
                                                                                    <input type="text" name="payable" id="payable" class="col-lg-12" value="<?php
                                                                                    if (!empty($order->balance_amount)) {
                                                                                        echo $bal_amt;
                                                                                    }
                                                                                    ?>" readonly>
                                                                                </div>
                                                                                <div class="col-lg-3">
                                                                                    <label>Paid Amount</label>
                                                                                    <input type="text" name="paid" id="paid" class="col-lg-12" value="<?php
                                                                                    if (!empty($order->balance_amount)) {
                                                                                        echo $bal_amt;
                                                                                    }
                                                                                    ?>">
                                                                                </div>
                                                                            </div>
                                                                            <?php $inv_no = count(Cakeorder::model()->findAll()) + 1; ?>
                                                                            <input type="hidden" name="total_amt" id="total_amt" value="<?php echo $order->amount; ?>">
                                                                        </form>
                                                                    </td>
                                                                </tr>   
                                                            <?php } ?>
                                                            <?php if ($order->cake_status == "delivered") { ?>
                                                                <?php if ($order->design_complexity_rate != 0.00) { ?>
                                                                    <tr>
                                                                        <td colspan="4"><?php echo Designcomplexity::model()->findByPk($order->design_complexity_id)->design_code . ' '; ?> Design Complexity Charges (Rs.)</td>
                                                                        <td class="text-right"><?php echo $order->design_complexity_rate; ?></td>
                                                                    </tr>    
                                                                <?php } ?>    
                                                                <?php if ($order->extra_charges != 0.00) { ?>
                                                                    <tr>
                                                                        <td colspan="4">Extra Charges (Rs.)</td>
                                                                        <td class="text-right"><?php echo $order->extra_charges; ?></td>
                                                                    </tr>    
                                                                <?php } ?>   
                                                                <?php if ($order->delivery_charges != 0.00) { ?>
                                                                    <tr>
                                                                        <td colspan="4">Delivery Charges (Rs.)</td>
                                                                        <td class="text-right"><?php echo $order->delivery_charges; ?></td>
                                                                    </tr>    
                                                                <?php } ?>
                                                            <?php } ?> 
                                                            <?php if ($order->cake_status == 'delivered') { ?>
                                                                <tr style="color: #1e60ac;">
                                                                    <td colspan="4"><b>Net Amount (Rs.)</b></td>
                                                                    <td class="text-right"><b id="total"><?php echo $net_amt; ?></b></td>
                                                                </tr> 
                                                            <?php } else { ?>
                                                                <tr style="color: #1e60ac;">
                                                                    <td colspan="4"><b>Net Amount (Rs.)</b></td>
                                                                    <td class="text-right"><b id="total"><?php echo $order->amount+$order->design_complexity_rate; ?></b></td>
                                                                </tr> 
                                                            <?php } ?>
<!--                                                            <tr>
                                                                <td colspan="4"><?php echo $tax->tax_name . ' '; ?>Tax <?php echo $tax->tax_percent . ' %'; ?></td>
                                                                <td class="text-right" id="tax_amt"><?php echo $tax_amt . '.00'; ?></td>
                                                            </tr>      -->
                                                            <tr style="color: #5e0aa8;">
                                                                <td colspan="4"><b>Total Amount (Rs.)</b></td>
                                                                <td class="text-right"><b id="gtotal"><?php echo $total_amt . '.00'; ?></b></td>
                                                            </tr>      
                                                            <tr style="color: #31a4eb;">
                                                                <td colspan="4"><b>Advance Amount (Rs.)</b></td>
                                                                <td class="text-right"><b><?php echo $order->advance_amount; ?></b></td>
                                                            </tr>  
                                                            <?php if ($order->cake_status == 'delivered') { ?>    
                                                                <?php if ($order->discount != 0.00) { ?>
                                                                    <tr>
                                                                        <td colspan="4">Discount (Rs.)</td>
                                                                        <td class="text-right"><?php echo $order->discount; ?></td>
                                                                    </tr>    
                                                                <?php } ?>    
                                                                <tr>
                                                                    <?php $total_paid = $order->amount - $order->advance_amount - $order->balance_amount; ?>
                                                                    <td colspan="4"><b>Final Payment (Rs.)</b></td>
                                                                    <td class="text-right"><b><?php echo $total_paid; ?></b></td>
                                                                </tr>    
                                                            <?php } ?>
                                                            <?php if ($order->cake_status == 'delivered') { ?>
                                                                <tr style="color: #932a0c;">
                                                                    <td colspan="4"><b>Balance Amount (Rs.)</b></td>
                                                                    <td class="text-right"><b><?php echo $order->balance_amount; ?></b></td>
                                                                </tr> 
                                                            <?php } else { ?>
                                                                <tr style="color: #932a0c;">
                                                                    <td colspan="4"><b>Balance & Payable Amount (Rs.)</b></td>
                                                                    <td class="text-right"><b id="balance"><?php echo $bal_amt . '.00'; ?></b></td>
                                                                </tr> 
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                <?php } ?> 
                                            </div>
                                        </div>
                                    </div>
                                    <?php if ($order->delivery_status == "deliver") { ?>                  
                                        <div class="alert alert-info" role="alert">
                                            <h4><strong>Delivery Address : </strong> <?php echo isset($customers->address) ? ucfirst($customers->address) : ""; ?></h4>
                                        </div> 
                                    <?php } ?>
                                </div>
                            </div>
                            <?php if ($order->cake_status == 'k_accepted') { ?>
                                <form id="adv">
                                    <div class="well">
                                        <div class="row">
                                            <input type="hidden" id="order_id" name="order_id" value="<?php
                                            if (!empty($order->id)) {
                                                echo $order->id;
                                            }
                                            ?>">
                                            <div class="col-lg-6">
                                                <label>Advance Amount</label>
                                                <input type="text" name="advance" class="col-lg-12" value="<?php
                                                if (!empty($order->advance_amount)) {
                                                    echo $order->advance_amount;
                                                } else {
                                                    echo '0';
                                                }
                                                ?>">
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Remark</label>
                                                <textarea name="remark" class="col-lg-12"><?php
                                                    if (!empty($order->remark)) {
                                                        echo $order->remark;
                                                    }
                                                    ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            <?php } ?>

                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <?php if ($order->cake_status == 'delivered') { ?>
                <?php } else if ($order->cake_status == 'pending') { ?>
                    <button type="button" data-loading-text="Please wait..." onclick="Change('k_accepted', '<?php echo $order->id; ?>');" class="btn btn-info btn_loading">Click to ACCEPT and Take ADVANCE</button>&emsp;
                    <button type="button" data-loading-text="Please wait..." onclick="Change('p_accepted', '<?php echo $order->id; ?>');" class="btn btn-primary btn_loading">Send to Kitchen</button>&emsp;
                <?php } else if ($order->cake_status == 'p_accepted' && Yii::app()->user->isKPOS() == 'kpos') { ?>
                    <button type="button" data-loading-text="Please wait..." onclick="Change('pending', '<?php echo $order->id; ?>');" class="btn btn-danger btn_loading">Click to REJECT</button>&emsp;
                    <button type="button" data-loading-text="Please wait..." onclick="Change('k_accepted', '<?php echo $order->id; ?>');" class="btn btn-primary btn_loading">Click to ACCEPT</button>&emsp;
                <?php } else if ($order->cake_status == 'processing' && Yii::app()->user->isKPOS() == 'kpos') { ?>
                    <button type="button" data-loading-text="Please wait..." onclick="Change('finished', '<?php echo $order->id; ?>');" class="btn btn-primary btn_loading">Click to Finished</button>&emsp;
                <?php } else if ($order->cake_status == 'finished' && Yii::app()->user->isPOS() == 'pos') { ?>
                    <button type="button" data-loading-text="Please wait..." onclick="Bill('delivered', '<?php echo $order->id; ?>');" class="btn btn-primary btn_loading">Click to Delivered</button>&emsp;
                <?php } else if ($order->cake_status == 'k_accepted') { ?>
                    <button type="button" onclick="Advance('processing', '<?php echo $order->id; ?>');" class="btn btn-primary btn_loading"><?php
                        echo 'Click to take ADVANCE and PROCESSED';
                        ?></button>&emsp;
                <?php } ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btnPrint" onclick="Print()"><i class="glyphicon glyphicon-print"></i> Print </button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $("#myOrderModal").modal({backdrop: 'static', keyboard: false});
    });

    function Payable() {
        var total = 0.00;
        var total_amt = 0.00;
        var total_with_dsc = 0.00;
        var total_with_tax = 0.00;
        var design = $('#design_complexity_rate').val();
        var extra_charges = $('#extra_charges').val();
        var discount = $('#discount').val();
        var tax = $('#tax').val();
        var delivery_charges = $('#delivery_charges').val();
        var bal = '<?php echo $order->balance_amount; ?>';
        var adv = '<?php echo $order->advance_amount; ?>';
        if (design == '') {
            design = 0.00;
        } else {
            design = $('#design_complexity_rate').val();
        }
        if (extra_charges == '') {
            extra_charges = 0.00;
        } else {
            extra_charges = $('#extra_charges').val();
        }
        if (delivery_charges == '') {
            delivery_charges = 0.00;
        } else {
            delivery_charges = $('#delivery_charges').val();
        }
        total = parseFloat(adv) + parseFloat(design) + parseFloat(extra_charges) + parseFloat(delivery_charges) + parseFloat(bal);
        total_amt = parseFloat(design) + parseFloat(extra_charges) + parseFloat(delivery_charges) + parseFloat(bal);
        if (!isNaN(total_amt)) {
            $('#total').html(total.toFixed(2));
        }
        if (tax == '') {
            tax = 0.00;
        } else {
            tax = (parseFloat(total_amt) + parseFloat(adv)) * (parseFloat($('#tax').val()) / 100);
        }
        $('#tax_amt').html(tax.toFixed(2));
        total_with_tax = parseFloat(total_amt) + parseFloat(tax.toFixed(2));

        if (discount == '') {
            discount = 0.00;
        } else {
            discount = $('#discount').val();
        }
        total_with_dsc = parseFloat(total_with_tax) - parseFloat(discount);
        if (!isNaN(total_with_dsc)) {
            $('#payable').val(total_with_dsc.toFixed(2));
            $('#balance').html(total_with_dsc.toFixed(2));
            $('#paid').val(total_with_dsc.toFixed(2));
            var gtotal = parseFloat(total_with_dsc) + parseFloat(adv);
            $('#gtotal').html(gtotal.toFixed(2));
            $('#total_amt').val(gtotal.toFixed(2));
        }
    }

    function getamt() {
        var id = $('#design_complexity_id').val();
        $.ajax({
            url: '<?php echo $this->createUrl('aos/getdesignrate'); ?>',
            data: {'id': id},
            type: 'post',
            success: function(response) {
                $('#design_complexity_rate').val(response);
                Payable();
            }
        });
    }

    function Change(status, id) {
        var $btn = $('.btn_loading').button('loading');
        $.ajax({
            url: '<?php echo $this->createUrl('aos/changestatus'); ?>',
            data: {'status': status, 'id': id},
            type: 'post',
            success: function(response) {
                $btn.button('reset');
                showStatus();
                window.location.reload();
//                $("#myOrderModal").modal('hide');
            }
        });
    }

    function Advance(status, id) {
        var datastring = $('#adv').serialize();
        $.ajax({
            url: '<?php echo $this->createUrl('aos/saveadvance'); ?>',
            data: datastring,
            type: 'post',
            success: function(response) {
                Change(status, id);
            }
        });
    }

    function Bill(status, id) {
        var datastring = $('#bill').serialize();
        $.ajax({
            url: '<?php echo $this->createUrl('aos/generatebill'); ?>',
            data: datastring,
            type: 'post',
            success: function(response) {
                Change(status, id);
            }
        });
    }

    $(function() {
        $("#btnPrint").click(function() {
            var contents = $("#printorder").html();
            var frame1 = $('<iframe />');
            frame1[0].name = "frame1";
            frame1.css({"position": "absolute", "top": "-1000000px"});
            $("body").append(frame1);
            var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
            frameDoc.document.open();
            //Create a new HTML document.
            frameDoc.document.write('<html><head><title>Print</title>');
            frameDoc.document.write('</head><body>');
            //Append the external CSS file.
            frameDoc.document.write("<link href='<?php echo Yii::app()->request->baseUrl; ?>/front/theme-default/materialadminb0e2.css' rel='stylesheet' type='text/css' />");
            frameDoc.document.write("<link href='<?php echo Yii::app()->request->baseUrl; ?>/front/theme-default/materialadmin_printb0e2.css' rel='stylesheet' type='text/css' />");
            //Append the DIV contents.
            frameDoc.document.write(contents);
            frameDoc.document.write('</body></html>');
            frameDoc.document.close();
            setTimeout(function() {
                window.frames["frame1"].focus();
                window.frames["frame1"].print();
                frame1.remove();
            }, 500);
        });
    });
</script>