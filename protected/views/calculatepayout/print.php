<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Payout List' => array('calculatepayout/admin'),
    'Print',
);
?>
<style type="text/css">
    #print_po{
        font-family:'Times New Roman';
        font-size: 15px;
    }
</style>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="panel-body">
                    <a href="#" class="btn btn-default pull-right" id="print_bill"><i class="fa fa-print"></i> Print</a>  
                    <div style="clear:both"></div><br/>  
                    <div id="print_po">                        
                        <center>
                            <h2>Payment Voucher</h2>
                        </center> 
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <table class="table table-bordered">
                                        <tr>
                                            <td><b>Voucher No.</b></td>
                                            <td><?php echo $list->voucher_no ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Voucher Date :</b></td>
                                            <td><?php echo date('d-m-Y',  strtotime($list->payment_date)) ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Place of Supply :</b></td>
                                            <td><?php echo Globalpreferences::getValueByParamName('company_state'); ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>State Code :</b></td>
                                            <td><?php echo Globalpreferences::getValueByParamName('place_of_supply_state_code') ?></td>
                                        </tr>
                                    </table> 
                                </td>
                                <td>
                                    <table class="table table-bordered">
                                        <tr>
                                            <td colspan="2" align="center"><b>Details of Supplier</b></td>
                                        </tr>
                                        <tr>
                                            <td><b>Name :</b></td>
                                            <td><?php echo $data->customer->vendor_name ?> <?php echo $data->customer->land_owner ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Address :</b></td>
                                            <td><?php echo $data->customer->village . ", " . $data->customer->district . ", " . $data->customer->state; ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>GSTIN :</b></td>
                                            <td><?php echo $data->customer->gstin_no; ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>State Code :</b></td>
                                            <td><?php echo $data->customer->state_code; ?></td>
                                        </tr>
                                    </table> 
                                </td>
                            </tr>
                        </table>
                        <fieldset>
                            <table class="table table-bordered">
                                <thead>
                                <th>Description of <br/> Product/Service</th>    
                                <th>HSN Codes</th>
                                <th class='text-right'>Taxable Value</th>
                                <?php if ($data->customer->place_of_supply == "1") { ?>
                                    <th class='text-right'>IGST Rate</th>
                                    <th class='text-right'>Amt.</th>
                                <?php } else { ?>
                                    <th class='text-right'>CGST Rate</th>
                                    <th class='text-right'>CGST Amt.</th>
                                    <th class='text-right'>SGST Rate</th>
                                    <th class='text-right'>SGST Amt.</th>
                                <?php } ?>
                                <th class='text-right'>Total Amt. Paid</th>
                                </thead>
                                <tbody>                                    
                                    <?php
                                    $total_tax_cgst = $list->tax_amt / 2;
                                    $total_tax_sgst = $list->tax_amt / 2;
                                    
                                    $total_rate_cgst = $list->tax_percent_rate / 2;
                                    $total_rate_sgst = $list->tax_percent_rate / 2;
                                    
                                    $r_total_tax_cgst = $list->reverse_amt / 2;
                                    $r_total_tax_sgst = $list->reverse_amt / 2;
                                    ?>
                                    <tr>
                                        <td><?php echo $data->kataparchy->item_name ?></td>
                                        <td><?php echo $data->kataparchy->gst_code ?></td>
                                        <td class='text-right'><?php echo $list->amount ?></td>
                                        <?php if ($data->customer->place_of_supply == "1") { ?>
                                            <td class='text-right'><?php echo $list->tax_percent_rate ?></td>
                                            <td class='text-right'><?php echo $list->tax_amt ?></td>
                                        <?php } else { ?>
                                            <td class='text-right'><?php echo $list->tax_percent_rate / 2 ?></td>
                                            <td class='text-right'><?php echo $total_tax_cgst; ?></td>
                                            <td class='text-right'><?php echo $list->tax_percent_rate / 2 ?></td>
                                            <td class='text-right'><?php echo $total_tax_sgst; ?></td>
                                        <?php } ?>
                                        <td class='text-right'><?php echo $list->amount ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Amount of Tax Subject to Reverse Charge</td>
                                        <td class='text-right'><?php echo $list->amount ?></td>
                                        <?php if ($data->customer->place_of_supply == "1") { ?>
                                            <td class='text-right'><?php echo $list->reverse_percent_rate ?></td>
                                            <td class='text-right'><?php echo $list->reverse_amt ?></td>
                                        <?php } else { ?>
                                            <td class='text-right'><?php echo $list->reverse_percent_rate / 2 ?></td>
                                            <td class='text-right'><?php echo $r_total_tax_cgst; ?></td>
                                            <td class='text-right'><?php echo $list->reverse_percent_rate / 2 ?></td>
                                            <td class='text-right'><?php echo $r_total_tax_sgst; ?></td>
                                        <?php } ?>
                                        <td class='text-right'><?php echo $r_total_tax_cgst+$r_total_tax_sgst ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <b>Total</b>
                                        </td>
                                        <td class='text-right'><b><?php echo $list->amount ?></b></td>
                                        <td></td>
                                        <td class='text-right'><?php echo $total_tax_cgst ?></td>
                                        <td></td>
                                        <td class='text-right'><?php echo $total_tax_sgst ?></td>
                                        <td class='text-right'><b><?php echo $list->amount ?></b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="8" align="center">
                                            <b>Invoice Total - Amount paid (in Words)- <?php echo Utils::convert_number_to_words($list->amount);?></b>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered">
                                <tr>
                                    <td colspan="2" align="center" valign="bottom">
                                        <br/><br/><br/><br/>
                                        <h4><b>For <?php echo Globalpreferences::getValueByParamName('company_name'); ?></b></h4><br/><br/><br/><br/>
                                        <h4><b>Authorized Signatory</b></h4>                                    
                                    </td>                                
                                   <td colspan="2" align="center" valign="bottom">
                                       <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
                                        <h4><b>Common Seal</b></h4>                                    
                                    </td>
                                    <td colspan="2" align="center">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td><b>Total Amount before Tax</b></td>
                                                <td><b>&#8377; <?php echo $list->amount ?></b></td>
                                            </tr>
                                            <tr>
                                                <td><b>Add: CGST <?php echo $list->tax_percent_rate / 2 ?> %</b></td>
                                                <td><b><?php echo $total_tax_cgst; ?></b></td>
                                            </tr>
                                            <tr>
                                                <td><b>Add: SGST <?php echo $list->tax_percent_rate / 2 ?> %</b></td>
                                                <td><b><?php echo $total_tax_sgst ?></b></td>
                                            </tr>
                                            <tr>
                                                <td><b>Total Tax Amount (GST) <?php echo $total_rate_cgst+$total_rate_sgst ?> %</b></td>
                                                <td><b><?php echo $total_tax_cgst+$total_tax_cgst ?></b></td>
                                            </tr>
                                            <tr>
                                                <td><b>Invoice Total</b></td>
                                                <td><b>&#8377; <?php echo $list->amount+$list->tax_amt;?></b></td>
                                            </tr>
                                            <?php if($data->customer->gstin_no==""){?>
                                            <tr>
                                                <td><b>GST on Reverse Charge <?php echo round($list->reverse_percent_rate)?> %</b></td>
                                                <td><b>&#8377; <?php echo $r_total_tax_cgst+$r_total_tax_sgst ?></b></td>
                                            </tr>
                                            <?php }?>
                                        </table>                                  
                                    </td>
                                </tr>
                            </table> 
                        </fieldset> 
                    </div>  
                </div>  
            </div>
        </div>
    </div>
</div>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/bs/js/jquery.js"></script>
<script type="text/javascript">
    $(function() {
        $("#print_bill").click(function() {
            var contents = $("#print_po").html();
            var frame1 = $('<iframe />');
            frame1[0].name = "frame1";
            frame1.css({"position": "absolute", "top": "-1000000px"});
            $("body").append(frame1);
            var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
            frameDoc.document.open();
            //Create a new HTML document.
            frameDoc.document.write('<html><head><title>Print</title>');
            frameDoc.document.write('</head><body>');
            //Append the external CSS file.
            frameDoc.document.write("<link href='<?php echo Yii::app()->request->baseUrl; ?>/dist/css/bootstrap.min.css' rel='stylesheet' type='text/css' />");
            //Append the DIV contents.
            frameDoc.document.write(contents);
            frameDoc.document.write('</body></html>');
            frameDoc.document.close();
            setTimeout(function() {
                window.frames["frame1"].focus();
                window.frames["frame1"].print();
                frame1.remove();
            }, 500);
        });
    });
</script>