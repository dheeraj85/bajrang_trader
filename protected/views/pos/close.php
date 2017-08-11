<?php 
$last_closing = Cashdrawer::model()->findAll(array('order'=>'id desc', 'limit'=>'1'));
?>

<div class="row" style="margin-top: 100px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="col-lg-4 col-md-4 col-sm-1 col-xs-12 pull-left"></div>
    <div class="col-lg-6 col-md-6 col-sm-10 col-xs-12">
        <form action="#<?php // echo $this->createUrl('pos/saveopening'); ?>" method="post">
    <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
        <h4><b>Enter Opening Cash</b></h4>
        <input type="text" id="opening" name="opening" class="form-control">
    </div>       
    <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12" style="margin-top: 40px;">
        <button type="submit" class="btn btn-primary" id="save_opening" ><b>SAVE</b></button>
        <a class="btn btn-danger" href="<?php echo $this->createUrl('site/logout'); ?>" ><b>CANCEL</b></a>
    </div>
    </form>
        
        <div id="result"></div>
    </div><!--end .col -->
    <div class="col-lg-2 col-md-2 col-sm-1 col-xs-12 pull-right"></div>
 
</div>
</div><!--end .row -->  
 
<script type="text/javascript">
    $(document).ready(function() {
         $("#search").click(function() {
           CheckCounter();  
        });
    });

    function CheckCounter() {
        $('#result').html("<center><img src='<?php echo Yii::app()->baseUrl ?>/images/loader.gif'/></center>");
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



