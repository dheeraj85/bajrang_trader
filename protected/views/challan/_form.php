<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'challan-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>
<div class='row'>
    <div class='col-md-6'>
        <label>Customer</label>
        <?php echo $form->dropDownList($model, 'customer_id', CHtml::listData(Customer::model()->findAll(), 'id', 'full_name'), array('class' => 'form-control', 'empty' => '--Select--')); ?>
    </div>
    <div class='col-md-6'>
        <label>Challan Date</label><br/>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'Challan[challan_date]',
            'id' => 'Challan_challan_date',
            'value' => isset($model->challan_date) ? $model->challan_date : date('Y-m-d'),
            'options' => array(
                'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
            ),
            'htmlOptions' => array(
                'style' => '',
                //'readonly' => 'readonly'
                'placeholder' => 'Challan Date', 'class' => 'form-control',
            ),
        ));
        ?>
    </div>
</div><br/>
<div class='row'>
    <div class='col-md-6'>
        <label>Purchase In-ward</label> 
        <select id="Challan_purchase_invoice_id" name="Challan[purchase_invoice_id]" class="form-control select2">
            <option value="">--Select--</option>
            <?php
            foreach (Purchaseinvoice::model()->findAllBySql("select * from purchase_invoice where is_conflict_bill_accepted=0 order by id desc") as $iset) {
                if ($model->purchase_invoice_id == $iset->id) {
                    ?>
                    <option value="<?php echo $iset->id ?>" selected="selected"><?php echo $iset->id?></option>
                <?php } else { ?>
                    <option value="<?php echo $iset->id ?>"><?php echo $iset->id ?></option>
                    <?php
                }
            }
            ?>    
        </select>
    </div>
    <div class='col-md-6'>
        <?php echo $form->textFieldControlGroup($model, 'truck_wagon_no', array('maxlength' => 255, 'readonly' => true)); ?>
    </div>
</div>
<div class='row'>
    <div class='col-md-6'> 
        <label>Purchase Order</label>
        <select id="Challan_purchase_order_id" name="Challan[purchase_order_item]" class="form-control">
            <option value="">--Select--</option>               
        </select>
    </div>
    <div class='col-md-6'>
        <?php echo $form->textFieldControlGroup($model, 'ex_station', array('maxlength' => 150)); ?>  
    </div>
</div>
<?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY,'id'=>'btn-challan')); ?>
<?php $this->endWidget(); ?>
<script type="text/javascript">
    $(document).ready(function() {
        <?php
        if($model->purchase_invoice_id){
        ?>
        var pi=<?php echo $model->purchase_invoice_id?>;        
        var po='<?php echo $model->purchase_order_item?>';        
        getpolist(pi,po);
        <?php }?>
        
        $("#Challan_purchase_invoice_id").change(function() {
            var id = $(this).val();
            checkinvoice(id);
            $.ajax({
                url: '<?php echo $this->createUrl('challan/getitems') ?>',
                data: {'id': id},
                type: 'get',
                dataType: 'JSON',
                cache: false,
                success: function(response) {
                    $('#Challan_truck_wagon_no').val(response.model.truck_wagon_no);
                    getpolist(id);                    
                }
            });
        });
    });
    
    function getpolist(pi,po_order) {
        $("#Challan_purchase_order_id").html("<option value=''>--Select--</option>");
        $.getJSON("<?php echo $this->createUrl('challan/getpolist'); ?>",{'pi':pi}, function(data) {
            $(".loading4").html("");
            var content = "";
            var content = '<option value="">--Select--</option>';
            $.each(data.items, function(i, ct) {
                if (po_order == ct.po_item) {
                    content += '<option value="' + ct.po_item + '" selected="selected">' + ct.po_order + '</option>';
                } else {
                    content += '<option value="' + ct.po_item + '">' + ct.po_order + '</option>';
                }
            });
            $("#Challan_purchase_order_id").html(content);
        });
    }
    function checkinvoice(id){
    $.ajax({
            url: '<?php echo Yii::app()->createUrl('purchaseinvoice/check_invoice') ?>',
            data: 'id=' + id,
            success: function(response) {
               if(response=="1"){
                alert("Invoice already taken.Please select different");  
                $("#btn-challan").attr("disabled","disabled");
                }else{
                $("#btn-challan").removeAttr("disabled","");
               }
            }
        });
    }
</script>    