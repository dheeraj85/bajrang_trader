<?php
$this->breadcrumbs = array(
     'Home' => array('site/dashboard'),
     Ticket::tickettype($model->ticket_type).' Tickets' => array('assignedtickets'),
    $model->subject,
);
$ticket_type = Tickettype::model()->findByPk($model->ticket_type);

$this->menu = array(
    array('label' => 'List Ticket', 'url' => array('index')),
    array('label' => 'Create Ticket', 'url' => array('create')),
    array('label' => 'Update Ticket', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Ticket', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Ticket', 'url' => array('admin')),
);
?>
<input type="hidden" id="tid" value="<?php echo $model->id; ?>"/>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header with-border" style="background-color: <?php echo $ticket_type->code; ?>;">
                    <h3 class="panel-title"><b>Reply Ticket :-</b> <?php echo $model->subject; ?></h3>
                </div>
                <div class="panel-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <th>Ticket Type</th>
                        <th>Subject</th>
                        <th style="width: 300px;">Description</th>
                        <th>Submitted By</th>
                        <th>Submit Date</th>
                        <th>Assigned Date</th>
                        <th>status</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo Ticket::tickettype($model->ticket_type); ?></td>
                                <td><?php echo $model->subject; ?></td>
                                <td style="width: 300px;"><?php echo $model->description; ?></td>
                                <td><?php echo  Ticket::user($model->submitted_by); ?></td>
                                <td><?php echo $model->submit_date; ?></td>
                                <td><?php echo $model->assigned_date; ?></td>
                                <td><?php echo Ticket::status($model->status); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <a class="btn btn-default" href="<?php echo $this->createUrl('ticket/assignedtickets'); ?>"><i class="fa fa-backward"></i> Back</a>
                    <hr/><br/>
    <h2>Replies :- </h2>
                    <div id="res"></div>
            </div>
        </div>
    </div>
</div>
</div>
<?php
//$this->widget('zii.widgets.CDetailView', array(
//	'data'=>$model,
//	'attributes'=>array(
//		'id',
//		'ticket_type',
//		'subject',
//		'description',
//		'submitted_by',
//		'submit_date',
//		'assigned_to',
//		'assigned_date',
//		'status',
//		'close_reason',
//	),
//)); 
?>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/bs/js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
   Reply(); 
});    

function Reply(){
    var tid = $('#tid').val();
    $.ajax({
        url:'<?php echo $this->createUrl('/ticket/reply'); ?>',
        data:{'tid':tid},
        type:'get',
        success: function(response){
         $('#res').html(response);   
         $('#reply_msg').focus();   
        }
    });
}
</script>