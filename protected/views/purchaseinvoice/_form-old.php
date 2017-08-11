<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'purchaseinvoice-form',
        ));
?>
<input type="hidden" name="invoice_id" id="invoice_id" value="<?php echo $imodel->id ?>">
<input type="hidden" name="state_code" id="state_code" value="<?php echo $imodel->state_code ?>">
<input type="hidden" name="is_reverse_item" id="is_reverse_item">
<input type="hidden" name="invoice_item_id" id="invoice_item_id">
<div class="row">
    <div class="col-lg-12">
        <div class="bg-lightgreen">
            <div class="row">
                <div class='col-lg-4'>
                    <label>Item (List can take time to load W.R.T Internet Speed.)</label>     
                    <select id="item_id" name="item_id" class="form-control select2">
                        <option value="">--Select/Type Item Name--</option>
                    </select>
                </div>
                <div class='col-lg-3' id="itemname" style="display:none;">
                    <label>Item</label>  
                    <input type="text" id="item_name" class="form-control" readonly>
                </div>               
                <div class='col-lg-3'>
                    <label>HSN/SAC code</label>     
                    <input name="hsn_sac_code" id="hsn_sac_code" class="form-control" placeholder="HSN/SAC Code" type="text" readonly="readonly">
                </div>
                <div class='col-lg-2'>
                    <label>Tax in %</label>     
                    <input name="tax_percent" id="tax_percent" class="form-control" placeholder="Tax %" type="number" readonly="readonly">
                </div>
            </div>
            <br/>    
            <div class="row"> 
                <div class='col-lg-2'>
                    <label>Vendor HSN/SAC</label>     
                    <input name="vendor_hsn_sac_code" id="vendor_hsn_sac_code" class="form-control" placeholder="Enter code here" type="text" >
                </div>
                <div class='col-lg-2'>
                    <label>Vendor Tax <span id="vendor_tax_percent_label"></span>(%)</label>          
                    <input name="vendor_tax_percent" id="vendor_tax_percent" class="form-control" placeholder="Tax %" type="number">
                </div>
                <div class='col-lg-2'>
                    <label>Vendor Qty</label>     
                    <input name="v_qty" id="Purchaseinvoice_item_v_qty" class="form-control" placeholder="Qty" type="number">
                </div>
                <div class='col-lg-2 is_good_section'>
                    <label>Scale</label>  
                    <select id="v_scale" name="v_scale" class="form-control">
                        <option value="">-</option>
                    </select>
                </div>
                <div class='col-lg-2 is_good_section'>
                    <label>Conversion</label>     
                    <select id="input_type" name="input_type" class="form-control">
                    </select>
                </div>
                <div class='col-lg-2' id="convertvalue" style="display:none;">
                    <label>Unit Value <span class="stock_taking_label"></span></label>     
                    <input name="c_unit_value" id="Purchaseinvoice_item_c_unit_value" class="form-control" placeholder="Unit Value" type="text">
                </div>
            </div>
            <br/>
            <div class="row"> 
                <div class='col-lg-2'>
                    <label>Stock Qty <span class="stock_taking_label"></span></label>     
                    <input name="stock_qty" id="Purchaseinvoice_item_stock_qty" class="form-control" placeholder="Stock Qty" type="number"> 
                    <input type="hidden" name="stock_taking_scale" id="stock_taking_scale">
                </div>
                <div class='col-lg-2'>
                    <label>Rate <span id="convert_label">(Per S-Qty)</span></label>     
                    <input name="rate" id="Purchaseinvoice_item_rate" class="form-control" placeholder="Rate" type="text"> 
                </div>
                <div class='col-lg-2'>
                    <label>Amount</label>     
                    <input name="amount" id="Purchaseinvoice_item_amount" class="form-control" placeholder="Amount" readonly type="text">
                </div>
                <div class='col-lg-2'>
                    <?php if ($imodel->discount_type == "item_discount") { ?>
                        <label>Discount</label>     
                        <input type="number" id="discount" name="discount" class="form-control">  
                    <?php } ?>
                </div>
               <div class='col-lg-2'>
                    <label>MRD Label</label>     
                    <select id="is_mrd" name="is_mrd" class="form-control">
                        <option value="">-</option>
                    </select>
                </div>
            </div>
            <br/>
            <div class="row"> 
                <div class='col-lg-2'>
                    <label>Item Tax Type</label>     
                    <input name="item_tax_type" id="Purchaseinvoice_item_tax_type" class="form-control" placeholder="Item Tax Type" 
                           value="<?php
                           if ($imodel->place_of_supply == "1") {
                               echo "IGST";
                           } else {
                               echo "CGST/SGST";
                           }
                           ?>"
                           readonly type="text">
                </div>
                <div class='col-lg-2'>
                    <label>Tax (%)</label>     
                    <input name="tax_percent_rate" id="Purchaseinvoice_tax_percent_rate" class="form-control" placeholder="Tax (%)" readonly type="text">
                </div>
                <div class='col-lg-2' style="display:none;" id="checkuttax">
                    <label>UT Tax (%)</label>     
                    <input name="ut_rate" id="Purchaseinvoice_ut_rate" class="form-control" placeholder="UT Tax (%)" type="number">
                </div>
                <div class='col-lg-2'>
                    <label>CESS Tax (%)</label>     
                    <input name="cess_rate" id="Purchaseinvoice_cess_rate" class="form-control" placeholder="CESS Tax (%)" type="number">
                </div>
            </div>
            <br/>
            <div id="mrdform" style="display:none;">
                <div class="row">
                    <div class='col-md-3'>
                        <label>Batch No  <span id="mrderror" style="color:#c40000;"></span></label>     
                        <input name="mrd_no" id="Purchaseinvoice_item_mrd_no" class="form-control" placeholder="Batch No." type="text">
                    </div>
                    <div class='col-md-3'>
                        <label>Make Date<span class="required">*</span></label><br/>
                        <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => 'make_date',
                            'id' => 'make_date',
                            'value' => Yii::app()->request->getPost('make_date'),
                            'options' => array(
                                'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
                            ),
                            'htmlOptions' => array(
                                'style' => '',
                                //'readonly' => 'readonly'
                                'placeholder' => 'Make Date', 'class' => 'form-control',
                            ),
                        ));
                        ?>
                    </div>
                    <div class='col-md-3'>
                        <label>Processed Date<span class="required">*</span></label><br/>
                        <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => 'ready_date',
                            'id' => 'ready_date',
                            'value' => Yii::app()->request->getPost('ready_date'),
                            'options' => array(
                                'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
                            ),
                            'htmlOptions' => array(
                                'style' => '',
                                //'readonly' => 'readonly'
                                'placeholder' => 'Processed Date', 'class' => 'form-control',
                            ),
                        ));
                        ?>
                    </div>
                    <div class='col-md-3'>
                        <label>Discard Date<span class="required">*</span></label><br/>
                        <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => 'discard_date',
                            'id' => 'discard_date',
                            'value' => Yii::app()->request->getPost('discard_date'),
                            'options' => array(
                                'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
                            ),
                            'htmlOptions' => array(
                                'style' => '',
                                //'readonly' => 'readonly'
                                'placeholder' => 'Discard Date', 'class' => 'form-control',
                            ),
                        ));
                        ?>
                    </div>
                </div>  
            </div><br/>
            <label>Particulars</label>     
            <textarea name="particulars" id="Purchaseinvoice_item_particulars" class="form-control" placeholder="Particulars" rows="3" cols="15"></textarea>

            <br/>    
            <div class="pull-right" style="margin-top:12px;">
                <input type="button" class="btn savebtn btn-default" id="additem" value="Add Item"/>
                <input type="button" class="btn savebtn btn-default" id="edititem" value="Edit & Save" style="display:none;"/>
            </div>
            <div style="clear:both"></div>
        </div>
    </div>
