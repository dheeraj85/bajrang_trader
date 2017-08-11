<?php
$this->breadcrumbs = array(
     'Home' => array('site/dashboard'),
//    'Tickets' => array('index'),
    'Tickets',
);

$this->menu = array(
    array('label' => 'List Ticket', 'url' => array('index')),
    array('label' => 'Create Ticket', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('ticket-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<style type="text/css">
    .view,.delete{
        display:none; 
    }
</style>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header with-border bg-green">
                    <h3 class="panel-title">Manage Assigned Tickets</h3>
                </div>
                <div class="panel-body table-responsive">
                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'ticket-grid',
                        'dataProvider' => $model->searchtickets(),
//                        'filter' => $model,
                        'columns' => array(
//                            'id',
                            array('htmlOptions' => array(), 'header' => 'Ticket Type', 'value' => 'Ticket::tickettype($data->ticket_type)'),
                            'subject',
                            array('htmlOptions' => array(), 'header' => 'Submitted By', 'value' => 'Ticket::user($data->submitted_by)'),
                            'submit_date',
//                            'status',
                            array('htmlOptions' => array(), 'header' => 'Status', 'value' => 'Ticket::status($data->status)'),
                            array('htmlOptions' => array(), 'header' => 'View', 'value' => 'Ticket::tickets($data)'),
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
