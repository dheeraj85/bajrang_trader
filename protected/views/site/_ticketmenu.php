<section class="content-header">
    <h1>
        Ticket Dashboard
        &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
        &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;    
        &emsp;<span class="btn btn-warning"><i class="glyphicon glyphicon-warning-sign"></i> Pending</span>
        &emsp;<span class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Assigned</span>
        &emsp;<span class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Closed</span>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->createUrl('site/dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Ticket Dashboard</li>
    </ol>
</section><br/><br/>
<section class="content">
    <div class="row">
        <?php foreach (Tickettype::model()->findAll() as $ticket_type) { 
            $ticket_pending = Ticket::model()->findAllByAttributes(array('ticket_type'=>$ticket_type->id,'status'=>'pending'));
            $ticket_assigned = Ticket::model()->findAllByAttributes(array('ticket_type'=>$ticket_type->id,'status'=>'assigned'));
            $ticket_close = Ticket::model()->findAllByAttributes(array('ticket_type'=>$ticket_type->id,'status'=>'close'));
            ?>
            <div class="col-lg-4 col-xs-12">
                <!-- small box -->
                <div class="small-box" style="background-color: <?php echo $ticket_type->code; ?>;border-radius: 10px;box-shadow: 5px 5px 5px #888888;">
                    <br/>
                    <div class="inner">
                        <h4><?php echo $ticket_type->name; ?></h4>
                    </div>
                    <div class="icon">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/dist/img/process.png" alt="Outlet Indent">
                    </div>
                    <br/><br/>
                    <a href="<?php echo $this->createUrl('/site/ticketmanageradmin',array('type'=>$ticket_type->id)) ?>" class="small-box-footer">
                        <span class="btn btn-warning"><i class="glyphicon glyphicon-warning-sign"></i> &emsp;<sup><b><?php echo count($ticket_pending); ?></b></sup></span>
                        <span class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> &emsp;<sup><b><?php echo count($ticket_assigned); ?></b></sup></span>
                        <span class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> &emsp;<b><sup><b><?php echo count($ticket_close); ?></b></sup></span>
                    </a>
                </div>
            </div><!-- ./col -->
        <?php } ?>
    </div><!-- /.row -->
</section>