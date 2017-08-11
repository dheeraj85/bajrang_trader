<?php
if (!empty($list)) {
    ?>
    <article class="module width_full">     
        <div class="module_content">
            <fieldset>
                <table class="table table-bordered">
                    <thead>
                    <th></th>
                    <th class='text-right' colspan="3"></th>
                    <?php if($list->place_of_supply=="1"){?>
                    <th class='text-right' style="color:#fff;">IGST Rate</th>
                    <th class='text-right' style="color:#fff;">Amt.</th>
                    <?php }else{?>
                    <th class='text-right' style="color:#fff;">CGST Rate</th>
                    <th class='text-right' style="color:#fff;">CGST Amt.</th>
                    <th class='text-right' style="color:#fff;">SGST Rate</th>
                    <th class='text-right' style="color:#fff;">SGST Amt.</th>
                    <?php }?>
                    <th class='text-right' colspan="7"></th>
                    <th>#</th>
                    </thead>
                    <tbody>
                         <?php echo Purchaseinvoiceitems::getbilltotalamt($list); ?>
                    </tbody>
                </table>
            </fieldset>           
        </div>
    </article>
<?php } ?>
<script type="text/javascript">
    function deletetax(id,invoice_id) {
        $.ajax({
            url: '<?php echo $this->createUrl('purchaseinvoice/deletetax') ?>',
            data: {'id': id, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
            type: 'post',
            success: function(response) {
                getbillpartial(invoice_id);
                setInterval(function() {
                        window.location.href = "<?php echo $this->createUrl('purchaseinvoice/create') ?>/"+invoice_id;
                 }, 1000);
            }
        });
    }
</script>