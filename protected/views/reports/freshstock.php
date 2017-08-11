<?php
$this->breadcrumbs = array(
    'Home' => array('site/reportdashboard'),
    'Reports' => array('site/reportdashboard'),
    'Fresh Stock Report',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Users', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Users', 'url' => array('admin')),
);
?>
<div class='form-css'>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="panel-title">Fresh Stock Report</h3>
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
                            <label class="control-label" for="input-date-start">Date Start</label><br/>
                            <div class="">
                                <input type="text" name="filter_date_start" id="datestart" class="datepicker form-control" value="<?php echo $data['filter_date_start']; ?>" placeholder="Select Start Date">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="control-label" for="input-date-end">Date End</label><br/>
                            <div class="">
                                <input type="text" name="filter_date_end" id="dateend" class="datepicker form-control" value="<?php echo $data['filter_date_end']; ?>" placeholder="Select End Date">
                            </div>
                        </div>
                        <div class="col-sm-4" style="margin-top:24px;">
                            <button type="button" onclick="printout()" class="btn btn-primary"><i class='fa fa-print'></i> Print</button>  
                            <button type="submit" id="button-filter" class="btn btn-primary"><i class="fa fa-search"></i> Filter</button>                                 
                            <button type="button" id="export_excel_button" class="btn btn-aqua"><i class='fa fa-download'></i> Export Excel</button>
                        </div>
                    </div>
                </div>
                <?php $this->endWidget(); ?>
            </div>
            <div class="table-responsive" id="print_itemwisesales">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-left">Category</th>
                            <th class="text-left">Sub Category</th>
                            <th class="text-left">Item</th>
                            <th class="text-left">Brand</th>
                            <th class="text-left">Stock Available</th>
                            <th class="text-left">Discard Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($data['data']) { ?>
                            <?php foreach ($data['data'] as $order) { ?>
                                <tr>
                                    <td class="text-left"><?php echo $order['category']; ?></td>
                                    <td class="text-left"><?php echo $order['scategory']; ?></td>
                                    <td class="text-left"><?php echo $order['item_name']; ?></td>
                                    <td class="text-left"><?php echo $order['brand']; ?></td>
                                    <td class="text-left"><?php echo $order['stock_qty']; ?></td>
                                    <td class="text-left"><?php echo $order['discard_date']; ?></td>
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
    function printout() {
        var newWindow = window.open('', '', 'height=500,width=700');
        newWindow.document.write('<html><head><title>Print</title>');
        newWindow.document.write('<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/dist/css/bootstrap.min.css" type="text/css" />');
        newWindow.document.write('</head><body >');
        newWindow.document.write($("#print_itemwisesales").html());
        newWindow.print();
    }
    $(function () {
        $("#export_excel_button").click(function () {
            var currentdate = new Date(); 
            var formatted=currentdate.getDate() + "-"
            + (currentdate.getMonth()+1)  + "-" 
            + currentdate.getFullYear() + "-"  
            + currentdate.getHours() + "-"  
            + currentdate.getMinutes() + "-" 
            + currentdate.getSeconds();
            $("#print_itemwisesales").table2excel({
                exclude: "",
                name: "Fresh Stock Report",
                filename:'FreshStock_Report_'+formatted,
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true
            });
        });
    });
</script>