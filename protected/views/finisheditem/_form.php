<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'purchaseinvoice-form',
    ));
?>
<input type="hidden" name="processed_item_id" id="processed_item_id">
<div class="row">
<div class="col-md-12">
    <div class="bg-red" style="padding:10px;">
    <div class="row"> 
         <div class='col-lg-3'>
            <label>Item</label>     
            <select id="item_id" name="item_id" class="form-control select2">
                <option value="">--Select Items--</option>
            </select>
        </div>
         <div class='col-lg-3' id="itemname" style="display:none;">
             <label>Item</label>  
             <input type="text" id="item_name" class="form-control" readonly>
        </div>
         <div class='col-lg-2'>
            <label>Particulars</label>     
            <input name="particulars" id="Purchaseinvoice_item_particulars" class="form-control" placeholder="Particulars" type="text">
        </div>
        <div class='col-lg-2'>
            <label>Processed Qty</label>     
            <input name="v_qty" id="Purchaseinvoice_item_v_qty" class="form-control" placeholder="Qty" type="text">
        </div>
         <div class='col-lg-1'>
            <label>Scale</label>  
            <select id="v_scale" name="v_scale" class="form-control">
                <option value="">-</option>
            </select>
        </div>
       <div class='col-lg-2'>
            <label>Conversion</label>     
            <select id="input_type" name="input_type" class="form-control">
            </select>
        </div>
        <div class='col-lg-2' id="convertvalue" style="display:none;">
            <label>Unit Value <span class="stock_taking_label"></span></label>     
            <input name="c_unit_value" id="Purchaseinvoice_item_c_unit_value" class="form-control" placeholder="Unit Value" type="text">
        </div>
    </div><br/>  
    <div class="row">
        <div class='col-lg-2'>
            <label>Stock Qty <span class="stock_taking_label"></span></label>     
            <input name="stock_qty" id="Purchaseinvoice_item_stock_qty" class="form-control" placeholder="Stock Quantity" type="text"> 
            <input type="hidden" name="stock_taking_scale" id="stock_taking_scale">
        </div>
        <div class='col-lg-3'>
            <label>Rate <span id="convert_label">(Per S-Qty)</span></label>     
            <input name="rate" id="Purchaseinvoice_item_rate" class="form-control" placeholder="Rate" type="text"> 
        </div>
           <div class='col-lg-2'>
            <label>Amount</label>     
            <input name="amount" id="Purchaseinvoice_item_amount" class="form-control" placeholder="Amount" readonly type="text">
        </div>
        <div class='col-lg-2'>
            <label>Batch Label</label>     
            <select id="is_mrd" name="is_mrd" class="form-control">
                <option value="">-</option>
            </select>
        </div>
         <div class='col-lg-2'>
          <label>Discount</label>     
          <input type="text" id="discount" name="discount" class="form-control">  
        </div>
    </div><br/>
    <div class="row">
    <?php foreach(Invoicesettings::model()->findAllByAttributes(array('type'=>'tax_in_items')) as $isetting){?>
    <div class="col-lg-2">
        <label><?php echo $isetting->label?> (%)</label>
        <input type="text" id="taxtype_<?php echo $isetting->label?>" name="taxtype_<?php echo $isetting->id?>" class="form-control">
    </div>
    <?php }?>
    </div><br/>  
    <div class="row" id="scheduled_alert" style="display:none;">
         <div class='col-md-5'>
            <label>Schedule Date<span class="required">*</span></label><br/>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'schedule_date',
                'id' => 'schedule_date',
                'value' => Yii::app()->request->getPost('schedule_date'),
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
                <input type="text" id="remarks" name="remarks" class="form-control">  
        </div>
    </div><br/>   
    <div id="mrdform" style="display:none;">
    <div class="row">
        <div class='col-lg-3'>
            <label>Batch No  <span id="mrderror" style="color:#c40000;"></span></label>     
            <input name="mrd_no" id="Purchaseinvoice_item_mrd_no" class="form-control" placeholder="Batch No." type="text">
        </div>
        <div class='col-lg-3'>
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
                    'placeholder' => 'Make Date','class'=>'form-control',
                ),
            ));
            ?>
        </div>
        <div class='col-lg-3'>
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
                    'placeholder' => 'Processed Date','class'=>'form-control',
                ),
            ));
            ?>
        </div>
        <div class='col-lg-3'>
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
                    'placeholder' => 'Discard Date','class'=>'form-control',
                ),
            ));
            ?>
        </div>
    </div>  
    </div><br/>    
    <div class="pull-right" style="margin-top:12px;">
        <input type="button" class="btn savebtn btn-default" id="additem" value="Save"/>
        <input type="button" class="btn savebtn btn-default" id="edititem" value="Save" style="display:none;"/>
    </div>
    <div style="clear:both"></div>
</div>
</div>
</div><br/>
<div class="row">
<div class="col-md-12">
  <div id="show_content_item" class="table-responsive"></div>
