<style>
    .status-btn{
        width: 90%;
        margin-left: 20px;
        margin-right: 20px;   
    }
</style>
<?php
$p = 0;
$a = 0;
$r = 0;
$d = 0;
foreach ($kot as $k) {
    if ($k->status == 'pending') {
        ++$p;
    }
    if ($k->status == 'accept') {
        ++$a;
    }
    if ($k->status == 'reject') {
        ++$r;
    }
    if ($k->status == 'done') {
        ++$d;
    }
}
?>
<div class="row">
    <div class="col-lg-12">
        <div class="widget-user">
            <!--            <div class="widget-user-header bg-aqua-active" style="height: 75px;">
                            <h3 style="margin-top: 0px;">Production KOT</h3>
                        </div>-->
            <div class="box-footer">
                <div class="row" style="margin-top: -30px;">
                    <div class="col-sm-12">
                        <div class="col-sm-3 border-right btn-warning">
                            <div class="description-block">
                                <h5 class="description-header"><b><?php echo $p; ?></b></h5>
                                <span class="description-text"><b>PENDING</b></span>
                            </div>
                        </div>
                        <div class="col-sm-3 border-right btn-info">
                            <div class="description-block">
                                <h5 class="description-header"><b><?php echo $a; ?></b></h5>
                                <span class="description-text" style="margin-left: -10px;"><b>ACCEPTED</b></span>
                            </div>
                        </div>
                        <div class="col-sm-3 border-right btn-danger">
                            <div class="description-block">
                                <h5 class="description-header"><b><?php echo $r; ?></b></h5>
                                <span class="description-text" style="margin-left: -10px;"><b>REJECTED</b></span>
                            </div>
                        </div>
                        <div class="col-sm-3 border-right btn-success">
                            <div class="description-block">
                                <h5 class="description-header"><b><?php echo $d; ?></b></h5>
                                <span class="description-text"><b>DONE</b></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3" id="cart_items" style="height: 600px;overflow-y: scroll;">
            <?php
            foreach ($kot as $k) {
                if ($k->status == 'pending') {
                    ?>
                    <button class="btn btn-warning status-btn" onclick="Viewkot(<?php echo $k->id; ?>);" style="margin-top: 5px;height: 50px;">
                        <strong style="float: left;">PKOT NO - <?php echo $k->kot_no; ?></strong>
                        <span style="float: right;">
                            <i style="margin-right: 20px;" class="fa fa-eye"></i>
        <!--                            <i style="" class="fa fa-briefcase" onclick="Ingredients(<?php //echo $k->id;  ?>);"></i>-->
                        </span>
                    </button>
                    <?php
                }
            }
            ?>
        </div> 
        <div class="col-sm-3" id="cart_items" style="height: 600px;overflow-y: scroll;">
            <?php
            foreach ($kot as $k) {
                if ($k->status == 'accept') {
                    ?>
                    <button class="btn btn-info status-btn" onclick="Viewkot(<?php echo $k->id; ?>);" style="margin-top: 5px;height: 50px;">
                        <strong style="float: left;">PKOT NO - <?php echo $k->kot_no; ?></strong>
                        <span style="float: right;">
                            <i style="margin-right: 20px;" class="fa fa-eye"></i>
        <!--                            <i style="" class="fa fa-briefcase" onclick="Ingredients(<?php echo $k->id; ?>);"></i>-->
                        </span>
                    </button>
                    <?php
                }
            }
            ?>
        </div>
        <div class="col-sm-3" id="cart_items" style="height: 600px;overflow-y: scroll;">
            <?php
            foreach ($kot as $k) {
                if ($k->status == 'reject') {
                    ?>
                    <button class="btn btn-danger status-btn" onclick="Viewkot(<?php echo $k->id; ?>);" style="margin-top: 5px;height: 50px;">
                        <strong style="float: left;">PKOT NO - <?php echo $k->kot_no; ?></strong>
                        <span style="float: right;">
                            <i style="margin-right: 20px;" class="fa fa-eye"></i>
        <!--                            <i style="" class="fa fa-briefcase" onclick="Ingredients(<?php echo $k->id; ?>);"></i>-->
                        </span>
                    </button>
                    <?php
                }
            }
            ?>
        </div>
        <div class="col-sm-3" id="cart_items" style="height: 600px;overflow-y: scroll;">
            <?php
            foreach ($kot as $k) {
                if ($k->status == 'done') {
                    ?>
                    <button class="btn btn-success status-btn" onclick="Viewkot(<?php echo $k->id; ?>);" style="margin-top: 5px;height: 50px;">
                        <strong style="float: left;">PKOT NO - <?php echo $k->kot_no; ?></strong>
                        <span style="float: right;">
                            <i style="margin-right: 20px;" class="fa fa-eye"></i>
        <!--                            <i style="" class="fa fa-briefcase" onclick="Ingredients(<?php echo $k->id; ?>);"></i>-->
                        </span>
                    </button>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<div id="pkot_detail"></div>
<script type="text/javascript">
    function View(id) {
        $('#pkot_detail').html("<center><img src='<?php echo Yii::app()->baseUrl ?>/images/loader.gif'/></center>");
        $.ajax({
            url: '<?php echo $this->createUrl('kitchen/vieworder'); ?>',
            data: {'id': id},
            type: 'post',
            success: function(response) {
                $('#pkot_detail').html(response);
            }
        });
    }

    function Viewkot(id) {
        $('#pkot_detail').html("<center><img src='<?php echo Yii::app()->baseUrl ?>/images/loader.gif'/></center>");
        $.ajax({
            url: '<?php echo $this->createUrl('kitchen/viewkot'); ?>',
            data: {'id': id},
            type: 'post',
            success: function(response) {
                $('#pkot_detail').html(response);
            }
        });
    }

    function Ingredients(id) {
        $('#pkot_detail').html("<center><img src='<?php echo Yii::app()->baseUrl ?>/images/loader.gif'/></center>");
        $.ajax({
            url: '<?php echo $this->createUrl('kitchen/viewingredients'); ?>',
            data: {'id': id},
            type: 'post',
            success: function(response) {
                $('#pkot_detail').html(response);
            }
        });
    }
</script>