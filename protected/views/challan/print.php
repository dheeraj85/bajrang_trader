<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Challan' => array('challan/admin'),
    'Print Challan',
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
                        <div class="pull-left">
                            <b>GSTN No : <?php echo Globalpreferences::getValueByParamName('company_gstin')?></b><br/>
                            <b>PAN No : <?php echo Globalpreferences::getValueByParamName('company_pan')?></b>
                        </div>
                        <div class="pull-right">
                            <b>Ph. No : <?php echo Globalpreferences::getValueByParamName('company_contact')?></b><br/>
                            <b>Mobile No : <?php echo Globalpreferences::getValueByParamName('company_mobile')?></b>
                        </div>
                        <div style="clear:both"></div><br/>
                        <center>
                            <h2 style="background-color:#000;color:#fff;font-weight:bold;">CHALLAN</h2>
                            <u><?php echo Globalpreferences::getValueByParamName('subject')?></u>
                            <h2><?php echo Globalpreferences::getValueByParamName('company_name')?></h2>
                            <h4><?php echo Globalpreferences::getValueByParamName('company_addr1')."<br/><br/>".Globalpreferences::getValueByParamName('company_addr2');?></h4>
                        </center>
                        <div><b>Batch No. .........</b></div><br/>
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    To,
                                    <center>
                                    <h4><b><?php echo $data->customer->full_name;?></b></h4>
                                    <h5><?php echo $data->customer->address;?></h5>
                                    </center>
                                </td>
                                <td>
                                    <table class="table table-bordered">
                                        <tr>
                                            <td><b>Ch. No.</b></td>
                                            <td><?php echo $data->id ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Date :</b></td>
                                            <td><?php echo $data->challan_date ?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                         <table class="table table-bordered">
                            <tr>
                                <td>
                                    <b>Purchase Order No.</b>
                                </td>
                                <td><?php echo $data->getpo($data); ?></td>
                                <td>
                                    <b>Ex-Station :</b>
                                </td>
                                <td><?php echo $data->ex_station ?></td>
                            </tr>
                        </table>
                        <fieldset>
                            <table class="table table-bordered">
                                <thead>
                                <th>Truck No.</th>    
                                <th>Particulars</th>
                                <th>Approximate Weight in MT</th>
                                <th class='text-right'>Rate in MT (INR)</th>
                                <th class='text-right'>Amount</th>
                                </thead>
                                <tbody>
                                    <?php echo Challanitems::getitems_print($id); ?>
                                </tbody>
                            </table>
                        </fieldset> 
                        <p style="text-align:justify;">
                            <b>DECLARATION : </b> My self Anil Kumar Agrawal Proprietor of <b><?php echo Globalpreferences::getValueByParamName('company_name')?>, <?php echo Globalpreferences::getValueByParamName('company_addr1').", ".Globalpreferences::getValueByParamName('company_addr2')?></b> do hereby declare
                            that the Bamboo / Firewood supplied by Truck/Tractor No. (Mentioned as above) has been procured by me from a genuine source. Details of source records are with me. In case any dispute arise in any way i.e. from Govt. Forest Department. Revenue Department or
                            Local Administration Department the whole liability/responsibility shall be borne by me.
                        </p><br/>
                        <div class="pull-right">
                            (<b>ANIL AGRAWAL</b>)
                        </div>
                        <br/><br/>
                        <table class="table">
                            <tr>
                                <td><b>Note : Original bill will be issued after weighment of Truck at <?php echo Globalpreferences::getValueByParamName('company_name')?>, <?php echo Globalpreferences::getValueByParamName('company_addr1').", ".Globalpreferences::getValueByParamName('company_addr2')?></b></td>
                            </tr>
                        </table>
                        <br/><br/>
                         <div class="pull-right">
                            (<b>For. : M/s. <?php echo Globalpreferences::getValueByParamName('company_name')?></b>)
                        </div>
                        <br/><br/>
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