<?php
/* @var $this VendorController */
/* @var $model Vendor */

$this->breadcrumbs = array(
    'Home' => array('pos/ots_items'),
    'Special Customer Ledger',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Vendor', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Vendor', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#vendor-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">      
            <div class="box">
                <div class="box-header bg-green">
                    <h3 class="panel-title">Special Customer Ledger</h3>
                </div>
                <div class="panel-body">
                    <?php
                    $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                        'id' => 'customer-form',
                        'enableAjaxValidation' => false,
                    ));
                    ?>
                    <div class='row'>     
                        <div class='col-md-5'>
                            <label>Select Customer </label>
                            <select id="Customer_id" name="Customer[id]" class="form-control select2">
                                <option value="">-Select-</option>
                                <?php
                                foreach (Customer::model()->findAllByAttributes(array('type' => 'party')) as $customer) {
                                    if ($list->id == $customer->id) {
                                        ?>
                                        <option value="<?php echo $customer->id ?>" selected="selected"><?php echo $customer->full_name ?> (<?php echo $customer->party_store_name ?>)</option>
                                    <?php } else {
                                        ?>
                                        <option value="<?php echo $customer->id ?>"><?php echo $customer->full_name ?> (<?php echo $customer->party_store_name ?>)</option>
                                        <?php
                                    }
                                }
                                ?>    
                            </select>
                        </div>
                        <div class='col-md-5' style="padding-top:23px;">
                            <?php echo BsHtml::submitButton('Show', array('color' => BsHtml::BUTTON_COLOR_GREEN, 'id' => 'btnsearch')); ?>
                        </div>
                    </div>
                    <?php $this->endWidget(); ?>
                    <br/>
                    <?php if (!empty($list)) { ?>
                        <table class="table table-bordered">
                            <tr>
                                <td><b>Name</b></td>
                                <td><b>Firm Name</b></td>
                                <td><b>Mobile No</b></td>
                                <td><b>Email</b></td>
                                <td><b>Customer Balance</b></td>
                                <td><b>On Account Receiving</b></td>
                            </tr>
                            <tr>
                                <td><?php echo $list->full_name; ?></td>
                                <td><?php echo $list->party_store_name; ?></td>
                                <td><?php echo $list->mobile_no; ?></td>
                                <td><?php echo $list->email_id; ?></td>
                                <td><?php echo $list->balance; ?></td>
                                <td>
                                    <a href="<?php echo $this->createUrl('customervoucher/create', array('id' => 11, 'receiver_type' => 'customer', 'receiver_id' => $list->id)) ?>" class="btn btn-green">Receive Payment</a>    
                                </td>
                            </tr>
                        </table>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class='row'>
        <div class="col-lg-3">
            <div class="box">
                <div class="box-header bg-green">
                    <h4 class="panel-title"> <?php if (!empty($list)) { ?><?php echo $list->full_name; ?> (Firm : <?php echo $list->party_store_name; ?>) <?php } ?></h4>
                </div>
                <br/>
                <?php
                $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                    'id' => 'searchcustomerinvoice-form',
                    'enableAjaxValidation' => false,
                ));
                ?>
                <input type="hidden" id="customer_id" name="customer_id" value="<?php if (!empty($list)) { ?><?php
                    echo $list->id;
                }
                ?>"/>
                <div class='col-md-12'>
                    <label>From Date</label>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'name' => 'from_dated',
                        'id' => 'from_dated',
                        'value' => Yii::app()->request->getPost('from_dated'),
                        'options' => array(
                            'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
                        ),
                        'htmlOptions' => array(
                            'style' => '',
                            //'readonly' => 'readonly'
                            'placeholder' => 'From Date', 'class' => 'form-control',
                        ),
                    ));
                    ?>
                </div>
                <div class='col-md-12'>
                    <label>To Date</label>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'name' => 'to_dated',
                        'id' => 'to_dated',
                        'value' => Yii::app()->request->getPost('to_dated'),
                        'options' => array(
                            'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
                        ),
                        'htmlOptions' => array(
                            'style' => '',
                            //'readonly' => 'readonly'
                            'placeholder' => 'To Date', 'class' => 'form-control',
                        ),
                    ));
                    ?>
                </div>
                <div class='col-md-2' style="padding-top:23px;">
                    <?php echo BsHtml::submitButton('Filter', array('color' => BsHtml::BUTTON_COLOR_GREEN, 'id' => 'searchcustomerinvoice')); ?>
                </div>
                <?php $this->endWidget(); ?>
                <div style="clear:both"></div>
                <br/>          

            </div>
        </div>      
        <div class="col-lg-9 col-md-9">
            <div class="box">
                <div class="box-header bg-green">
                    <h4 class="panel-title"> Customer Bill Details</h4>
                </div>
                <div class="col-md-12" id="show_err_msg"></div>
                <form id="reconcile_form" class="form-inline">
                    <input type="hidden" id="customer_id" name="customer_id" value="<?php if (!empty($list)) { ?><?php
                        echo $list->id;
                    }
                    ?>"/>
                    <div class="col-md-4">
                        <br>
                        Select Check boxes to  Reconcile Bill Amount
                    </div>

                    <div class="col-md-4">
                        <br>
                        <div style="font-weight: bold;font-size: 16px" class="badge">Amount added : <span id="show_total_amt">0.00</span> </div>
                    </div>

                    <div class="col-md-4 pull-right">
                        <br>                   
                        <!--<input type="text" name="voucher_no" class="form-control" placeholder="Enter Voucher no" required>-->
                        <select name="voucher_no" class="form-control">
                            <option value="">--Select Voucher--</option>
                            <?php
                            foreach ($vouchers as $vc) {
                                $condition = 'voucher_no=:v';
                                $params = array(':v' => $vc->id);
                                $voucherExists = Creditaccount::model()->exists($condition, $params);
                                if (!$voucherExists) {
                                    ?>
                                    <option value="<?= $vc->id; ?>" title="<?= $vc->amount; ?>"><?= $vc->id; ?> [Rs. <?= $vc->amount; ?>]</option>
                                <?php
                                }
                            }
                            ?>
                        </select>
                        <button type="button" data-loading-text="Saving..." id="bill_btn" class="btn btn-success pull-right" onclick="saveVoucherPayment(<?php if (!empty($list)) { ?><?php
                            echo $list->id;
                        }
                        ?>)">Save</button>          
                    </div>
                    <div class="panel-body table-responsive" id="history_invoiceresult">
