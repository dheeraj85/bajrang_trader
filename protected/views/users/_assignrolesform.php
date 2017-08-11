<div class="form-horizontal" style="">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
        'id' => 'user-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>
    <!--
        <p class="help-block">Fields with <span class="required">*</span> are required.</p>-->

    <?php //echo $form->errorSummary($model);  ?>
    <div class="row">
    <div class="col-lg-4">
        <label class="control-label" for="inputEmail">Users</label>
        <div class="controls">		
            <select id="userright_username" name="Userrights[user_id]" class="form-control" >
                <option>--Select Users--</option>
                <?php 
                $criteria = new CDbCriteria;
                $criteria->condition = "role!='sa'";
                foreach (Users::model()->findAllByAttributes(array("is_active" => 1),$criteria) as $value) { ?>
                    <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                <?php } ?>
            </select>
            <?php echo $form->error($model, 'user_id'); ?>
        </div>
    </div>    
    <div class="col-lg-2" style="margin-top:23px;">
        <div class="controls">	           
            <label class="control-label" for="inputEmail">User Role :</label> <b><span id="role"></span></b>
            <input type="hidden" id="role_user">
        </div>
    </div>    
    <div class="col-lg-2" style="margin-top:23px;">        
        <div class="controls">	
            <input type="button" class="btn btn-primary" id="search" value="Proceed"/>
        </div>
    </div>    
    </div>
    <?php echo $form->hiddenField($model, 'isactive'); ?><br/>
    <div id="result"></div>
    <?php $this->endWidget(); ?>
</div>
 <script src="<?php echo Yii::app()->request->baseUrl; ?>/bs/js/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#userright_username').change(function() {
            var ctid = $('#userright_username').val();
            $.ajax({
                url: '<?php echo $this->createUrl('users/getrole'); ?>',
                data: {'ctid': ctid},
                cache: false,
                success: function(response) {
                    $('#role').html(response);
                    $('#role_user').val(response);
                }
            });
        });

        $('#search').click(function() {
            var form = $('#user-form').serialize();
            var roleuser=$('#role_user').val();
            $('#result').html("<center><img src='<?php echo Yii::app()->baseUrl ?>/dist/img/loading_icon.gif'/></center>");
            $.ajax({
                url: '<?php echo $this->createUrl('users/proceed'); ?>',
                data: form,
                cache: false,
                type: 'post',
                success: function(response) {
                    $('#result').html(response);
                    if(roleuser=="CPS"){
                        $("#mastercms").show();
                    }else{
                        $("#mastercms").hide();
                    }
                }
            });
        });
    });
</script>