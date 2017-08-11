<?php $counter = Cashcounter::model()->findByPk($cash_drawer->counter_id); ?>
<div class="row" style="margin-top: 100px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-lg-3 col-md-3 col-sm-1 col-xs-12 pull-left"></div>
        <div class="col-lg-6 col-md-6 col-sm-10 col-xs-12" style="border: 1px solid #cccccc;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h2><b><?php echo $counter->counter_name; ?></b></h2><hr/><br/>
            </div>
            <form action="<?php echo $this->createUrl('pos/received'); ?>" method="post">
                <input type="hidden" name="drawer_id" value="<?php echo $cash_drawer->id; ?>">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!--<h4><b>Enter Opening Cash</b></h4>-->
                        <div class="checkbox" style="margin-left: 20px;">
                            <h4>
                                <input type="checkbox" id="is_handover_verified" style="margin-top: 2px;" name="is_handover_verified" class="" value="1"> <b>Have You Received Cash <?php echo $cash_drawer->cash . ' Rs.' ?> By <?php echo Users::model()->findByPk($cash_drawer->user_from)->name; ?> In Your Drawer.</b>
                            </h4>
                        </div>

                    </div>
                </div><br/>
                <div class="row">       
                    <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12" style="/*margin-top: 40px;*/">
                        <textarea class="form-control" id="handover_remark" name="handover_remark" placeholder="Enter Remark Here..." ></textarea>
                    </div>
                </div><br/>
                <div class="row">  
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="/*margin-top: 40px;*/">
                        <button type="submit" onclick="return confirm('Are you sure You want to Accept the given cash in your drawer ?')" class="btn btn-success" id="accept" ><b>ACCEPT</b></button>
                        <a type="submit" href="<?php echo $this->createUrl('site/logout'); ?>" onclick="return confirm('Are you sure You want to Reject the given cash in your drawer ?')" class="btn btn-danger" id="reject" ><b>REJECT</b></a>
                        <a class="btn btn-default" href="<?php echo $this->createUrl('site/logout'); ?>" ><b>QUIT</b></a>
                    </div>
                </div>
            </form><br/>
            <div class="clear" style="clear: both;"></div>
        </div><!--end .col -->
        <div class="col-lg-3 col-md-3 col-sm-1 col-xs-12 pull-right"></div>

    </div>
    <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12 pull-left"></div>
    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12" style="margin-top: 50px;">
        <div id="result"></div>
    </div>
    <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12 pull-right"></div>
</div><!--end .row -->  

<script type="text/javascript">
    $(document).ready(function() {
        $('#accept').attr('disabled', 'disabled');

        $('#is_handover_verified').click(function(event) {
            if (this.checked) {
                $('#accept').removeAttr('disabled');
                $('#reject').attr('disabled', 'disabled');
            } else {
                $('#reject').removeAttr('disabled');
                $('#accept').attr('disabled', 'disabled');
            }
        });

        $("#search").click(function() {
            CheckCounter()
        });
    });

    function CheckCounter() {
        $('#orders').html("<center><img src='<?php echo Yii::app()->baseUrl ?>/images/loader.gif'/></center>");
        var data = $('#counter').val();
        $.ajax({
            url: '<?php echo $this->createUrl('pos/checkcounter'); ?>',
            data: {'data': data},
            type: 'post',
            success: function(response) {
                $('#result').html(response);
//                setInterval(function() {
//            showStatus();
//        }, 60000);
            }
        });
    }
</script>