</div><br/>
<?php $this->endWidget(); ?>
<div class="col-lg-12">
<?php if (!empty($imodel->id)) { ?>
<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'invoice-form',
    ));
?>
<legend style="padding-left:12px;"> Add Charges after added all items </legend>
<div id="other_charges"> 
<input type="hidden" name="invoicemain_id" id="invoicemain_id" value="<?php echo $imodel->id?>">
<div class="bg-lightgreen" style="padding:10px;">
<?php foreach(Invoicesettings::model()->findAllByAttributes(array('type'=>'bill_cost')) as $isetting){
 $cother=Invoicebilltax::model()->findByAttributes(array("invoice_id"=>$imodel->id,"invoice_settings_id"=>$isetting->id));
    ?>
<div class="col-md-3">
    <label><?php echo $isetting->label?></label>
    <input type="text" name="billcost_<?php echo $isetting->id?>" class="form-control" value="<?php  if(isset($cother->tax_percent)){ echo $cother->tax_percent; }?>">
</div>
<?php }?>
<div style="clear:both"></div>
</div>  
<div class="pull-right" style="margin-top:12px;">
    <input type="button" class="btn btn-green" id="btncharges" value="Add Charges"/>
</div>
    <div style="clear:both"></div>
</div><br/>
<?php $this->endWidget(); ?>
<?php }?>
</div>
<div class="col-lg-12">
    <div id="show_content_item" class="table-responsive"></div>
