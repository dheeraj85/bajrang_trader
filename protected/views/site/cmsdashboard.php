<section class="content-header">
    <h1>
        Master CMS Dashboard
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->createUrl('site/dashboard')?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Master CMS Dashboard</li>
    </ol>
</section>
<?php if (Yii::app()->user->isSA() == 'sa') {?>
<section class="content">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <a href="<?php echo $this->createUrl('itemscale/admin')?>" class="small-box-footer">
            <div class="small-box bg-aqua">
                <br/><br/><br/>
                <div class="inner">
                    <p>Scale's & Measures</p>
                </div>
                <div class="icon">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/dist/img/scale.png" alt="Scale's & Measures">
                </div>
                <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>
            </div>
            </a>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <a href="<?php echo $this->createUrl('purchasecategory/index')?>" class="small-box-footer">
            <div class="small-box bg-aqua">
                <br/><br/><br/>
                <div class="inner">
                    <p>Item Master</p>
                </div>
                <div class="icon">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/dist/img/items.png" alt="Item Master">
                </div>
                <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>
            </div>
            </a>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <a href="<?php echo $this->createUrl('designation/admin')?>" class="small-box-footer">
            <div class="small-box bg-aqua">
                <br/><br/><br/>
                <div class="inner">
                    <p>HR CMS</p>
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
            <a href="<?php echo $this->createUrl('tickettype/admin')?>" class="small-box-footer">
            <div class="small-box bg-aqua">
                <br/><br/><br/>
                <div class="inner">
                    <p>Ticket Management</p>
                </div>
                <div class="icon">
                   <img src="<?php echo Yii::app()->request->baseUrl; ?>/dist/img/ticket.png" alt="Ticket Management">
                </div>
                <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>
            </div>
            </a>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <a href="<?php echo $this->createUrl('invoicesettings/admin')?>" class="small-box-footer">
            <div class="small-box bg-aqua">
                <br/><br/><br/>
                <div class="inner">
                    <p>Invoice Setting</p>
                </div>
                <div class="icon">
                   <img src="<?php echo Yii::app()->request->baseUrl; ?>/dist/img/ticket.png" alt="Ticket Management">
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
            <a href="<?php echo $this->createUrl('purchasecategory/index')?>" class="small-box-footer">
            <div class="small-box bg-aqua">
                <br/><br/><br/>
                <div class="inner">
                    <p>Item Master</p>
                </div>
                <div class="icon">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/dist/img/items.png" alt="Item Master">
                </div>
                <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>
            </div>
            </a>
        </div><!-- ./col -->
    </div><!-- /.row -->
</section>
<?php } ?>