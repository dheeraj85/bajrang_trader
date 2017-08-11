<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'challanitems-form',
    'enableAjaxValidation'=>false,
)); ?>
<input type="hidden" name="id" id="challan_id" value="<?php echo $id?>"/>
<input type="hidden" name="challan_item_id" id="challan_item_id"/>
<div class="row">
    <div class="col-lg-12">
        <div class="bg-lightgreen">
            <div class="row">
                <div class='col-lg-3' id="item_label">
                    <label>Item</label>     
                    <select id="item_id" name="Challanitems[item_id]" class="form-control select2">
                        <option value="">--Select/Type Item Name--</option>
                    </select>
                </div>
                <div class='col-lg-3' id="itemname" style="display:none;">
                    <label>Item</label>  
                    <input type="text" id="item_name" class="form-control" readonly>
                </div>               
                <div class='col-lg-3'>
                    <label>Weight in MT</label>  
                    <input type="text" name="Challanitems[weight]" id="qty" class="form-control" placeholder="Weight" type="number">
                </div>
                <div class='col-lg-3'>
                    <label>Rate in MT</label>     
                    <input name="Challanitems[rate]" id="rate" class="form-control" placeholder="Rate" type="number">
                </div>
                <div class='col-lg-3'>
                    <label>Amount</label>     
                    <input name="Challanitems[amount]" id="amount" class="form-control" placeholder="Amount" type="number" readonly>
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
        Getvendoritems(itemid);
<?php if (!empty($id)) { ?>
            getpartial(<?php echo $id; ?>);
<?php } ?>
        
        $("#rate").blur(function() {
            var qty = $('#qty').val();
            var uprice = $("#rate").val();
            var amt = ((parseFloat(qty) * parseFloat(uprice)));
            $("#amount").val(amt.toFixed(2));
        });
        
        $("#qty").blur(function() {
            var qty = $('#qty').val();
            var uprice = $("#rate").val();
            var amt = ((parseFloat(qty) * parseFloat(uprice)));
            $("#amount").val(amt.toFixed(2));
        });
        
        $('#edititem').click(function() {
            var form = $('#challanitems-form').serialize();
            var challan_id=$("#challan_id").val();
            var challan_item_id = $('#challan_item_id').val();
            //alert(form);
                $.ajax({
                    url: '<?php echo $this->createUrl('challanitems/edititem') ?>',
                    data: form + '&YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>'+'&challan_item_id='+challan_item_id,
                    type: 'post',
                    cache: false,
                    success: function(response) {
                        $("#edititem").hide();
                        $("#itemname").hide();
                        $("#additem").show();
                        $('#challanitems-form')[0].reset();
                        $("#challan_item_id").val('');
                        $("#item_id").val('0');
                        getpartial(challan_id);
                        setInterval(function() {
                        window.location.href = "<?php echo $this->createUrl('challanitems/create') ?>/"+challan_id;
                        }, 1000);
                    }
                });
        });
    });
    function Getvendoritems(item_id) {
        $("#item_id").html("");
        $.getJSON("<?php echo $this->createUrl('challanitems/getitemlist'); ?>", function(data) {
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
    function getpartial(challan_id) {
        $.ajax({
            url: '<?php echo $this->createUrl('challanitems/getinvoicedata') ?>',
            data: {'challan_id': challan_id, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
            type: 'post',
            success: function(response) {
                $('#show_content_item').html(response);
                $('#show_content_item').focus();
            }
        });
    }
</script>    