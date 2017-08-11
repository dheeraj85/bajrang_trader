<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
        ));
?>
<div class='row'>
    <div class='col-md-3'>     
        <label>Category</label>
        <?php echo $form->dropDownList($model, 'p_category_id', CHtml::listData(Purchasecategory::model()->findAll(), 'id', 'name'), array('class' => 'form-control', 'empty' => '--Select--')); ?>
    </div>
    <div class='col-md-3'>    
        <label>Sub Category</label>
        <select name="Itemstock[p_sub_category_id]" id="Itemstock_sub_category_id" class="form-control">
            <option value="">--Select--</option>
        </select>       
    </div>
    <div class='col-md-3'>    
        <label>Discard Date<span class="required">*</span></label><br/>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'Itemstock[discard_date]',
            'id' => 'discard_date',
            'value' => $model->discard_date,
            'options' => array(
                'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
            ),
            'htmlOptions' => array(
                'style' => '',
                //'readonly' => 'readonly'
                'placeholder' => 'Discard Date', 'class' => 'form-control',
            ),
        ));
        ?>
    </div>
</div>    
<div class='pull-right'>
    <br/>
    <button type="submit" id="button-filter" class="btn btn-green"><i class="fa fa-search"></i> Filter</button>
    <button type="button" onclick="printout()" class="btn btn-green"><i class='fa fa-print'></i> Print</button> 
    <button type="button" id="export_excel_button" class="btn btn-green"><i class='fa fa-download'></i> Export Excel</button>
</div>
<div style="clear:both"></div><br/>
<?php $this->endWidget(); ?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/bs/js/jquery.js"></script>
<script type="text/javascript">
        $(document).ready(function() {
<?php if (!empty($model->p_category_id) && !empty($model->p_sub_category_id)) { ?>
                var scid =<?php echo $model->p_sub_category_id ?>;
                var cid = <?php echo $model->p_category_id ?>;
                GetSCategory(cid, scid, 'Purchase');
<?php } ?>
        $("#Itemstock_p_category_id").change(function() {
                var scid = 0;
                var cid = $(this).val();
                GetSCategory(cid, scid, 'Purchase');
            });
        });
        function GetSCategory(cid, scid, type) {
            $("#Itemstock_sub_category_id").html("");
            //$(".loading4").html("<img src='<?php echo Yii::app()->baseUrl ?>/img/loading.gif'>");
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
                $("#Itemstock_sub_category_id").html(content);
            });
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
            $("#itemstock-excel-grid").table2excel({
                exclude: "",
                name: "Inventory Stock Report",
                filename: 'Inventory_Stock_Report_' + formatted,
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true
            });
        });
    });
</script>