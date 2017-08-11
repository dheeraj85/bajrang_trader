<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
        ));
?>
<div class='row'>
    <div class='col-lg-2'>
        <?php echo $form->dropdownlistControlGroup($model, 'invoice_type', Utils::itype(), array('maxlength' => 100, 'id' => 'invoice_type', 'class' => 'form-control','' => '--type--')); ?>    
    </div>
    <div class='col-lg-2'>
        <?php echo $form->textFieldControlGroup($model, 'id', array('maxlength' => 50)); ?>
    </div>
    <div class='col-lg-2'>
        <label>Invoice Date<span class="required">*</span></label><br/>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'Purchaseinvoice[invoice_date]',
            'id' => 'invoice_date02',
            'value' => $model->invoice_date,
            'options' => array(
                'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
            ),
            'htmlOptions' => array(
                'style' => '',
                //'readonly' => 'readonly'
                'placeholder' => 'Invoice Date', 'class' => 'form-control',
            ),
        ));
        ?>
    </div>
    <div class='col-lg-3'>
        <?php echo $form->dropDownListControlGroup($model, 'vendor_id', CHtml::listData(Vendor::model()->findAll(), 'id', 'firm_name'), array('class' => 'form-control select2', 'empty' => '--Select--')); ?>
    </div>
    <div class='col-lg-3'>
        <?php echo $form->dropDownListControlGroup($model, 'received_by', CHtml::listData(Employee::model()->findAll(), 'id', 'empname'), array('class' => 'form-control', 'empty' => '--Select--')); ?>  
    </div>
    </div>
<div class="pull-right">
     <label></label><br/>    
    <button type="submit" id="button-filter" class="btn btn-green"><i class="fa fa-search"></i> Filter</button>
    <button type="button" onclick="printout()" class="btn btn-green"><i class='fa fa-print'></i> Print</button> 
    <button type="button" id="export_excel_button" class="btn btn-green"><i class='fa fa-download'></i> Export Excel</button>
</div>
<div style="clear:both"></div><br/>
<?php $this->endWidget(); ?>
<script>
    function printout() {
       var newWindow = window.open('', 'print', 'height=500,width=700');
        newWindow.document.write('<html><head><title>Print</title>');
        newWindow.document.write('<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/dist/css/bootstrap.min.css" type="text/css" />');
        newWindow.document.write('</head><body>');
        newWindow.document.write($("#itemstock-excel").html());
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
                name: "Purchase Invoice Report",
                filename: 'Purchase_Invoice_Report_' + formatted,
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true
            });
        });
    });
</script>