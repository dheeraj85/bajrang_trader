<?php
if (!empty($list)) {
    ?>
    <article class="module width_full">
        <div class="box-header bg-primary">
        <h3 class="panel-title">Expense Invoice Item Details</h3>
        </div>
        <div class="module_content">
            <fieldset>
                <table class="table table-bordered">
                    <thead>
                    <th>Item.</th>
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
                      <?php echo Expenseinvoiceitems::getinvoiceitems($list); ?>
                    </tbody>
                </table>
            </fieldset>           
        </div>
    </article>
<?php } ?>
<script type="text/javascript">  
    function itemdelete(id, invoice_id) {
        $.ajax({
            url: '<?php echo $this->createUrl('expenseinvoice/itemdelete') ?>',
            data: {'id': id, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
            type: 'post',
            success: function(response) {
                getpartial(invoice_id);
                setInterval(function() {
                        window.location.href = "<?php echo $this->createUrl('expenseinvoice/create') ?>/"+invoice_id;
                 }, 1000);
            }
        });
    }
    
    function edititem(id,vid,is_service,state_code) {
        $('html,body').animate({
            scrollTop: $("#expenseinvoice-form").offset().top},
         1000);
         $("#additem").hide();
         $("#edititem").show();
         $('#expenseinvoice-form')[0].reset();
         $.getJSON("<?php echo $this->createUrl('expenseinvoice/getitemdata'); ?>", {"id": id}, function(data) {
             $("#invoice_item_id").val(data.model.id);
             check_gsttype(data.model.goods_service);
             $("#itemname").fadeIn(1000).slideDown();
             GetItemname(data.model.item_id);
             Getvendoritems(data.model.item_id); 
             $("#hsn_sac_code").val(data.model.hsn_sac_code);
             $("#tax_percent").val(data.model.tax_percent_rate);
             $("#vendor_hsn_sac_code").val(data.model.vendor_hsn_sac_code);
             $("#vendor_tax_percent").val(data.model.vendor_tax_percent);
             $("#Expenseinvoice_item_particulars").val(data.model.particulars);
             $("#Expenseinvoice_item_amount").val(data.model.amount);
             if(vid=="1") {
               checkuttax(state_code);  
               if(data.model.is_choice_tax=="1"){
               $("#Expenseinvoice_tax_percent_rate").val(data.model.vendor_tax_percent);
               }else{
               $("#Expenseinvoice_tax_percent_rate").val(data.model.tax_percent_rate);    
               }
             }else{
                if(data.model.is_choice_tax=="1"){ 
                $('#Expenseinvoice_tax_percent_rate').val(eval(data.model.vendor_tax_percent/2)+" / "+eval(data.model.vendor_tax_percent/2));    
                }else{
                $('#Expenseinvoice_tax_percent_rate').val(eval(data.model.tax_percent_rate/2)+" / "+eval(data.model.tax_percent_rate/2));        
                }
             }  
             $("#discount").val(data.model.discount);
        });
    }
    function GetItemname(itemid){
         $.ajax({
            url: '<?php echo $this->createUrl('expenseinvoice/getItemname') ?>',
            data: {'id': itemid},
            type: 'get',
            dataType: 'JSON',
            cache: false,
            success: function(response) {
              $('#item_name').val(response.itemname);
            }
        });
    }
</script>