<!DOCTYPE html>
<html lang="en">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />   
   <head>
        <title>Cake Designing App</title>
        <meta charset="utf-8">
        <link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css'/>
        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/front/theme-default/bootstrap94be.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/front/theme-default/materialadminb0e2.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/front/theme-default/font-awesome.min753e.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/front/theme-default/material-design-iconic-font.mine7ea.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/front/theme-default/libs/jquery-ui/jquery-ui-theme5e0a.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/front/theme-default/materialadmin_printb0e2.css"  media="print"/>
        <!-- jQuery (required) & jQuery UI + theme (optional) -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/front/docs/js/jquery-latest.min.js"></script>	
	<!-- keyboard widget css & script (required) -->
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/front/keyboard.css" rel="stylesheet">
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/front/jquery.keyboard.js"></script>
              <script src="<?php echo Yii::app()->request->baseUrl; ?>/front/libs/jquery/jquery-1.11.2.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/front/libs/jquery/jquery-migrate-1.2.1.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/front/libs/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/front/libs/bootstrap/bootstrap.min.js"></script>
  
    </head>
    <body class="menubar-hoverable header-fixed">
        <div id="content">
            <section>
                <div class="section-body contain-lg">
                    <div class="row">			
                        <div class="col-lg-12">
                            <div class="card card-tiles style-default-light">
                                <div class="row">
                                    <?php echo $content;?>
                                </div><!-- .row -->
                            </div>
                        </div><!--end .col -->
                    </div><!--end .row -->

                </div>
            </section>
        </div>
    </body>
</html>
<script type="text/javascript">
$(document).unbind('keydown').bind('keydown', function (event) {
    var doPrevent = false;
    if (event.keyCode === 8) {
        var d = event.srcElement || event.target;
        if ((d.tagName.toUpperCase() === 'INPUT' && 
             (
                 d.type.toUpperCase() === 'TEXT' ||
                 d.type.toUpperCase() === 'PASSWORD' || 
                 d.type.toUpperCase() === 'FILE' || 
                 d.type.toUpperCase() === 'SEARCH' || 
                 d.type.toUpperCase() === 'EMAIL' || 
                 d.type.toUpperCase() === 'NUMBER' || 
                 d.type.toUpperCase() === 'DATE' )
             ) || 
             d.tagName.toUpperCase() === 'TEXTAREA') {
            doPrevent = d.readOnly || d.disabled;
        }
        else {
            doPrevent = true;
        }
    }

    if (doPrevent) {
        event.preventDefault();
    }
});
</script>