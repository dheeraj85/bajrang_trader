<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'kataparchy-form',
    'enableAjaxValidation' => false,
        ));
?>
<input type="hidden" name="id" id="invoice_id" value="<?php echo $id ?>"/>
<input type="hidden" name="challan_id" id="challan_id" value="<?php echo $challan_details->id ?>"/>
<input type="hidden" name="kata_parchy_id" id="kata_parchy_id"/>
<div class="row">
    <div class="col-lg-12">
        <div class="bg-lightgreen">
            <div class="row">
                <div class='col-lg-4' id="item_label">
                    <label>Item (List can take time to load W.R.T Internet Speed.)</label>     
                    <select id="item_id" name="Kataparchy[item_id]" class="form-control select2">
                        <option value="">--Select/Type Item Name--</option>
                    </select>
                </div>
                <div class='col-lg-4' id="itemname" style="display:none;">
                    <label>Item</label>  
                    <input type="text" id="item_name" class="form-control" readonly>
                </div>                                                
                <div class='col-lg-4'>
                    <label>GRN No.</label>     
                    <input name="Kataparchy[grn_no]" id="grn_no" class="form-control" placeholder="GRN No." type="text">
                </div>
                <div class='col-lg-4'>
                    <label>PO Number</label>     
                    <input name="Kataparchy[order_no]" id="order_no" class="form-control" placeholder="PO Number" type="number" readonly="readonly" value="<?php echo $challan_details->getpo($challan_details); ?>">
                </div>
            </div><br/>
            <div class="row">                
                <div class='col-lg-4'>
                    <label>Vendor Name</label>     
                    <input name="Kataparchy[vendor_name]" id="vendor_name" class="form-control" placeholder="Vendor Name" type="text" readonly="readonly"  value="<?php echo Yii::app()->params['company_name']; ?>">
                </div>
                <div class='col-lg-2'>
                    <label>Load Weight</label>  
                    <input type="text" name="Kataparchy[load_weight]" id="load_weight" class="form-control" placeholder="Load Weight" type="number">
                </div>
                <div class='col-lg-2'>
                    <label>Net Weight</label>     
                    <input name="Kataparchy[net_weight]" id="net_weight" class="form-control" placeholder="Net Weight">
                </div>
                <div class='col-lg-4'>
                    <label>Kata Parchi Date</label>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'name' => 'Kataparchy[kata_parchi_date]',
                        'id' => 'Kataparchy_kata_parchi_date',
                        'value' => isset($model->kata_parchi_date) ? $model->kata_parchi_date : date('d-m-Y'),
                        'options' => array(
                            'dateFormat' => 'dd-mm-yy', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
                        ),
                        'htmlOptions' => array(
                            'style' => '',
                            //'readonly' => 'readonly'
                            'placeholder' => 'Bill Date', 'class' => 'form-control', 'required' => 'required',
                        ),
                    ));
                    ?>
                </div>
            </div>
        </div> 
    </div> 
</div><br/> 
<div class="pull-right">
    <?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_GREEN, 'id' => 'additem')); ?>
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

        $('#edititem').click(function() {
            var form = $('#kataparchy-form').serialize();
            var invoice_id = $("#invoice_id").val();
            var kata_parchy_id = $('#kata_parchy_id').val();
            //alert(form);
            $.ajax({
                url: '<?php echo $this->createUrl('kataparchy/edititem') ?>',
                data: form + '&YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>' + '&kata_parchy_id=' + kata_parchy_id,
                type: 'post',
                cache: false,
                success: function(response) {
                    $("#edititem").hide();
                    $("#itemname").hide();
                    $("#additem").show();
                    $('#kataparchy-form')[0].reset();
                    $("#challan_id").val('');
                    $("#item_id").val('0');
                    getpartial(invoice_id);
                    setInterval(function() {
                        window.location.href = "<?php echo $this->createUrl('kataparchy/create') ?>/" + invoice_id;
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
    function getpartial(invoice_id) {
        $.ajax({
            url: '<?php echo $this->createUrl('kataparchy/getinvoicedata') ?>',
            data: {'invoice_id': invoice_id, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
            type: 'post',
            success: function(response) {
                $('#show_content_item').html(response);
                $('#show_content_item').focus();
            }
        });
    }
</script>    