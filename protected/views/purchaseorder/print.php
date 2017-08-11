<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Purchase Orders' => array('purchaseorder/admin'),
    'Print Purchase Order',
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
                        <center><h3>Purchase Order</h3></center><hr/>
                        <table class="table table-bordered">
                            <tr>
                                <th>Order No.</th>
                                <th>GST No.</th>
                                <th>Delivery Period From</th>
                                <th>Delivery Period To</th>
                                <th>Location</th>
                            </tr>
                            <tr>
                                <td><?php echo $data->order_no ?></td>
                                <td><?php echo $data->gst_no ?></td>
                                <td><?php echo $data->delivery_form ?></td>
                                <td><?php echo $data->delivery_to ?></td>
                                <td><?php echo $data->place ?></td>
                            </tr>
                        </table>
                        <fieldset>
                            <table class="table table-bordered">
                                <thead>
                                <th>S. No.</th>    
                                <th>Item Code</th>
                                <th>HSN/SAC</th>
                                <th>Item Description</th>
                                <th>Qty</th>
                                <th class='text-right'>Rate(INR)</th>
                                <th class='text-right'>PER</th>
                                <th class='text-right'>OPU</th>
                                </thead>
                                <tbody>
                                    <?php echo Purchaseorderitems::getordersitems_print($id); ?>
                                </tbody>
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