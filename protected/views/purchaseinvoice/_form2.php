<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'purchaseinvoice-form',
    ));
?>
<input type="hidden" name="invoice_id" id="invoice_id" value="<?php echo $imodel->id?>">
<input type="hidden" name="invoice_item_id" id="invoice_item_id">
<div class="row">
<div class="col-md-8">
    <div class="bg-lightgreen">
    <div class="row">
         <?php if($imodel->invoice_type=="cash"){?>    
        <div class='col-md-4'>
         <label>Category</label>
          <select name="Purchaseinvoiceitems[p_category_id]" id="Purchaseinvoiceitems_p_category_id" class="form-control">
            <option value="">--Select Sub Category--</option>
        </select>
        </div>
        <div class='col-md-4'>
          <label>Sub Category</label>
        <select name="Purchaseinvoiceitems[p_sub_category_id]" id="Purchaseinvoiceitems_sub_category_id" class="form-control">
            <option value="">--Select Sub Category--</option>
        </select>
        </div>
         <?php }?>
         <div class='col-md-4'>
            <label>Item</label>     
            <select id="item_id" name="item_id" class="form-control"></select>
        </div>
    </div><br/>    
    <div class="row">        
        <div class='col-md-4'>
            <label>Particulars</label>     
            <input name="particulars" id="Purchaseinvoice_item_particulars" class="form-control" placeholder="Particulars" type="text">
        </div>
           <div class='col-md-2'>
            <label>Vendor Qty</label>     
            <input name="v_qty" id="Purchaseinvoice_item_v_qty" class="form-control" placeholder="Qty" type="text">
        </div>
        <div class='col-md-2'>
            <label>Scale</label>  
            <select id="v_scale" name="v_scale" class="form-control">
                <option value="">-</option>
            </select>
        </div>
         <div class='col-md-2'>
            <label>Conversion</label>     
            <select id="input_type" name="input_type" class="form-control">
            </select>
        </div>
        <div class='col-md-2-5' id="convertvalue" style="display:none;">
            <label>Unit Value <span class="stock_taking_label"></span></label>     
            <input name="c_unit_value" onchange="getprice(this.value)" id="Purchaseinvoice_item_c_unit_value" class="form-control" placeholder="Unit Value" type="text">
        </div>
    </div><br/>
    <div class="row">
        <div class='col-md-2-5'>
            <label>Stock Qty <span class="stock_taking_label"></span></label>     
            <input name="stock_qty" id="Purchaseinvoice_item_stock_qty" class="form-control" placeholder="Stock Quantity" type="text"> 
            <input type="hidden" name="stock_taking_scale" id="stock_taking_scale">
        </div>
        <div class='col-md-2-5'>
            <label>Rate (Per V-Qty)</label>     
            <input name="rate" onchange="getamount()" id="Purchaseinvoice_item_rate" class="form-control" placeholder="Rate" type="text"> 
        </div>
           <div class='col-md-2-5'>
            <label>Amount</label>     
            <input name="amount" id="Purchaseinvoice_item_amount" class="form-control" placeholder="Amount" readonly type="text">
        </div>
        <div class='col-md-2'>
            <label>MRD Label</label>     
            <select id="is_mrd" name="is_mrd" class="form-control">
                <option value="">-</option>
            </select>
        </div>
         <div class='col-md-2'>
            <?php if ($imodel->discount_type == "item_discount") { ?>
                <label>Discount</label>     
                <input type="text" id="discount" name="discount" class="form-control">  
            <?php } ?>
        </div>
    </div><br/>
    <div class="row">
    <?php if($imodel->invoice_format=="F1"){?>
    <?php foreach(Invoicesettings::model()->findAllByAttributes(array('type'=>'tax_in_items')) as $isetting){?>
    <div class="col-md-2">
        <label><?php echo $isetting->label?> (%)</label>
        <input type="text" id="taxtype_<?php echo $isetting->label?>" name="taxtype_<?php echo $isetting->id?>" class="form-control">
    </div>
    <?php }}else{?>
    <?php }?>
    </div>  
    <div class="row" id="scheduled_alert" style="display:none;">
         <div class='col-md-5'>
            <label>Schedule Date<span class="required">*</span></label><br/>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'schedule_date',
                'id' => 'schedule_date',
                'value' => $_POST['schedule_date'],
                'options' => array(
                    'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
                ),
                'htmlOptions' => array(
                    'style' => '',
                    //'readonly' => 'readonly'
                    'placeholder' => 'Schedule Date','class'=>'form-control',
                ),
            ));
            ?>
        </div>
        <div class='col-md-5'>
                <label>Remark</label>     
                <input type="text" id="remark" name="remark" class="form-control">  
        </div>
    </div><br/>   
    <div id="mrdform" style="display:none;">
    <div class="row">
        <div class='col-md-6'>
            <label>MRD No  <span id="mrderror" style="color:#c40000;"></span></label>     
            <input name="mrd_no" id="Purchaseinvoice_item_mrd_no" class="form-control" placeholder="MRD No." type="text">
        </div>
        <div class='col-md-6'>
            <label>Make Date<span class="required">*</span></label><br/>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'make_date',
                'id' => 'make_date',
                'value' => $_POST['make_date'],
                'options' => array(
                    'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
                ),
                'htmlOptions' => array(
                    'style' => '',
                    //'readonly' => 'readonly'
                    'placeholder' => 'Make Date','class'=>'form-control',
                ),
            ));
            ?>
        </div>
    </div>    
    <div class="row">
        <div class='col-md-6'>
            <label>Processed Date<span class="required">*</span></label><br/>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'ready_date',
                'id' => 'ready_date',
                'value' => $_POST['ready_date'],
                'options' => array(
                    'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
                ),
                'htmlOptions' => array(
                    'style' => '',
                    //'readonly' => 'readonly'
                    'placeholder' => 'Processed Date','class'=>'form-control',
                ),
            ));
            ?>
        </div>
        <div class='col-md-6'>
            <label>Discard Date<span class="required">*</span></label><br/>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'discard_date',
                'id' => 'discard_date',
                'value' => $_POST['discard_date'],
                'options' => array(
                    'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
                ),
                'htmlOptions' => array(
                    'style' => '',
                    //'readonly' => 'readonly'
                    'placeholder' => 'Discard Date','class'=>'form-control',
                ),
            ));
            ?>
        </div>
    </div>  
    </div><br/>    
    <div class="pull-right" style="margin-top:12px;">
        <input type="button" class="btn btn-default" id="additem" value="Add Item"/>
    </div>
    <div style="clear:both"></div>
