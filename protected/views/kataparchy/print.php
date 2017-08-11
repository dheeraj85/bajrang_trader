<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Purchase Invoice' => array('purchaseinvoice/admin'),
    'Print Kata Parchy',
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="panel-body">
                    <a href="#" class="btn btn-default pull-right" id="print_bill"><i class="fa fa-print"></i> Print</a>  
                    <div style="clear:both"></div><br/>  
                    <div id="print_po"> 
                       <div class="pull-left">
                            <b>Pass No : ........................</b><br/><br/>
                            <b>Mode of Trpt : Road Truck</b><br/><br/>
                            <b>Vehicle No : <?php echo $data->truck_wagon_no?></b><br/><br/>
                            <b>No & Date : <?php echo $list->challan->id;?>/<?php echo $list->challan->challan_date;?></b>
                        </div>
                        <div class="pull-right">
                            <b>GRN No : <?php echo $list->grn_no;?></b><br/><br/>
                            <b>Driver Name : <?php echo $data->driver_name?></b><br/><br/>
                            <b>Trpt.No./Name : <?php echo Yii::app()->params['company_name']?></b><br/><br/>
                            <b>Bilty No/Date : <?php echo $list->challan->id;?>/<?php echo $list->challan->challan_date;?></b>
                        </div>
                       <div style="clear:both"></div><br/>  
                         <table class="table table-bordered">
                                <thead>     
                                <th>Item Code</th>    
                                <th>PO Number</th>
                                <th>Material</th>
                                <th>Vendor</th>
                                <th class='text-right'>Load Wt.</th>
                                <th class='text-right'>Net Wt.</th>
                                </thead>
                                <tbody>
                                    <?php 
                                        echo "<td>" . $list->item_code . "</td>";
                                        echo "<td>" . $list->order_no . "</td>";
                                        echo "<td>" . $list->item_name . "</td>";
                                        echo "<td>" . Yii::app()->params['company_name'] . "</td>";
                                        echo "<td align='right'>" . $list->load_weight . "</td>";
                                        echo "<td align='right'>" . $list->net_weight . "</td>";
                                        echo "</tr>";
                                        $load_weight = $load_weight + $list->load_weight;
                                        $net_weight = $net_weight + $list->net_weight;
                                        echo "<tr>";
                                        echo "<td colspan='4'><b>Total Weight in MT </b></td>";
                                        echo "<td align='right'><b>" . $load_weight . "</b></td>";
                                        echo "<td align='right'><b>" . $net_weight . "</b></td>";
                                        echo "</tr>";
                                    ?>
                                </tbody>
                            </table>    
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