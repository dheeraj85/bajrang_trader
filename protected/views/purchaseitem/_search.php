<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
        ));
?>
<div class='row'>
    <div class='col-md-3'>
        <label>Item Type</label>
        <?php echo $form->dropdownlist($model, 'item_type', Utils::types(), array('maxlength' => 100, 'id' => 'item_type', 'class' => 'form-control')); ?>
    </div>  
    <div class='col-md-3'>
        <label>Category</label>
        <select name="Purchaseitem[p_category_id]" id="Purchaseitem_p_category_id" class="form-control">
            <option value="">--Select Category--</option>
        </select>
    </div>
    <div class='col-md-3'>
        <label>Sub Category</label>
        <select name="Purchaseitem[p_sub_category_id]" id="Purchaseitem_sub_category_id" class="form-control">
            <option value="">--Select Sub Category--</option>
        </select>
    </div>    
    <div class='col-md-3'>
        <?php echo $form->textFieldControlGroup($model, 'itemname', array('maxlength' => 100)); ?>
    </div>
</div><br/>
<div class='row'>
    <div class='pull-right' style="padding-right:15px;">
<!--        <a id="dlink"  style="display:none;"></a>-->
        <button type="submit" id="button-filter" class="btn btn-aqua"><i class="fa fa-search"></i> Filter</button>
        <button type="button" onclick="printout()" class="btn btn-aqua"><i class='fa fa-print'></i> Print</button>  
        <button type="button" id="export_excel_button" class="btn btn-aqua"><i class='fa fa-download'></i> Export Excel</button>
    </div>
</div>
<div style="clear:both"></div><br/>
<?php $this->endWidget(); ?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/bs/js/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
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
    $(function () {
        $("#export_excel_button").click(function () {
            var currentdate = new Date(); 
            var formatted=currentdate.getDate() + "-"
            + (currentdate.getMonth()+1)  + "-" 
            + currentdate.getFullYear() + "-"  
            + currentdate.getHours() + "-"  
            + currentdate.getMinutes() + "-" 
            + currentdate.getSeconds();
            $("#purchaseitem-excel").table2excel({
                exclude: "",
                name: "Purchase Item Report",
                filename:'PurchaseItem_Report_'+formatted,
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true
            });
        });
    });
</script>