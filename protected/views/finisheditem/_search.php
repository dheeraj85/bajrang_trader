<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
        ));
?>
<div class='row'>
    <div class='col-md-4'>    
        <label>Item</label>     
        <select id="Itemstock_item_id" name="Itemstock[item_id]" class="form-control select2">
            <option value="">--Select--</option>
        </select>
    </div>
    <div class='col-md-4'>    
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
    <div class='col-md-4' style="margin-top:23px;">
        <button type="submit" id="button-filter" class="btn bg-red"><i class="fa fa-search"></i> Filter</button>
        <button type="button" onclick="printout()" class="btn btn-red"><i class='fa fa-print'></i> Print</button> 
        <button type="button" id="export_excel_button" class="btn btn-red"><i class='fa fa-download'></i> Export Excel</button>
    </div>
    </div>
</div> 
<?php $this->endWidget(); ?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/bs/js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {
      var item_id=0;  
      Getvendoritems(item_id);  
    <?php if (!empty($model->item_id)) { ?>
        var item_id =<?php echo $model->item_id?>;
        Getvendoritems(item_id);
    <?php }?>           
 
  });

    function Getvendoritems(item_id) {
        $("#Itemstock_item_id").html("");
        // $(".loading4").html("<img src='<?php //echo Yii::app()->baseUrl   ?>/img/loading.gif'>");
        $.getJSON("<?php echo $this->createUrl('purchaseinvoice/getitemlist'); ?>", function(data) {
            $(".loading4").html("");
            var content = "";
            content += '<option value="">--Select--</option>';
            $.each(data.items, function(i, ct) {
                if (item_id == ct.id) {
                    content += '<option value="' + ct.id + '" selected="selected">' + ct.itemname + '(' + ct.brand + ')</option>';
                } else {
                    content += '<option value="' + ct.id + '">' + ct.itemname + '(' + ct.brand + ')</option>';
                }
            });
            $("#Itemstock_item_id").html(content);
        });
    }    
</script>
<script>
    function printout() {
       var newWindow = window.open('', 'print', 'height=500,width=700');
        newWindow.document.write('<html><head><title>Print</title>');
        newWindow.document.write('<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/dist/css/bootstrap.min.css" type="text/css" />');
        newWindow.document.write('</head><body >');
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
            $("#itemstock-excel").table2excel({
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