<?php
$pkot = Productionkot::model()->findByPk($id);
?>
<style>
    #circle {
        text-align: center;
        width: 75px;
        height: 75px;
        -webkit-border-radius: 50px;
        -moz-border-radius: 50px;
        border-radius: 50px;
        background: #6d7eb7;
    }

    #text {
        position: absolute;
        top: 50%;
        left: 40%;
        transform: translate(-50%, -50%);
        color: #fff;
    }

    p.speech,.left-speech {
        position: relative;
        margin-left: -15px;
        padding: 5px;
        width: 90%;
        height: auto;
        text-align: left;
        line-height: 20px;
        background-color: #fff;
        border: 1px solid #666;
        -webkit-border-radius: 10px;
        -moz-border-radius: 10px;
        border-radius: 10px;
        -webkit-box-shadow: 2px 2px 4px #888;
        -moz-box-shadow: 2px 2px 4px #888;
        box-shadow: 2px 2px 4px #888;
    }

    p.speech,.right-speech {
        position: relative;
        margin-left: 10%;
        padding: 5px;
        width: 90%;
        height: auto;
        text-align: left;
        line-height: 20px;
        background-color: #fff;
        border: 1px solid #666;
        -webkit-border-radius: 10px;
        -moz-border-radius: 10px;
        border-radius: 10px;
        -webkit-box-shadow: 2px 2px 4px #888;
        -moz-box-shadow: 2px 2px 4px #888;
        box-shadow: 2px 2px 4px #888;
    }
</style>

<div id="myOrderModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">PKOT Detail</h4>
            </div>
            <div class="modal-body">
                <div class="section-body">
                    <div class="row" id="printorder">
                        <div class="col-sm-3"></div>
                        <div class="col-md-6" style="border: 1px solid black;" id="data"> 
                            <div class="card card-printable" id="kot-details">

                            </div>
                        </div>
                        <div class="col-sm-3"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <?php if ($pkot->status == 'pending') { ?>
                    <button type="button" data-loading-text="Please wait..." onclick="ChangePKotStatus('accept', '<?php echo $pkot->id; ?>');" class="btn btn-primary btn_loading">Click to ACCEPT</button>&emsp;
                    <button type="button" data-loading-text="Please wait..." onclick="ChangePKotStatus('reject', '<?php echo $pkot->id; ?>');" class="btn btn-danger btn_loading">Click to REJECT</button>&emsp;
                <?php } else if ($pkot->status == 'accept') { ?>
                    <button type="button" data-loading-text="Please wait..." onclick="ChangePKotStatus('done', '<?php echo $pkot->id; ?>');" class="btn btn-success btn_loading">Click to DONE</button>&emsp;
                <?php } else if ($pkot->status == 'reject') { ?>
                    <button type="button" data-loading-text="Please wait..." onclick="ChangePKotStatus('accept', '<?php echo $pkot->id; ?>');" class="btn btn-primary btn_loading">Click to ACCEPT</button>&emsp;
                <?php } else if ($pkot->status == 'done') { ?>
                <?php } ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btnPrint" onclick="Print()"><i class="glyphicon glyphicon-print"></i> Print </button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        var id = '<?php echo $id; ?>';
        Refresh(id);
        $("#myOrderModal").modal({backdrop: 'static', keyboard: false});
    });

    function Refresh(id) {
        $.ajax({
            url: '<?php echo $this->createUrl('kitchen/refreshkot'); ?>',
            data: {'id': id},
            type: 'post',
            success: function(response) {
                $('#kot-details').html(response);
            }
        });
    }

    function ChangePKotStatus(status, id) {
        var $btn = $('.btn_loading').button('loading');
        $.ajax({
            url: '<?php echo $this->createUrl('kitchen/changepkotstatus'); ?>',
            data: {'status': status, 'id': id},
            type: 'post',
            success: function(response) {
                $btn.button('reset');
                $("#myOrderModal").modal('hide');
            }
        });
    }

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
            frameDoc.document.write("<link href='<?php echo Yii::app()->request->baseUrl; ?>/bs/css/bootstrap.css' rel='stylesheet' type='text/css' />");
            frameDoc.document.write("<link href='<?php echo Yii::app()->request->baseUrl; ?>/bs/css/bootstrap-theme.css' rel='stylesheet' type='text/css' />");
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