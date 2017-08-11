<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'expenseinvoice-form',
        ));
?>
<input type="hidden" name="invoice_id" id="invoice_id" value="<?php echo $imodel->id ?>">
<input type="hidden" name="state_code" id="state_code" value="<?php echo $imodel->state_code ?>">
<input type="hidden" name="is_reverse_item" id="is_reverse_item">
<input type="hidden" name="invoice_item_id" id="invoice_item_id">
<div class="row">
    <div class="col-lg-12">
        <div class="bg-lightblue">
            <div class="row">
                <div class='col-lg-4'>
                    <label>Item (List can take time to load W.R.T Internet Speed.)</label>     
                    <select id="item_id" name="item_id" class="form-control select2">
                        <option value="">--Select Item Name--</option>
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
                <div class='col-lg-3'>
                    <label>Vendor HSN/SAC</label>     
                    <input name="vendor_hsn_sac_code" id="vendor_hsn_sac_code" class="form-control" placeholder="Enter code here" type="text" >
                </div>
                <div class='col-lg-3'>
                    <label>Vendor Tax <span id="vendor_tax_percent_label"></span>(%)</label>          
                    <input name="vendor_tax_percent" id="vendor_tax_percent" class="form-control" placeholder="Tax %" type="number">
                </div>
                <div class='col-lg-3'>
                    <label>Amount</label>     
                    <input name="amount" id="Expenseinvoice_item_amount" class="form-control" placeholder="Amount" type="text">
                </div>
                <div class='col-lg-3'>
                    <?php if ($imodel->discount_type == "item_discount") { ?>
                        <label>Discount</label>     
                        <input type="number" id="discount" name="discount" class="form-control">  
                    <?php } ?>
                </div>
            </div>
            <br/>
            <div class="row"> 
                <div class='col-lg-3'>
                    <label>Item Tax Type</label>     
                    <input name="item_tax_type" id="Expenseinvoice_item_tax_type" class="form-control" placeholder="Item Tax Type" 
                           value="<?php
                           if ($imodel->place_of_supply == "1") {
                               echo "IGST";
                           } else {
                               echo "CGST/SGST";
                           }
                           ?>"
                           readonly type="text">
                </div>
                <div class='col-lg-3'>
                    <label>Tax (%)</label>     
                    <input name="tax_percent_rate" id="Expenseinvoice_tax_percent_rate" class="form-control" placeholder="Tax (%)" readonly type="text">
                </div>
                <div class='col-lg-3' style="display:none;" id="checkuttax">
                    <label>UT Tax (%)</label>     
                    <input name="ut_rate" id="Expenseinvoice_ut_rate" class="form-control" placeholder="UT Tax (%)" type="number">
                </div>
                <div class='col-lg-3'>
                    <label>CESS Tax (%)</label>     
                    <input name="cess_rate" id="Expenseinvoice_cess_rate" class="form-control" placeholder="CESS Tax (%)" type="number">
                </div>
            </div>
            <br/>
            <label>Particulars</label>     
            <textarea name="particulars" id="Expenseinvoice_item_particulars" class="form-control" placeholder="Particulars" rows="3" cols="15"></textarea>

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
    <div id="show_content_item" class="table-responsive"></div>
</div>
<div class="col-md-12">
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
        <td class='text-right' style="color:#fff;">AAA</td>
    </tr>
    </table>    
    <div id="show_bill_content" class="table-responsive"></div>
    <div class="row">
        <div class="pull-right" style="margin-right:12px;">
          <input type="button" class="btn btn-primary" id="submit" value="Save & Send to Review"/>
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
//        $("#submit").attr('disabled', 'disabled');
        $("#item_id").focus();
        var itemid = 0;
        Getvendoritems(itemid);
