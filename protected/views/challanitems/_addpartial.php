<article class="module width_full">
    <div class="box-header bg-green">
        <h3 class="panel-title">Challan Item Details</h3>
    </div>
    <div class="module_content">
        <fieldset>
            <table class="table table-bordered">
                <thead>
                <th>Truck No.</th>    
                <th>Particulars</th>
                <th>Weight in MT</th>
                <th class='text-right'>Rate in MT (INR)</th>
                <th class='text-right'>Amount</th>
                <th>#</th>
                </thead>
                <tbody>
                    <?php echo Challanitems::getitems($id); ?>
                </tbody>
            </table>
        </fieldset>           
    </div>
</article>
<script type="text/javascript">
    function itemdelete(id, challan_id) {
        $.ajax({
            url: '<?php echo $this->createUrl('challanitems/itemdelete') ?>',
            data: {'id': id, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
            type: 'post',
            success: function(response) {
                getpartial(challan_id);
                setInterval(function() {
                    window.location.href = "<?php echo $this->createUrl('challanitems/create') ?>/" + challan_id;
                }, 1000);
            }
        });
    }

    function edititem(id) {
        $('html,body').animate({
            scrollTop: $("#challanitems-form").offset().top},
        1000);
        $("#item_label").hide();
        $("#additem").hide();
        $("#edititem").show();
        $('#challanitems-form')[0].reset();
        $.getJSON("<?php echo $this->createUrl('challanitems/getitemdata'); ?>", {"id": id}, function(data) {
            $("#challan_item_id").val(data.model.id);
            Getvendoritems(data.model.item_id);
            $("#itemname").fadeIn(1000).slideDown();
            GetItemname(data.model.item_id);
            $("#qty").val(data.model.weight);
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