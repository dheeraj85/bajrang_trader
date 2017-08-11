<section class="content-header">
    <h1>
        Outlet Dashboard
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->createUrl('site/dashboard')?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Outlet Dashboard</li>
    </ol>
</section>
<section class="content">
<div class="row"> 
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <a href="<?php echo $this->createUrl('indentmaster/create'); ?>" class="small-box-footer">
        <div class="small-box bg-aqua">
            <br/><br/><br/>
            <div class="inner">
                <p>GPU Indent</p>
            </div>
            <div class="icon">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/dist/img/process.png" alt="GPU Indent">
            </div>
            <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>
        </div>
        </a>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <a href="<?php echo $this->createUrl('outletindent/create') ?>" class="small-box-footer">
        <div class="small-box bg-aqua">
            <br/><br/><br/>
            <div class="inner">
                <p>Outlet Indent</p>
            </div>
            <div class="icon">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/dist/img/process.png" alt="Outlet Indent">
            </div>
            <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>
        </div>
        </a>
    </div><!-- ./col -->
     <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <a href="<?php echo $this->createUrl('outletstaff/create') ?>" class="small-box-footer">
        <div class="small-box btn-primary">
            <br/><br/><br/>
            <div class="inner">
                <p>Outlet Staff</p>
            </div>
            <div class="icon">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/dist/img/hrm.png" alt="HRM">
            </div>
            <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>
        </div>
        </a>
    </div><!-- ./col -->
</div><!-- /.row -->
</section>