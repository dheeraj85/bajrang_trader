<?php $counter = Cashcounter::model()->findByPk($cash_drawer->counter_id); ?>
<div class="row" style="margin-top: 100px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-lg-3 col-md-3 col-sm-1 col-xs-12 pull-left"></div>
        <div class="col-lg-6 col-md-6 col-sm-10 col-xs-12" style="border: 1px solid #cccccc;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h2><b><?php echo $counter->counter_name; ?></b></h2><hr/><br/>
            </div>
            <form action="<?php echo $this->createUrl('pos/savehandover'); ?>" method="post">
                <input type="hidden" name="counter_id" value="<?php echo $counter->id; ?>">
                <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <h4><b>Handover From</b></h4>
                    <input type="text" class="form-control" value="<?php echo Users::model()->findByPk($cash_drawer->user_to)->name ?>" readonly>
                </div>       
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="/*margin-top: 40px;*/">
                    <h4><b>Handover To</b></h4>
                    <select class="form-control" id="user_to" name="user_to">
                        <option value="">--Select POS User--</option>
                        <?php foreach (Users::model()->findAllByAttributes(array('role' => 'pos')) as $user) { 
                            if($user->id == Yii::app()->user->id){
                               ?>
                        <option value="<?php echo $user->id; ?>">OWN (<?php echo $user->name; ?>)</option>    
                        <?php  }else{
                            ?>
                        <option value="<?php echo $user->id; ?>"><?php echo $user->name; ?></option>    
                        <?php } } ?>
                    </select>
                </div>
                </div><br/>
                <div class="row"> 
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <h4><b>Enter Handover Cash</b></h4>
                    <input type="text" id="cash" name="cash" class="form-control" placeholder="Enter Cash">
                </div>             
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="/*margin-top: 40px;*/">
                    <h4><b>Remark</b></h4>
                    <textarea class="form-control" id="remark" name="remark" placeholder="Enter Remark Here..." ></textarea>
                </div>
                </div>
                <div class="row"> 
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="/*margin-top: 40px;*/">
                    <button type="submit" onclick="return confirm('Are you sure you want to leave the counter ?')" class="btn btn-primary" id="save_handover" ><b>SAVE</b></button>
                    <a class="btn btn-danger" href="<?php echo $this->createUrl('pos/ots_items'); ?>" ><b>CANCEL</b></a>
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



