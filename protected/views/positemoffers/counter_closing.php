<?php
$this->breadcrumbs = array(
    'POS Management System' => array('positemoffers/index'),
    'Outlet Day Closing',
);
?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/bs/js/jquery.js"></script>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                    <h3 class="panel-title">Add Closing to counter</h3>
                </div>
                <div class="panel-body">
                    <div class='row'>
                        <div class='col-md-4'>
                            <label>Counter</label>
                            <select id="counter" name="counter" class="form-control">
                                <option value="">--Select Counter--</option>
                                <?php foreach (Cashcounter::model()->findAll() as $counter) { ?>
                                    <option value="<?php echo $counter->id ?>"><?php echo $counter->counter_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class='col-md-4'>
                            <label>Date</label>
                            <?php
                            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'name' => 'date',
                                'id' => 'date',
                                'value' => date('Y-m-d'),
                                'options' => array(
                                    'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
                                ),
                                'htmlOptions' => array(
                                    'style' => '',
//                                    'disabled' => 'disabled',
                                    'placeholder' => 'Date', 'class' => 'form-control',
                                ),
                            ));
                            ?>
                        </div>
                        <div class='col-md-4' style="margin-top: 25px;">
                            <button type="button" class="btn btn-primary" id="search" ><i class="glyphicon glyphicon-search"></i> Search</button>
                        </div>
                    </div><br/>
                    <div class='row'>
                        <div class='col-lg-12'>
                            <div id="closing"></div>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="contra"></div>
                        </div>
                    </div>
                </div>
            </div>     
        </div>  
    </div> 
</div> 
<!--<script src="<?php // echo Yii::app()->request->baseUrl; ?>/front/libs/jquery/jquery-1.11.2.min.js"></script>-->
<script type="text/javascript">
    $(document).ready(function() {
        GetContraVoucher();
        $('#date').change(function() {
            GetContraVoucher();
        });
        $('#search').click(function() {
            GetOpening();
        });
    });

    function GetOpening() {
        var cid = $('#counter').val();
        var date = $('#date').val();
        $.ajax({
            url: "<?php echo $this->createUrl('positemoffers/closing'); ?>",
            data: {'cid': cid,'date': date},
            type: 'post',
            success: function(data) {
                $("#closing").html(data);
            }
        });
    }

    function GetContraVoucher() {
        var date = $('#date').val();
        $.ajax({
            url: "<?php echo $this->createUrl('positemoffers/contravoucher'); ?>",
            data: {'date': date},
            type: 'post',
            success: function(data) {
                $("#contra").html(data);
            }
        });
    }
</script>
