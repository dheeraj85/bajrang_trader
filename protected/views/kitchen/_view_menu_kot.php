<?php
$mkot = Menukot::model()->findByPk($id);
?>

<style>
    @media print {
        .no-print{
            display:none; 
        }
        tr td,th {
            font-size:12px;  
        }
        #bill_area {
            overflow: no-display;
        }
        .border_on_print{
            border-bottom:1px dotted #000; 
        }
        .border_on_print_tb{
            border-bottom:1px dotted #000; 
            border-top: 1px dotted #000; 
        }
        *{
            font-family:monospace; 
        }
    }

    @media only screen{
        .no-screen{
            display:none; 
        }
        #bill_area {
            overflow: scroll;
        }
    }

</style>
<div id="myOrderModals" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">MKOT Detail</h4>
            </div>
            <div class="modal-body">
                <div class="section-body">
                    <div class="row" id="printorder">
                        <div class="col-sm-3"></div>
                        <div class="col-md-6" style="border: 1px solid black;" id="data"> 
                            <div class="card-printable" id="kot-details"><div class="row">
                                    <div class="col-xs-4" style="text-align: left;"><h4><?php echo $mkot->status; ?></h4></div> 
                                    <div class="col-xs-4" style="text-align: center;"><div id="circle"><strong id="text">MKOT No <br/> <?php echo $mkot->kot_no; ?></strong></div></div> 
                                    <div class="col-xs-4" style="text-align: right;"><h4><?php echo date('d-m-Y', strtotime($mkot->kot_date)); ?></h4></div> 
                                </div> <hr/>   
                                <div class="card">    
                                    <table class="table no-margin">
                                        <thead>
                                        <th>S No.</th>
                                        <th>Item</th>
                                        <th>Qty</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $c = 1;
                                            $mkot_items = Menukotitems::model()->findAllByAttributes(array('menu_kot_id' => $mkot->id));
                                            foreach ($mkot_items as $item) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $c++; ?></td>
                                                    <td><?php echo Menukotitems::getMenuItem($item); ?></td>
                                                    <td><?php echo $item->qty; ?></td>
                                                </tr>  
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <?php if ($mkot->status == 'pending') { ?>
                    <button type="button" data-loading-text="Please wait..." onclick="ChangeMKotStatus('accept', '<?php echo $mkot->id; ?>');" class="btn btn-primary btn_loading">Click to ACCEPT</button>&emsp;
                    <!--<button type="button" data-loading-text="Please wait..." onclick="ChangeMKotStatus('reject', '<?php echo $mkot->id; ?>');" class="btn btn-danger btn_loading">Click to REJECT</button>&emsp;-->
                <?php } else if ($mkot->status == 'accept') { ?>
                    <button type="button" data-loading-text="Please wait..." onclick="ChangeMKotStatus('done', '<?php echo $mkot->id; ?>');" class="btn btn-success btn_loading">Click to DONE</button>&emsp;
                <?php } else if ($mkot->status == 'reject') { ?>
                    <button type="button" data-loading-text="Please wait..." onclick="ChangeMKotStatus('accept', '<?php echo $mkot->id; ?>');" class="btn btn-primary btn_loading">Click to ACCEPT</button>&emsp;
                <?php } else if ($mkot->status == 'done') { ?>
                <?php } ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btnPrint" onclick="Print()"><i class="glyphicon glyphicon-print"></i> Print </button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        $("#myOrderModals").modal({backdrop: 'static', keyboard: false});
    });

    function ChangeMKotStatus(status, id) {
        var $btn = $('.btn_loading').button('loading');
        $.ajax({
            url: '<?php echo $this->createUrl('kitchen/changemkotstatus'); ?>',
            data: {'status': status, 'id': id},
            type: 'post',
            success: function (response) {
                $btn.button('reset');
                $("#myOrderModals").modal('hide');
                window.location.reload();
            }
        });
    }

    $(function () {
        $("#btnPrint").click(function () {
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
            frameDoc.document.write("<link href='<?php echo Yii::app()->request->baseUrl; ?>/bs/css/bootstrap.css' rel='stylesheet' type='text/css' />");
            frameDoc.document.write("<link href='<?php echo Yii::app()->request->baseUrl; ?>/bs/css/bootstrap-theme.css' rel='stylesheet' type='text/css' />");
            //Append the DIV contents.
            frameDoc.document.write(contents);
            frameDoc.document.write('</body></html>');
            frameDoc.document.close();
            setTimeout(function () {
                window.frames["frame1"].focus();
                window.frames["frame1"].print();
                frame1.remove();
            }, 500);
        });
    });
</script>