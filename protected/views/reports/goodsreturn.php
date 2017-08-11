<?php
$this->breadcrumbs = array(
    'Home' => array('site/reportdashboard'),
    'Reports' => array('site/reportdashboard'),
    'Goods Return Report',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Users', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Users', 'url' => array('admin')),
);
?>
<div class='form-css'>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="panel-title">Goods Return Report</h3>
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
                        <div class="col-lg-3">
                            <label class="control-label" for="input-date-start">Date Start</label><br/>
                            <div class="">
                                <input type="text" name="filter_date_start" id="datestart" class="datepicker form-control" value="<?php echo $data['filter_date_start']; ?>" placeholder="Select Start Date">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label class="control-label" for="input-date-end">Date End</label><br/>
                            <div class="">
                                <input type="text" name="filter_date_end" id="dateend" class="datepicker form-control" value="<?php echo $data['filter_date_end']; ?>" placeholder="Select End Date">
                            </div>
                        </div>
                        <div class="col-lg-3" style="margin-top:24px;">
                            <button type="submit" id="button-filter" class="btn btn-primary"><i class="fa fa-search"></i> Filter</button>                                 
                            <button type="button" id="export_excel_button" class="btn btn-aqua"><i class='fa fa-download'></i> Export Excel</button>
                        </div>
                    </div>
                </div>
            <?php $this->endWidget(); ?>
            </div>
            <div class="table-responsive" id="good_return_items">
                <table class="table table-bordered">
                    <thead>
                        <tr>  
                            <th class="text-left">Invoice No</th>
                            <th class="text-left">Item</th>
                            <th class="text-left">Brand</th>                            
                            <th class="text-left">Stock Qty</th>
                            <th class="text-left">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($data['data']) { ?>
                            <?php foreach ($data['data'] as $order) { ?>
                                <tr>                                    
                                    <td class="text-left"><?php echo $order['invoice_no']; ?></td>
                                    <td class="text-left"><?php echo $order['item_name']; ?></td>
                                    <td class="text-left"><?php echo $order['brand']; ?></td>
                                    <td class="text-left"><?php echo $order['stock_qty']; ?></td>
                                    <td class="text-left"><?php echo $order['amount']; ?></td>
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
        </div>
    </div>
</div>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/bs/js/jquery.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/dist/js/bootstrap-datepicker.js"></script>
<script>
    $('.datepicker').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true
    }).on('changeDate', function (ev) {
        $(this).datepicker('hide');
    });
</script>
<script>
    $(function () {
        $("#export_excel_button").click(function () {
            var currentdate = new Date(); 
            var formatted=currentdate.getDate() + "-"
            + (currentdate.getMonth()+1)  + "-" 
            + currentdate.getFullYear() + "-"  
            + currentdate.getHours() + "-"  
            + currentdate.getMinutes() + "-" 
            + currentdate.getSeconds();
            $("#good_return_items").table2excel({
                exclude: "",
                name: "Goods Return Report",
                filename:'GoodsReturn_Report_'+formatted,
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true
            });
        });
    });
</script>