<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'offshelfsale-form',
    'enableAjaxValidation' => false,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<div class='row'>
    <div class='col-md-3 customer'>
        <?php echo $form->dropDownListControlGroup($model, 'customer_id', CHtml::listData(Customer::model()->findAllByAttributes(array('type' => 'party')), 'id', 'full_name'), array('empty' => '--Select Party/Customer--')); ?>
    </div>

    <div class="col-lg-2" >
        <label>Bill Date</label>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'Bill[bill_date]',
            'id' => 'Bill_bill_date',
            'value' => isset($model->bill_date) ? $model->bill_date : date('d-m-Y'),
            'options' => array(
                'dateFormat' => 'dd-mm-yy', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
            ),
            'htmlOptions' => array(
                'style' => '',
                //'readonly' => 'readonly'
                'placeholder' => 'Bill Date', 'class' => 'form-control', 'required' => 'required',
            ),
        ));
        ?>
        <?php echo $form->error($model, 'bill_date'); ?>
    </div>
    <div class="col-lg-2" >
        <label>Date From</label>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'bill_from_date',
            'name' => 'Bill[bill_from_date]',
            //       'value' => isset($model->regdate) ? $model->regdate : date('Y-m-d'),
            'options' => array(
                'onSelect' => 'js:function(selectedDate) {
                        $("#Bill_bill_from_date").datepicker("option", "maxDate", selectedDate);
                  }',
                'dateFormat' => 'dd-mm-yy',
                'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
            ),
            'htmlOptions' => array(
                'style' => '',
                'placeholder' => 'Bill From Date',
                'class' => 'form-control',
                'required' => 'required',
            ),
        ));
        ?>
        <?php echo $form->error($model, 'bill_from_date'); ?>
    </div>

    <div class="col-lg-2"> 
        <label>Date To</label>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'attribute' => 'bill_to_date',
            'name' => 'Bill[bill_to_date]',
              'value' => isset($model->bill_to_date) ? $model->bill_to_date : date('Y-m-d'),
            'options' => array(
                'onSelect' => 'js:function(selectedDate) {
                        $("#Bill_bill_from_date").datepicker("option", "maxDate", selectedDate);
                  }',
                'dateFormat' => 'dd-mm-yy',
                'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
            ),
            'htmlOptions' => array(
                'style' => '',
                //'readonly' => 'readonly'
                'placeholder' => 'Bill To Date', 'class' => 'form-control',
                'ng-model' => 'formInfo.to_date'
            ),
        ));
        ?>
        <?php echo $form->error($model, 'bill_to_date'); ?>

    </div>
    <div class="col-lg-3">
        <label>Item</label>
        <select class="form-control" id="order_items" name="Bill[item_id]">
        </select>
    </div>
</div>
<div class="row">

    <div class="col-lg-2">
        <label>Total Weight</label>
        <input type="text" name="Bill[weight]" id="weight" class="form-control"  value="<?= $model->weight;?>">            
        <?php echo $form->error($model, 'weight'); ?>       
    </div>
    <div class="col-lg-2">
        <label>Rate</label>
        <input type="text" name="Bill[rate]" class="form-control" value="<?= $model->rate;?>">            
        <?php echo $form->error($model, 'rate'); ?>          
    </div>
    <div class='col-md-2'>
        <?php echo $form->textAreaControlGroup($model, 'particulars', array('rows' => 1)); ?>
    </div>
    <div class='col-md-3' style="margin-top: 23px;">  
        <?php if (empty($model->id)) { ?>
            <?php echo BsHtml::submitButton('Create Bill', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>
        <?php } else { ?>
            <?php echo BsHtml::submitButton('Update Bill', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>
            <a  href="<?php echo $this->createUrl('offshelfsale/create'); ?>" class="btn btn-default">Back</a>
        <?php } ?>
    </div>
</div>
<?php $this->endWidget(); ?>
<script type="text/javascript">
    $(document).ready(function() {
<?php if (!empty($model->item_id)) { ?>
            var id =<?php echo $model->item_id; ?>;
            GetItems(id);
<?php } else { ?>
            var id = '';
            GetItems(id);
<?php } ?>
        $("#Offshelfsale_txn_type").change(function() {
            var val = $(this).val();
            //   alert('val' + val);
            if (val == 'customer') {
                $(".customer").show();
                $(".cash_customer").hide();
            } else {
                $(".customer").hide();
                $(".cash_customer").show();
            }
        });
        
        $("#order_items").change(function() {            
            var id=$(this).val();
            var from_date=$("#Bill_bill_from_date").val();
            var to_date=$("#Bill_bill_to_date").val();
            $.getJSON("<?php echo $this->createUrl('bill/getItemTotalWeight'); ?>",{'id':id,'from_date':from_date,'to_date':to_date},function(data) {
                $("#weight").val(data.tweight).focus();
                
            });
        });
    });

    function GetItems(id) {
        $("#order_items").html("");
        $.getJSON("<?php echo $this->createUrl('bill/getItemList'); ?>", function(data) {
            var content = "";
            content += '<option value="">--Select Item--</option>';
            $.each(data.list, function(i, ct) {
                if (ct.id == id) {
                    content += '<option value="' + ct.id + '" selected>' + ct.itemname + '(' + ct.gst_code + ')</option>';
                } else {
                    content += '<option value="' + ct.id + '">' + ct.itemname + '(' + ct.gst_code + ')</option>';
                }
            });
            $("#order_items").html(content);
        });
    }
</script>