</div>
</div>
<div class="col-md-4">
  <div id="show_content_item" class="table-responsive"></div>
</div>
</div>
<?php $this->endWidget(); ?>
<?php if (!empty($imodel->id)) { ?>
<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'invoice-form',
    ));
?>
<legend style="padding-left:12px;"> Add Charges after added all items </legend>
<div id="other_charges"> 
<input type="hidden" name="invoicemain_id" id="invoicemain_id" value="<?php echo $imodel->id?>">
<div class="row"> 
   <div class="col-md-8">
    <div class="bg-lightblue">
     <?php if($imodel->invoice_format=="F1"){?>
    <?php foreach(Invoicesettings::model()->findAllByAttributes(array('type'=>'bill_cost')) as $isetting){
     $cother=Invoicebilltax::model()->findByAttributes(array("invoice_id"=>$imodel->id,"invoice_settings_id"=>$isetting->id));
        ?>
    <div class="col-md-3">
        <label><?php echo $isetting->label?></label>
        <input type="text" name="billcost_<?php echo $isetting->id?>" class="form-control" value="<?php echo $cother->tax_percent?>">
    </div>
    <?php }}else{?>
    <?php foreach(Invoicesettings::model()->findAllByAttributes(array('type'=>'bill_cost')) as $isetting){
     $cother=Invoicebilltax::model()->findByAttributes(array("invoice_id"=>$imodel->id,"invoice_settings_id"=>$isetting->id));
        ?>
    <div class="col-md-3">
        <label><?php echo $isetting->label?></label>
        <input type="text" name="billcost_<?php echo $isetting->id?>" class="form-control" value="<?php echo $cother->tax_percent?>">
    </div>
    <?php }?>    
    <div class="col-md-3">
        <label>Select Tax </label>
        <select id="billcost_taxtype" name="billcost_taxtype" class="form-control">
            <option value="">-Select-</option>
            <?php foreach (Invoicesettings::model()->findAllByAttributes(array('type'=>'tax_in_items')) as $iset) {
            $ctax=Invoicebilltax::model()->findByAttributes(array("type"=>'tax',"invoice_id"=>$imodel->id,"invoice_settings_id"=>$iset->id));
            if($iset->id==$ctax->invoice_settings_id){
                ?>
            <option value="<?php echo $iset->id?>" selected="selected"><?php echo $iset->label?></option>
            <?php }else{ ?>
                <option value="<?php echo $iset->id?>"><?php echo $iset->label?></option>
            <?php }}?>    
       </select>
    </div>
  <?php $cbilltax=Invoicebilltax::model()->findByAttributes(array("invoice_id"=>$imodel->id,"type"=>'tax'));?>      
    <div class="col-md-3">
        <label>Tax (%)</label>
        <input type="text" name="billcost_tax" class="form-control" value="<?php echo number_format($cbilltax->tax_percent,"1");?>"> 
    </div>
    <?php }?>
    <div style="clear:both"></div>
    <div class="row" style="padding-left:15px;"> 
    <div class="col-md-3">
        <?php if ($imodel->discount_type == "bill_discount") { ?>     
            <label>Discount</label>     
            <input type="text" id="bill_discount" name="bill_discount" class="form-control" value="<?php echo $imodel->total_discount?>"> 
        <?php } ?>
    </div>
    </div>
    </div>  
    <div class="pull-right" style="margin-top:12px;">
        <input type="button" class="btn btn-green" id="btncharges" value="Add Charges"/>
    </div>
       <div style="clear:both"></div>
    </div>
    <div class="col-md-4">
      <div id="show_bill_content" class="table-responsive"></div>
    </div>
