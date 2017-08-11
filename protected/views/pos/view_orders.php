<div class="row">
    <div class="col-lg-12">
        
        <?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'orders_form',
    'action'=>'getorders',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
?>
        <!--<form id="orders_form">-->
            <div class="col-lg-2">
                <label>POS Type</label>
                <select class="form-control" id="pos_type" name="pos_type">
                    <!--<option value="">--Select POS Type--</option>-->
                    <option value="OTS">OTS</option>
                    <option value="MENU">MENU</option>
                </select>
            </div>
            <div class="col-lg-3">
                <label>Counter</label>
                <select class="form-control" id="counter_id" name="counter_id">
                    <option value="">All</option>
                    <?php foreach (Cashcounter::model()->findAll() as $counter) { ?>
                    <option value="<?php echo $counter->id ?>"><?php echo $counter->counter_name; ?></option>
                   <?php } ?>
                </select>
            </div>
            <div class="col-lg-2">
                <label>Order From Date</label>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => 'fd',
                    'id' => 'fd',
                    'value' => date('Y-m-d'),
                    'options' => array(
                        'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
                    ),
                    'htmlOptions' => array(
                        'style' => '',
                        //'readonly' => 'readonly'
                        'placeholder' => 'Order From Date', 'class' => 'form-control',
                    ),
                ));
                ?>
            </div>
            <div class="col-lg-2">
                <label>Order To Date</label>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => 'td',
                    'id' => 'td',
                    'value' => date('Y-m-d'),
                    'options' => array(
                        'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
                    ),
                    'htmlOptions' => array(
                        'style' => '',
                        //'readonly' => 'readonly'
                        'placeholder' => 'Order To Date', 'class' => 'form-control',
                    ),
                ));
                ?>
            </div>
    
        <div class="col-lg-3" style="margin-top: 25px;">
            <button type="button" class="btn btn-primary" id="search_order" data-loading-text="Loading..."><i class="fa fa-search fa-fw"></i>SEARCH</button>
            <button type="submit" class="btn btn-primary" name="search_order" value="export"><i class='fa fa-download'></i> Export List</button>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div><br/>
<div class="row">
    <div class="col-lg-12">
        <div id="orders"></div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#search_order').click(function () {
             $('#orders').html("<center><img src='<?php echo Yii::app()->baseUrl ?>/images/loader.gif'/></center>");
           var fd = $("#fd").val();
            var td = $("#td").val();
            if(fd!='' && td!=''){
            var orders = $("#orders_form").serialize();
            $.ajax({
                url: '<?php echo $this->createUrl('pos/getorders'); ?>',
                data: orders,
                type: 'post',
                success: function (response) {
                    
                    $("#orders").html(response);
                }
            });
            }else{
            alert("Select Both Date");
            }
        });
              
    });
</script>