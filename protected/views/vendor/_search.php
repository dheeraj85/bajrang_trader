<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
        ));
?>
<div class='row'>
    <div class='col-md-3'>   
        <?php echo $form->textFieldControlGroup($model, 'name', array('maxlength' => 50)); ?>
    </div>
    <div class='col-md-3'>    
        <?php echo $form->textFieldControlGroup($model, 'firm_name', array('maxlength' => 50)); ?>
    </div>
    <div class='col-md-3'>         
        <?php echo $form->textFieldControlGroup($model, 'mobile', array('maxlength' => 10)); ?>
    </div>
    <div class='col-md-3'>         
<?php echo $form->textFieldControlGroup($model, 'tin_no', array('maxlength' => 20)); ?>
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
<script>
    function printout() {
       var newWindow = window.open('', 'print', 'height=500,width=700');
        newWindow.document.write('<html><head><title>Print</title>');
        newWindow.document.write('<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/dist/css/bootstrap.min.css" type="text/css" />');
        newWindow.document.write('</head><body>');
        newWindow.document.write($("#itemstock-excel").html());
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
            $("#itemstock-excel").table2excel({
                exclude: "",
                name: "Vendors list Report",
                filename:'Vendors_list_Report_'+formatted,
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true
            });
        });
    });
</script>