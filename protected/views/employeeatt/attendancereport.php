<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="widget flat radius-bordered">
            <div class="widget-header bg-blueberry">
                <span class="widget-caption">Attendance Report Date Wise</span>
                <div class="widget-buttons">
                    <a href="#" data-toggle="maximize">
                        <i class="fa fa-expand"></i>
                    </a>
                    <a href="#" data-toggle="collapse">
                        <i class="fa fa-minus"></i>
                    </a>
                    <a href="#" data-toggle="dispose">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="widget-body">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <label>Category</label><br/>
                        <select class="form-control" name="staff_category"  id="category"><option value="0">---Select---</option>
                            <?php foreach (Staffcategory::model()->findAllBySql("select * from staff_category group by staff_category") as $c) {
                                ?>
                                <?php if ($c->staff_category == $model->subcategory) {
                                    ?>
                                    <option value="<?php echo $c->staff_category ?>" selected><?php echo $c->staff_category; ?></option>
                                <?php } else {
                                    ?>
                                    <option value="<?php echo $c->staff_category ?>"><?php echo $c->staff_category; ?></option>
                                <?php }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <label>Sub Category</label><br/>
                        <select class="form-control" name="staff_sub_category_id" id="subcategory">
                            <option value="0">--select--</option>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <label>From Date</label><br/>
                        <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => 'from_date',
                            'id' => 'from_date',
                            'value' => date('Y-m-01'),
                            'options' => array(
                                'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-15:+1'
                            ),
                            'htmlOptions' => array(
                                //'style' => 'height:20px;width:260px;',
                                'class' => 'form-control',
                                //'readonly' => 'readonly'
                                'placeholder' => 'From Date',
                            ),
                        ));
                        ?>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <label>To Date</label><br/>
                        <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => 'to_date',
                            'id' => 'to_date',
                            'value' => date('Y-m-d'),
                            'options' => array(
                                'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-15:+1'
                            ),
                            'htmlOptions' => array(
                                //'style' => 'height:20px;width:260px;',
                                'class' => 'form-control',
                                //'readonly' => 'readonly'
                                'placeholder' => 'To Date',
                            ),
                        ));
                        ?>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-6 col-xs-12" style="margin-top: 25px;">
                        <button type="button" class="btn btn-primary" id="report"><i class="fa fa-eye"></i> View Report </button>
                    </div>
                </div><hr/>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div id="showreport"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#category').change(function() {
            var ctid = $('#category').val();
            $.ajax({
                url: '<?php echo $this->createUrl('/staff/admin/staffclassallotment/getsubcategory'); ?>',
                data: {'ctid': ctid},
                cache: false,
                success: function(response) {
                    $('#subcategory').html(response);
                }
            });
        });
        $('#report').click(function() {
            var fd = $('#from_date').val();
            var td = $('#to_date').val();
            var cid = $('#category').val();
            var scid = $('#subcategory').val();
            Show(fd, td, scid);
        });
    });
    function Show(fd, td, scid) {
        $('#showreport').html("<center><img src='<?php echo Yii::app()->baseUrl ?>/images/loader.gif'/></center>");
        $.ajax({
            url: '<?php echo $this->createUrl('/staff/admin/staffattendance/getreport'); ?>',
            data: {'fd': fd, 'td': td, 'scid': scid},
            type: 'post',
            success: function(response) {
                $('#showreport').html(response);
            }
        });
    }
</script>