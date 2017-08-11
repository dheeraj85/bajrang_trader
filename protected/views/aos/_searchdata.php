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
                                <td><?php echo 'TOC-' . $data->id; ?></td>
                                <td><?php echo $cust->full_name; ?></td>
                                <td><?php echo $cust->mobile_no; ?></td>
                                <td style="color: #a49d1b;"><?php echo 'Pending...'; ?></td>
                                <td><?php echo date('d-M-Y', strtotime($data->order_date)); ?></td>
                                <td><?php echo $data->delivery_datetime; ?></td>
                                <td><button type="button" onclick="View(<?php echo $data->id; ?>);" class="btn btn-info"><i class="glyphicon glyphicon-eye-open"></i><?php echo 'View '; ?></button></td>
                            </tr>
                            <?php
                        } else if ($data->cake_status == 'p_accepted') {
                            ?>
                            <tr>
                                <td><?php echo 'TOC-' . $data->id; ?></td>
                                <td><?php echo $cust->full_name; ?></td>
                                <td><?php echo $cust->mobile_no; ?></td>
                                <td style="color: #18186a;"><?php echo 'Accepted'; ?></td>
                                <td><?php echo date('d-M-Y', strtotime($data->order_date)); ?></td>
                                <td><?php echo $data->delivery_datetime; ?></td>
                                <td><button type="button" onclick="View(<?php echo $data->id; ?>);" class="btn btn-info"><i class="glyphicon glyphicon-eye-open"></i><?php echo 'View '; ?></button></td>
                            </tr>
                            <?php
                        } else if ($data->cake_status == 'k_accepted') {
                            ?>
                            <tr>
                                <td><?php echo 'TOC-' . $data->id; ?></td>
                                <td><?php echo $cust->full_name; ?></td>
                                <td><?php echo $cust->mobile_no; ?></td>
                                <td style="color: #00cc66;"><?php echo 'Advance'; ?></td>
                                <td><?php echo date('d-M-Y', strtotime($data->order_date)); ?></td>
                                <td><?php echo $data->delivery_datetime; ?></td>
                                <td><button type="button" onclick="View(<?php echo $data->id; ?>);" class="btn btn-info"><i class="glyphicon glyphicon-eye-open"></i><?php echo 'View '; ?></button></td>
                            </tr>
                            <?php
                        } else if ($data->cake_status == 'processing') {
                            ?>
                            <tr>
                                <td><?php echo 'TOC-' . $data->id; ?></td>
                                <td><?php echo $cust->full_name; ?></td>
                                <td><?php echo $cust->mobile_no; ?></td>
                                <td style="color: #00cccc;"><?php echo 'Proccesed'; ?></td>
                                <td><?php echo date('d-M-Y', strtotime($data->order_date)); ?></td>
                                <td><?php echo $data->delivery_datetime; ?></td>
                                <td><button type="button" onclick="View(<?php echo $data->id; ?>);" class="btn btn-info"><i class="glyphicon glyphicon-eye-open"></i><?php echo 'View '; ?></button></td>
                            </tr>
                            <?php
                        } else if ($data->cake_status == 'finished') {
                            ?>
                            <tr>
                                <td><?php echo 'TOC-' . $data->id; ?></td>
                                <td><?php echo $cust->full_name; ?></td>
                                <td><?php echo $cust->mobile_no; ?></td>
                                <td style="color: #009900;"><?php echo 'Finished'; ?></td>
                                <td><?php echo date('d-M-Y', strtotime($data->order_date)); ?></td>
                                <td><?php echo $data->delivery_datetime; ?></td>
                                <td><button type="button" onclick="View(<?php echo $data->id; ?>);" class="btn btn-info"><i class="glyphicon glyphicon-eye-open"></i><?php echo 'View '; ?></button></td>
                            </tr>
                            <?php
                        } else if ($data->cake_status == 'delivered') {
                            ?>
                            <tr>
                                <td><?php echo 'TOC-' . $data->id; ?></td>
                                <td><?php echo $cust->full_name; ?></td>
                                <td><?php echo $cust->mobile_no; ?></td>
                                <td style="color: #0000cc;">Delivered</td>
                                <td><?php echo date('d-M-Y', strtotime($data->order_date)); ?></td>
                                <td><?php echo $data->delivery_datetime; ?></td>
                                <td><button type="button" onclick="View(<?php echo $data->id; ?>);" class="btn btn-info"><i class="glyphicon glyphicon-eye-open"></i><?php echo 'View '; ?></button></td>
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
    <div id="order_detail"></div>
<script type="text/javascript">
                                    $(document).ready(function() {

                                    });

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