</div>
<br/> 
<div class="row pull-right" style="margin-right:0px;">
  <input type="button" class="btn btn-green" id="submit" value="Save & Send to Review"/>
</div>
<div style="clear:both"></div>
</div>
<?php $this->endWidget(); ?>
<?php }?><br/>  
<script src="<?php echo Yii::app()->request->baseUrl; ?>/bs/js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {
        var scale=0;
        var type="";
        var catid=0;
        var ismrd=0;
        var itemid=0;
        GetScale(scale);        
        GetItype(type);
        GetCategory(catid);
        GetMrd(ismrd);
        scheduled(itemid);
        
    <?php if (!empty($imodel->id)) { ?>
            getpartial(<?php echo $imodel->id;?>);
            getbillpartial(<?php echo $imodel->id;?>);
    <?php }?>        
    <?php if (!empty($imodel->vendor_id)) { ?>
        var cid = 0;
        var vid = <?php echo $imodel->vendor_id?>;
        GetItems(vid, cid);
    <?php }?> 
    
    $("#Purchaseinvoiceitems_p_category_id").change(function() {
            var scid = 0;
            var cid = $(this).val();
            GetSCategory(cid, scid);
     });
     
    $("#Purchaseinvoiceitems_p_category_id").change(function() {
            var scid = 0;
            var cid = $(this).val();
            GetSCategory(cid, scid);
     });
     
    $("#Purchaseinvoiceitems_sub_category_id").change(function() {
            var item_id = 0;
            var cid=$("#Purchaseinvoiceitems_p_category_id").val();
            var scid = $(this).val();
            Getvendoritems(cid, scid,item_id);
     });
     
    $("#Purchaseinvoice_item_v_qty").blur(function() {
        var vqty=$(this).val();
        var input_type = $("#input_type").val();
        if (input_type == "Direct") {
        $("#Purchaseinvoice_item_stock_qty").val(vqty);
        }
    });
    
    $("#Purchaseinvoice_item_mrd_no").blur(function() {
       var mrd=$(this).val();
        $.ajax({
            url: '<?php echo $this->createUrl('purchaseinvoice/checkmrdno') ?>',
            data: {'mrd': mrd},
            type: 'get',
            dataType: 'JSON',
            cache: false,
            success: function(response) {
              if(response.msg=="1"){
                 alert("MRD No. already Exists");  
                $("#additem").attr('disabled', 'disabled');
                }else{
                $("#additem").removeAttr('disabled');
            }
            }
        });
    });
     
    $("#input_type").change(function() {
        var input_type = $(this).val();
        if (input_type == "Convert") {
            $("#convertvalue").fadeIn(1000).slideDown();
        } else {
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
            url: '<?php echo $this->createUrl('purchaseinvoice/getitemscale') ?>',
            data: {'id': id},
            type: 'get',
            dataType: 'JSON',
            cache: false,
            success: function(response) {
              if(response.is_schedule=="1"){
                 $("#scheduled_alert").fadeIn(1000).slideDown();  
                }
                $('.stock_taking_label').html("(" + response.scale + ")");
                $('#stock_taking_scale').val(response.scale);
            }
        });
    });

    $('#additem').click(function() {
        var form = $('#purchaseinvoice-form').serialize();
         var invoice_id = $('#invoice_id').val();
         if($("#item_id").val()==""){
         alert("Select Item");  
         $("#item_id").focus();
         return false;
         }else if($("#Purchaseinvoice_item_v_qty").val()==""){
         alert("Vendor Qty Required");  
         $("#Purchaseinvoice_item_v_qty").focus();
         return false;
         }else if($("#Purchaseinvoice_item_stock_qty").val()==""){
         alert("Stock Qty Required");  
         $("#Purchaseinvoice_item_stock_qty").focus();
         return false;
         }else if($("#Purchaseinvoice_item_rate").val()==""){
         alert("Rate Per V-Qty Required");  
         $("#Purchaseinvoice_item_rate").focus();
         return false;
         }else{
        $("#additem").attr('disabled', 'disabled').html("Submiting...");
        $.ajax({
            url: '<?php echo $this->createUrl('purchaseinvoice/addinvoiceitem') ?>',
            data: form+'&YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>',
            type: 'post',
            cache: false,
            success: function(response) {
                alert(response);
                $("#additem").removeAttr('disabled').html('Add Item');
                $('#purchaseinvoice-form')[0].reset();
                $("#invoice_item_id").val('');
                getpartial(invoice_id);
            }
        });
        return true;
    }
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
                getbillpartial(invoice_id);
            }
        });
    });
    
    $('#submit').click(function() {
        var invoice_id=<?php echo $imodel->id?>;
        $("#submit").attr('disabled', 'disabled').html("Submiting...");
        $.ajax({
            url: '<?php echo $this->createUrl('purchaseinvoice/processinvoice') ?>',
            data: {'invoice_id': invoice_id, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
            type: 'post',
            cache: false,
            success: function(response) {
                $("#submit").removeAttr('disabled').html('Save & Send to Review');
                setInterval(function(){ 
                       window.location.href = "<?php echo $this->createUrl('purchaseinvoice/admin') ?>";
                }, 1000);
            }
        });
    });
    
  });

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

    function getprice(cvalue) {
        var vqty = $('#Purchaseinvoice_item_v_qty').val();
        var netqty = parseFloat(cvalue) * parseFloat(vqty);
        $("#Purchaseinvoice_item_stock_qty").val(netqty);
    }

    function getamount() {
        var vqty = $('#Purchaseinvoice_item_v_qty').val();
        var uprice = $("#Purchaseinvoice_item_rate").val();
        var amt = ((parseFloat(vqty) * parseFloat(uprice) ));
        $("#Purchaseinvoice_item_amount").val(amt.toFixed(2));
    }

      function GetScale(sid) {
        $("#v_scale").html("");
        $.getJSON("<?php echo $this->createUrl('purchaseinvoice/getScale'); ?>", function(data) {
            $(".loading4").html("");
            var content = "";
            content += '<option value="">-</option>';
            $.each(data.items, function(i, ct) {
                if (sid == ct.id) {
                    content += '<option value="' + ct.id + '" selected="selected">' + ct.type_name +'</option>';
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
                    content += '<option value="' + ct + '" selected="selected">' + ct +'</option>';
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
                    content += '<option value="' + ct + '" selected="selected">' + ct +'</option>';
                } else {
                    content += '<option value="' + ct + '">' + ct + '</option>';
                }
            });
            $("#is_mrd").html(content);
        });
    }
    
    function GetItems(vid, cid) {
        $("#item_id").html("");
        // $(".loading4").html("<img src='<?php //echo Yii::app()->baseUrl   ?>/img/loading.gif'>");
        $.getJSON("<?php echo $this->createUrl('purchaseinvoice/getList'); ?>", {"vid": vid}, function(data) {
            $(".loading4").html("");
            var content = "";
            content += '<option value="">--Select Items--</option>';
            $.each(data.items, function(i, ct) {
                if (cid == ct.purchase_item_id) {
                    content += '<option selected="selected" value="' + ct.purchase_item_id + '">' + ct.itemname + '(' + ct.brand + ')</option>';
                } else {
                    content += '<option value="' + ct.purchase_item_id + '">' + ct.itemname + '(' + ct.brand + ')</option>';
                }
            });
            $("#item_id").html(content);
        });
    }
    
    function Getvendoritems(cid,scid,item_id) {
        $("#item_id").html("");
        // $(".loading4").html("<img src='<?php //echo Yii::app()->baseUrl   ?>/img/loading.gif'>");
        $.getJSON("<?php echo $this->createUrl('purchaseinvoice/getitemlist'); ?>", {"cid": cid,"scid": scid}, function(data) {
            $(".loading4").html("");
            var content = "";
            content += '<option value="">--Select Items--</option>';
            $.each(data.items, function(i, ct) {
                if (item_id == ct.id) {
                    content += '<option selected="selected" value="' + ct.id + '">' + ct.itemname + '(' + ct.brand + ')</option>';
                } else {
                    content += '<option value="' + ct.id + '">' + ct.itemname + '(' + ct.brand + ')</option>';
                }
            });
            $("#item_id").html(content);
        });
    }
    
    function GetCategory(catid) {
        $("#Purchaseinvoiceitems_p_category_id").html("");
        $.getJSON("<?php echo $this->createUrl('purchaseinvoice/getCategoryList'); ?>", function(data) {
            $(".loading4").html("");
            var content = "";
            content += '<option value="">--Select Category--</option>';
            $.each(data.scat, function(i, ct) {
                if (catid == ct.id) {
                    content += '<option value="' + ct.id + '" selected="selected">' + ct.name + '</option>';
                } else {
                    content += '<option value="' + ct.id + '">' + ct.name + '</option>';
                }
            });
            $("#Purchaseinvoiceitems_p_category_id").html(content);
        });
    }
    function GetSCategory(cid, scid) {
        $("#Purchaseinvoiceitems_sub_category_id").html("");
        //$(".loading4").html("<img src='<?php echo Yii::app()->baseUrl ?>/img/loading.gif'>");
        $.getJSON("<?php echo $this->createUrl('purchaseitem/getSCategoryList'); ?>", {"cid": cid}, function(data) {
            $(".loading4").html("");
            var content = "";
            content += '<option value="">--Select Sub Category--</option>';
            $.each(data.scat, function(i, ct) {
                if (scid == ct.id) {
                    content += '<option value="' + ct.id + '" selected="selected">' + ct.name + '</option>';
                } else {
                    content += '<option value="' + ct.id + '">' + ct.name + '</option>';
                }
            });
            $("#Purchaseinvoiceitems_sub_category_id").html(content);
        });
    }
    
    function scheduled(itemid){
        $.ajax({
            url: '<?php echo $this->createUrl('purchaseinvoice/getitemscale') ?>',
            data: {'id': itemid},
            type: 'get',
            dataType: 'JSON',
            cache: false,
            success: function(response) {
              if(response.is_schedule=="1"){
                 $("#scheduled_alert").fadeIn(1000).slideDown();  
                }
                $('.stock_taking_label').html("(" + response.scale + ")");
                $('#stock_taking_scale').val(response.scale);
            }
        });
    }
</script>