<?php
if (!empty($list)) {
    ?>
    <article class="module width_full">
        <div class="box-header bg-green">
        <h3 class="panel-title">Purchase Invoice Item Details</h3>
        </div>
        <div class="module_content">
            <fieldset>
                <table class="table table-bordered">
                    <thead>
                    <th>Item.</th>
                    <th class='text-right'>Qty.</th>
                    <th class='text-right'>Rate</th>
                    <th class='text-right'>Taxable Amt.</th>
                    <?php if($list->place_of_supply=="1"){?>
                    <th class='text-right'>IGST Rate</th>
                    <th class='text-right'>Amt.</th>
                    <?php }else{?>
                    <th class='text-right'>CGST Rate</th>
                    <th class='text-right'>CGST Amt.</th>
                    <th class='text-right'>SGST Rate</th>
                    <th class='text-right'>SGST Amt.</th>
                    <?php }?>
                    <th class='text-right'>CESS Rate</th>
                    <th class='text-right'>CESS Amt.</th>
                    <?php if($list->discount_type=="item_discount"){?>
                    <th class='text-right'>Discount</th>
                    <?php }?>
                    <th class='text-right'>Tax Amt</th>
                    <th class='text-right'>Final Amt</th>
                    <th>#</th>
                    </thead>
                    <tbody>
                      <?php echo Purchaseinvoiceitems::getinvoiceitems($list); ?>
                    </tbody>
                </table>
            </fieldset>           
        </div>
    </article>
<?php } ?>
<script type="text/javascript">  
    function itemdelete(id, invoice_id) {
        $.ajax({
            url: '<?php echo $this->createUrl('purchaseinvoice/itemdelete') ?>',
            data: {'id': id, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
            type: 'post',
            success: function(response) {
                getpartial(invoice_id);
                setInterval(function() {
                        window.location.href = "<?php echo $this->createUrl('purchaseinvoice/create') ?>/"+invoice_id;
                 }, 1000);
            }
        });
    }
    
    function edititem(id,vid,is_service,state_code) {
        $('html,body').animate({
            scrollTop: $("#purchaseinvoice-form").offset().top},
         1000);
         $("#additem").hide();
         $("#edititem").show();
         $('#purchaseinvoice-form')[0].reset();
         $.getJSON("<?php echo $this->createUrl('purchaseinvoice/getitemdata'); ?>", {"id": id}, function(data) {
             $("#invoice_item_id").val(data.model.id);
             GetItems(vid,data.model.item_id);
             check_gsttype(data.model.goods_service);
             $("#itemname").fadeIn(1000).slideDown();
             GetItemname(data.model.item_id);
             if(vid==null){
              Getvendoritems(data.model.item_id);   
             }
             $("#hsn_sac_code").val(data.model.hsn_sac_code);
             $("#tax_percent").val(data.model.tax_percent_rate);
             $("#vendor_hsn_sac_code").val(data.model.vendor_hsn_sac_code);
             $("#vendor_tax_percent").val(data.model.vendor_tax_percent);
             $("#Purchaseinvoice_item_particulars").val(data.model.particulars);
             $("#Purchaseinvoice_item_v_qty").val(data.model.v_qty);
             GetScale(data.model.v_scale);
             GetItype(data.model.input_type);
             if (data.model.input_type == "Convert") {
             $("#convertvalue").fadeIn(1000).slideDown();
             }
             $("#Purchaseinvoice_item_c_unit_value").val(data.model.c_unit_value);
             $("#Purchaseinvoice_item_stock_qty").val(data.model.stock_qty);
             $("#Purchaseinvoice_item_rate").val(data.model.rate);
             $("#Purchaseinvoice_item_amount").val(data.model.amount);
             if(vid=="1") {
               checkuttax(state_code);  
               if(data.model.is_choice_tax=="1"){
               $("#Purchaseinvoice_tax_percent_rate").val(data.model.vendor_tax_percent);
               }else{
               $("#Purchaseinvoice_tax_percent_rate").val(data.model.tax_percent_rate);    
               }
             }else{
                if(data.model.is_choice_tax=="1"){ 
                $('#Purchaseinvoice_tax_percent_rate').val(eval(data.model.vendor_tax_percent/2)+" / "+eval(data.model.vendor_tax_percent/2));    
                }else{
                $('#Purchaseinvoice_tax_percent_rate').val(eval(data.model.tax_percent_rate/2)+" / "+eval(data.model.tax_percent_rate/2));        
                }
             }  
             GetMrd(data.model.is_mrd);
             if(data.model.is_mrd=="Yes"){
                 $("#mrdform").fadeIn(1000).slideDown();
                 $("#Purchaseinvoice_item_mrd_no").val(data.model.mrd_no);
                 $("#make_date").val(data.model.make_date);
                 $("#ready_date").val(data.model.ready_date);
                 $("#discard_date").val(data.model.discard_date);
             }
             scheduled(data.model.item_id);
                $("#schedule_date").val(data.model.schedule_date);
                $("#remarks").val(data.model.remarks);
               $("#discount").val(data.model.discount);
        });
    }
    function GetItemname(itemid){
         $.ajax({
            url: '<?php echo $this->createUrl('purchaseinvoice/getItemname') ?>',
            data: {'id': itemid},
            type: 'get',
            dataType: 'JSON',
            cache: false,
            success: function(response) {
              $('#item_name').val(response.itemname+"("+response.brand+")");
            }
        });
    }
</script>