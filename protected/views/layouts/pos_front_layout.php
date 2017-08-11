<!DOCTYPE html>
<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <head>
        <title>Bill Print</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/dist/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/dist/css/ionicons.min.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/dist/css/_all-skins.min.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/iCheck/flat/blue.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/select2/select2.min.css">
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/bs/js/jquery.js"></script>
        <?php
        $cs = Yii::app()->clientScript;
        $themePath = Yii::app()->baseUrl;
        $cs
                ->registerCssFile($themePath . '/bs/css/bootstrap.css')
                ->registerCssFile($themePath . '/bs/css/bootstrap-theme.css');
        ?>
    </head>
    <body class="menubar-hoverable header-fixed well" style="/*background-color: #41d0be;*/">
        <!-- BEGIN HEADER-->
        <div id="base">
            <div class="offcanvas">
            </div>
            <div id="content" style="left: -31px;padding-top: 0px;">
                <section>
                    <div class="section-body">
                        <?php echo $content; ?>                   
                    </div>
                </section>
            </div>
        </div> 

    </body>
</html>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/tableexport/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/tableexport/tableExport.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/tableexport/jquery.base64.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/dist/js/jquery-ui.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/dist/js/app.min.js"></script>