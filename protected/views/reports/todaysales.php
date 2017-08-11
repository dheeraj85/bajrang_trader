<div id="printorder" class="alert1 alert-success" style="display:none;"></div>
<div class="container-fluid">
    <div class="row">   
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-list"></i> Today Sales Report</h3>
                </div>
                <div class="panel-body">
                    <div class="search-form">
                        <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            //  'action' => Yii::app()->createUrl($this->route),
                            'method' => 'post',
                        ));
                        ?>
                        <div class="well">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label" for="input-date-start">Date</label>
                                        <div class="input-group date">
                                            <input type="text" name="filter_date" id="datestart" style="width:400px;" class="datepicker form-control" value="<?php echo $data['filter_date']; ?>" placeholder="Select Date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label" for="input-group">Category</label>
                                        <select name="filter_cat" id="input-group" class="form-control">
                                            <option value="0">Select Category</option>    
                                            <?php
                                           foreach (Utils::types() as $t => $v) {
                                                ?>
                                                <?php if ($data['filter_cat']==$t) { ?>
                                                    <option value="<?php echo $t; ?>" selected="selected"><?php echo $v; ?></option>
                                                <?php } else { ?>
                                                    <option value="<?php echo $t; ?>"><?php echo $v; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">                               
                                    <button type="button" onclick="printout()" class="btn btn-primary pull-right"><i class='fa fa-print'></i> Print All</button>  
                                    <button type="button" id="print_bill" class="btn btn-primary pull-right"><i class='fa fa-print'></i> Print Detail Bill</button>  
                                    <button type="submit" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Filter</button>                                
                                </div>
                            </div>
                        </div>
                        <?php $this->endWidget(); ?>
                    </div>
                    <div class="table-responsive" id="print_itemwisesales">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td class="text-left">Date</td>
                                    <td class="text-left">Bill No.</td>
                                    <td class="text-left">Category</td>
                                    <td class="text-left">Table No.</td>
                                    <td class="text-left">Customer Name</td>
                                    <td class="text-left">Mobile No.</td>
                                    <td class="text-right">Total</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($data['orders']) { ?>
                                    <?php foreach ($data['orders'] as $order) { ?>
                                        <tr>
                                            <td class="text-left"><?php echo $order['date']; ?></td>
                                            <td class="text-left"><?php echo $order['id']; ?></td>
                                            <td class="text-left"><?php if($order['cat']=="1"){
                                                echo "Self Service";
                                            }if($order['cat']=="2"){
                                            echo "On Table";}                                            
                                            if($order['cat']=="3"){
                                            echo "Take Away";}                                            
                                            if($order['cat']=="4"){
                                            echo "Home Delivery";}
                                            ?></td>
                                            <td class="text-left"><?php echo $order['tableno']; ?></td>
                                            <td class="text-left"><?php echo $order['cname']; ?></td>
                                            <td class="text-left"><?php echo $order['mno']; ?></td>
                                            <td class="text-right"><?php echo $order['total']; ?></td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td class="text-center" colspan="7"><?php echo $data['text_no_results']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-datepicker.js"></script>
<script>
    $('.datepicker').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true
    }).on('changeDate', function(ev) {
        $(this).datepicker('hide');
    });
</script>
<script>
    $(document).ready(function() {
    $('#print_bill').click(function() {
        $.ajax({
            url: '<?php echo $this->createUrl('orders/printdetailbill', array("date" => $data['filter_date'],'category'=>$data['filter_cat'])) ?>',
            success: function(response) {
                // alert(response);
                $("#printorder").html(response);
                Printdetail($('#printorder').html());
            }
        });
    });
});

function Printdetail(data) {
    var mywindow = window.open('', 'go_highway_print', 'height=500,width=700');
    mywindow.document.write('<html><head><title>Print</title>');
    mywindow.document.write('<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/theme/pos/styles/helpers/bootstrap.min.css" type="text/css" />');
    mywindow.document.write('</head><body >');
    //alert(data);
    mywindow.document.write(data);
    mywindow.document.write('</body></html>');
    mywindow.print();
    mywindow.close();
    //return true;
}

function printout() {
   var newWindow = window.open('', 'go_highway_print', 'height=500,width=700');
    newWindow.document.write('<html><head><title>Print</title>');
    newWindow.document.write('<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/theme/pos/styles/helpers/bootstrap.min.css" type="text/css" />');
    newWindow.document.write('</head><body >');
    newWindow.document.write($("#print_itemwisesales").html());
    newWindow.print();
}
</script>