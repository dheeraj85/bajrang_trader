<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Item Stock',
    'Finished Item Details',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Purchaseinvoice', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Purchaseinvoice', 'url' => array('admin')),
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="panel-body" style="padding:0px;">
                    <article class="module width_full">
                        <div class="box-header bg-red">
                            <h3 class="panel-title">Item Details</h3>
                        </div>
                        <div class="module_content">
                            <fieldset>
                                <table class="table table-bordered">
                                    <thead>
                                    <th>Item.</th>
                                    <th>Taxes</th>
                                    <th>Discount</th>
                                    <th>Amt (Rs.)</th>
                                    </thead>
                                    <tbody>
                                        <?php echo Purchaseinvoiceitems::getinvoiceitemsgpu($model); ?>
                                    </tbody>
                                </table>
                            </fieldset>           
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>