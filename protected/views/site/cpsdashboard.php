<section class="content-header">
    <h1>
        Central Purchase System
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->createUrl('site/dashboard')?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Central Purchase System</li>
    </ol>
</section>
<?php if (Yii::app()->user->isSA() == 'sa' || Yii::app()->user->isCPS() == 'cps') {?>
<section class="content">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <a href="<?php echo $this->createUrl('vendor/index')?>" class="small-box-footer">
            <div class="small-box bg-green">
                <br/><br/><br/>
                <div class="inner">
                    <p>Vendor Management</p>
                </div>
                <div class="icon">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/dist/img/hrm.png" alt="Vendor Management">
                </div>
                <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>
            </div>
            </a>
        </div><!-- ./col -->
       <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <a href="<?php echo $this->createUrl('purchaseinvoice/index')?>" class="small-box-footer">
            <div class="small-box bg-green">
                <br/><br/><br/>
                <div class="inner">
                    <p>Purchase Invoice</p>
                </div>
                <div class="icon">
                   <img src="<?php echo Yii::app()->request->baseUrl; ?>/dist/img/ticket.png" alt="HRM">
                </div>
                <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>
            </div>
            </a>
        </div><!-- ./col -->

    
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <a href="<?php echo $this->createUrl('vendor/ledger')?>" class="small-box-footer">
            <div class="small-box bg-green">
                <br/><br/><br/>
                <div class="inner">
                    <p>Vendor Ledger</p>
                </div>
                <div class="icon">
                   <img src="<?php echo Yii::app()->request->baseUrl; ?>/dist/img/ticket.png" alt="HRM">
                </div>
                <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>
            </div>
            </a>
        </div><!-- ./col -->
    </div><!-- /.row -->
</section>
<?php }else{?>
<section class="content">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <a href="<?php echo $this->createUrl('itemstock/index')?>" class="small-box-footer">
            <div class="small-box bg-green">
                <br/><br/><br/>
                <div class="inner">
                    <p>Inventory Management</p>
                </div>
                <div class="icon">
                   <img src="<?php echo Yii::app()->request->baseUrl; ?>/dist/img/ticket.png" alt="HRM">
                </div>
                <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>
            </div>
            </a>
        </div><!-- ./col -->
    </div><!-- /.row -->
</section>
<?php } ?>