</div>
<div class="col-md-12">
      <div id="show_bill_content" class="table-responsive"></div>
   <?php
    $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
        'id' => 'invoice-form',
        ));
    ?>
    <input type="hidden" name="invoicemain_id" id="invoicemain_id" value="<?php echo $imodel->id?>">
    <table class="table table-bordered">
        <tr>
        <td colspan="12">
            <b>Add Round Off amount in Final Amount</b>
        </td>
        <td class='text-right'  colspan="4" style="color:#fff;">CGST Rate</td>
        <td class='text-right' style="color:#fff;">CGST Amt.</td>
        <td class='text-right' style="color:#fff;">SGST Rate</td>
        <td class='text-right' style="color:#fff;">SGST Amt.</td>
        <td class='text-right' style="color:#fff;">SGST Amt.</td>
        <td class='text-right' style="color:#fff;">SGST Amt.</td>
        <td class='text-right' style="color:#fff;">SGST Amt.</td>
        <td align="right">
            <input type="text" style="width:60px;" class="form-control" name="round_off_amount" id="round_off_amount" value="<?php echo $imodel->round_off?>"/> 
        </td>
        <td class='text-right' style="color:#fff;">A</td>
    </tr>
    </table>
    <div class="row">
        <div class="col-lg-10">
            <div style="color:#dd4b39"><h4>Save & Send to Review button will get activated once you click Add Charges button right above.</h4></div>
        </div>
        <div class="col-lg-2" style="margin-right:0px;">
          <input type="button" class="btn btn-green" id="submit" value="Save & Send to Review"/>
        </div>
    </div>
    <div style="clear:both"></div>
    <?php $this->endWidget(); ?>    
</div>
<br/>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/front/libs/jquery/jquery-1.11.2.min.js"></script>    
<script src="<?php echo Yii::app()->request->baseUrl; ?>/front/bootstrap.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/front/bootbox.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#submit").attr('disabled', 'disabled');
        $("#item_id").focus();
        var scale = 0;
        var type = "";
        var ismrd = "";
        var itemid = 0;
        GetScale(scale);
        GetItype(type);
        GetMrd(ismrd);
        scheduled(itemid);
        Getvendoritems(itemid);
<?php if (!empty($imodel->id)) { ?>
            getpartial(<?php echo $imodel->id; ?>);
            getbillpartial(<?php echo $imodel->id;?>);
<?php } ?>
   <?php if($imodel->place_of_supply=="1") {?>
            checkuttax(<?php echo $imodel->state_code?>);
   <?php }?>    
    
