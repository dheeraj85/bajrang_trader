<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'purchaseorderitems-form',
    'enableAjaxValidation' => false,
        ));
?>
<input type="hidden" name="id" id="order_id" value="<?php echo $id?>"/>
<input type="hidden" name="order_item_id" id="order_item_id"/>
<div class="row">
    <div class="col-lg-12">
        <div class="bg-lightgreen">
            <div class="row">
                <div class='col-lg-4' id="item_label">
                    <label>Item (List can take time to load W.R.T Internet Speed.)</label>     
                    <select id="item_id" name="Purchaseorderitems[item_id]" class="form-control select2">
                        <option value="">--Select/Type Item Name--</option>
                    </select>
                </div>
                <div class='col-lg-4' id="itemname" style="display:none;">
                    <label>Item</label>  
                    <input type="text" id="item_name" class="form-control" readonly>
                </div>               
                <div class='col-lg-4'>
                    <label>HSN/SAC code</label>     
                    <input name="Purchaseorderitems[hsn_sac_code]" id="hsn_sac_code" class="form-control" placeholder="HSN/SAC Code" type="text" readonly="readonly">
                </div>                                
                <div class='col-lg-4'>
                    <label>Tax in %</label>     
                    <input name="Purchaseorderitems[tax_percent]" id="tax_percent" class="form-control" placeholder="Tax %" type="number" readonly="readonly">
                </div>
            </div><br/>
            <div class="row">
                <div class='col-lg-4'>
                    <label>Qty</label>  
                    <input type="text" name="Purchaseorderitems[qty_req]" id="qty" class="form-control" placeholder="Qty" type="number">
                </div>
                <div class='col-lg-4'>
                    <label>Rate</label>     
                    <input name="Purchaseorderitems[rate]" id="rate" class="form-control" placeholder="Rate" type="number">
                </div>
                <div class='col-lg-4'>
                    <label>Amount</label>     
                    <input name="Purchaseorderitems[amount]" id="amount" class="form-control" placeholder="Amount" type="number" readonly>
                </div>
            </div>
        </div> 
    </div> 
</div><br/> 
<div class="pull-right">
    <?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_GREEN,'id'=>'additem')); ?>
    <input type="button" class="btn savebtn btn-green" id="edititem" value="Edit & Save" style="display:none;"/>
</div>
<div style="clear:both"></div><br/>
<?php $this->endWidget(); ?>
<div id="show_content_item" class="table-responsive"></div>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/front/libs/jquery/jquery-1.11.2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var itemid = 0;
        var scale = 0;
        Getvendoritems(itemid);
        GetScale(scale);
<?php if (!empty($id)) { ?>
            getpartial(<?php echo $id; ?>);
<?php } ?>
        $("#item_id").change(function() {
            var id = $(this).val();
            $.ajax({
                url: '<?php echo $this->createUrl('purchaseinvoice/getitems') ?>',
                data: {'id': id},
                type: 'get',
                dataType: 'JSON',
                cache: false,
                success: function(response) {
                    $('#hsn_sac_code').val(response.items.gst_code);
                    $('#tax_percent').val(response.items.gst_percent);
                }
            });
        });
        
        $("#rate").blur(function() {
            var qty = $('#qty').val();
            var uprice = $("#rate").val();
            var amt = ((parseFloat(qty) * parseFloat(uprice)));
            $("#amount").val(amt.toFixed(3));
        });
        
        $("#qty").blur(function() {
            var qty = $('#qty').val();
            var uprice = $("#rate").val();
            var amt = ((parseFloat(qty) * parseFloat(uprice)));
            $("#amount").val(amt.toFixed(3));
        });
        
        $('#edititem').click(function() {
            var form = $('#purchaseorderitems-form').serialize();
            var order_id=$("#order_id").val();
            var order_item_id = $('#order_item_id').val();
            //alert(form);
                $.ajax({
                    url: '<?php echo $this->createUrl('purchaseorderitems/editorderitem') ?>',
                    data: form + '&YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>'+'&order_item_id='+order_item_id,
                    type: 'post',
                    cache: false,
                    success: function(response) {
                        $("#edititem").hide();
                        $("#itemname").hide();
                        $("#additem").show();
                        $('#purchaseorderitems-form')[0].reset();
                        $("#order_item_id").val('');
                        $("#item_id").val('0');
                        getpartial(order_id);
                        setInterval(function() {
                        window.location.href = "<?php echo $this->createUrl('purchaseorderitems/create') ?>/"+order_id;
                        }, 1000);
                    }
                });
        });
    });
    function Getvendoritems(item_id) {
        $("#item_id").html("");
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
    function getpartial(order_id) {
        $.ajax({
            url: '<?php echo $this->createUrl('purchaseorderitems/getinvoicedata') ?>',
            data: {'order_id': order_id, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
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
</script>    