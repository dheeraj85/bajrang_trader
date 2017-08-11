<article class="module width_full">
    <div class="box-header bg-green">
        <h3 class="panel-title">Purchase Invoice Item Details</h3>
    </div>
    <div class="module_content">
        <fieldset>
            <table class="table table-bordered">
                <thead>
                <th>S. No.</th>    
                <th>Item Code</th>
                <th>HSN/SAC</th>
                <th>Item Description</th>
                <th>Qty</th>
                <th class='text-right'>Rate(INR)</th>
                <th class='text-right'>PER</th>
                <th class='text-right'>OPU</th>
                <th>#</th>
                </thead>
                <tbody>
                    <?php echo Purchaseorderitems::getordersitems($id); ?>
                </tbody>
            </table>
        </fieldset>           
    </div>
</article>
<script type="text/javascript">
    function itemdelete(id, order_id) {
        $.ajax({
            url: '<?php echo $this->createUrl('purchaseorderitems/itemdelete') ?>',
            data: {'id': id, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
            type: 'post',
            success: function(response) {
                getpartial(order_id);
                setInterval(function() {
                    window.location.href = "<?php echo $this->createUrl('purchaseorderitems/create') ?>/" + order_id;
                }, 1000);
            }
        });
    }

    function edititem(id) {
        $('html,body').animate({
            scrollTop: $("#purchaseorderitems-form").offset().top},
        1000);
        $("#item_label").hide();
        $("#additem").hide();
        $("#edititem").show();
        $('#purchaseorderitems-form')[0].reset();
        $.getJSON("<?php echo $this->createUrl('purchaseorderitems/getitemdata'); ?>", {"id": id}, function(data) {
            $("#order_item_id").val(data.model.id);
            Getvendoritems(data.model.item_id);
            $("#itemname").fadeIn(1000).slideDown();
            GetItemname(data.model.item_id);
            $("#hsn_sac_code").val(data.items.gst_code);
            $("#tax_percent").val(data.items.gst_percent);
            $("#vendor_hsn_sac_code").val(data.model.vendor_hsn_sac_code);
            $("#vendor_tax_percent").val(data.model.vendor_tax_percent);
            $("#qty").val(data.model.qty_req);
            $("#rate").val(data.model.rate);
            $("#amount").val(data.model.amount);
        });
    }
    function GetItemname(itemid) {
        $.ajax({
            url: '<?php echo $this->createUrl('purchaseinvoice/getItemname') ?>',
            data: {'id': itemid},
            type: 'get',
            dataType: 'JSON',
            cache: false,
            success: function(response) {
                $('#item_name').val(response.itemname + "(" + response.brand + ")");
            }
        });
    }
</script>