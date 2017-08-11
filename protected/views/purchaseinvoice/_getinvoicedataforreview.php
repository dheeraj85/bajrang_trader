<?php
if (!empty($list)) {
    ?>
  <article class="module width_full table-responsive">
        <div class="module_content">
            <fieldset>
                <table class="table table-bordered">
                    <thead>                        
                    <th>Invoice No</th>
                    <th>Invoice Type</th>
                    <th>Vendor</th>
                    <th>GSTIN No</th>
                    <th>Bill GSTIN No</th>
                    <th>Place of Supply</th>
                    <th>Invoice Date</th>
                    <th>Status</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $list->invoice_no; ?>
                            <?php 
                            if($list->is_gstn_compliant=="1"){
                                echo "<span class='badge pull-right' style='background-color: #dd4b39'>C</span>";
                            }
                            ?>
                            </td>
                            <td><?php echo $list->invoice_type; ?></td>
                            <td><?php echo $list->reqstatus($list); ?></td>
                            <td><?php echo $list->req_gst($list); ?></td>
                            <td><?php echo $list->gstin_no; ?></td>
                            <td><?php echo $list->statecode($list); ?></td>
                            <td><?php echo $list->invoice_date; ?></td>    
                            <td><?php echo $list->check_gst($list); ?></td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>           
        </div>
    </article>
    <article class="module width_full">
        <div class="box-header bg-green">
            <h3 class="panel-title">Purchase Invoice Item Details</h3>
        </div>
        <div class="module_content" id="show_content">
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
                    </thead>
                    <tbody>
                         <?php echo Purchaseinvoiceitems::getinvoiceitemsreview($list); ?>
                    </tbody>
                </table>
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
                    </thead>
                    <tbody>
                         <?php echo Purchaseinvoiceitems::getbilltotalamtreview($list); ?>
                    </tbody>
                </table>
            </fieldset>
        </div>
    </article>
<?php } ?>