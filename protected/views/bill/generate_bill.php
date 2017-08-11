<?php
$this->breadcrumbs = array(
    'Bills' => array('index'),
    'Create',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Bill', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Bill', 'url' => array('admin')),
);
?>

<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                    <h3 class="panel-title">Generate Bill 
                        <span class="pull-right">
                            Order No : <?php echo $model->purchaseOrder->order_no; ?>
                            &emsp;&emsp;
                            Date From : <?php echo Utils::yyyymmdd_to_ddmmyyyy($model->bill_from_date); ?>
                            &emsp;
                            To : <?php echo Utils::yyyymmdd_to_ddmmyyyy($model->bill_to_date); ?>
                        </span>
                    </h3>
                </div>
                <div class="panel-body">

                    <!-- This is show item of kanta parchi -->
                    <div class="row">
                    <div id="challan_list" class="col-lg-6">
                        <?php if (!empty($rows)) { ?>
                            <legend>List of Kanta Parchi Available in Between Dates</legend>
                            <form id="addBillForm">
                                  <!--action="<?php //Yii::app()->createUrl('bill/savebillitems');                  ?>" method='post'>-->        
                                <div id="show_msg">    </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Challan No</th>
                                            <th>GRN No</th>
                                            <th>GST Code </th>                                                
                                            <th>Net Weight</th>                                              
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $total_weight = 0.00;
                                        foreach ($rows as $row) {
                                            $check = Billitems::model()->findByAttributes(array('kata_parchi_id' => $row->id));
                                            ?>
                                            <tr>
                                                <td><?php echo $row->challan_id ?></td>
                                                <td><?php echo $row->grn_no ?></td>                          
                                                <td><?php echo $row->gst_code ?></td>                                                   
                                                <td><?php
                                                    $total_weight = $total_weight + $row->net_weight;
                                                    echo $row->net_weight;
                                                    ?>
                                                </td>

                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <th colspan="3" style="text-align: right">Total Weight</th>
                                            <th> <?php echo $total_weight; ?></th>
                                        </tr>
                                    </tbody>
                                </table>


                                <div class="col-lg-12 pull-right" style="margin-top:21px;">

                                    <input type="hidden" name="bill_id" value="<?= $model->id ?>">
                                    <button type="button" class="btn btn-primary" onclick="generateBill()">Generate Bill</button>
                                    <a href="<?php echo $this->createUrl('bill/create'); ?>" class="btn btn-info">Back</a>
                                </div>
                            </form>
                        <?php } else { ?>
                            <div class="alert alert-info"><h3>No Kanta Parchi Found for this item.</h3></div>
                        <?php } ?>
                    </div>
                    <!-- This is show item of kanta parchi -->
                    <div class="col-lg-6">
                        <legend>Bill Added on the basis of Between Dates</legend>

                        <table class="table table-bordered">
                            <tr>
                                <th>Weight</th>
                                <th>Rate</th>
                                <th>Tax</th>
                                <th>Amount</th>
                            </tr>
                            <?php
                            $bill_weight = 0.00;
                            foreach ($model->billItems as $i) {
                                $bill_weight = $bill_weight + $i->weight;
                                ?>
                                <tr>
                                    <td><?= $i->weight; ?></td>
                                    <td><?= $i->rate; ?></td>
                                    <td><?= $i->tax; ?></td>
                                    <td><?= $i->amount; ?></td>
                                </tr>
                            <?php } ?>
                            <tr>

                            </tr>
                            <tr>
                                <th colspan="3" style="text-align: right">Total Weight</th>
                                <th> <?php echo $bill_weight; ?></th>
                            </tr>
                        </table>
                    </div>
                    </div>
                    <?php if(!empty($total_weight) && !empty($bill_weight)) { 
                        if($bill_weight <> $total_weight) {
                        ?>
                    <div class="alert alert-danger">Please check there is difference between Kata Parchi list and Total Bill</div>
                    <?php } } ?>
                </div>
            </div>     
        </div>  
    </div> 

</div>  
<script src="<?php echo Yii::app()->request->baseUrl; ?>/bs/js/jquery.js"></script>
<script>
                                    function generateBill() {
                                        var c = confirm('Are you sure want to generate bill and added all items ?');
                                        if (c) {
                                            $('#show_msg').html('<div id="divLoading" style="margin: 0px; padding: 0px; position: fixed; right: 0px; top: 0px; width: 100%; height: 100%; background-color: rgb(102, 102, 102); z-index: 30001; opacity: 0.8;"><p style="position: absolute; color: White; top: 50%; left: 45%;">Please wait...<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loader.gif"></p></div>');
                                            var url = "<?php echo $this->createUrl('bill/savebillitems'); ?>";
                                            $.post(url, $("#addBillForm").serialize(), function(data) {
                                                var data = jQuery.parseJSON(data);
                                                // alert(data.msg);
                                                if (data.msg == 'success') {
                                                    window.location.href = "<?php echo $this->createUrl('bill/showbill') ?>/<?= $model->id ?>";
                                                                    } else {
                                                                        $("#show_msg").html("Please check all the Kanta Parchi or Enter correct rate to generate bill ").addClass("alert alert-danger");
                                                                    }
                                                                });


                                                            }
                                                        }
</script>