<?php if (!empty($list->id)) { ?>
                            <table class="table table-bordered">
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><b>Invoice No.</b></td>
                                    <td><b>Invoice Date</b></td>
                                    <td><b>Total Amount</b></td>
                                    <td><b>Paid Amount</b></td>
                                    <td><b>Balance</b></td>
                                    <td><b>Reconcile Bill Amount</b></td>
                                    <td><b>Action</b></td>
                                </tr>
                                <?php
                                $paid_total = 0.00;
                                $gross_total = 0.00;
                                foreach ($plist as $invlist) {
                                    if (ShelfSale::getbalance($invlist) > 0 && !empty($invlist->invoice_number)) {
                                        $total = ShelfSale::gettotal($invlist);
                                        $balance = ShelfSale::getbalance($invlist);
                                        $paid = ShelfSale::getpaid($invlist);
                                        ?>
                                        <tr>
                                            <td><input class="customcheckbox" type="checkbox" name="bill[]" id="check_<?php echo $invlist->id; ?>" onclick="showCheckedAmt(<?php echo $invlist->id . ',' . $balance; ?>)"></td>
                                            <td><a href="#" onclick="reviewpost(<?php echo $invlist->id; ?>);"><?php echo $invlist->invoice_number; ?></a></td>
                                            <td><?php echo $invlist->order_date; ?></td>
                                            <td style="text-align: center;"><?php echo $total; ?></td>
                                            <td style="text-align: center;"><?php echo isset($paid) ? $paid : 0.00; ?></td>
                                            <td style="text-align: center;"><?php echo $balance; ?></td>
                                            <td>
                                                <input type="text" name="amt[<?php echo $invlist->id; ?>]" id="amt_<?php echo $invlist->id; ?>"
                                                       class="form-control amt_box" placeholder="Amount" disabled="disabled" oninput="checkAddedAmt()" value="0.00">
                                            </td>
                                            <td>
                                                <a href="#" onclick="paydetails(<?php echo $invlist->id; ?>);">Pay Details</a>
                                            </td>
                                        </tr>
                                        <?php
                                        $paid_total = $paid_total + $paid;
                                        $gross_total = $gross_total + $total;
                                    }
                                }
                                ?> 

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align: center;font-weight: bold;">
    <?= $gross_total; ?>
                                    </td>
                                    <td style="text-align: center;font-weight: bold;"><?= $paid_total; ?></td>
                                    <td style="text-align: center;font-weight: bold;"><?= $gross_total - $paid_total; ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="text-align: center;font-weight: bold;">
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>

                            </table>

<?php } ?>
                    </div>
                </form>
                <div class="panel-body table-responsive" id="invoiceresult"></div>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal8" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Invoice Pay Details</h4>
            </div>
            <div class="modal-body">
                <div id="invoicepaydetails"></div> 
            </div>      
        </div>
    </div>
