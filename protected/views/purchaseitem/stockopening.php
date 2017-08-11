<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Stock Settlement' => array('purchaseitem/stockadmin'),
    'Add Opening Stock',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Purchaseitem', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Purchaseitem', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#purchaseitem-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border bg-green">
                    <h3 class="panel-title">Add Opening Stock</h3>
                </div>
                <div class="panel-body table-responsive">
                    <h2>Available Qty : <?= $total_qty; ?>
                        <label class="pull-right">You are updating stock of 
                    <?php if($type=='csk') echo "CSK"; else  echo "Shelf"; ?>
                    </label></h2> 
                    
                    <?php
                    $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                        // 'action' => Yii::app()->createUrl($this->route),
                        'method' => 'post',
                    ));
                    ?>
                    <div class='row'>
                        <div class='col-md-4'>
                            <label>Item Type</label>
                            <?php echo $form->dropdownlist($model, 'item_type', Utils::types(), array('maxlength' => 100, 'id' => 'item_type', 'class' => 'form-control')); ?>
                        </div>  
                        <div class='col-md-4'>
                            <label>Category</label>
                            <select name="Purchaseitem[p_category_id]" id="Purchaseitem_p_category_id" class="form-control">
                                <option value="">--Select Category--</option>
                            </select>
                        </div>
                        <div class='col-md-4'>
                            <label>Sub Category</label>
                            <select name="Purchaseitem[p_sub_category_id]" id="Purchaseitem_sub_category_id" class="form-control">
                                <option value="">--Select Sub Category--</option>
                            </select>
                        </div>
                    </div><br/>
                    <div class='row'>
                        <div class='col-md-4'>
                            <?php echo $form->textFieldControlGroup($model, 'itemname', array('maxlength' => 100, 'readonly' => 'readonly')); ?>
                        </div>
                        <?php if($type=='csk') { ?>
                        <div class='col-md-4'>
                            <label>Rate</label>
                            <input type="text" name="price" id="price" class="form-control" placeholder="Enter Price" required>
                        </div>
                        <?php } ?>
                        <div class='col-md-4'>
                            <label>Opening Stock Qty</label>
                            <input type="text" name="stock_qty" id="stock_qty" class="form-control" placeholder="Enter Opening Stock Qty" required>
                        </div>

                    </div>
                    <div class="row">
                        <div class='col-md-4' style="padding-top:25px;">
                            <button type="button" class="btn btn-default" onclick="window.location.reload();">Reset</button>
                            <button type="submit" id="button-filter" class="btn btn-aqua" data-loading-text="Saving...">Save</button>
                        </div>
                    </div>
                    <div style="clear:both"></div><br/>
                    <?php $this->endWidget(); ?>
                    <script src="<?php echo Yii::app()->request->baseUrl; ?>/bs/js/jquery.js"></script>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $("#button-filter").on('click', function() {
                                $("#button-filter").button('loading');
                            });
<?php if (!empty($model->item_type) && !empty($model->p_category_id)) { ?>
                                var catid =<?php echo $model->p_category_id ?>;
                                var itype = '<?php echo $model->item_type ?>';
                                GetCategory(catid, itype);
<?php } ?>

<?php if (!empty($model->p_category_id)) { ?>
                                var cid =<?php echo $model->p_category_id ?>;
                                var scid =<?php echo $model->p_sub_category_id ?>;
                                var itype = '<?php echo $model->item_type ?>';
                                GetSCategory(cid, scid, itype);
<?php } ?>
                            $("#item_type").change(function() {
                                var itype = $(this).val();
                                var catid = 0;
                                Getitemtype(itype);
                                GetCategory(catid, itype);
                            });
                            $("#Purchaseitem_p_category_id").change(function() {
                                var scid = 0;
                                var cid = $(this).val();
                                var itype = $("#item_type").val();
                                GetSCategory(cid, scid, itype);
                            });

                        });//ready

                        function GetCategory(catid, itype) {
                            $("#Purchaseitem_p_category_id").html("");
                            $.getJSON("<?php echo $this->createUrl('purchaseinvoice/getCategoryListChoice'); ?>", {"type": itype}, function(data) {
                                $(".loading4").html("");
                                var content = "";
                                content += '<option value="">--Select--</option>';
                                $.each(data.scat, function(i, ct) {
                                    if (catid == ct.id) {
                                        content += '<option value="' + ct.id + '" selected="selected">' + ct.name + '</option>';
                                    } else {
                                        content += '<option value="' + ct.id + '">' + ct.name + '</option>';
                                    }
                                });
                                $("#Purchaseitem_p_category_id").html(content);
                            });
                        }

                        function GetSCategory(cid, scid, itype) {
                            $("#Purchaseitem_sub_category_id").html("");
                            $.getJSON("<?php echo $this->createUrl('purchaseitem/getSCategoryList'); ?>", {"cid": cid, "type": itype}, function(data) {
                                $(".loading4").html("");
                                var content = "";
                                content += '<option value="0">--Select Sub Category--</option>';
                                $.each(data.scat, function(i, ct) {
                                    if (scid == ct.id) {
                                        content += '<option value="' + ct.id + '" selected="selected">' + ct.name + '</option>';
                                    } else {
                                        content += '<option value="' + ct.id + '">' + ct.name + '</option>';
                                    }
                                });
                                $("#Purchaseitem_sub_category_id").html(content);
                            });
                        }
                        function Getitemtype(itype) {
                            if (itype == "Processed") {
                                $("#typeofproduct").show();
                            } else {
                                $("#typeofproduct").hide();
                            }
                        }
                    </script>
                    <script>
                        function printout() {
                            var newWindow = window.open('', 'print', 'height=500,width=700');
                            newWindow.document.write('<html><head><title>Print</title>');
                            newWindow.document.write('<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/dist/css/bootstrap.min.css" type="text/css" />');
                            newWindow.document.write('</head><body>');
                            newWindow.document.write($("#printslist").html());
                            newWindow.print();
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
                                $("#purchaseitem-excel").table2excel({
                                    exclude: "",
                                    name: "Purchase Item Report",
                                    filename: 'PurchaseItem_Report_' + formatted,
                                    fileext: ".xls",
                                    exclude_img: true,
                                    exclude_links: true,
                                    exclude_inputs: true
                                });
                            });
                        });
                    </script>
                </div>
            </div>
        </div>  
    </div>
</div>