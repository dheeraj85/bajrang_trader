<?php 
 $flavor = Cakeflavour::model()->findByPk($cake_order->flavour_id);
?>
<div id="myOrderModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Ingredients Detail for <?php echo $flavor->flavour_name; ?> Flavor  Cake</h4>
            </div>
            <div class="modal-body">
                <div class="section-body">
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-md-10">
                            <div class="card card-printable" id="printorder">   
                                <?php if (!empty($list)) { ?>
                                <strong>&emsp;Flavor Name : &emsp;<?php echo $flavor->flavour_name; ?></strong>
                                    <table class="table">
                                        <thead>
                                        <th style="width: 10%;">S No</th>
                                        <th style="width: 40%;">Item Name</th>
                                        <th style="width: 50%;">Needed Weight in gm</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $c = 0;
                                            $total_weight = 0.00;
                                            foreach ($list as $item) {
                                                $item_name = Purchaseitem::model()->findByPk($item->item_id);
                                                $weight = $item->weight_in_gm * $cake_order->weight;
                                                $total_weight = $total_weight + $weight;        
                                                ?>
                                                <tr>
                                                    <td><?php echo ++$c; ?></td>
                                                    <td><?php echo $item_name->itemname; ?></td>
                                                    <td><?php echo $weight; ?></td>
                                                </tr>
                                            <?php } ?>
                                                <tr>
                                                    <td colspan="2" style="text-align: center;"><b>Total Weight in gram's</b></td>
                                                    <td><?php echo $total_weight.' gm'; ?></td>
                                                </tr>
                                        </tbody>
                                    </table>
                                <?php }else{ ?>
                                <div class="alert alert-danger"><h4>No Record Found For This Flavor</h4></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btnPrint" onclick="Print()"><i class="glyphicon glyphicon-print"></i> Print </button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#myOrderModal").modal({backdrop: 'static', keyboard: false});
    });

    $(function() {
        $("#btnPrint").click(function() {
            var contents = $("#printorder").html();
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
            frameDoc.document.write("<link href='<?php echo Yii::app()->request->baseUrl; ?>/front/theme-default/materialadminb0e2.css' rel='stylesheet' type='text/css' />");
            frameDoc.document.write("<link href='<?php echo Yii::app()->request->baseUrl; ?>/front/theme-default/materialadmin_printb0e2.css' rel='stylesheet' type='text/css' />");
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