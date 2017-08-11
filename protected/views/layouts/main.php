<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!--<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">-->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" crossorigin="anonymous">
        <!--<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/dist/css/font-awesome.min.css">-->
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/dist/css/ionicons.min.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/dist/css/_all-skins.min.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/iCheck/flat/blue.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/select2/select2.min.css">
        <?php
        $cs = Yii::app()->clientScript;
        $themePath = Yii::app()->baseUrl;
        $cs
                ->registerCssFile($themePath . '/bs/css/bootstrap.css')
                ->registerCssFile($themePath . '/bs/css/bootstrap-theme.css');
        ?>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="<?php echo $this->createUrl('site/dashboard'); ?>" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>JB</b></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>JAI BAJRANG</b></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <?php
                    $user = Yii::app()->user->id;
                    $ticket_pending = Ticket::model()->findAllBySql("select * from ticket where status='pending'");
                    $ticket_to = Ticket::model()->findAllBySql("select * from ticket where assigned_to=$user and status!='close'");
                    $ticket_by = Ticket::model()->findAllBySql("select * from ticket where submitted_by=$user and status!='close'");
                    ?>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- Messages: style can be found in dropdown.less-->
                            <li class="dropdown messages-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-ticket"></i>

                                    <?php if (Yii::app()->user->isTicketManager() == 'ticket_mgr') { ?>
                                        <span class="label label-warning"><?php echo count($ticket_pending); ?></span>
                                    <?php } else { ?>
                                        <span class="label label-success"><?php echo count($ticket_to); ?></span>
                                    <?php } ?>

                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header"></li>
                                    <li>
                                        <ul class="menu">
                                            <?php if (Yii::app()->user->isTicketManager() == 'ticket_mgr') { ?>
                                            <?php } else { ?>
                                                <li class="header"><span style="padding-left:10px;font-size:18px;color:#0077b3;">Create & Manage Tickets</span><hr/></li>
                                                <li>
                                                    <a href="<?php echo $this->createUrl('ticket/admin'); ?>" class="">

                                                        <h4>
                                                            <span class="label label-success"><?php echo count($ticket_by); ?></span>   My Tickets
                                                        </h4>
                                                    </a>
                                                </li>
                                                <li>&nbsp;</li>
                                                <li class="header"><span style="padding-left:10px;font-size:18px;color:#0077b3;">Ticket Manager</span><hr/></li>
                                                <li>
                                                    <a href="<?php echo $this->createUrl('ticket/assignedtickets'); ?>" class="">
                                                        <h4>
                                                            <span class="label label-success"><?php echo count($ticket_to); ?></span>   Assigned Tickets
                                                        </h4>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <?php
                                    if (!empty(Yii::app()->user->id)) {
                                        $model = Users::model()->findByPk(Yii::app()->user->id);
                                        ?>
                                        <span class="hidden-xs"><?php echo strtoupper($model->name) . " (" . strtoupper($model->role) . ")"; ?></span>
                                    <?php } ?>                  
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/A-logo-151X-151.png" class="img-circle" alt="User Image">
                                        <p> <?php echo strtoupper($model->name) . " (" . strtoupper($model->role) . ")"; ?>     
                                            <?php
                                            if (!empty(Yii::app()->user->id)) {
                                                $lastlogin = Userslogins::model()->findBySql("select * from users_logins where user_id=" . Yii::app()->user->id . " order by id desc limit 1");
                                                ?>   
                                                <small>Last Login <?php echo $lastlogin->in_out; ?></small>
                                            <?php } ?>  
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <!--                    <div class="pull-left">
                                                              <a href="#" class="btn btn-default btn-flat">Profile</a>
                                                            </div>-->
                                        <div class="pull-right">
                                            <a href="<?php echo $this->createUrl('site/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <!--                    <div class="user-panel">
                    <?php
                    if (!empty(Yii::app()->user->id)) {
                        $model = Users::model()->findByPk(Yii::app()->user->id);
                        ?>
                                                        <div class="pull-left image">
                                                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/dist/img/gbook_logo.jpg" class="img-circle" alt="User Image">
                                                        </div>
                                                        <div class="pull-left info">
                                                            <p><?php echo strtoupper($model->name) . " (" . strtoupper($model->role) . ")"; ?></p>
                                                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                                                        </div>
                    <?php } ?>   
                                        </div>-->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <!--<li class="header">MAIN NAVIGATION</li>-->
                        <?php
                        echo Yii::app()->user->isKPOS();
                        if (Yii::app()->user->isSA() == 'sa') {
                            $this->renderPartial('//layouts/_samenu', array('active_menu' => $this->active_menu, 'open_class' => $this->open_class, 'active_class' => $this->active_class));
                        } else if (Yii::app()->user->isCDS() == 'cds') {
                            $this->renderPartial('//layouts/_cdsmenu', array('active_menu' => $this->active_menu, 'open_class' => $this->open_class, 'active_class' => $this->active_class));
                        } else if (Yii::app()->user->isGPU() == 'gpu') {
                            $this->renderPartial('//layouts/_gpumenu', array('active_menu' => $this->active_menu, 'open_class' => $this->open_class, 'active_class' => $this->active_class));
                        } else if (Yii::app()->user->isCPS() == 'cps') {
                            $this->renderPartial('//layouts/_cpsmenu', array('active_menu' => $this->active_menu, 'open_class' => $this->open_class, 'active_class' => $this->active_class));
                        } else if (Yii::app()->user->isOutletManager() == 'outlet_mgr') {
                            $this->renderPartial('//layouts/_outletmenu', array('active_menu' => $this->active_menu, 'open_class' => $this->open_class, 'active_class' => $this->active_class));
                        } else if (Yii::app()->user->isPOS() == 'pos') {
                            $this->renderPartial('//layouts/_posmenu', array('active_menu' => $this->active_menu, 'open_class' => $this->open_class, 'active_class' => $this->active_class));
                        } else if (Yii::app()->user->isKPOS() == 'kpos') {
                            $this->renderPartial('//layouts/_kposmenu', array('active_menu' => $this->active_menu, 'open_class' => $this->open_class, 'active_class' => $this->active_class));
                        }
                        ?>
                    </ul>
                </section>
            </aside>
            <div class="content-wrapper">
                <?php
                if (isset($this->breadcrumbs)):
                    if (Yii::app()->controller->route !== 'site/index')
                        $this->breadcrumbs = array_merge(array(Yii::t('zii', 'Home') => 'dashboard'), $this->breadcrumbs);
                    $this->widget('bootstrap.widgets.BsBreadcrumb', array(
                        'links' => $this->breadcrumbs,
                        'homeLink' => false,
                        'tagName' => 'ol',
                        'separator' => '',
                        'activeLinkTemplate' => '<li><a href="{url}">{label}</a></li>',
                        'inactiveLinkTemplate' => '<li><span>{label}</span></li>',
                        'htmlOptions' => array('class' => 'breadcrumb')
                    ));
                    ?>
                <?php endif; ?> 
                <?php
                foreach (Yii::app()->user->getFlashes() as $key => $message) {
                    echo '<div class="alert alert-' . $key . '">' . $message . "<button type='button' class='close' data-dismiss='alert'>x</button></div>\n";
                }
                ?>
                <?php echo $content; ?>
            </div><!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> Beta
                </div>
                <strong>Copyright &copy; 2015-2016 <a href="#">Trader Application</a>.</strong> Developed By <a href="http://cics.co.in" target="_blank">CICS</a>
            </footer>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/dist/js/jquery-ui.min.js"></script>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/front/libs/jquery/jquery-1.11.2.min.js"></script>    
            <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/tableexport/jquery.table2excel.js"></script>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/select2/select2.full.min.js"></script>
        </div><!-- ./wrapper -->
        <!-- I have commented below for Barcode. if no use please delete--->
        <script>
            $(function() {
                $(".select2").select2();
                $('.select2-selection__rendered').removeAttr('title');
            });
        </script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/dist/js/app.min.js"></script>
    </body>
</html>
<div id="load_model"></div>
<script type="text/javascript">
            function authreview(id, url) {
                $.ajax({
                    url: '<?php echo Yii::app()->createUrl('purchaseorder/authreview') ?>',
                    data: 'sync_id=' + id + '&url=' + url,
                    success: function(response) {
                        $("#load_model").html(response);
                    }
                });
            }
</script>
<script type="text/javascript">
    jQuery.browser = {};
    (function() {
        jQuery.browser.msie = false;
        jQuery.browser.version = 0;
        if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
            jQuery.browser.msie = true;
            jQuery.browser.version = RegExp.$1;
        }
    })();
</script>