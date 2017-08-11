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
                    <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-aqua-active">
                  <h3 class="widget-user-username">Alexander Pierce</h3>
                  <h5 class="widget-user-desc">Founder &amp; CEO</h5>
                </div>
<!--                <div class="widget-user-image">
                  <img class="img-circle" src="../dist/img/user1-128x128.jpg" alt="User Avatar">
                </div>-->
                <div class="box-footer">
                  <div class="row">
                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <h5 class="description-header">3,200</h5>
                        <span class="description-text">SALES</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <h5 class="description-header">13,000</h5>
                        <span class="description-text">FOLLOWERS</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-4">
                      <div class="description-block">
                        <h5 class="description-header">35</h5>
                        <span class="description-text">PRODUCTS</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div>
              </div>
                    <div id="cart_items" style="height: 275px;overflow-y: scroll;">
                        <?php
                        foreach ($searchdata as $val) {
                            if ($val->cake_status == 'pending') {
                                ?>
                                <a href="#" class="btn btn-danger status-btn" onclick="View(<?php echo $val->id; ?>);">
                                    <strong style="float: left;">TOC - <?php echo $val->id; ?></strong>
                                    <i style="float: right;" class="fa fa-eye"></i>
                                </a>
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
                                <a href="#" class="btn btn-info status-btn" onclick="View(<?php echo $val->id; ?>);">
                                    <strong style="float: left;">TOC - <?php echo $val->id; ?></strong>
                                    <i style="float: right;" class="fa fa-eye"></i>
                                </a>
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
                                <a href="#" class="btn btn-primary status-btn" onclick="View(<?php echo $val->id; ?>);">
                                    <strong style="float: left;">TOC - <?php echo $val->id; ?></strong>
                                    <i style="float: right;" class="fa fa-eye"></i>
                                </a>
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
                                <a href="#" class="btn btn-warning status-btn" onclick="View(<?php echo $val->id; ?>);">
                                    <strong style="float: left;">TOC - <?php echo $val->id; ?></strong>
                                    <i style="float: right;" class="fa fa-eye"></i>
                                </a>
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
                                <a href="#" class="btn btn-success status-btn" onclick="View(<?php echo $val->id; ?>);">
                                    <strong style="float: left;">TOC - <?php echo $val->id; ?></strong>
                                    <i style="float: right;" class="fa fa-eye"></i>
                                </a>
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
                                <a href="#" class="btn btn-accent status-btn" onclick="View(<?php echo $val->id; ?>);">
                                    <strong style="float: left;">TOC - <?php echo $val->id; ?></strong>
                                    <i style="float: right;" class="fa fa-eye"></i>
                                </a>
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
</script>