<?php if (!empty($imodel->vendor_id)) { ?>
            var cid = 0;
            var vid = <?php echo $imodel->vendor_id ?>;
            GetItems(vid, cid);
<?php } ?>

        $("#Purchaseinvoice_item_v_qty").blur(function() {
            var vqty = $(this).val();
            var input_type = $("#input_type").val();
            if (input_type == "Direct") {
                $("#Purchaseinvoice_item_stock_qty").val(vqty);
            }
        });

        $("#Purchaseinvoice_item_c_unit_value").blur(function() {
            var cvalue = $(this).val();
            var vqty = $('#Purchaseinvoice_item_v_qty').val();
            var netqty = parseFloat(cvalue) * parseFloat(vqty);
            $("#Purchaseinvoice_item_stock_qty").val(netqty);
        });

        $("#Purchaseinvoice_item_rate").blur(function() {
            var vqty = $('#Purchaseinvoice_item_v_qty').val();
            var sqty = $('#Purchaseinvoice_item_stock_qty').val();
            var uprice = $("#Purchaseinvoice_item_rate").val();
            var input_type = $("#input_type").val();
            if (input_type == "Direct") {
                var amt = ((parseFloat(sqty) * parseFloat(uprice)));
            } else {

                var amt = ((parseFloat(vqty) * parseFloat(uprice)));
            }
            $("#Purchaseinvoice_item_amount").val(amt.toFixed(2));
        });

        $("#Purchaseinvoice_item_mrd_no").blur(function() {
            var mrd = $(this).val();
            $.ajax({
                url: '<?php echo $this->createUrl('purchaseinvoice/checkmrdno') ?>',
                data: {'mrd': mrd},
                type: 'get',
                dataType: 'JSON',
                cache: false,
                success: function(response) {
                    if (response.msg == "1") {
                        alert("Batch No. already Exists");
                        $("#additem").attr('disabled', 'disabled');
                    } else {
                        $("#additem").removeAttr('disabled');
                    }
                }
            });
        });

        $("#input_type").change(function() {
            var input_type = $(this).val();
            if (input_type == "Convert") {
                $("#convert_label").html("(Per V-Qty)");
                $("#convertvalue").fadeIn(1000).slideDown();
            } else {
                $("#convert_label").html("(Per S-Qty)");
                $("#convertvalue").fadeOut(1000);
            }
        });

        $("#is_mrd").change(function() {
            var input_type = $(this).val();
            if (input_type == "Yes") {
                $("#mrdform").fadeIn(1000).slideDown();
            } else {
                $("#mrdform").fadeOut(1000);
            }
        });


        $("#item_id").change(function() {
            var id = $(this).val();
            $.ajax({
                url: '<?php echo $this->createUrl('purchaseinvoice/getitems') ?>',
                data: {'id': id},
                type: 'get',
                dataType: 'JSON',
                cache: false,
                success: function(response) {
                    if (response.items.is_schedule == "1") {
                        $("#scheduled_alert").fadeIn(1000).slideDown();
                    }                    
                    $('.stock_taking_label').html("(" + response.items.item_scale + ")");
                    $('#stock_taking_scale').val(response.items.scale);
                    $('#hsn_sac_code').val(response.items.gst_code);
                    $('#stock_taking_scale').val(response.items.item_scale);
                    $('#tax_percent').val(response.items.gst_percent);
                    $('#Purchaseinvoice_cess_rate').val(response.items.cess_tax);
                    $('#vendor_tax_percent_label').html(response.items.gst_percent);
                    <?php if($imodel->place_of_supply=="1") {?>
                    $('#Purchaseinvoice_tax_percent_rate').val(response.items.gst_percent);
                    <?php }else{?>
                    $('#Purchaseinvoice_tax_percent_rate').val(eval(response.items.gst_percent/2)+" / "+eval(response.items.gst_percent/2));    
                    <?php }?>             
                     
                    if(response.items.item_classification=="Reverse-Charge"){
                     $("#is_reverse_item").val("1");  
                      }else{
                    $("#is_reverse_item").val("0");   
                      }   
                     check_gsttype(response.items.goods_service);   
                    }
            });
        });

        $('#additem').click(function() {
            var form = $('#purchaseinvoice-form').serialize();
            var invoice_id = $('#invoice_id').val();
            var tax_percent = $('#tax_percent').val();
            var vendor_tax_percent = $('#vendor_tax_percent').val();
            if ($("#item_id").val() == "") {
                alert("Select Item");
                $("#item_id").focus();
                return false;
            } else if ($("#vendor_tax_percent").val() == "") {
                alert("Vendor Tax Required");
                $("#vendor_tax_percent").focus();
                return false;
            } else if ($("#Purchaseinvoice_item_v_qty").val() == "") {
                alert("Vendor Qty Required");
                $("#Purchaseinvoice_item_v_qty").focus();
                return false;
            } else if ($("#Purchaseinvoice_item_stock_qty").val() == "") {
                alert("Stock Qty Required");
                $("#Purchaseinvoice_item_stock_qty").focus();
                return false;
            } else if ($("#Purchaseinvoice_item_rate").val() == "") {
                alert("Rate Per V-Qty Required");
                $("#Purchaseinvoice_item_rate").focus();
                return false;
            } else {
               if(tax_percent!=vendor_tax_percent){
                   confirm_boot('It seems that 2 different GST tax rate has been applied to this goods purchase, Kindly select either "VENDOR TAX" or "SELF ASSIGNED HSN/SAC BASED TAX" Which has to be assigned to this goods transaction.', function(result) {
                //console.log("Confirmed? " + result);
                var choice_tax="";
                if (result) {
                    choice_tax=1;
                }else{
                    choice_tax=0;
                }
                $("#additem").attr('disabled', 'disabled').html("Submiting...");
                $.ajax({
                    url: '<?php echo $this->createUrl('purchaseinvoice/addinvoiceitem') ?>',
                    data: form + '&YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>'+'&choice_tax='+choice_tax,
                    type: 'post',
                    cache: false,
                    success: function(response) {
                        $("#additem").removeAttr('disabled').html('Add Item');
                        $('#purchaseinvoice-form')[0].reset();
                        $("#invoice_item_id").val('');
                        $("#item_id").val('0');
                        $("#v_scale").val('0');
                        $("#input_type").val('');
                        $("#is_mrd").val('');
                        $("#convertvalue").hide();
                        GetItype('Direct');
                        getpartial(invoice_id);
                    }
                });
                return true; 
                
              });                   
               }else{
                $("#additem").attr('disabled', 'disabled').html("Submiting...");
                $.ajax({
                    url: '<?php echo $this->createUrl('purchaseinvoice/addinvoiceitem') ?>',
                    data: form + '&YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>'+'&choice_tax=0',
                    type: 'post',
                    cache: false,
                    success: function(response) {
                        $("#additem").removeAttr('disabled').html('Add Item');
                        $('#purchaseinvoice-form')[0].reset();
                        $("#invoice_item_id").val('');
                        $("#item_id").val('0');
                        $("#v_scale").val('0');
                        $("#input_type").val('');
                        $("#is_mrd").val('');
                        $("#convertvalue").hide();
                        GetItype('Direct');
                        getpartial(invoice_id);
                    }
                });
                return true;  
               }
            }
        });

        $('#edititem').click(function() {
            var form = $('#purchaseinvoice-form').serialize();
            var invoice_id = $('#invoice_id').val();
            var tax_percent = $('#tax_percent').val();
            var vendor_tax_percent = $('#vendor_tax_percent').val();
            if(tax_percent!=vendor_tax_percent){
                   confirm_boot('It seems that 2 different GST tax rate has been applied to this goods purchase, Kindly select either "VENDOR TAX" or "SELF ASSIGNED HSN/SAC BASED TAX" Which has to be assigned to this goods transaction.', function(result) {
                //console.log("Confirmed? " + result);
                var choice_tax="";
                if (result) {
                    choice_tax=1;
                }else{
                    choice_tax=0;
                }
                    $("#edititem").attr('disabled', 'disabled').html("Submiting...");
                    $.ajax({
                        url: '<?php echo $this->createUrl('purchaseinvoice/editinvoiceitem') ?>',
                        data: form + '&YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>'+'&choice_tax='+choice_tax,
                        type: 'post',
                        cache: false,
                        success: function(response) {
                            $("#edititem").removeAttr('disabled').html('Edit & Save');
                            $("#edititem").hide();
                            $("#itemname").hide();
                            $("#additem").show();
                            $('#purchaseinvoice-form')[0].reset();
                            $("#invoice_item_id").val('');
                            $("#item_id").val('0');
                            $("#v_scale").val('0');
                            $("#input_type").val('');
                            $("#is_mrd").val('');
                            $("#convertvalue").hide();
                            GetItype('Direct');
                            getpartial(invoice_id);
                        }
                    });
                });                   
               }else{
                  $("#edititem").attr('disabled', 'disabled').html("Submiting...");
                    $.ajax({
                        url: '<?php echo $this->createUrl('purchaseinvoice/editinvoiceitem') ?>',
                        data: form + '&YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>'+'&choice_tax=0',
                        type: 'post',
                        cache: false,
                        success: function(response) {
                            $("#edititem").removeAttr('disabled').html('Edit & Save');
                            $("#edititem").hide();
                            $("#itemname").hide();
                            $("#additem").show();
                            $('#purchaseinvoice-form')[0].reset();
                            $("#invoice_item_id").val('');
                            $("#item_id").val('0');
                            $("#v_scale").val('0');
                            $("#input_type").val('');
                            $("#is_mrd").val('');
                            $("#convertvalue").hide();
                            GetItype('Direct');
                            getpartial(invoice_id);
                        }
                    }); 
            }

        });
        
        $('#submit').click(function() {
            var invoice_id =<?php echo $imodel->id ?>;
            var round_off=$("#round_off_amount").val();
            $("#submit").attr('disabled', 'disabled').html("Submiting...");
            $.ajax({
                url: '<?php echo $this->createUrl('purchaseinvoice/processinvoice') ?>',
                data: {'invoice_id': invoice_id,'round_off_amount':round_off,'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
                type: 'post',
                cache: false,
                success: function(response) {
                    $("#submit").removeAttr('disabled').html('Save & Send to Review');
                    setInterval(function() {
                        window.location.href = "<?php echo $this->createUrl('purchaseinvoice/admin') ?>";
                    }, 1000);
                }
            });
        });

        $('#btncharges').click(function() {
            var form = $('#invoice-form').serialize();
            var invoice_id=$("#invoicemain_id").val();
            $("#btncharges").attr('disabled', 'disabled').html("Submiting...");
            $.ajax({
                url: '<?php echo $this->createUrl('purchaseinvoice/completeinvoice') ?>',
                data: form+'&YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>',
                type: 'post',
                cache: false,
                success: function(response) {
                    $("#btncharges").removeAttr('disabled').html('Add Charges');
                    $('#invoice-form')[0].reset();
                    $("#submit").removeAttr('disabled').html('Save & Send to Review');
                    getbillpartial(invoice_id);
                }
            });
         });         
    });
    
    function check_gsttype(goods_service){
    if(goods_service=="Services") {
        $('.is_good_section').hide();
        }else{
        $('.is_good_section').show();    
        }
    }
    function checkuttax(statecode) {
    $.ajax({
            url: '<?php echo $this->createUrl('purchaseinvoice/checkuttax') ?>',
            data: {'statecode': statecode, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
            type: 'post',
            success: function(response) {
             if(response=="1"){
                $('#checkuttax').show();
             }
            }
        });
    }

    function getpartial(invoice_id) {
        $.ajax({
            url: '<?php echo $this->createUrl('purchaseinvoice/getinvoicedata') ?>',
            data: {'invoice_id': invoice_id, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
            type: 'post',
            success: function(response) {
                $('#show_content_item').html(response);
                $('#show_content_item').focus();
            }
        });
    }
    
    function getbillpartial(invoice_id) {
        $.ajax({
            url: '<?php echo $this->createUrl('purchaseinvoice/getinvoicebilldata') ?>',
            data: {'invoice_id': invoice_id, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
            type: 'post',
            success: function(response) {
                $('#show_bill_content').html(response);
                $('#show_bill_content').focus();
            }
        });
    }

    function GetScale(sid) {
        $("#v_scale").html("");
        $.getJSON("<?php echo $this->createUrl('purchaseinvoice/getScale'); ?>", function(data) {
            $(".loading4").html("");
            var content = "";
            content += '<option value="0">-</option>';
            $.each(data.items, function(i, ct) {
                if (sid == ct.id) {
                    content += '<option value="' + ct.id + '" selected="selected">' + ct.type_name + '</option>';
                } else {
                    content += '<option value="' + ct.id + '">' + ct.type_name + '</option>';
                }
            });
            $("#v_scale").html(content);
        });
    }
    function GetItype(type) {
        $("#input_type").html("");
        $.getJSON("<?php echo $this->createUrl('purchaseinvoice/getItype'); ?>", function(data) {
            $(".loading4").html("");
            var content = "";
            content += '';
            $.each(data.items, function(i, ct) {
                if (type == ct) {
                    content += '<option value="' + ct + '" selected="selected">' + ct + '</option>';
                } else {
                    content += '<option value="' + ct + '">' + ct + '</option>';
                }
            });
            $("#input_type").html(content);
        });
    }
    function GetMrd(ismrd) {
        $("#is_mrd").html("");
        $.getJSON("<?php echo $this->createUrl('purchaseinvoice/getMrd'); ?>", function(data) {
            $(".loading4").html("");
            var content = "";
            content += '';
            $.each(data.items, function(i, ct) {
                if (ismrd == ct) {
                    content += '<option value="' + ct + '" selected="selected">' + ct + '</option>';
                } else {
                    content += '<option value="' + ct + '">' + ct + '</option>';
                }
            });
            $("#is_mrd").html(content);
        });
    }
    function GetItems(vid, cid) {
        $("#item_id").html("<option value>--Select/Type Item Name--</option>");
        // $(".loading4").html("<img src='<?php //echo Yii::app()->baseUrl          ?>/img/loading.gif'>");
        $.getJSON("<?php echo $this->createUrl('purchaseinvoice/getList'); ?>", {"vid": vid}, function(data) {
            $(".loading4").html("");
            var content = "";
            var content = '<option value="">--Select/Type Item Name--</option>';
            $.each(data.items, function(i, ct) {
                if (cid == ct.purchase_item_id) {
                    content += '<option value="' + ct.purchase_item_id + '" selected="selected">' + ct.itemname + '(' + ct.brand + ')</option>';
                } else {
                    content += '<option value="' + ct.purchase_item_id + '">' + ct.itemname + '(' + ct.brand + ')</option>';
                }
            });
            $("#item_id").html(content);
        });
    }

    function Getvendoritems(item_id) {
        $("#item_id").html("");
        // $(".loading4").html("<img src='<?php //echo Yii::app()->baseUrl          ?>/img/loading.gif'>");
        $.getJSON("<?php echo $this->createUrl('purchaseinvoice/getitemlist'); ?>", function(data) {
            $(".loading4").html("");
            var content = "";
            content += '<option value="">--Select Items--</option>';
            $.each(data.items, function(i, ct) {
                if (item_id == ct.id) {
                    content += '<option value="' + ct.id + '" selected="selected">' + ct.itemname + '(' + ct.brand + ')</option>';
                } else {
                    content += '<option value="' + ct.id + '">' + ct.itemname + '(' + ct.brand + ')</option>';
                }
            });
            $("#item_id").html(content);
        });
    }

    function scheduled(itemid) {
        $.ajax({
            url: '<?php echo $this->createUrl('purchaseinvoice/getitemscale') ?>',
            data: {'id': itemid},
            type: 'get',
            dataType: 'JSON',
            cache: false,
            success: function(response) {
                if (response.is_schedule == "1") {
                    $("#scheduled_alert").fadeIn(1000).slideDown();
                }
                $('.stock_taking_label').html("(" + response.scale + ")");
                $('#stock_taking_scale').val(response.scale);
            }
        });
    }
    
    var confirm_boot = function(msg, callback) {
        bootbox.confirm({
            size: "large",
            title: '<i>TOC Application</i>',
            message: '<div style="font-size:18px;" class="alert alert-danger">' + msg + '</div>',
            buttons: {
                cancel: {
                    label: '<i class="fa fa-check"></i> SELF ASSIGNED HSN/SAC BASED TAX',
                },
                confirm: {
                    label: '<i class="fa fa-check"></i> VENDOR TAX',
                }
            },
            callback: function(result) {
                console.log('This was logged in the callback: ' + result);
                callback(result);
            }
        });
    }
</script>