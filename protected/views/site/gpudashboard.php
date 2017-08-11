<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Goods Processing Unit

',
);
?>
<!--<section class="content-header">
    <h1>
        GPU Dashboard
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php // echo $this->createUrl('site/dashboard')?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">GPU Dashboard</li>
    </ol>
</section>-->
<section class="content">
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <a href="<?php echo $this->createUrl('indentmaster/index') ?>" class="small-box-footer">
        <div class="small-box bg-red">
            <br/><br/><br/>
            <div class="inner">
                <p>Internal Indent</p>
            </div>
            <div class="icon">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/dist/img/process.png" alt="Goods Processing Unit">
            </div>
            <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>
        </div>
        </a>
    </div><!-- ./col -->
     <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <a href="<?php echo $this->createUrl('finisheditem/index') ?>" class="small-box-footer">
        <div class="small-box bg-red">
            <br/><br/><br/>
            <div class="inner">
                <p>Finished Item Stock</p>
            </div>
            <div class="icon">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/dist/img/ticket.png" alt="Finished Item Stock">
            </div>
            <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>
        </div>
        </a>
    </div><!-- ./col -->
</div><!-- /.row -->
</section>