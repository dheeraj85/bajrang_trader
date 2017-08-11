<div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Security Password</h4>
      </div>
      <div class="modal-body">
         <?php
          $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
              'id' => 'reviewauthform',
          ));
          ?>
           <div class="form-group">
              <input type="password" placeholder="Security Password" class="form-control" name="auth_password" id="auth_password"/>
              <input type="hidden" class="form-control" id="valid_data" name="valid_data" value="security"/>
           </div>
           <div class="form-group">
            <button type="button" id="authpwd" class="btn btn-green">Submit</button>
        </div>
          <label id="error_pwd"></label>
      <?php $this->endWidget(); ?>
      </div>      
    </div>
  </div>
</div>
<script type="text/javascript">
    $('#myModal5').modal('show');  
    $("#authpwd").click(function(){
        var authpwd=$("#auth_password").val();
        var valid_data=$("#valid_data").val();
        $.ajax({
            url: '<?php echo $this->createUrl('purchaseorder/getsecuritypwd') ?>',
            data: {'valid_data':valid_data,'authpwd':authpwd,'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
            type: 'post',
            success: function(response) {
                if(response=="1"){
                    $('#myModal5').modal('hide');  
                    reviewpost(<?php echo $id;?>);
                }else{
                  $("#error_pwd").html(response);  
                }
            }
        }); 
    });    
</script>