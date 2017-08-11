<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php
        $cs = Yii::app()->clientScript;
        $themePath = Yii::app()->baseUrl;
        $cs
                ->registerCssFile($themePath . '/bs/css/bootstrap.css')
                ->registerCssFile($themePath . '/bs/css/bootstrap-theme.css');
        ?>
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/dist/css/AdminLTE.min.css">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="#"><b>Traders</b> Login</a>
            </div><!-- /.login-logo -->
            <div class="login-box-body">
                <div class="row" style='padding-left:15px;'>
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-9" style="padding-top:15px;">Sign in to start your session</div>
                </div>
                 <?php echo $content; ?>
            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->
    </body>
</html>