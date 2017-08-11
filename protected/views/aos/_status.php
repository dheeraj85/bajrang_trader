<style>
    .status-btn{
        width: 90%;
        margin-left: 20px;
        margin-right: 20px;   
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="col-md-4 col-md-4 col-sm-6 col-xs-12">
            <div class="card height-8">
                <div class="card-head">
                    <table class="table height-1" style="background-color:#91d0fd;">
                        <tr>
                            <td><h3 style="text-align: center;">PENDING</h3></td>
                        </tr>
                    </table>
                    <div id="cart_items" style="height: 275px;overflow-y: scroll;">
                        <?php
                        foreach ($searchdata as $val) {
                            if ($val->cake_status == 'pending') {
                                ?>
                                <button class="btn btn-danger status-btn">
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
        </div>
        <div class="col-md-4 col-md-4 col-sm-6 col-xs-12">
            <div class="card height-8">
                <div class="card-head">
                    <table class="table height-1" style="background-color:#91d0fd;">
                        <tr>
                            <td><h3 style="text-align: center;">POS ACCEPTED</h3></td>
                        </tr>
                    </table>
                    <div id="cart_items" style="height: 275px;overflow-y: scroll;">
                        <?php
                        foreach ($searchdata as $val) {
                            if ($val->cake_status == 'p_accepted') {
                                ?>
                                <button class="btn btn-info status-btn">
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
        </div>
        <div class="col-md-4 col-md-4 col-sm-6 col-xs-12">
            <div class="card height-8">
                <div class="card-head">
                    <table class="table height-1" style="background-color:#91d0fd;">
                        <tr>
                            <td><h3 style="text-align: center;">ADVANCE</h3></td>
                        </tr>
                    </table>
                    <div id="cart_items" style="height: 275px;overflow-y: scroll;">
                        <?php
                        foreach ($searchdata as $val) {
                            if ($val->cake_status == 'k_accepted') {
                                ?>
                                <button class="btn btn-primary status-btn">
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
        </div>
        <div class="col-md-4 col-md-4 col-sm-6 col-xs-12">
            <div class="card height-8">
                <div class="card-head">
                    <table class="table height-1" style="background-color:#91d0fd;">
                        <tr>
                            <td><h3 style="text-align: center;">PROCESSING</h3></td>
                        </tr>
                    </table>
                    <div id="cart_items" style="height: 275px;overflow-y: scroll;">
                        <?php
                        foreach ($searchdata as $val) {
                            if ($val->cake_status == 'processing') {
                                ?>
                                <button class="btn btn-warning status-btn">
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
        </div>
        <div class="col-md-4 col-md-4 col-sm-6 col-xs-12">
            <div class="card height-8">
                <div class="card-head">
                    <table class="table height-1" style="background-color:#91d0fd;">
                        <tr>
                            <td><h3 style="text-align: center;">FINISHED</h3></td>
                        </tr>
                    </table>
                    <div id="cart_items" style="height: 275px;overflow-y: scroll;">
                        <?php
                        foreach ($searchdata as $val) {
                            if ($val->cake_status == 'finished') {
                                ?>
                                <button class="btn btn-success status-btn">
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
        </div>
        <div class="col-md-4 col-md-4 col-sm-6 col-xs-12">
            <div class="card height-8">
                <div class="card-head">
                    <table class="table height-1" style="background-color:#91d0fd;">
                        <tr>
                            <td><h3 style="text-align: center;">DELIVERED</h3></td>
                        </tr>
                    </table>
                    <div id="cart_items" style="height: 275px;overflow-y: scroll;">
                        <?php
                        foreach ($searchdata as $val) {
                            if ($val->cake_status == 'delivered') {
                                ?>
                                <button class="btn btn-accent status-btn">
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
        </div>
    </div>
</div>
<div id="order_detail"></div>
<script type="text/javascript">
    $(document).ready(function() {

    });

    function View(id) {
        $('#order_detail').html("<center><img src='<?php echo Yii::app()->baseUrl ?>/images/loader.gif'/></center>");
        $.ajax({
            url: '<?php echo $this->createUrl('aos/vieworder'); ?>',
            data: {'id': id},
            type: 'post',
            success: function(response) {
                $('#order_detail').html(response);
            }
        });
    }

    function Ingredients(id) {
        $('#order_detail').html("<center><img src='<?php echo Yii::app()->baseUrl ?>/images/loader.gif'/></center>");
        $.ajax({
            url: '<?php echo $this->createUrl('aos/viewingredients'); ?>',
            data: {'id': id},
            type: 'post',
            success: function(response) {
                $('#order_detail').html(response);
            }
        });
    }
</script>