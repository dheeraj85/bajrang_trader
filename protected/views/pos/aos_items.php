<div class="row">
    <div class="col-md-12">
        <div class="card1">
            <div class="card-head">
                <ul class="nav nav-tabs nav-justified">
                    <li><a href="<?php echo $this->createUrl("pos/ots_items"); ?>">OTS</a></li>
                    <li><a href="<?php echo $this->createUrl("pos/menu_items"); ?>">MENU  <sup class="badge style-danger"></sup></a></li>
                    <li class="active"><a href="#<?php // echo $this->createUrl("pos/aos_items");   ?>">AOS  <sup class="badge style-danger"></sup></a></li>
                </ul>
            </div><!--end .card-head -->
            <div class="tab-content">
                <div class="tab-pane active" id="fourth4">
                    <ul class="header-nav">
                        <li class="col-lg-3"><div style="font-size:14px;font-weight:bold;">AOS ITEMS</div></li>
                        <li class="col-lg-9 pull-right">
                            <form action="#" class="navbar-search expanded" role="search" id="search_form">
                                <div class="form-group">
                                    <input type="text" style="width:450px;" class="form-control" id="aos_search" name="aos_search" placeholder="Search Customer Name, Number and Order Number wise">
                                    <button type="button" class="btn btn-icon-toggle ink-reaction" id="search_data"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </li>
                    </ul>
                    <div class="row">
                        <div id="orders"></div>
                    </div>

                </div>
            </div><!--end .card-body -->
        </div>
        <br/>
    </div><!--end .col -->

</div><!--end .row -->  
<script type="text/javascript">
    $(document).ready(function() {
        showStatus();
        $("form").submit(function(e) {
            e.preventDefault();
        });
        $('#search_form').submit(function() {
            showStatus();
            $('#aos_search').val('');
        });
        $('#search_data').click(function() {
            showStatus();
        });
        $('#aos_search').keyup(function() {
            showStatus();
        });
    });

    function showStatus() {
        $('#orders').html("<center><img src='<?php echo Yii::app()->baseUrl ?>/images/loader.gif'/></center>");
        var data = $('#aos_search').val();
        $.ajax({
            url: '<?php echo $this->createUrl('aos/status'); ?>',
            data: {'data': data},
            type: 'post',
            success: function(response) {
                $('#orders').html(response);
//                setInterval(function() {
//            showStatus();
//        }, 60000);
            }
        });
    }
</script>

