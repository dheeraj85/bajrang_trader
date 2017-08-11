<?php
if (!empty($searchdata)) {
    ?>
    <h4>Cake Orders</h4>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered">
                <thead>
                <th>Order No</th>
                <th>Name</th>
                <th>Number</th>
                <th>Status</th>
                <th>Order Date</th>
                <th>Deliver Date</th>
                <th>Action</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($searchdata as $data) {
                        $cust = Customer::model()->findByPk($data->customer_id);
                        if ($data->cake_status == 'pending') {
                            ?>
                            <tr>
                                <td><?php echo 'TOC-'.$data->id; ?></td>
                                <td><?php echo $cust->full_name; ?></td>
                                <td><?php echo $cust->mobile_no; ?></td>
                                <td style="color: #a49d1b;"><?php echo 'Pending...'; ?></td>
                                <td><?php echo date('d-M-Y', strtotime($data->order_date)); ?></td>
                                <td><?php echo $data->delivery_datetime; ?></td>
                                <td>
                                    <button type="button" onclick="changeStatus('pending',<?php echo $data->id; ?>);" class="btn btn-success"><i class="glyphicon glyphicon-send"></i><?php echo 'Send Kot '; ?></button>
                                    <button type="button" onclick="View(<?php echo $data->id; ?>);" class="btn btn-info"><i class="glyphicon glyphicon-eye-open"></i><?php echo 'View '; ?></button>
                                </td>
                            </tr>
                            <?php
                        } else if ($data->cake_status == 'p_accepted') {
                            ?>
                            <tr>
                                <td><?php echo 'TOC-'.$data->id; ?></td>
                                <td><?php echo $cust->full_name; ?></td>
                                <td><?php echo $cust->mobile_no; ?></td>
                                <td style="color: #18186a;"><?php echo 'Accepted'; ?></td>
                                <td><?php echo date('d-M-Y', strtotime($data->order_date)); ?></td>
                                <td><?php echo $data->delivery_datetime; ?></td>
                                <td>
                                    <?php if (Yii::app()->user->isPOS() == 'pos') { ?>
                                    Accepted By POS
                                    <?php }else if (Yii::app()->user->isKPOS() == 'kpos') { ?>
                                    <button type="button" onclick="changeStatus('p_accepted',<?php echo $data->id; ?>);" class="btn btn-success"><?php echo 'Click To Accept'; ?></button>
                                    <?php } ?>
                                    <button type="button" onclick="View(<?php echo $data->id; ?>);" class="btn btn-info"><i class="glyphicon glyphicon-eye-open"></i><?php echo 'View '; ?></button>
                                </td>
                            </tr>
                            <?php
                        } else if ($data->cake_status == 'k_accepted') {
                            ?>
                            <tr>
                                <td><?php echo 'TOC-'.$data->id; ?></td>
                                <td><?php echo $cust->full_name; ?></td>
                                <td><?php echo $cust->mobile_no; ?></td>
                                <td style="color: #00cc66;"><?php echo 'Advance'; ?></td>
                                <td><?php echo date('d-M-Y', strtotime($data->order_date)); ?></td>
                                <td><?php echo $data->delivery_datetime; ?></td>
                                <td>
                                    <button type="button" id="processing_btn" style="display: none;" onclick="changeStatus('k_accepted',<?php echo $data->id; ?>);" class="btn btn-success"><?php echo 'Click to Proccessing'; ?></button>
                                    <button type="button" id="adv_btn" onclick="takeAdvance(<?php echo $data->id; ?>);" class="btn btn-primary"><?php echo 'Take Advance'; ?></button>
                                    <button type="button" onclick="View(<?php echo $data->id; ?>);" class="btn btn-info"><i class="glyphicon glyphicon-eye-open"></i><?php echo 'View '; ?></button>
                                </td>
                            </tr>
                            <?php
                        } else if ($data->cake_status == 'processing') {
                            ?>
                            <tr>
                                <td><?php echo 'TOC-'.$data->id; ?></td>
                                <td><?php echo $cust->full_name; ?></td>
                                <td><?php echo $cust->mobile_no; ?></td>
                                <td style="color: #00cccc;"><?php echo 'Proccesed'; ?></td>
                                <td><?php echo date('d-M-Y', strtotime($data->order_date)); ?></td>
                                <td><?php echo $data->delivery_datetime; ?></td>
                                <td>
                                    <?php if (Yii::app()->user->isPOS() == 'pos') { ?>
                                    
                                    <?php }else if (Yii::app()->user->isKPOS() == 'kpos') { ?>
                                    <button type="button" onclick="changeStatus('processing',<?php echo $data->id; ?>);" class="btn btn-success"><?php echo 'Click To Finished'; ?></button>
                                 <?php } ?>
                                    <button type="button" onclick="View(<?php echo $data->id; ?>);" class="btn btn-info"><i class="glyphicon glyphicon-eye-open"></i><?php echo 'View '; ?></button>
                                </td>
                            </tr>
                            <?php
                        } else if ($data->cake_status == 'finished') {
                            ?>
                            <tr>
                                <td><?php echo 'TOC-'.$data->id; ?></td>
                                <td><?php echo $cust->full_name; ?></td>
                                <td><?php echo $cust->mobile_no; ?></td>
                                <td style="color: #009900;"><?php echo 'Finished'; ?></td>
                                <td><?php echo date('d-M-Y', strtotime($data->order_date)); ?></td>
                                <td><?php echo $data->delivery_datetime; ?></td>
                                <td>
                                    <button type="button" onclick="changeStatus('finished',<?php echo $data->id; ?>);" class="btn btn-success"><?php echo 'Click To Deliver'; ?></button>
                                    <button type="button" onclick="View(<?php echo $data->id; ?>);" class="btn btn-info"><i class="glyphicon glyphicon-eye-open"></i><?php echo 'View '; ?></button>
                                </td>
                            </tr>
                            <?php
                        } else if ($data->cake_status == 'delivered') {
                            ?>
                            <tr>
                                <td><?php echo 'TOC-'.$data->id; ?></td>
                                <td><?php echo $cust->full_name; ?></td>
                                <td><?php echo $cust->mobile_no; ?></td>
                                <td style="color: #0000cc;">Delivered</td>
                                <td><?php echo date('d-M-Y', strtotime($data->order_date)); ?></td>
                                <td><?php echo $data->delivery_datetime; ?></td>
                                <td>
                                    <button type="button" class="btn btn-default">Delivered</button>
                                    <button type="button" onclick="View(<?php echo $data->id; ?>);" class="btn btn-info"><i class="glyphicon glyphicon-eye-open"></i><?php echo 'View '; ?></button>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
<?php } else { ?>
    <div class="alert alert-danger"><h4>No Record Found</h4></div>
    <?php
}
?>

<div id="myAdvanceModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Advance Detail</h4>
            </div>
            <div class="modal-body">
                <form id="adv">
                    <div class="row">
                    <input type="hidden" id="order_id" name="order_id">
                    <div class="col-lg-6">
                        <label>Advance Amount</label>
                        <input type="text" name="advance" class="col-lg-12">
                    </div>
                    <div class="col-lg-6">
                        <label>Remark</label>
                        <textarea name="remark" class="col-lg-12"></textarea>
                    </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="save" onclick="Saveadvance()"><i class="glyphicon glyphicon-save"></i> Save </button>
            </div>
        </div>
    </div>
</div>
    

                <div id="order_detail"></div>
<script type="text/javascript">
                    $(document).ready(function() {

                    });

                    function Saveadvance() {
//                        $('#orders').html("<center><img src='<?php echo Yii::app()->baseUrl ?>/images/loader.gif'/></center>");
                        var datastring = $('#adv').serialize();
                        alert(datastring);
                        $.ajax({
                            url: '<?php echo $this->createUrl('aos/saveadvance'); ?>',
                            data: datastring,
                            type: 'post',
                            success: function(response) {
                                $('#orders').html(response);
                                $("#processing_btn").show();
                                $("#adv_btn").hide();
                                $("#myAdvanceModal").modal('hide');
                            }
                        });
                    }

                    function takeAdvance(id) {
                        $('#order_id').val(id);
                        $("#myAdvanceModal").modal({backdrop: 'static', keyboard: false});
//                        $("#myAdvanceModal").modal('show');
                    }
                    function changeStatus(status, id) {
                        $('#orders').html("<center><img src='<?php echo Yii::app()->baseUrl ?>/images/loader.gif'/></center>");
                        $.ajax({
                            url: '<?php echo $this->createUrl('aos/changestatus'); ?>',
                            data: {'status': status, 'id': id},
                            type: 'post',
                            success: function(response) {
                                $('#orders').html(response);
                                window.location.reload();
                            }
                        });
                    }
                    
                    function View(id) {
                        $('#order_detail').html("<center><img src='<?php echo Yii::app()->baseUrl ?>/images/loader.gif'/></center>");
                        $.ajax({
                            url: '<?php echo $this->createUrl('aos/vieworder'); ?>',
                            data: {'id': id},
                            type: 'post',
                            success: function(response) {
                                $('#order_detail').html(response);
                            }
                        });
                    }
</script>