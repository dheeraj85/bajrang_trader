<?php
$this->breadcrumbs = array(
     'Home' => array('site/dashboard'),
//    'Tickets' => array('index'),
    Ticket::tickettype($type).' Tickets',
);
$ticket_type = Tickettype::model()->findByPk($type);
?>

<style type="text/css">
    .view,.delete{
        display:none; 
    }
    .summary{
        font-size: large;
        font-weight: bold;
        color: red;
    }
</style>
                <div class="row">
                    <div class="col-lg-12" style="margin-left: -30px;">
                    <a class="btn btn-default pull-right" href="<?php echo $this->createUrl('site/dashboard'); ?>"><i class="fa fa-backward"></i> Back</a>
                </div>
                </div>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header with-border" style="background-color: <?php echo $ticket_type->code; ?>;">
                    <h3 class="panel-title">Manage Tickets</h3>
                </div>
                <div class="panel-body table-responsive">
                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'ticket-grid',
                        'dataProvider' => $model->searchadmin(),
//                        'filter' => $model,
                        'columns' => array(
//                            'id',
                            array('htmlOptions' => array(), 'header' => 'Ticket Type', 'value' => 'Ticket::tickettype($data->ticket_type)'),
//                            'ticket_type',
                            'subject',
                            array('htmlOptions' => array(), 'header' => 'Submitted By', 'value' => 'Ticket::user($data->submitted_by)'),
                            'submit_date',
//                            'status',
                            array('htmlOptions' => array(), 'header' => 'Status', 'value' => 'Ticket::status($data->status)'),
                            array('htmlOptions' => array(), 'header' => 'View', 'value' => 'Ticket::viewticket($data)'),
                            /*
                              'description',
                              'assigned_to',
                              'assigned_date',
                              'close_reason',
                             */
//                            array(
//                                'class' => 'bootstrap.widgets.BsButtonColumn',
//                            ),
                        ),
                    ));
                    ?>
                </div>
            </div>
        </div>  
    </div>
</div>