</div>
<div class="modal fade" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Invoice Item Details</h4>
            </div>
            <div class="modal-body">
                <div id="invoicedetails"></div> 
            </div>      
        </div>
    </div>
</div>
<div class="modal fade" id="myModal7" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Invoice Payment</h4>
            </div>
            <div id="error_field" class="alert bg-red" style="display:none;"></div>  
            <div class="modal-body">
                <?php
                $model1 = new Invoicepay();
                $form1 = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                    'id' => 'invoicepayform',
                ));
                ?>
                <input type="hidden" id="invoice_id" name="invoice_id">
                <div class='row'>                    
                    <div class='col-md-6'>
                        <label>Amount</label>
<?php echo $form1->textField($model1, 'amount', array('maxlength' => 100)); ?>
                    </div>
                    <div class='col-md-6'>
                        <label>Pay Date</label>
                        <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => 'dated',
                            'id' => 'dated',
                            'value' => $model1->dated,
                            'options' => array(
                                'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
                            ),
                            'htmlOptions' => array(
                                'style' => '',
                                //'readonly' => 'readonly'
                                'placeholder' => 'Pay Date', 'class' => 'form-control',
                            ),
                        ));
                        ?>
                    </div>
                </div><br/>
                <div class='row'>           
                    <div class='col-md-6'>     
                        <label>Voucher No</label>
<?php echo $form1->textField($model1, 'voucher_no', array('maxlength' => 100)); ?>
                    </div>  
                </div>
                <br/>
                <div class="form-group">
                    <button type="button" id="payinvoice" class="btn btn-green">Pay</button>
                </div>
