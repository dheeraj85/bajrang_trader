<div class="panel-body" >
    <?php if(!empty($err_msg)){?>
    <div id="login-alert"><?php echo $err_msg;?></div>
    <?php }?>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login_form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>  
     <?php echo $form->error($model, 'username', array('class' => 'alert alert-error')); ?>
     <?php echo $form->error($model, 'password', array('class' => 'alert alert-error')); ?> 
    <div class="form-group has-feedback">            
        <?php
        echo $form->textField($model, 'username', array('class' => "form-control", 'placeholder' => "Mobile No."));
        ?>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">            
        <?php
        echo $form->passwordField($model, 'password', array('class' => "form-control", 'placeholder' => "Password"));
        ?>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="row">
        <div class="col-xs-8">
            <div class="checkbox icheck">
                <label>
                    <?php echo $form->checkBox($model, 'rememberMe'); ?><?php echo $form->label($model, 'rememberMe'); ?>
                </label>
            </div>
        </div><!-- /.col -->
        <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div><!-- /.col -->
    </div>
    <?php $this->endWidget(); ?>   
</div>
<?php
//$this->widget('bootstrap.widgets.BsGridView', array(
//    'id' => 'users-grid',
//    'type' => 'bordered',
//    'dataProvider' => $smodel->search(),
//    //'filter' => $model,
//    'columns' => array(
//        //'id',
//        //'name',
//        //'mobile',
//        //'email',
//        //'password',
//        //'auth_password',
//        //'role',
//    ),
//));
?>