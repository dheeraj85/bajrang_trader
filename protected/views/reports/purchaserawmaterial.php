<?php
$this->breadcrumbs = array(
    'Home' => array('site/reportdashboard'),
    'Reports' => array('site/reportdashboard'),
    'Raw Material Purchased Item Report',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Users', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Users', 'url' => array('admin')),
);
?>
<div class='form-css'>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="panel-title">Raw Material Purchased Item Report</h3>
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
                        <div class="col-lg-4">
                            <label class="control-label" for="input-date-start">Date Start</label><br/>
                            <div class="">
                                <input type="text" name="filter_date_start" id="datestart" class="datepicker form-control" value="<?php echo $data['filter_date_start']; ?>" placeholder="Select Start Date">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label class="control-label" for="input-date-end">Date End</label><br/>
                            <div class="">
                                <input type="text" name="filter_date_end" id="dateend" class="datepicker form-control" value="<?php echo $data['filter_date_end']; ?>" placeholder="Select End Date">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label>Select</label>
                            <select name="choice_item" id="choice_item" class="form-control">
                                <option value="">--Select--</option>
                                <?php
                                foreach (Utils::typewise() as $k => $v) {
                                    if (Yii::app()->request->getPost('choice_item') == $k) {
                                        ?>
                                        <option value="<?php echo $k ?>" selected><?php echo $v ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $k ?>"><?php echo $v ?></option>
                                    <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div><br/>
                    <div class="row">                        
                        <div id="itemwise_select">    
                            <div class='col-lg-3'>
                                <label>Category</label>
                                <select id="p_category_id" name="p_category_id" class="form-control" >
                                    <option value="">--Select--</option>
                                    <?php
                                    foreach (Purchasecategory::model()->findAll() as $value) {
                                        if (Yii::app()->request->getPost('p_category_id') == $value->id) {
                                            ?>
                                            <option value="<?php echo $value->id; ?>" selected><?php echo $value->name; ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                                        <?php
                                        }
                                    }
                                    ?>       
                                </select>
                            </div>
                            <div class='col-lg-3'>
                                <label>Sub Category</label>
                                <select name="p_sub_category_id" id="p_sub_category_id" class="form-control">
                                    <option value="">--Select--</option>
                                </select>
                            </div>
                            <div class='col-lg-3'>
                                <label>Item</label>
                                <select name="item_id" id="item_id" class="form-control">
                                    <option value="">--Select--</option>
                                </select>
                            </div>
                        </div> 
                        <div class="pull-right" style="margin-top:24px;margin-right:15px;">
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
<?php if ($_POST['choice_item'] == "all") { ?>
                                <th class="text-left">Sub Category</th>
                                <th class="text-left">Item</th>
                                <th class="text-left">Brand</th>
                                <th class="text-left">Purchased Qty</th>                                
                                <th class="text-left">Avg. Rate</th>
                                <th class="text-left">Avl. Qty</th>
                                <!--<th class="text-left">Amount</th>-->
<?php } else { ?>
                                <th class="text-left">Invoice ID</th>
                                <th class="text-left">Invoice No</th>
                                <th class="text-left">Firm Name / Vendor Name</th>
                                <th class="text-left">Purchased Qty</th>                        
                                <th class="text-left">Invoice Date</th>                      
<?php } ?>

                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($data['data']) { ?>
                            <?php
                            $c = 1;
                            $tqty = 0.0;
                            $aqty = 0.0;
                            $trate = 0.0;
                            $tamt = 0.0;
                            foreach ($data['data'] as $order) {
                                $rep = new Reports();
                                ?>
                                <tr>
        <?php if ($_POST['choice_item'] == "all") { ?>
                                        <td class="text-left"><?php echo $order['scategory']; ?></td>
                                        <td class="text-left"><?php echo $order['item_name']; ?></td>
                                        <td class="text-left"><?php echo $order['brand']; ?></td>
                                        <td class="text-left"><?php echo $order['stock_qty']; ?> <?php echo $order['scale']; ?></td>
                                   
                                        <td class="text-left"><?php echo $order['rate']; ?></td>
                                             <td class="text-left"><?php
                                            $avl_qty = $rep->getAvailableQty($order['item_id'], $data['filter_date_start'], $data['filter_date_end']);
                                            echo $avl_qty[0]['avl_stock_qty'];
                                            ?> <?php echo $order['scale']; ?>
                                        </td>
                                        <!--<td class="text-left"><?php // echo $order['amount'];   ?></td>-->
                                        <?php } else { ?>
                                        <td class="text-left"><a href="#" onclick="reviewpost(<?php echo $order['invoice_id']; ?>);"><?php echo $order['invoice_id']; ?></a></td>
                                        <td class="text-left"><?php echo $order['invoice_no']; ?></td>
                                        <td class="text-left"><?php echo $order['vendorinfo']; ?></td>
                                        <td class="text-left"><?php echo $order['stock_qty']; ?> <?php echo $order['scale']; ?></td>

                                        <td class="text-left"><?php echo $order['invoice_date']; ?></td>

                                <?php } ?>
                                </tr>
                                <?php
                                $tqty = $tqty + $order['stock_qty'];
                                $aqty = $aqty + $avl_qty[0]['avl_stock_qty'];
                                $trate = $trate + $order['rate'];
                                $tamt = $tamt + $order['amount'];
                                $c++;
                            }
                            ?>
                            <tr>
    <?php if ($_POST['choice_item'] == "all") { ?>
                                <td colspan="3"style="text-align: right"><b>Total</b></td>
                                    <td><b><?php echo $tqty; ?></b></td>
                                    <td></td>
                                    <td><b><?php echo $aqty; ?></b></td>
                                    <!--<td><b><?php //echo floor($trate / $c); ?></b></td>-->
                                    <!--<td><b><?php // echo $tamt; ?></b></td>-->
    <?php } else { ?>
                                    <td colspan="3" style="text-align: right"><b>Total</b></td>
                                    <td><b><?php echo $tqty; ?></b></td>
                                    <td></td>
                            <?php } ?>
                            </tr>
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
<div class="modal fade" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Invoice Item Details</h4>
            </div>
            <div class="modal-body">
                <div id="invoicedetails"></div> 
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
                                }).on('changeDate', function(ev) {
                                    $(this).datepicker('hide');
                                });
</script>
<script type="text/javascript">
    $(document).ready(function() {

<?php if (!empty($_POST['p_category_id']) && !empty($_POST['p_sub_category_id'])) { ?>
            var scid =<?php echo $_POST['p_sub_category_id'] ?>;
            var cid = <?php echo $_POST['p_category_id'] ?>;
            GetSCategory(cid, scid, 'Purchase');
<?php } ?>

<?php if (!empty($_POST['p_category_id']) && !empty($_POST['p_sub_category_id']) && !empty($_POST['item_id'])) { ?>
            var scid =<?php echo $_POST['p_sub_category_id'] ?>;
            var cid = <?php echo $_POST['p_category_id'] ?>;
            var item_id = <?php echo $_POST['item_id'] ?>;
            GetItems(cid, scid, item_id, 'Purchase');
<?php } ?>

<?php if (!empty($_POST['choice_item'])) { ?>
            var choice_item = '<?php echo $_POST['choice_item'] ?>';
            if (choice_item == "all") {
                $("#itemwise_select").hide();
            } else {
                $("#itemwise_select").show();
            }
<?php } ?>

        $("#choice_item").change(function() {
            var choice_item = $(this).val();
            if (choice_item == "all") {
                $("#itemwise_select").hide();
            } else {
                $("#itemwise_select").show();
            }
        });

        $("#p_category_id").change(function() {
            var scid = 0;
            var cid = $(this).val();
            GetSCategory(cid, scid, 'Purchase');
        });

        $("#p_sub_category_id").change(function() {
            var itemid = 0;
            var cid = $("#p_category_id").val();
            var scid = $(this).val();
            GetItems(cid, scid, itemid, 'Purchase');
        });
    });
</script>
<script type="text/javascript">
    function GetSCategory(cid, scid, type) {
        $("#p_sub_category_id").html("");
        $.getJSON("<?php echo $this->createUrl('purchaseitem/getSCategoryList'); ?>", {"cid": cid, "type": type}, function(data) {
            $(".loading4").html("");
            var content = "";
            content += '<option value="">--Select--</option>';
            $.each(data.scat, function(i, ct) {
                if (scid == ct.id) {
                    content += '<option value="' + ct.id + '" selected="selected">' + ct.name + '</option>';
                } else {
                    content += '<option value="' + ct.id + '">' + ct.name + '</option>';
                }
            });
            $("#p_sub_category_id").html(content);
        });
    }

    function GetItems(cid, scid, item) {
        $("#item_id").html("");
        $.getJSON("<?php echo $this->createUrl('reports/getitems'); ?>", {"cid": cid, "scid": scid}, function(data) {
            $(".loading4").html("");
            var content = "";
            content += '<option value="">--Select--</option>';
            $.each(data.items, function(i, ct) {
                if (item == ct.id) {
                    content += '<option value="' + ct.id + '" selected="selected">' + ct.itemname + '</option>';
                } else {
                    content += '<option value="' + ct.id + '">' + ct.itemname + '</option>';
                }
            });
            $("#item_id").html(content);
        });
    }

    function reviewpost(id) {
        $.ajax({
            url: '<?php echo $this->createUrl('vendor/getinvoicedata') ?>',
            data: {'invoice_id': id},
            success: function(response) {
                $('#invoicedetails').html(response);
                $('#myModal6').modal('show');
            }
        });
    }

    $(function() {
        $("#export_excel_button").click(function() {
            var currentdate = new Date();
            var formatted = currentdate.getDate() + "-"
                    + (currentdate.getMonth() + 1) + "-"
                    + currentdate.getFullYear() + "-"
                    + currentdate.getHours() + "-"
                    + currentdate.getMinutes() + "-"
                    + currentdate.getSeconds();
            $("#purchased_itemwisesales").table2excel({
                exclude: "",
                name: "Purchase Rawmaterial Report",
                filename: 'Purchase_Rawmaterial_Report_' + formatted,
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true
            });
        });
    });
</script>