</div>
</div>
<?php $this->endWidget(); ?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/bs/js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {
//    var catid=0;
    var scale=0;
    var type="";
    var ismrd="";
    var itemid=0;
//    GetCategory(catid);
    GetScale(scale);        
    GetItype(type);
    GetMrd(ismrd);
    scheduled(itemid);
    getpartial();
    Getvendoritems(itemid);
    
//     $("#Purchaseinvoiceitems_p_category_id").change(function() {
//            var scid = 0;
//            var cid = $(this).val();
//            GetSCategory(cid, scid,'Processed');
//     });
//     
//    $("#Purchaseinvoiceitems_sub_category_id").change(function() {
//            var item_id = 0;
//            var cid=$("#Purchaseinvoiceitems_p_category_id").val();
//            var scid = $(this).val();
//            Getvendoritems(cid, scid,item_id);
//     });
     
       $("#Purchaseinvoice_item_v_qty").blur(function() {
        var vqty=$(this).val();
        var input_type = $("#input_type").val();
        if (input_type == "Direct") {
        $("#Purchaseinvoice_item_stock_qty").val(vqty);
        }
    });
    
     $("#Purchaseinvoice_item_c_unit_value").blur(function() {
        var cvalue=$(this).val(); 
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
         var amt = ((parseFloat(sqty) * parseFloat(uprice) ));    
        }else{
        
        var amt = ((parseFloat(vqty) * parseFloat(uprice) ));
        }
        $("#Purchaseinvoice_item_amount").val(amt.toFixed(2));
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
                 alert("Batch No. already Exists");  
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
             $("#convert_label").html("(Per P-Qty)");        
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
         if($("#item_id").val()==""){
         alert("Select Item");  
         $("#item_id").focus();
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
            url: '<?php echo $this->createUrl('finisheditem/additem') ?>',
            data: form+'&YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>',
            type: 'post',
            cache: false,
            success: function(response) {
                $("#additem").removeAttr('disabled').html('Add Item');
                $('#purchaseinvoice-form')[0].reset();
                $("#processed_item_id").val('');
                $("#item_id").val('0');
                $("#v_scale").val('0');
                $("#input_type").val('');
                $("#is_mrd").val('');
                $("#Purchaseinvoiceitems_p_category_id").val('0');
                $("#Purchaseinvoiceitems_sub_category_id").val('0');
                getpartial();
            }
        });
        return true;
    }
    });
    
     $('#edititem').click(function() {
        var form = $('#purchaseinvoice-form').serialize();
        $("#edititem").attr('disabled', 'disabled').html("Submiting...");
        $.ajax({
            url: '<?php echo $this->createUrl('finisheditem/edititem') ?>',
            data: form+'&YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>',
            type: 'post',
            cache: false,
            success: function(response) {
                $("#edititem").removeAttr('disabled').html('Edit Item');
                $("#edititem").hide();
                $("#itemname").hide();
                $("#additem").show();
                $('#purchaseinvoice-form')[0].reset();
                $("#processed_item_id").val('');
                $("#item_id").val('0');
                $("#v_scale").val('0');
                $("#input_type").val('');
                $("#is_mrd").val('');
                $("#Purchaseinvoiceitems_p_category_id").val('0');
                $("#Purchaseinvoiceitems_sub_category_id").val('0');
                getpartial();
            }
        });
    });
    
});

// function GetCategory(catid) {
//        $("#Purchaseinvoiceitems_p_category_id").html("");
//        $.getJSON("<?php //echo $this->createUrl('purchaseinvoice/getcategorygpu'); ?>", function(data) {
//            $(".loading4").html("");
//            var content = "";
//            content += '<option value="">--Select--</option>';
//            $.each(data.scat, function(i, ct) {
//                if (catid == ct.id) {
//                    content += '<option value="' + ct.id + '" selected="selected">' + ct.name + '</option>';
//                } else {
//                    content += '<option value="' + ct.id + '">' + ct.name + '</option>';
//                }
//            });
//            $("#Purchaseinvoiceitems_p_category_id").html(content);
//        });
//    }
//    
//    function GetSCategory(cid, scid,type) {
//        $("#Purchaseinvoiceitems_sub_category_id").html("");
//        $.getJSON("<?php //echo $this->createUrl('purchaseitem/getSCategoryList'); ?>", {"cid": cid,"type":type}, function(data) {
//            $(".loading4").html("");
//            var content = "";
//            content += '<option value="">--Select--</option>';
//            $.each(data.scat, function(i, ct) {
//                if (scid == ct.id) {
//                    content += '<option value="' + ct.id + '" selected="selected">' + ct.name + '</option>';
//                } else {
//                    content += '<option value="' + ct.id + '">' + ct.name + '</option>';
//                }
//            });
//            $("#Purchaseinvoiceitems_sub_category_id").html(content);
//        });
//    }
    
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
    function getpartial() {
          $.ajax({
              url: '<?php echo $this->createUrl('finisheditem/getlatestitem') ?>',
              data: {'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
              type: 'post',
              success: function(response) {
                  $('#show_content_item').html(response);
                  $('#show_content_item').focus();
              }
          });
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
        function Getvendoritems(item_id) {
        $("#item_id").html("");
        // $(".loading4").html("<img src='<?php //echo Yii::app()->baseUrl   ?>/img/loading.gif'>");
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
</script>