<?php if (!empty($imodel->id)) { ?>
            getpartial(<?php echo $imodel->id; ?>);
            getbillpartial(<?php echo $imodel->id;?>);
<?php } ?>
   <?php if($imodel->place_of_supply=="1") {?>
            checkuttax(<?php echo $imodel->state_code?>);
   <?php }?>    
    
        $("#item_id").change(function() {
            var id = $(this).val();
            $.ajax({
                url: '<?php echo $this->createUrl('expenseinvoice/getitems') ?>',
                data: {'id': id},
                type: 'get',
                dataType: 'JSON',
                cache: false,
                success: function(response) {
                    $('#hsn_sac_code').val(response.items.hsn_sac_code);
                    $('#tax_percent').val(response.items.tax_percent);
                    $('#Expenseinvoice_cess_rate').val(response.items.cess_tax);
                    $('#vendor_tax_percent_label').html(response.items.tax_percent);
                    <?php if($imodel->place_of_supply=="1") {?>
                    $('#Expenseinvoice_tax_percent_rate').val(response.items.tax_percent);
                    <?php }else{?>
                    $('#Expenseinvoice_tax_percent_rate').val(eval(response.items.tax_percent/2)+" / "+eval(response.items.tax_percent/2));    
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
            var form = $('#expenseinvoice-form').serialize();
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
            }else if ($("#Expenseinvoice_item_amount").val() == "") {
                alert("Amount Required");
                $("#Expenseinvoice_item_amount").focus();
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
                    url: '<?php echo $this->createUrl('expenseinvoice/addinvoiceitem') ?>',
                    data: form + '&YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>'+'&choice_tax='+choice_tax,
                    type: 'post',
                    cache: false,
                    success: function(response) {
                        $("#additem").removeAttr('disabled').html('Add Item');
                        $('#expenseinvoice-form')[0].reset();
                        $("#invoice_item_id").val('');
                        $("#item_id").val('0');
                        getpartial(invoice_id);
                    }
                });
                return true; 
                
              });                   
               }else{
                $("#additem").attr('disabled', 'disabled').html("Submiting...");
                $.ajax({
                    url: '<?php echo $this->createUrl('expenseinvoice/addinvoiceitem') ?>',
                    data: form + '&YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>',
                    type: 'post',
                    cache: false,
                    success: function(response) {
                        $("#additem").removeAttr('disabled').html('Add Item');
                        $('#expenseinvoice-form')[0].reset();
                        $("#invoice_item_id").val('');
                        $("#item_id").val('0');
                        getpartial(invoice_id);
                    }
                });
                return true;  
               }
            }
        });

        $('#edititem').click(function() {
            var form = $('#expenseinvoice-form').serialize();
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
                        url: '<?php echo $this->createUrl('expenseinvoice/editinvoiceitem') ?>',
                        data: form + '&YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>'+'&choice_tax='+choice_tax,
                        type: 'post',
                        cache: false,
                        success: function(response) {
                            $("#edititem").removeAttr('disabled').html('Edit & Save');
                            $("#edititem").hide();
                            $("#itemname").hide();
                            $("#additem").show();
                            $('#expenseinvoice-form')[0].reset();
                            $("#invoice_item_id").val('');
                            $("#item_id").val('0');
                            getpartial(invoice_id);
                        }
                    });
                });                   
               }else{
                  $("#edititem").attr('disabled', 'disabled').html("Submiting...");
                    $.ajax({
                        url: '<?php echo $this->createUrl('expenseinvoice/editinvoiceitem') ?>',
                        data: form + '&YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>',
                        type: 'post',
                        cache: false,
                        success: function(response) {
                            $("#edititem").removeAttr('disabled').html('Edit & Save');
                            $("#edititem").hide();
                            $("#itemname").hide();
                            $("#additem").show();
                            $('#expenseinvoice-form')[0].reset();
                            $("#invoice_item_id").val('');
                            $("#item_id").val('0');
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
                url: '<?php echo $this->createUrl('expenseinvoice/processinvoice') ?>',
                data: {'invoice_id': invoice_id,'round_off_amount':round_off,'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
                type: 'post',
                cache: false,
                success: function(response) {
                    $("#submit").removeAttr('disabled').html('Save & Send to Review');
                    setInterval(function() {
                        window.location.href = "<?php echo $this->createUrl('expenseinvoice/admin') ?>";
                    }, 1000);
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
            url: '<?php echo $this->createUrl('expenseinvoice/checkuttax') ?>',
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
            url: '<?php echo $this->createUrl('expenseinvoice/getinvoicedata') ?>',
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
            url: '<?php echo $this->createUrl('expenseinvoice/getinvoicebilldata') ?>',
            data: {'invoice_id': invoice_id, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
            type: 'post',
            success: function(response) {
                $('#show_bill_content').html(response);
                $('#show_bill_content').focus();
            }
        });
    }

    function Getvendoritems(item_id) {
        $("#item_id").html("");
        // $(".loading4").html("<img src='<?php //echo Yii::app()->baseUrl          ?>/img/loading.gif'>");
        $.getJSON("<?php echo $this->createUrl('expenseinvoice/getitemlist'); ?>", function(data) {
            $(".loading4").html("");
            var content = "";
            content += '<option value="">--Select Item Name--</option>';
            $.each(data.items, function(i, ct) {
                if (item_id == ct.id) {
                    content += '<option value="' + ct.id + '" selected="selected">' + ct.gs_name + '</option>';
                } else {
                    content += '<option value="' + ct.id + '">' + ct.gs_name + '</option>';
                }
            });
            $("#item_id").html(content);
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