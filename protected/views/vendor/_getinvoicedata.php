<?php
if (!empty($list)) {
    ?>
    <article class="module width_full">
        <div class="module_content" id="show_content">
            <fieldset>
                <table class="table table-bordered">             
                    <tbody>
                    <th>Item.</th>
                    <th>Qty.</th>
                    <?php if($list->invoice_format=="F1"){?>
                    <th>Taxes</th>
                    <?php }?>
                    <?php if($list->discount_type=="item_discount"){?>
                    <th>Discount</th>
                    <?php }?>
                    <th>Rate (Rs.)</th>
                    <th>Amount (Rs.)</th>
                    </thead>
                    <tbody>
                         <?php echo Purchaseinvoiceitems::getinvoiceitemsreview($list); ?>
                         <?php echo Purchaseinvoiceitems::getbilltotalamtreview($list); ?>
                    </tbody>
                </table>
            </fieldset>
        </div>
    </article>
<?php } ?>