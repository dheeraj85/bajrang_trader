<?php
$this->breadcrumbs = array(
    'Home' => array('site/reportdashboard'),
    'Reports' => array('site/reportdashboard'),
    'Sales Item Report',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Users', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Users', 'url' => array('admin')),
);
?>
<div class='form-css'>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="panel-title">Stock Settlement Details</h3>
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
                                <input type="text" name="filter_date_start" id="datestart" class="datepicker form-control" value="<?php echo $data['filter_date_start']; ?>" placeholder="Select Start Date">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <label class="control-label" for="input-date-end">Date End</label><br/>
                            <div class="">
                                <input type="text" name="filter_date_end" id="dateend" class="datepicker form-control" value="<?php echo $data['filter_date_end']; ?>" placeholder="Select End Date">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <label>Select</label>
                            <select name="choice_item" id="choice_item" class="form-control">
                                <?php
                                foreach (Utils::saletype() as $k => $v) {
                                    if (Yii::app()->request->getPost('choice_item') == $k) {
                                        ?>
                                        <option value="<?php echo $k ?>" selected><?php echo $v ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $k ?>"><?php echo $v ?></option>
    <?php }
} ?>
                            </select>
                        </div>
                        <div class='col-lg-3'>
                            <label>Item</label>     
                            <select id="item_id" name="item_id" class="form-control select2">
                                <option value="">--Select--</option>
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
                            <th class="text-left">Item</th>
                            <th class="text-left">Stock Qty</th>
                            <th class="text-left">Added Date</th>                          
                            <th class="text-left">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if ($data['order']) { ?>
                            <?php 
                             $tamt=0.0;
                            foreach ($data['order'] as $order) {  
                            $tamt=$tamt+ $order['stock_qty'];
                             ?>
                                <tr>
                                    
                                    <td><b><?php echo Purchaseitem::model()->findByPk($order['item_id'])->itemname;?></b></td>
                                    <td><b><?php echo $order['stock_qty'];?></b></td>
                                    <td><b><?php echo $order['created_date'];?></b></td>
                                    <td><b><?php echo $order['price'];?></b></td>
                                </tr>
           
                    <?php } } ?>
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
<script type="text/javascript">
    $(document).ready(function () {
<?php if (!empty($_POST['item_id'])) { ?>
            var item_id = <?php echo $_POST['item_id'] ?>;
            var type = '<?php echo $_POST['choice_item'] ?>';
            Getvendoritems(item_id, type);
<?php } ?>
        $("#choice_item").change(function () {
            var item_id = 0;
            var type = $(this).val();
            Getvendoritems(item_id, type);
        });
    });
</script>
<script>
    function Getvendoritems(item_id, type) {
        $("#item_id").html("");
        $.getJSON("<?php echo $this->createUrl('reports/getitemlist'); ?>", {"type": type}, function (data) {
            $(".loading4").html("");
            var content = "";
            content += '<option value="">--Select--</option>';
            $.each(data.items, function (i, ct) {
                if (item_id == ct.id) {
                    content += '<option value="' + ct.id + '" selected="selected">' + ct.itemname + '(' + ct.brand + ')</option>';
                } else {
                    content += '<option value="' + ct.id + '">' + ct.itemname + '(' + ct.brand + ')</option>';
                }
            });
            $("#item_id").html(content);
        });
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