<?php
if (!empty($list)) {
    ?>
    <article class="module width_full">
        <div class="module_content">
            <fieldset>
                <table class="table table-bordered">
                    <tbody>
                      <?php echo Expenseinvoiceitems::getbilltotalamt($list); ?>   
                      <?php echo Expenseinvoiceitems::getreverseinvoiceitems($list); ?>
                    </tbody>
                </table>
            </fieldset>           
        </div>
    </article>
<?php } ?>