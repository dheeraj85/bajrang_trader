<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> Sales Report</h3>
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
                            <label class="control-label" for="input-date-start">Date Start</label>
                            <div class="input-group date">
                                <input type="text" name="filter_date_start" id="datestart" style="width:400px;" class="datepicker form-control" value="<?php echo $data['filter_date_start']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label" for="input-date-end">Date End</label>
                            <div class="input-group date">
                                <input type="text" name="filter_date_end" id="dateend" style="width:400px;" class="datepicker form-control" value="<?php echo $data['filter_date_end']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label" for="input-group">Group By</label>
                            <select name="filter_group" id="input-group" class="form-control">
                                <?php foreach ($data['groups'] as $group) { ?>
                                    <?php if ($group['value'] == $data['filter_group']) { ?>
                                        <option value="<?php echo $group['value']; ?>" selected="selected"><?php echo $group['text']; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $group['value']; ?>"><?php echo $group['text']; ?></option>
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
        <div class="table-responsive" id="print_sales">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td class="text-left">Date Start</td>
                        <td class="text-left">Date End</td>
                        <td class="text-right">No. Orders</td>
                        <td class="text-right">Total</td>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($data['orders']) { ?>
                        <?php foreach ($data['orders'] as $order) { ?>
                            <tr>
                                <td class="text-left"><?php echo $order['date_start']; ?></td>
                                <td class="text-left"><?php echo $order['date_end']; ?></td>
                                <td class="text-right"><?php echo $order['orders']; ?></td>
                                <td class="text-right"><?php echo $order['total']; ?></td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td class="text-center" colspan="6"><?php echo $data['text_no_results']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-sm-6 text-left"><?php echo $data['pagination']; ?></div>
            <div class="col-sm-6 text-right"><?php echo $data['results']; ?></div>
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
        newWindow.document.write($("#print_sales").html());
        newWindow.print();
    }
</script>