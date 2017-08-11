<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Internal Indent',
    'Manage Indent',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Indentmaster', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Indentmaster', 'url' => array('create')),
);
?>
<style>
    @media print
    {
        .no_print{
            display: none;
        }

    }
</style>
<div class="panel panel-primary">
    <div class="panel-heading">Indent Details</div>
    <div class="panel-body">

        <div class="row well">
            <div class="col-lg-6" style="font-size: 16px" >
                Indent No: <b><?php echo $model->id ?></b>  |             
                Dated: <b><?php echo $model->indent_date; ?></b> | 
                Type: <b><?php echo $model->indent_type; ?></b> | 
                Indent From: <b><?php echo $model->createdby->name; ?> (<?php echo $model->created_user_role; ?>)</b>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-6" style="background-color: #3ff9d5">

                <?php
                if (!empty($model->invoice_id)) {
                    $items_invoice = Indentitems::model()->findAllByAttributes(array('sync_id' => $model->sync_id, 'item_purpose' => 'Resale'));
                    if (!empty($items_invoice)) {
                        ?>
                        <div id="print_invoice" style=" text-align: center;">
                            <h3><?php echo Yii::app()->params['company_name']; ?></h3>
                            <h4>Invoice</h4>
                            <div class="col-lg-8 pull-left" style=" text-align:justify;">
                                To, <br>
                                <?php echo $model->createdby->name; ?> (<?php echo $model->created_user_role; ?>), <?php echo $model->createdby->mobile; ?>
                            </div>
                            <div class="col-lg-4 pull-right">Invoice # <?php echo $model->invoice_id; ?> / Dt: <?php echo date('d-M-Y', strtotime($model->invoice_date)); ?></div>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Item Name</th>
                                        <th>Qty</th>                                     
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody><?php
                                    $grand_amount = 0.00;
                                    $c = 1;
                                    foreach ($items_invoice as $item) {
                                        ?>
                                        <tr>
                                            <td><?php echo $c; ?></td>
                                            <td><b><?php echo $item->item_name . " (" . $item->item_brand . ")"; ?></b>
                                                <table class="table table-bordered">
                                                    <tr>

                                                        <th>MRD No</th>
                                                        <th>Make Date</th>
                                                        <th>Discard Date</th>
                                                        <th>Qty</th>
                                                        <th>Rate</th>
                                                        <th>Tax</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                    <?php
                                                    $amount_total = 0.00;
                                                    $stocks = InternalStock::model()->findAllByAttributes(array('indent_item_id' => $item->id));
                                                    foreach ($stocks as $s) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $s->mrd_no; ?></td>
                                                            <td><?php echo $s->make_date; ?></td>
                                                            <td><?php echo $s->discard_date; ?></td>
                                                            <td><?php echo $s->stock_qty . " " . $s->stock_taking_scale; ?></td>
                                                            <td><?php echo $s->rate; ?></td>
                                                            <td><?php echo $s->tax; ?></td>
                                                            <td><?php
                                                                $amount_total = $amount_total + $s->amount;
                                                                echo $s->amount;
                                                                ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </table>
                                            </td>
                                            <td><?php
                                                if ($item->qty_dispatch) {
                                                    echo $item->qty_dispatch . " " . $item->qty_scale;
                                                }
                                                ?></td>
                                            <td><?php $grand_amount = $grand_amount + $amount_total;
                                    echo $amount_total; ?></td>
                                        </tr>
                                        <?php
                                        $c++;
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="3" align="right">Total</td>
                                        <td><b><?php echo $grand_amount; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" align="right">In Words : <?php echo Utils::convert_number_to_words($grand_amount); ?></td>

                                    </tr>

                                </tbody>
                            </table>



                        </div>
                        <div class="pull-left"> <a href="#" onclick="printInvoice('#print_invoice')" class="btn btn-primary">Print Invoice</a></div>
                    <?php } ?>
<?php } ?>
            </div>


            <div class="col-lg-6 pull-right" style="background-color: #e7ff61">



                <?php
                if (!empty($model->invoice_id)) {
                    $items_challan = Indentitems::model()->findAllByAttributes(array('sync_id' => $model->sync_id, 'item_purpose' => 'Supply'));
                    if (!empty($items_challan)) {
                        ?>
                        <div id="print_challan" style=" text-align: center;">
                            <h3><?php echo Yii::app()->params['company_name']; ?></h3>
                            <h4>Challan</h4>
                            <div class="col-lg-8 pull-left" style=" text-align:justify;">
                                To, <br>
        <?php echo $model->createdby->name; ?> (<?php echo $model->created_user_role; ?>), <?php echo $model->createdby->mobile; ?>
                            </div>
                            <div class="col-lg-4 pull-right">Challan # <?php echo $model->challan_no; ?> / Dt: <?php echo date('d-M-Y', strtotime($model->invoice_date)); ?></div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Item Name</th>
                                        <th>Total Qty</th>                                     
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody><?php
                                    $grand_challan_amount = 0.00;
                                    $c = 1;
                                    foreach ($items_challan as $item) {
                                        if ($item->qty_dispatch > 0) {
                                            ?>
                                            <tr>
                                                <td><?php echo $c; ?></td>
                                                <td><b><?php echo $item->item_name . " (" . $item->item_brand . ")"; ?></b>
                                                    <table class="table table-bordered">
                                                  .      <tr>                                                        
                                                            <th>MRD No</th>
                                                            <th>Make Date</th>
                                                            <th>Discard Date</th>
                                                            <th>Qty</th>
                                                            <th>Rate</th>
                                                            <!--<th>Tax</th>-->
                                                            <th>Amount</th>
                                                        </tr>
                                                        <?php
                                                        $amount_total = 0.00;
                                                        $stocks = InternalStock::model()->findAllByAttributes(array('indent_item_id' => $item->id));
                                                        foreach ($stocks as $s) {
                                                            ?>
                                                            <tr>                                                           
                                                                <td><?php echo $s->mrd_no; ?></td>
                                                                <td><?php echo $s->make_date; ?></td>
                                                                <td><?php echo $s->discard_date; ?></td>
                                                                <td><?php echo $s->stock_qty . " " . $s->stock_taking_scale; ?></td>
                                                                <td><?php echo $s->rate; ?></td>
                                                                <!--<td><?php //echo $s->tax;  ?></td>-->
                                                                <td><?php
                                                                    $amount_total = $amount_total + $s->amount;
                                                                    echo $s->amount;
                                                                    ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </table>
                                                </td>
                                                <td><b><?php
                                                        if ($item->qty_dispatch) {
                                                            echo $item->qty_dispatch . " " . $item->qty_scale;
                                                        }
                                                        ?></b></td>

                                                <td><?php $grand_challan_amount = $grand_challan_amount + $amount_total;
                                                echo $amount_total; ?></td>
                                            </tr>
                                            <?php
                                            $c++;
                                        }
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="3" align="right">Total</td>
                                        <td><b><?php 
                                    echo $grand_challan_amount; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" align="right">In Words : <?php echo Utils::convert_number_to_words($grand_challan_amount); ?></td>

                                    </tr>
                                </tbody>
                            </table>


                        </div>
                        <div class="pull-right"> <a href="#" onclick="printChallan('#print_challan')" class="btn btn-primary">Print Challan</a></div>
    <?php } ?>
<?php } ?>
            </div>          
        </div>

    </div>
</div>

<script>
    function printChallan(elem)
    {
        Popup($('<div/>').append($(elem).clone()).html());
    }
    function printInvoice(elem)
    {
        Popup($('<div/>').append($(elem).clone()).html());
    }
    function Popup(data)
    {

        var mywindow = window.open('', 'Print', 'height=600,width=900');
        mywindow.document.write('<html><head><title>Print</title>');
        mywindow.document.write('<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/bs/css/bootstrap.css" media="print" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.print();
//  mywindow.close();

        return true;
    }
</script>