<?php
$this->breadcrumbs = array(
    'Home' => array('site/reportdashboard'),
    'Reports' => array('site/reportdashboard'),
    'Item Wise Sale Report',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Users', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Users', 'url' => array('admin')),
);
?>
<div class='form-css'>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="panel-title">Item Wise Sale Report</h3>
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
                        <div class="col-lg-2">
                            <label class="control-label" for="input-date-start">Date Start</label><br/>
                            <div class="">
                                <input type="text" name="time_from" id="datestart" class="datepicker form-control" value="<?php echo $time_from; ?>" placeholder="Select Start Date">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <label class="control-label" for="input-date-end">Date End</label><br/>
                            <div class="">
                                <input type="text" name="time_to" id="dateend" class="datepicker form-control" value="<?php echo $time_to; ?>" placeholder="Select End Date">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <label>Select</label>
                            <select name="type" id="choice_item" class="form-control">
                                <?php
                                foreach (Utils::saletypeforItem() as $k => $v) {
                                    if ($type== $k) {
                                        ?>
                                        <option value="<?php echo $k ?>" selected><?php echo $v ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $k ?>"><?php echo $v ?></option>
    <?php } } ?>
                            </select>
                        </div>

                        <div class="col-lg-3" style="margin-top:24px;">
                            <button type="submit" id="button-filter" class="btn btn-primary"><i class="fa fa-search"></i> Filter</button>                                 
                            <button type="button" id="export_excel_button" class="btn btn-aqua"><i class='fa fa-download'></i> Export Excel</button>
                        </div>
                    </div>
                </div>
<?php $this->endWidget(); ?>
            </div>
            <div class="table-responsive" id="purchased_itemwisesales">
                <table class="table table-bordered">
                    <thead>
                        <tr>  
                            <th class="text-left">Item Name</th>
                            <th class="text-left">Qty</th>
                            <th class="text-left">Amount</th>
       
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($data)) { ?>
                            <?php 
                             $tamt=0.0;
                            foreach ($data as $order) { ?>
                                <tr>
                                    <td class="text-left"><?php echo $order['name']; ?></td>
                                    <td class="text-left"><?php echo $order['qty']; ?></td>
                                    <td class="text-left"><?php echo $order['amount']; ?></td>
                
                                </tr>
                          <?php 
                            $tamt=$tamt+ $order['amount'];
                            } ?>
                                <tr>
                                    <td colspan="2"></td>
                                    <td><b><?php echo $tamt;?></b></td>
                                </tr>
                        <?php } else { ?>
                            <tr>
                                <td class="text-center alert alert-danger" colspan="7"><?php echo "No Result Found(s)";?></td>
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

   $(function () {
        $("#export_excel_button").click(function () {
            var currentdate = new Date(); 
            var formatted=currentdate.getDate() + "-"
            + (currentdate.getMonth()+1)  + "-" 
            + currentdate.getFullYear() + "-"  
            + currentdate.getHours() + "-"  
            + currentdate.getMinutes() + "-" 
            + currentdate.getSeconds();
            $("#purchased_itemwisesales").table2excel({
                exclude: "",
                name: "Sales Item Report",
                filename:'Sales_Item_Report_'+formatted,
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true
            });
        });
    });
</script>

