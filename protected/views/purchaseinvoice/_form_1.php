<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'purchaseinvoice-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));
?>
<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php //echo $form->errorSummary($model); ?>
<div class='bg-green' style="padding:5px;">
    <div class='row'>
        <div class='col-md-2'>
            <?php echo $form->dropdownlistControlGroup($model, 'invoice_type', Utils::itype(), array('maxlength' => 100, 'id' => 'invoice_type', 'class' => 'form-control')); ?>
        </div>
        <div class='col-md-2'>
            <?php echo $form->textFieldControlGroup($model, 'invoice_no', array('maxlength' => 50)); ?>
        </div>
        <div class='col-md-3' id="invoicetype_supplier">
            <?php echo $form->dropDownListControlGroup($model, 'vendor_id', CHtml::listData(Vendor::model()->findAll(), 'id', 'firm_name'), array('class' => 'form-control', 'empty' => '---Select Vendor---')); ?>
        </div>
        <div class='col-md-3' id="invoicetype_cash" style="display:none;">
           <?php echo $form->textFieldControlGroup($model, 'suppliername', array('maxlength' => 50)); ?>
        </div>
        <div class='col-md-3'>
            <label>Invoice Date<span class="required">*</span></label><br/>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'Purchaseinvoice[invoice_date]',
                'id' => 'invoice_date',
                'value' => $model->invoice_date,
                'options' => array(
                    'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
                ),
                'htmlOptions' => array(
                    'style' => 'width:240px;padding: 6px 12px;
                    font-size: 14px;
                    line-height: 1.42857143;
                    color: #555555;
                    background-color: #ffffff;
                    background-image: none;
                    border: 1px solid #cccccc;',
                    //'readonly' => 'readonly'
                    'placeholder' => 'Invoice Date',
                ),
            ));
            ?>
            <?php echo $form->error($model, 'invoice_date'); ?>
        </div>
        <div class='col-md-2'>
            <?php echo $form->dropDownListControlGroup($model, 'received_by', CHtml::listData(Employee::model()->findAll(), 'id', 'empname'), array('class' => 'form-control', 'empty' => 'Received By')); ?>  
        </div>
    </div>
