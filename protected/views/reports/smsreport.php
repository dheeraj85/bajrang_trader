<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> Send Daily / Weekly / Monthly Report</h3>
    </div>
    <div class="panel-body">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            //  'action' => Yii::app()->createUrl($this->route),
            'method' => 'post',
        ));
        ?>
        <div class="form-inline">
            <div class="form-group">
                <label for="exampleInputName2">Report type</label>
                <select name="reporttype" id="reporttype" class="form-control">
                    <option value="0">Select Report type</option>
                    <?php
                    foreach (Utils::rtype() as $k => $v) {
                        ?>
                        <option value="<?php echo $k ?>"><?php echo $v ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputName2" style="padding-bottom:40px;"></label>
                <button type="button" id="btn-submit" data-loading-text="Loading..." class="btn btn-primary" autocomplete="off">
                    Send Report
                </button>
            </div>
        </div>
        <?php $this->endWidget(); ?>
        <br/>
        <div id="message"></div>
        <div id="message1"></div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#reporttype").change(function() {
            var rtype = $(this).val();
            $.getJSON("<?php echo $this->createUrl('reports/checkreportsend') ?>", {"rtype": rtype}, function(data)
            {
               if (data.rtype == 'daily') {
                    $("#btn-submit").removeAttr("disabled", "");
               }
                if (data.rtype == 'weekly') {
                    if (data.status == '1'){
                      $("#btn-submit").removeAttr("disabled", "");   
                    }else{
                     $("#btn-submit").attr("disabled", "disabled");   
                    }
                }
                 if (data.rtype == 'monthly') {
                    if (data.status == '1'){
                      $("#btn-submit").removeAttr("disabled", "");   
                    }else{
                     $("#btn-submit").attr("disabled", "disabled");   
                    }  
                 }
            });
        });//change

        $('#btn-submit').click(function() {
            var rtype = $("#reporttype").val();
            var $btn = $(this);
            $btn.button('loading');
            $.getJSON("<?php echo $this->createUrl('reports/sendsmsreport') ?>", {"rtype": rtype}, function(data)
            {
                if (data.rtype == 'weekly') {
                if (data.msg == '1'){     
                    $("#message").html("<div class='alert1 alert-danger'>Weekly Report Already Sent</div>");                  
                    $("#message1").html("<div class='alert1 alert-success'>"+data.msg1+"</div>");
                } else {
                    $("#message").html("<div class='alert1 alert-success'>Weekly Report Sent Successfully</div>");
                    $("#message1").html("<div class='alert1 alert-success'>"+data.msg1+"</div>");
                }
            }
              if (data.rtype == 'monthly') {
                if (data.msg == '1'){     
                    $("#message").html("<div class='alert1 alert-danger'>Monthly Report Already Sent</div>");                  
                    $("#message1").html("<div class='alert1 alert-success'>"+data.msg1+"</div>");
                } else {
                    $("#message").html("<div class='alert1 alert-success'>Monthly Report Sent Successfully</div>");
                    $("#message1").html("<div class='alert1 alert-success'>"+data.msg1+"</div>");
                }
            }
            });
            setTimeout(function() {
                $btn.button('reset');
            }, 1000);
        });
    });
</script>