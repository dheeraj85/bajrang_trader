<article class="module width_full">
    <div class="box-header bg-green">
        <h3 class="panel-title">Kata Parchy Details</h3>
    </div>
    <div class="module_content">
        <fieldset>
            <table class="table table-bordered">
                <thead>
                <th>GRN No.</th>    
                <th>Challan No.</th>    
                <th>Item Code</th>    
                <th>PO Number</th>
                <th>Material</th>
                <th>Vendor</th>
                <th>Load Wt.</th>
                <th>Net Wt.</th>
                <th>Date</th>
                <th>#</th>
                </thead>
                <tbody>
                    <?php echo Kataparchy::getitems($id); ?>
                </tbody>
            </table>
        </fieldset>           
    </div>
</article>
<script type="text/javascript">
    function itemdelete(id, invoice_id) {
        $.ajax({
            url: '<?php echo $this->createUrl('kataparchy/itemdelete') ?>',
            data: {'id': id, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
            type: 'post',
            success: function(response) {
                getpartial(invoice_id);
                setInterval(function() {
                    window.location.href = "<?php echo $this->createUrl('kataparchy/create') ?>/" + invoice_id;
                }, 1000);
            }
        });
    }

    function edititem(id) {
        $('html,body').animate({
            scrollTop: $("#kataparchy-form").offset().top},
        1000);
        $("#item_label").hide();
        $("#additem").hide();
        $("#edititem").show();
        $('#kataparchy-form')[0].reset();
        $.getJSON("<?php echo $this->createUrl('kataparchy/getitemdata'); ?>", {"id": id}, function(data) {
            $("#kata_parchy_id").val(data.model.id);
            Getvendoritems(data.model.item_id);
            $("#itemname").fadeIn(1000).slideDown();
            GetItemname(data.model.item_id);
            $("#grn_no").val(data.model.grn_no);
            $("#order_no").val(data.model.order_no);
            $("#vendor_name").val(data.model.vendor_name);
            $("#load_weight").val(data.model.load_weight);
            $("#net_weight").val(data.model.net_weight);
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