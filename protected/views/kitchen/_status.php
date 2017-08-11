<style>
    .status-btn{
        width: 90%;
        margin-left: 20px;
        margin-right: 20px;   
    }
</style>
<?php
$k = 0;
$p = 0;
$f = 0;
foreach ($searchdata as $v) {
    if ($v->cake_status == 'p_accepted') {
        ++$k;
    }
    if ($v->cake_status == 'processing') {
        ++$p;
    }
    if ($v->cake_status == 'finished') {
        ++$f;
    }
}
?>
<div class="row">
    <div class="col-lg-12">
        <div class="widget-user">
            <!--            <div class="widget-user-header bg-aqua-active" style="height: 75px;">
                            <h3 style="margin-top: 0px;">AOS</h3>
                        </div>-->
            <div class="box-footer">
                <div class="row" style="margin-top: -30px;">
                    <div class="col-sm-12">
                        <div class="col-sm-4 border-right btn-warning">
                            <div class="description-block">
                                <h5 class="description-header"><b><?php echo $k ?></b></h5>
                                <span class="description-text"><b>PENDING</b></span>
                            </div>
                        </div>
                        <div class="col-sm-4 border-right btn-info">
                            <div class="description-block">
                                <h5 class="description-header"><b><?php echo $p ?></b></h5>
                                <span class="description-text"><b>PROCESSING</b></span>
                            </div>
                        </div>
                        <div class="col-sm-4 border-right btn-success">
                            <div class="description-block">
                                <h5 class="description-header"><b><?php echo $f ?></b></h5>
                                <span class="description-text"><b>FINISHED</b></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4" id="cart_items" style="height: 600px;overflow-y: scroll;">
            <?php
            foreach ($searchdata as $val) {
                if ($val->cake_status == 'p_accepted') {
                    ?>
            <button class="btn btn-warning status-btn" style="margin-top: 5px;height: 50px;">
                        <strong style="float: left;">TOC - <?php echo $val->id; ?></strong>
                        <span style="float: right;">  <i style="margin-right: 50px;" class="fa fa-eye" onclick="View(<?php echo $val->id; ?>);"></i>
                            <i style="" class="fa fa-briefcase" onclick="Ingredients(<?php echo $val->id; ?>);"></i>
                        </span>
                    </button>
                    <?php
                }
            }
            ?>
        </div> 
        <div class="col-sm-4" id="cart_items" style="height: 600px;overflow-y: scroll;">
            <?php
            foreach ($searchdata as $val) {
                if ($val->cake_status == 'processing') {
                    ?>
                    <button class="btn btn-info status-btn" style="margin-top: 5px;height: 50px;">
                        <strong style="float: left;">TOC - <?php echo $val->id; ?></strong>
                        <span style="float: right;">  <i style="margin-right: 50px;" class="fa fa-eye" onclick="View(<?php echo $val->id; ?>);"></i>
                            <i style="" class="fa fa-briefcase" onclick="Ingredients(<?php echo $val->id; ?>);"></i>
                        </span>
                    </button>
                    <?php
                }
            }
            ?>
        </div>
        <div class="col-sm-4" id="cart_items" style="height: 600px;overflow-y: scroll;">
            <?php
            foreach ($searchdata as $val) {
                if ($val->cake_status == 'finished') {
                    ?>
                    <button class="btn btn-success status-btn" style="margin-top: 5px;height: 50px;">
                        <strong style="float: left;">TOC - <?php echo $val->id; ?></strong>
                        <span style="float: right;">  <i style="margin-right: 50px;" class="fa fa-eye" onclick="View(<?php echo $val->id; ?>);"></i>
                            <i style="" class="fa fa-briefcase" onclick="Ingredients(<?php echo $val->id; ?>);"></i>
                        </span>
                    </button>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<div id="order_details"></div>
<script type="text/javascript">
    $(document).ready(function() {

    });

    function View(id) {
        $('#order_details').html("<center><img src='<?php echo Yii::app()->baseUrl ?>/images/loader.gif'/></center>");
        $.ajax({
            url: '<?php echo $this->createUrl('kitchen/vieworder'); ?>',
            data: {'id': id},
            type: 'post',
            success: function(response) {
                $('#order_details').html(response);
            }
        });
    }

    function Ingredients(id) {
        $('#order_details').html("<center><img src='<?php echo Yii::app()->baseUrl ?>/images/loader.gif'/></center>");
        $.ajax({
            url: '<?php echo $this->createUrl('kitchen/viewingredients'); ?>',
            data: {'id': id},
            type: 'post',
            success: function(response) {
                $('#order_details').html(response);
            }
        });
    }
</script>