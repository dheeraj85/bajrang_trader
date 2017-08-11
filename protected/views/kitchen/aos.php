<?php
$this->breadcrumbs = array(
    'Home' => array('kitchen/index'),
    'Kitchen Operations',
);

$d2 = strtotime(date('Y-m-d'));
$d1 = $d2 - (86400 * 7);
$fd = date('Y-m-d', $d2);
$td = date('Y-m-d', $d1);
$order = Cakeorder::model()->findAllBySql("select * from cake_order where cake_status='p_accepted' and order_date>=$d1 and order_date<=$d2");
$pkot = Productionkot::model()->findAllByAttributes(array('status' => 'pending'));
$mkot = Menukot::model()->findAllByAttributes(array('status' => 'pending'));
?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/bs/js/jquery.js"></script>
<div class="row">
    <div class="col-lg-12">
        <legend style="margin-left: 10px;">Kitchen Operations</legend>
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><h2>&emsp;&emsp;AOS&emsp;&emsp;<sup><span class="label label-danger"><?php echo count($order); ?></span></sup></h2></a></li>
          </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <div class="col-lg-12">
                    <div class="box box-widget widget-user" id="aos"></div>
                </div>
            </div>
<!--            <div role="tabpanel" class="tab-pane" id="profile">
                <div class="col-md-12">
                     Widget: user widget style 1 
                    <div class="box box-widget widget-user" id="pkot"></div> 
                </div>
            </div>-->
            <div role="tabpanel" class="tab-pane" id="messages">

                <div class="col-md-12">
<!--                     Widget: user widget style 1 -->
                    <div class="box box-widget widget-user" id="mkot"></div>
                </div>
            </div>
            <!--<div role="tabpanel" class="tab-pane" id="settings">setting</div>-->
        </div>
    </div>

</div>
<script type="text/javascript">
    $(document).ready(function() {
        showStatus();
        showProductionKOT();
        showMenuKOT();
    });

    function showStatus() {
        $('#aos').html("<center><img src='<?php echo Yii::app()->baseUrl ?>/images/loader.gif'/></center>");
        var data = '';
//        var data = $('#aos_search').val();
        $.ajax({
            url: '<?php echo $this->createUrl('kitchen/status'); ?>',
           // data: {'data': data},
            type: 'post',
            success: function(response) {

                $('#aos').html(response);
            }
        });
    }

    function showProductionKOT() {
        $('#pkot').html("<center><img src='<?php echo Yii::app()->baseUrl ?>/images/loader.gif'/></center>");
        $.ajax({
            url: '<?php echo $this->createUrl('kitchen/productionkot'); ?>',
           // data: '',
            type: 'post',
            success: function(response) {
                $('#pkot').html(response);
            }
        });
    }

    function showMenuKOT() {
        $('#pkot').html("<center><img src='<?php echo Yii::app()->baseUrl ?>/images/loader.gif'/></center>");
        $.ajax({
            url: '<?php echo $this->createUrl('kitchen/menukot'); ?>',
           // data: '',
            type: 'post',
            success: function(response) {
                $('#mkot').html(response);
            }
        });
    }
</script>

