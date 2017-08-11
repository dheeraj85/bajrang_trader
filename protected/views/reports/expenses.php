<div class="container-fluid">
    <div class="row">   
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-list"></i> Item Wise Expenses Report</h3>
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
                                        <label class="control-label" for="input-date-start">Date To</label>
                                        <div class="input-group date">
                                            <input type="text" name="filter_date_start" id="datestart" style="width:400px;" class="datepicker form-control" value="<?php echo $data['filter_date_start']; ?>" placeholder="Select Start Date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label" for="input-date-end">Date From</label>
                                        <div class="input-group date">
                                            <input type="text" name="filter_date_end" id="dateend" style="width:400px;" class="datepicker form-control" value="<?php echo $data['filter_date_end']; ?>" placeholder="Select End Date">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label" for="input-group">Item</label>
                                        <select name="filter_item" id="input-group" class="form-control">
                                            <option value="0">Select Item</option>    
                                            <?php
                                            $itemlist = Expensesubcategory::model()->findAll();
                                            foreach ($itemlist as $group) {
                                                ?>
                                                <?php if ($group->id == $data['filter_item']) { ?>
                                                    <option value="<?php echo $group->id; ?>" selected="selected"><?php echo $group->item_name; ?></option>
                                                <?php } else { ?>
                                                    <option value="<?php echo $group->id; ?>"><?php echo $group->item_name; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">                               
                                    <button type="button" onclick="printout()" class="btn btn-primary pull-right"><i class='fa fa-print'></i> Print</button>  
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
                                    <td class="text-left">Voucher No</td>
                                    <td class="text-left">Item Name</td>
                                    <td class="text-right">Qty</td>
                                    <td class="text-right">Price</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($data['orders']) { ?>
                                    <?php 
                                    $sum=0.0;
                                    foreach ($data['orders'] as $order) { ?>
                                        <tr>
                                            <td class="text-left"><?php echo $order['date']; ?></td>
                                            <td class="text-left"><?php echo Expensesmaster::model()->findByPk($order['eid'])->voucher_no; ?></td>
                                            <td class="text-left"><?php echo Expensesubcategory::model()->findByPk($order['sid'])->item_name; ?></td>
                                            <td class="text-right"><?php echo $order['qty']; ?></td>
                                            <td class="text-right"><?php echo $order['total']; ?></td>
                                        </tr>
                                    <?php 
                                    $sum=$sum+$order['total'];
                                    } ?>
                                        <tr>
                                            <td><b>Total</b></td>  
                                            <td class="text-right" colspan="4"><b><?php echo number_format((float)$sum, 2, '.', ''); ?></b></td>  
                                        </tr>
                                <?php } else { ?>
                                    <tr>
                                        <td class="text-center" colspan="6"><?php echo $data['text_no_results']; ?></td>
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
    function printout() {
       var newWindow = window.open('', 'go_highway_print', 'height=500,width=700');
        newWindow.document.write('<html><head><title>Print</title>');
        newWindow.document.write('<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/theme/pos/styles/helpers/bootstrap.min.css" type="text/css" />');
        newWindow.document.write('</head><body >');
        newWindow.document.write($("#print_itemwisesales").html());
        newWindow.print();
    }
</script>