</div><br/>
<form class="horizontal" id="invoiceitem">
<div class="row">
    <div class='col-md-3'>
        <label>Item</label>     
        <select id="item_id" name="item_id" class="form-control select2">
            <option value="">--Select Items--</option>
        </select>
    </div>
    <div class='col-md-3'>
        <label>Particulars</label>     
        <input name="particulars" id="Purchaseinvoice_item_particulars" class="form-control" placeholder="Particulars" type="text">
    </div>
    <div class='col-md-2'>
        <label>Vendor Qty</label>     
        <input name="v_qty" id="Purchaseinvoice_item_v_qty" class="form-control" placeholder="Vendor Qty" type="text">
    </div>
    <div class='col-md-2'>
        <label>Vendor Scale</label>  
        <select id="v_scale" name="v_scale" class="form-control">
            <option value="">-Select-</option>
            <?php foreach (Itemscale::model()->findAllByAttributes(array('scale_type' => 'Vscale')) as $p) {
                ?>
                <option value="<?php echo $p->id; ?>"><?php echo $p->type_name; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class='col-md-2'>
        <label>Type</label>     
        <select id="input_type" name="input_type" class="form-control">
            <option value="">-Select-</option>
            <?php foreach (Utils::inputtype() as $k => $v) {
                ?>
                <option value="<?php echo $v; ?>"><?php echo $v; ?></option>
            <?php } ?>
        </select>
    </div>  
</div><br/>
<div class="row">  
      <div class='col-md-2' id="convertvalue" style="display:none;">
        <label>Convert Unit Value</label>     
        <input name="c_unit_value" onchange="getprice(this.value)" id="Purchaseinvoice_item_c_unit_value" class="form-control" placeholder="Unit Value" type="text">
    </div>
    <div class='col-md-2'>
        <label>Stock Quantity <span id="stock_taking_label"></span></label>     
        <input name="stock_qty" id="Purchaseinvoice_item_stock_qty" class="form-control" readonly placeholder="Stock Quantity" type="text"> 
        <input type="hidden" name="stock_taking_scale" id="stock_taking_scale">
    </div>
    <div class='col-md-2'>
        <label>Rate</label>     
        <input name="rate" id="Purchaseinvoice_item_rate" class="form-control" placeholder="Rate" type="text"> 
    </div>
    <div class='col-md-2'>
        <label>Tax (%)</label>     
        <input name="tax" id="Purchaseinvoice_item_tax" onchange="getamount();" class="form-control" placeholder="Tax" type="text"> 
    </div>
    <div class='col-md-2'>
        <label>Amount</label>     
        <input name="amount" id="Purchaseinvoice_item_amount" class="form-control" placeholder="Amount" readonly type="text">
    </div>
    <div class='col-md-2'>
        <label>MRD Label</label>     
        <select id="is_mrd" name="is_mrd" class="form-control">
            <option value="">-Select-</option>
            <?php foreach (Utils::schedule() as $k => $v) {
                ?>
                <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
            <?php } ?>
        </select>
    </div>
</div><br/>
<div class="row" id="mrdform" style="display:none;">
    <div class='col-md-2'>
        <label>MRD No</label>     
        <input name="mrd_no" id="Purchaseinvoice_item_mrd_no" class="form-control" placeholder="MRD No." type="text">
    </div>
    <div class='col-md-3'>
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
                'style' => 'width:250px;padding: 6px 12px;
                    font-size: 14px;
                    line-height: 1.42857143;
                    color: #555555;
                    background-color: #ffffff;
                    background-image: none;
                    border: 1px solid #cccccc;',
                //'readonly' => 'readonly'
                'placeholder' => 'Make Date',
            ),
        ));
        ?>
    </div>
    <div class='col-md-3'>
        <label>Ready Date<span class="required">*</span></label><br/>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'ready_date',
            'id' => 'ready_date',
            'value' => $_POST['ready_date'],
            'options' => array(
                'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
            ),
            'htmlOptions' => array(
                'style' => 'width:250px;padding: 6px 12px;
                    font-size: 14px;
                    line-height: 1.42857143;
                    color: #555555;
                    background-color: #ffffff;
                    background-image: none;
                    border: 1px solid #cccccc;',
                //'readonly' => 'readonly'
                'placeholder' => 'Ready Date',
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
            'value' => $_POST['discard_date'],
            'options' => array(
                'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
            ),
            'htmlOptions' => array(
                'style' => 'width:250px;padding: 6px 12px;
                    font-size: 14px;
                    line-height: 1.42857143;
                    color: #555555;
                    background-color: #ffffff;
                    background-image: none;
                    border: 1px solid #cccccc;',
                //'readonly' => 'readonly'
                'placeholder' => 'Discard Date',
            ),
        ));
        ?>
    </div>
</div>
<br/>
<div class="row pull-right">
    <input type="button" class="btn btn-green" id="additem" value="Add Item"/>
    <input type="button" class="btn btn-green" id="submit" value="Finish"/>