<?php $this->endWidget(); ?>
            </div>      
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/bs/js/jquery.js"></script>
<script type="text/javascript">
                                        $(document).ready(function() {
                                            $('#paymode').change(function() {
                                                var pay_mode = $(this).val();
                                                if (pay_mode == "Cash") {
                                                    $("#paid_other_no").hide();
                                                    $("#paid_other_cash").hide();
                                                } else {
                                                    $("#paid_other_no").show();
                                                    $("#paid_other_cash").show();
                                                }
                                            });

                                            $('#payinvoice').click(function() {
                                                var form = $('#invoicepayform').serialize();
                                                if ($("#Invoicepay_amount").val() == "") {
                                                    $("#error_field").show();
                                                    $("#error_field").html("Amount Required");
                                                    $("#Invoicepay_amount").focus();
                                                    return false;
                                                } else {
                                                    $("#error_field").html("");
                                                }
                                                if ($("#Invoicepay_voucher_no").val() == "") {
                                                    $("#error_field").show();
                                                    $("#error_field").html("Voucher No. Required");
                                                    $("#Invoicepay_voucher_no").focus();
                                                    return false;
                                                } else {
                                                    $("#error_field").html("");
                                                }
                                                $("#payinvoice").attr('disabled', 'disabled').html("Submiting...");
                                                $.ajax({
                                                    url: '<?php echo $this->createUrl('vendor/payinvoice') ?>',
                                                    data: form + '&YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>',
                                                    type: 'post',
                                                    cache: false,
                                                    success: function(response) {
                                                        $("#payinvoice").removeAttr('disabled').html('Pay');
                                                        $('#invoicepayform')[0].reset();
                                                        $('#myModal7').modal('hide');
                                                        searchresult();
                                                    }
                                                });
                                            });
                                        });

                                        function showCheckedAmt(id, balance) {
                                            var amt = $("#show_total_amt").text();
                                            //  alert(amt);
                                            if ($('#check_' + id).is(':checked')) {
                                                $("#amt_" + id).val(balance);
                                                $("#amt_" + id).removeAttr('disabled').focus();
                                                $("#show_total_amt").text(eval(amt) + eval(balance));
                                            } else {
                                                $("#amt_" + id).val('0.00');
                                                $("#amt_" + id).attr('disabled', 'disabled');
                                                var tamt = 0.00;
                                                $(".amt_box").each(function() {
                                                    tamt = eval(tamt) + eval($(this).val());
                                                });
                                                $("#show_total_amt").text(tamt);
                                            }
                                        }

                                        function checkAddedAmt() {
                                            var amt = 0.00;
                                            $(".amt_box").each(function() {
                                                amt = eval(amt) + eval($(this).val());
                                            });
                                            $("#show_total_amt").text(amt);
                                        }

                                        function saveVoucherPayment(cid) {
                                            var added_amt = $("#show_total_amt").text();
                                            var vcr_amt =<?= $vc->amount; ?>;
                                            if (vcr_amt == '') {
                                                alert('Add amount to Reconcile Bill Amount with voucher');
                                                return false;
                                            } else
                                            if (added_amt > vcr_amt) {
                                                alert('You can\'t add amount more than voucher amount');
                                                return false;
                                            } else if (vcr_amt < added_amt) {
                                                alert('You can\'t add less amount of voucher amount');
                                                return false;
                                            } else {
                                              $("#bill_btn").attr('disabled','disabled');
                                                var url = '<?php echo $this->createUrl('offshelfsale/savevoucher') ?>';
                                                $.post(url, $("#reconcile_form").serialize(), function(result) {
                                                   $("#bill_btn").removeAttr('disabled');
                                                    var result = jQuery.parseJSON(result);
                                                    if (result.msg == 'success') {
                                                        $("#show_err_msg").html('Amount has been reconciled with voucher ').addClass('alert alert-success').removeClass('alert-danger');
                                                        setInterval(function() {
                                                            window.location.href = '<?php echo $this->createUrl("offshelfsale/ledger") ?>?cid=' + cid;
                                                        }, 2000);
                                                    } else {
                                                        $("#show_err_msg").html('Please enter correct details').addClass('alert alert-danger').removeClass('alert-success');
                                                    }
                                                });
                                            }//if
                                        }

                                        function reviewpost(id) {
                                            $.ajax({
                                                url: '<?php echo $this->createUrl('offshelfsale/getitem') ?>',
                                                data: {'invoice_id': id},
                                                success: function(response) {
                                                    $('#invoicedetails').html(response);
                                                    $('#myModal6').modal('show');
                                                }
                                            });
                                        }
                                        function paydetails(id) {
                                            $.ajax({
                                                url: '<?php echo $this->createUrl('offshelfsale/getpayitem') ?>',
                                                data: {'invoice_id': id},
                                                success: function(response) {
                                                    $('#invoicepaydetails').html(response);
                                                    $('#myModal8').modal('show');
                                                }
                                            });
                                        }
                                        function invoicepay(id) {
                                            $("#invoice_id").val(id);
                                            $('#myModal7').modal('show');
                                        }

</script>