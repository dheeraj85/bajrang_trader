<section class="content-header">
    <h1>
        Super Admin Dashboard
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->createUrl('site/dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Super Admin Dashboard</li>
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
                        <p>Purchase System</p>
                    </div>
                    <div class="icon">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/dist/img/cps.png" alt="Central Purchase System">
                    </div>
                    <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>
                </div>
            </a>    
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <a href="<?php echo $this->createUrl('supply/transfershelf') ?>" class="small-box-footer">
                <div class="small-box bg-yellow">
                    <br/><br/>
                    <div class="inner">
                        <p>Stock Distribution <br> &  Management</p>
                    </div>
                    <div class="icon">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/dist/img/cds.png" alt="Central Distribution System">
                    </div>
                    <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>
                </div>
            </a> 
        </div><!-- ./col -->

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <a href="<?php echo $this->createUrl('offshelfsale/create') ?>" class="small-box-footer">
                <div class="small-box btn-primary">
                    <br/><br/><br/>
                    <div class="inner">
                        <p>Sale</p>
                    </div>
                    <div class="icon">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/dist/img/pos_cms.png" alt="HRM">
                    </div>
                    <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>
                </div>
            </a>
        </div><!-- ./col -->

    </div><!-- /.row -->

    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <a href="<?php echo $this->createUrl('employee/index') ?>" class="small-box-footer">
                <div class="small-box btn-primary">
                    <br/><br/>
                    <div class="inner">
                        <p>Human Resource <br/>System</p>
                    </div>
                    <div class="icon">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/dist/img/hrm.png" alt="HRM">
                    </div>
                    <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>
                </div>
            </a>    
        </div><!-- ./col -->


        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <a href="<?php echo $this->createUrl('voucher/index') ?>" class="small-box-footer">
                <div class="small-box btn-primary">
                    <br/><br/>
                    <div class="inner">
                        <p>Account Management <br/>System</p>
                    </div>
                    <div class="icon">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/dist/img/exp_cms.png" alt="HRM">
                    </div>
                    <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>
                </div>
            </a>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <a href="<?php echo $this->createUrl('expenseheads/index') ?>" class="small-box-footer">
                <div class="small-box btn-primary">
                    <br/><br/>
                    <div class="inner">
                        <p>Expense Management <br/>System</p>
                    </div>
                    <div class="icon">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/dist/img/exp_cms.png" alt="HRM">
                    </div>
                    <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>
                </div>
            </a>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <a href="<?php echo $this->createUrl('site/reportdashboard') ?>" class="small-box-footer">
                <div class="small-box btn-aqua">
                    <br/><br/><br/>
                    <div class="inner">
                        <p>Reports</p>
                    </div>
                    <div class="icon">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/dist/img/report-icon.png" alt="HRM">
                    </div>
                    <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>
                </div>
            </a>
        </div><!-- ./col -->    

    </div>
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <a href="<?php echo $this->createUrl('reports/gstformat') ?>" class="small-box-footer">
                <div class="small-box btn-aqua">
                    <br/><br/><br/>
                    <div class="inner">
                        <p>GST</p>
                    </div>
                    <div class="icon">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/dist/img/report-icon.png" alt="HRM">
                    </div>
                    <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>
                </div>
            </a>
        </div><!-- ./col -->    
    </div>
</section>