</div>
</form>
<br/>
<div id="show_content"></div>
<?php $this->endWidget(); ?>
<script type="text/javascript">
    $(document).ready(function() {        
        $("#invoice_type").change(function() {
            var input_type = $(this).val();
            if (input_type == "Cash") {
                $("#invoicetype_cash").show();
                 $("#invoicetype_supplier").hide();
            } else {
                $("#invoicetype_supplier").show();
                $("#invoicetype_cash").hide();
            }
        });
        
        $("#input_type").change(function() {
            var input_type = $(this).val();
            if (input_type == "Convert") {
                $("#convertvalue").show();
                $("#convertvalue").slideDown();
            } else {
                $("#convertvalue").hide();
                $("#convertvalue").slideUp();
            }
        });

        $("#is_mrd").change(function() {
            var input_type = $(this).val();
            if (input_type == "1") {
                $("#mrdform").show();
                $("#mrdform").slideDown();
            } else {
                $("#mrdform").hide();
                $("#mrdform").slideUp();
            }
        });

        $("#Purchaseinvoice_vendor_id").change(function() {
            var cid = 0;
            var vid = $(this).val();
            GetItems(vid, cid);
        });

        $("#Purchaseinvoice_vendor_id").change(function() {
            var vendor_id = $(this).val();
            var invoice_no = $('#Purchaseinvoice_invoice_no').val();
            getpartial(invoice_no, vendor_id);
        });

        $("#item_id").change(function() {
            var id = $(this).val();
            $.ajax({
                url: '<?php echo $this->createUrl('purchaseinvoice/getitemscale') ?>',
                data: {'id': id},
                type: 'get',
                success: function(response) {
                    $('#stock_taking_label').html("(" + response + ")");
                    $('#stock_taking_scale').val(response);
                }
            });
        });


        $('#additem').click(function() {
            var form = $('#purchaseinvoice-form').serialize();
            var invoice_no = $("#Purchaseinvoice_invoice_no").val();
            var vendor_id = $('#Purchaseinvoice_vendor_id').val();
            $("#additem").attr('disabled', 'disabled').html("Submiting...");
            $.ajax({
                url: '<?php echo $this->createUrl('purchaseinvoice/addinvoiceitem') ?>',
                data: form,
                type: 'post',
                cache: false,
                success: function(response) {
                    $("#additem").removeAttr('disabled').html('Add Item');
                    $('#purchaseinvoice-form')[0].reset();
                    getpartial(invoice_no, vendor_id);
                }
            });
        });

    });

    function getpartial(invoice_no, vendor_id) {
        $.ajax({
            url: '<?php echo $this->createUrl('purchaseinvoice/getinvoicedata') ?>',
            data: {'invoice_no': invoice_no, 'vendor_id': vendor_id, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
            type: 'post',
            success: function(response) {
                $('#show_content').html(response);
                $('#show_content').focus();
            }
        });
    }

    function getprice(cvalue) {
        var vqty = $('#Purchaseinvoice_item_v_qty').val();
        var netqty = parseFloat(cvalue) * parseFloat(vqty);
        $("#Purchaseinvoice_item_stock_qty").val(netqty);
    }

    function getamount() {
        var uprice = $("#Purchaseinvoice_item_rate").val();
        var tax = $("#Purchaseinvoice_item_tax").val();
        var tax_price = ((parseFloat(uprice) * parseFloat(tax)) / 100);
        var amt = parseFloat(uprice) + parseFloat(tax_price);
        $("#Purchaseinvoice_item_amount").val(amt.toFixed(2));
    }

    function itemdelete(id,invoice_no,vendor_id) {
        $.ajax({
            url: '<?php echo $this->createUrl('purchaseinvoice/itemdelete') ?>',
            data: {'id': id, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
            type: 'post',
            success: function(response) {
                getpartial(invoice_no, vendor_id);
            }
        });
    }

    function GetItems(vid, cid) {
        $("#item_id").html("");
        // $(".loading4").html("<img src='<?php //echo Yii::app()->baseUrl  ?>/img/loading.gif'>");
        $.getJSON("<?php echo $this->createUrl('purchaseinvoice/getList'); ?>", {"vid": vid}, function(data) {
            $(".loading4").html("");
            var content = "";
            content += '<option value="0">--Select Items--</option>';
            $.each(data.items, function(i, ct) {
                if (cid == ct.id) {
                    content += '<option value="' + ct.purchase_item_id + '" selected="selected">' + ct.brand + '(' + ct.item_scale + ')</option>';
                } else {
                    content += '<option value="' + ct.purchase_item_id + '">' + ct.brand + '(' + ct.item_scale + ')</option>';
                }
            });
            $("#item_id").html(content);
        });
    }
</script>