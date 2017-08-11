<ul class="header-nav">
    <li class="col-lg-3"><div style="font-size:14px;font-weight:bold;">AOS ITEMS</div></li>
    <li class="col-lg-9 pull-right">
        <form action="#" class="navbar-search expanded" role="search" id="search_form">
            <div class="form-group">
                <input type="text" style="width:450px;" class="form-control" id="aos_search" name="aos_search" placeholder="Search Customer Name, Number and Order Number wise">
            </div>
            <button type="button" class="btn btn-icon-toggle ink-reaction" id="search_data"><i class="fa fa-search"></i></button>
        </form>
    </li>
</ul>
<legend></legend>
<div class="card-body no-padding height-3">       
    <div class="col-lg-4 col-md-4 col-sm-6  col-xs-12">
        <div class="card" onclick="showOrders('pending')">
            <div class="card-body small-padding text-center">
                <span class="text-default-dark">Pending <sup class="badge style-danger"><?php echo count(Cakeorder::model()->findAllByAttributes(array('cake_status' => 'pending'))) ?></sup></span>
            </div>
        </div><!--end .card -->
    </div><!--end .col -->   
    <div class="col-lg-4 col-md-4 col-sm-6  col-xs-12">
        <div class="card" onclick="showOrders('p_accepted')">
            <div class="card-body small-padding text-center bg-success">
                <span class="text-default-dark">Accepted <sup class="badge style-danger"><?php echo count(Cakeorder::model()->findAllByAttributes(array('cake_status' => 'p_accepted'))) ?></sup></span>
            </div>
        </div><!--end .card -->
    </div><!--end .col -->   
    <div class="col-lg-4 col-md-4 col-sm-6  col-xs-12">
        <div class="card" onclick="showOrders('k_accepted')">
            <div class="card-body small-padding text-center bg-warning">
                <span class="text-default-dark">Advance <sup class="badge style-danger"><?php echo count(Cakeorder::model()->findAllByAttributes(array('cake_status' => 'k_accepted'))) ?></sup></span>
            </div>
        </div><!--end .card -->
    </div><!--end .col -->   

    <div class="col-lg-4 col-md-4 col-sm-6  col-xs-12">
        <div class="card" onclick="showOrders('processing')">
            <div class="card-body small-padding text-center bg-info">
                <span class="text-default-dark">Processing <sup class="badge style-danger"><?php echo count(Cakeorder::model()->findAllByAttributes(array('cake_status' => 'processing'))) ?></sup></span>
            </div>
        </div><!--end .card -->
    </div><!--end .col -->   
    <div class="col-lg-4 col-md-4 col-sm-6  col-xs-12">
        <div class="card" onclick="showOrders('finished')">
            <div class="card-body small-padding text-center bg-warning">
                <span class="text-default-dark">Finished <sup class="badge style-danger"><?php echo count(Cakeorder::model()->findAllByAttributes(array('cake_status' => 'finished'))) ?></sup></span>
            </div>
        </div><!--end .card -->
    </div><!--end .col -->   
    <div class="col-lg-4 col-md-4 col-sm-6  col-xs-12">
        <div class="card" onclick="showOrders('delivered')">
            <div class="card-body small-padding text-center bg-warning">
                <span class="text-default-dark">Delivered <sup class="badge style-danger"><?php echo count(Cakeorder::model()->findAllByAttributes(array('cake_status' => 'delivered'))) ?></sup></span>
            </div>
        </div><!--end .card -->
    </div><!--end .col -->   
</div>


<!--<legend>Cake_Order_Details</legend>
<form id="aos_search" class="form-group">
    <div class="row">
        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
            <label>Customer Name</label>  
            <input type="text" id="name" name="name" class="form-control">
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
            <label>Contact No</label>  
            <input type="text" id="mobile" name="mobile" class="form-control">
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
            <label>Status</label>  
            <select id="status" name="status" class="form-control">
                <option value="">--Status--</option>
                <option value="pending">Pending</option>
                <option value="accepted">Accepted</option>
                <option value="processing">Processing</option>
                <option value="finished">Finished</option>
                <option value="delivered">Delivered</option>
            </select>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
            <label>Deliver From Date</label>  
            <input type="text" id="fd" name="fd" class="form-control datepicker">
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
            <label>Deliver To Date</label>  
            <input type="text" id="td" name="td" class="form-control datepicker">
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12" style="margin-top: 25px;">
            <button type="button" class="btn btn-success" id="search_data"><i class="fa fa-search"></i> Search</button>
        </div>
    </div>
</form><br/>-->
<div class="row">
    <div id="orders"></div>
</div>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/bs/js/jquery.js"></script>
<script type="text/javascript">
            $(document).ready(function() {
                $("form").submit(function(e) {
                    e.preventDefault();
                });
                $('#search_form').submit(function() {
                    searchOrders();
                    $('#aos_search').val('');
                });
                $('#search_data').click(function() {
                    searchOrders();
                });
                $('#aos_search').keyup(function() {
                    searchOrders();
                });
            });

            function searchOrders() {
                $('#orders').html("<center><img src='<?php echo Yii::app()->baseUrl ?>/images/loader.gif'/></center>");
                var data = $('#aos_search').val();
                $.ajax({
                    url: '<?php echo $this->createUrl('aos/searchdata'); ?>',
                    data: {'data': data},
                    type: 'post',
                    success: function(response) {
                        $('#orders').html(response);
                    }
                });
            }

            function showOrders(status) {
                $('#orders').html("<center><img src='<?php echo Yii::app()->baseUrl ?>/images/loader.gif'/></center>");
                $.ajax({
                    url: '<?php echo $this->createUrl('aos/searchdatabystatus'); ?>',
                    data: {'status': status},
                    type: 'post',
                    success: function(response) {
                        $('#orders').html(response);
                    }
                });
            }
</script>

