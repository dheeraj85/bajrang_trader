<?php
if (!empty($reply)) {
    ?><br/>
    <div class="row">
        <?php
        foreach ($reply as $rply) {
            if ($rply->from_id == Yii::app()->user->id) {
                ?>
                <div class="col-lg-12" style="margin-top: 5px;">
                    <div class="bg-info" style="padding: 10px;">
                        <img src="<?php echo Yii::app()->baseUrl ?>/images/user1.png" alt="user" width="40px" height="40px"/>
                        <label style="font-size: 18px;margin-left: 10px;">You</label><label style="float: right;"><?php echo $rply->reply_date; if ($ticket->status == 'assigned') { ?>&emsp;<span class="btn" style="color: red;" onclick="Delete(<?php echo $rply->id; ?>);"><i class="fa fa-close"></i></span><?php } ?></label>
                        <br/><p style="margin-left: 50px;"><?php echo $rply->reply_msg; ?></p>
                    </div>
                </div>
                <?php
            } else if ($rply->from_id != Yii::app()->user->id || Yii::app()->user->isSA() == 'sa'){
                $user = Users::model()->findByPk($rply->from_id);
                $user_rights = Userrights::model()->findByAttributes(array('user_id' => $rply->from_id));
                ?>
                <div class="col-lg-12" style="margin-top: 5px;">
                    <div class="bg-success" style="padding: 10px;">
                        <img src="<?php echo Yii::app()->baseUrl ?>/images/user2.png" alt="user" width="40px" height="40px"/>
                        <label style="font-size: 18px;margin-left: 10px;"><?php echo $user->name . '(' . $user_rights->heading . ')' ?></label><label style="float: right;"><?php echo $rply->reply_date; ?></label>
                        <br/><p style="margin-left: 50px;"><?php echo $rply->reply_msg; ?></p>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div><br/>
    <?php
} else {
    ?>
    <div class="alert alert-danger" style="text-align: center;"><h4>No Reply Found Here....</h4></div>
    <?php
}
if ($ticket->status == 'assigned'){ 
    if(Yii::app()->user->isTicketManager() == 'ticket_mgr') { }else {
    ?>
    <form id="reply">
        <input type="hidden" id="tid" name="tid" value="<?php echo $tid; ?>"/>
        <input type="hidden" id="from_id" name="from_id" value="<?php echo Yii::app()->user->id; ?>"/>
        <?php if ($ticket->submitted_by == Yii::app()->user->id) { ?>
            <input type="hidden" id="to_id" name="to_id" value="<?php echo $ticket->assigned_to; ?>"/>
        <?php } else if ($ticket->assigned_to == Yii::app()->user->id) { ?>
            <input type="hidden" id="to_id" name="to_id" value="<?php echo $ticket->submitted_by; ?>"/>
        <?php } ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-8">
                    <textarea id="reply_msg" name="reply_msg" class="form-control" placeholder="Write Your Comment Here...." rows="3" ></textarea>
                </div>
                <div class="col-lg-4">
                    <button type="button" id="replybtn" class="btn btn-primary" ><i class="fa fa-reply"></i> Submit</button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fa fa-close"></i> Close Ticket</button>
                </div>
            </div>
        </div>
    </form>
<?php } } ?>
<div class="modal fade bs-example-modal-sm" id="gateway1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="pull-left col-lg-3"></div>
    <div class="widget flat radius-bordered col-lg-6 bg-info" style="margin-top: 5%;">
        <div class="widget-header bg-success">
            <div class="widget-buttons" style="margin-top: 20px;">
                <a href="#" data-toggle="dispose">
                    <i class="fa fa-times close" data-dismiss="modal"></i>
                </a>
            </div>
        </div>
        <div class="widget-body">
            <form id="close_form">
                <div class="row">
                    <div class="col-lg-12">
                        <input type="hidden" id="ticket_id" name="ticket_id" value="<?php echo $tid; ?>"/>
                        <div class="col-lg-10">
                            <textarea id="close_msg" name="close_msg" class="form-control" placeholder="Write Close Reason Here...." rows="3" ></textarea>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="close" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="submit" data-loading-text="Loading..." autocomplete="off"  data-dismiss="modal">Submit</button>
            </div>
        </div>
    </div>
    <div class="pull-right col-lg-3"></div>
</div>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/bs/js/jquery.js"></script>
<script type="text/javascript">
                            $(document).ready(function() {
                                $('#replybtn').click(function() {
                                    var datastring = $('#reply').serialize();
                                    var msg = $('textarea#reply_msg').val();
                                    if(msg==''){
                                        alert('Please Enter Comment First...!!!');
                                    }else{
                                    $.ajax({
                                        url: '<?php echo $this->createUrl('/ticket/replysave'); ?>',
                                        data: datastring,
                                        type: 'get',
                                        success: function(response) {
                                            Reply();
                                            $('textarea#reply_msg').focus();
                                        }
                                    });
                                    }
                                });
                                $('.close').click(function() {
                                Reply();
                                });
                                $('#close').click(function() {
                                Reply();
                                });
                                $('#submit').click(function() {
                                    var data = $('#close_form').serialize();
                                    var msg = $('textarea#close_msg').val();
                                    if(msg==''){
                                        alert('Please Give The Reson Of Close Conversation...!!!');
                                    }else{
                                    $.ajax({
                                        url: '<?php echo $this->createUrl('/ticket/close'); ?>',
                                        data: data,
                                        type: 'get',
                                        success: function(response) {
                                            Reply();
                                        }
                                    });
                                    }
                                });
                            });

                            function Delete(id) {
                                var r = confirm('Are You Sure You want To Delete Your Coversation ?');
                                if (r == true) {
                                    $.ajax({
                                        url: '<?php echo $this->createUrl('/ticket/deletereply'); ?>',
                                        data: {'id': id},
                                        type: 'get',
                                        success: function(response) {
                                            Reply();
                                        }
                                    });
                                } else {

                                }
                            }
</script>