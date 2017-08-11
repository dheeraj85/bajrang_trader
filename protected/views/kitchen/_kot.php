<?php 
if ($pkot->status == 'pending') {
        $pkot_status = 'Pending';
    }
    if ($pkot->status == 'accept') {
        $pkot_status = 'Accept';
    }
    if ($pkot->status == 'reject') {
       $pkot_status = 'Reject';
    }
    if ($pkot->status == 'done') {
        $pkot_status = 'Done';
    }
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


    @media print {
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
            left: 50%;
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
            margin-left: 8%;
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

        .no-print{
            display: none;
        }
    }
</style>

<div class="row">
    <div class="col-xs-4" style="text-align: left;"><h4><?php echo $pkot_status; ?></h4><h5><?php echo date('d-m-Y',  strtotime($pkot->kot_date)); ?></h5></div> 
    <div class="col-xs-4" style="text-align: center;"><div id="circle"><strong id="text">PKOT No <br/> <?php echo $pkot->kot_no; ?></strong></div></div> 
    <div class="col-xs-4" style="text-align: right;"><?php if($pkot->is_redraw==0){ ?><h4>Redraw</h4><?php }else if($pkot->is_redraw==1){ ?><h4 style="color: #ff9933"><b>Redraw</b></h4><?php } ?><h4><?php echo $pkot->delivery_status; ?></h4></div> 
</div> <hr/>   
<div class="card">    
    <table class="table no-margin">
        <thead>
        <th>S No.</th>
        <th>Item</th>
        <th>Qty</th>
        <th class="no-print"></th>
        </thead>
        <tbody>
            <?php
            $c = 1;
            foreach ($pkot_items as $item) {
                ?>
                <tr>
                    <td><?php echo $c++; ?></td>
                    <td><?php echo Productionkotitems::getItem($item); ?></td>
                    <td><?php echo $item->qty; ?></td>
                    <td class="no-print">
                        <?php if ($item->status == "pending") { ?>
                            <a href="#" class="btn btn-success" onclick="ChangeItemStatus('accept',<?php echo $item->id; ?>,<?php echo $item->production_kot_id; ?>);"><i class="glyphicon glyphicon-ok"></i> Accept</a>  
                            <a href="#" class="btn btn-danger" onclick="ChangeItemStatus('reject',<?php echo $item->id; ?>,<?php echo $item->production_kot_id; ?>);"><i class="glyphicon glyphicon-remove"></i> Reject</a>  
                        <?php } else if ($item->status == "accept") { ?> 
                            <a href="#" class="btn btn-primary" onclick="ChangeItemStatus('done',<?php echo $item->id; ?>,<?php echo $item->production_kot_id; ?>);"><i class="glyphicon glyphicon-ok"></i> Done</a> 
                        <?php } else if ($item->status == "done") { ?> 
                            <!--<a href="#" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Remove</a>--> 
                        <?php } ?>
                    </td>
                </tr>  
            <?php } ?>
            <tr>
                <td colspan="4">
                    <h4>Delivery By : <?php echo $pkot->deliver_by; ?></h4>
                    <h4>Comments : </h4><hr/>
                    <div id="comment_box">
                        <?php
                        foreach ($pkot_comments as $comment) {
                            if ($comment->from_id == Yii::app()->user->id) {
                                ?>
                                <p class="right-speech"></span><?php echo $comment->comments; ?></p>
                            <?php } else {
                                ?>
                                <p class="left-speech"><?php echo $comment->comments; ?></p>
                                <?php
                            }
                        }
                        if ($item->status != "done") {
                            ?>
                            <div class="col-sm-11 no-print">
                                <textarea class="form-control" rows="3" cols="8" name="comment" id="comment"></textarea>
                            </div>
                            <div class="col-sm-1 no-print">
                                <button class="btn btn-rounded btn-info pull-left btn-comment" onclick="Savecomment(<?php echo $id; ?>);" type="button"><i class="glyphicon glyphicon-send"></i></button>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<script type="text/javascript">

    function Savecomment(id) {
        var $btn = $('.btn-comment').button('loading');
        var comment = $("#comment").val();
        $.ajax({
            url: '<?php echo $this->createUrl('kitchen/savecomment'); ?>',
            data: {'id': id, 'comment': comment},
            type: 'post',
            success: function(response) {
                $btn.button('reset');
                Refresh(id);
            }
        });
    }

    function ChangeItemStatus(status, item_id, id) {
        var $btn = $('.btn_loading').button('loading');
        $.ajax({
            url: '<?php echo $this->createUrl('kitchen/changeitemstatus'); ?>',
            data: {'status': status, 'item_id': item_id},
            type: 'post',
            success: function(response) {
                $btn.button('reset');
                Refresh(id);
//                showProductionKOT();
//                $("#myOrderModal").modal('hide');
            }
        });
    }
</script>