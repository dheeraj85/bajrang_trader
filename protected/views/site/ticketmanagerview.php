<?php
$this->breadcrumbs = array(
     'Home' => array('site/dashboard'),
    Ticket::tickettype($model->ticket_type).' Tickets' => array('site/ticketmanageradmin?type='.$model->ticket_type),
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
                    <h3 class="panel-title"><b>View Ticket :-</b> <?php echo $model->subject; ?></h3>
                </div>
                <div class="panel-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <th>Ticket Type</th>
                        <th>Subject</th>
                        <th style="width: 200px;">Description</th>
                        <th>Submitted By</th>
                        <th>Submit Date</th>
                        <th>Assigned To</th>
                        <th>Assigned Date</th>
                        <th>status</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo Ticket::tickettype($model->ticket_type); ?></td>
                                <td><?php echo $model->subject; ?></td>
                                <td style="width: 200px;"><?php echo $model->description; ?></td>
                                <td><?php echo Ticket::user($model->submitted_by); ?></td>
                                <td><?php echo $model->submit_date; ?></td>
                                <td><?php echo Ticket::user($model->assigned_to); ?></td>
                                <td><?php echo $model->assigned_date; ?></td>
                                <td><?php echo Ticket::status($model->status); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <br/>
                    <?php if($model->status!='close'){ ?>
                    <form action="<?php echo $this->createUrl('ticket/assignticket'); ?>" method="get">
                        <div class="row">
                            <input type="hidden" id="tid" name="tid" value="<?php echo $model->id; ?>"/>
                            <div class="col-lg-4">
                                <label>Select User Role</label>
                                <select id="role" name="role" class="form-control" onchange="Getuser();">
                                    <option value="">--Select User Role--</option>    
                                    <?php foreach (Utils::roles() as $k=>$v) { ?>
                                        <option value="<?php echo $k; ?>"><?php echo $v; ?></option>    
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label>Select User</label>
                                <select id="uid" name="uid" class="form-control">
                                    <option value="">--Select User--</option> 
                                </select>
                            </div>
                            <div class="col-lg-4" style="margin-top: 25px;">
                                <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-default" href="<?php echo $this->createUrl('site/ticketmanageradmin',array('type'=>$model->ticket_type)); ?>"><i class="fa fa-backward"></i> Back</a>
                            </div>
                        </div>
                    </form><br/>
                    <?php }else{ ?>
                    <a class="btn btn-default" href="<?php echo $this->createUrl('site/ticketmanageradmin',array('type'=>$model->ticket_type)); ?>"><i class="fa fa-backward"></i> Back</a>
                    <?php } ?>
                               
    <h2>Conversations :- </h2>
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
    $(document).ready(function() {
        Reply();
    });

    function Getuser() {
        var val = $('#role').val();
        $.ajax({
            url: '<?php echo $this->createUrl('/ticket/getuser'); ?>',
            data: {'val': val},
            type: 'get',
            success: function(response) {
                $('#uid').html(response);
            }
        });
    }
    
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