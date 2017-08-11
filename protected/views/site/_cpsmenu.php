<section class="content-header">
    <h1>
        CPS Dashboard
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->createUrl('site/dashboard')?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">CPS Dashboard</li>
    </ol>
</section>
<section class="content">
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <a href="<?php echo $this->createUrl('site/cmsdashboard') ?>" class="small-box-footer">
        <div class="small-box bg-aqua">
            <br/><br/><br/>
            <div class="inner">
                <p>Master CMS</p>
            </div>
            <div class="icon">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/dist/img/cms.png" alt="Master CMS">
            </div>
            <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>
        </div>
        </a>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <a href="<?php echo $this->createUrl('site/cpsdashboard') ?>" class="small-box-footer">
        <div class="small-box bg-green">
            <br/><br/><br/>
            <div class="inner">
                <p>Central Purchase System</p>
            </div>
            <div class="icon">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/dist/img/cps.png" alt="Central Purchase System">
            </div>
            <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>
        </div>
        </a>
    </div><!-- ./col -->
</div><!-- /.row -->
</section>