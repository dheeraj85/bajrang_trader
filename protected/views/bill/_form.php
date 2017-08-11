<?php
/* @var $this OffshelfsaleController */
/* @var $model Offshelfsale */
/* @var $form BSActiveForm */
?>

<?php
$state_list = Gststatecodes::model()->findAll();
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
            'value' => isset($model->bill_from_date) ? $model->bill_from_date : date('d-m-Y'),
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
           'value' => isset($model->bill_to_date) ? $model->bill_to_date : date('d-m-Y'),
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
        <label>Purchase Order</label>          
        <select class="form-control" name="Bill[purchase_order_id]" id="Bill_purchase_order_id" required="required" onchange="getOrderItems(this.value)">

        </select>
        <?php echo $form->error($model, 'purchase_order_id'); ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-3">
        <label>Item</label>
        <select class="form-control" id="order_items" name="Bill[item_id]">
        </select>
    </div>
    <div class="col-lg-2">
        <label>Total Weight</label>
        <input type="text" name="Bill[weight]" class="form-control" value="<?php echo $model->weight; ?>">            
        <?php echo $form->error($model, 'weight'); ?>       
    </div>
    <div class="col-lg-2">
        <label>Rate</label>
        <input type="text" name="Bill[rate]" class="form-control" value="<?php echo $model->rate; ?>">            
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
            <div id="show_msg"></div>
    </div>
</div>
<?php $this->endWidget(); ?>
<script type="text/javascript">
    $(document).ready(function() {
<?php if (!empty($model->purchase_order_id)) { ?>
            var id =<?php echo $model->purchase_order_id; ?>;
            var item_id =<?php echo $model->item_id; ?>;
            GetPurchaseOrders(id);
            getOrderItems(id,item_id);
<?php } else { ?>
            var id = '';
            GetPurchaseOrders(id);
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
    });
    function GetPurchaseOrders(id) {
        $("#Bill_purchase_order_id").html("");
        $.getJSON("<?php echo $this->createUrl('bill/getOrderList'); ?>", function(data) {
            var content = "";
            content += '<option value="">--Select Purchase Order--</option>';
            $.each(data.list, function(i, ct) {
                if (ct.id == id) {
                    content += '<option value="' + ct.id + '" selected>' + ct.order_no + '</option>';
                } else {
                    content += '<option value="' + ct.id + '">' + ct.order_no + '</option>';
                }
            });
            $("#Bill_purchase_order_id").html(content);
        });
    }
    function getOrderItems(id, item_id) {
        $("#order_items").html("");
            $('#show_msg').html('<div id="divLoading" style="margin: 0px; padding: 0px; position: fixed; right: 0px; top: 0px; width: 100%; height: 100%; background-color: rgb(102, 102, 102); z-index: 30001; opacity: 0.8;"><p style="position: absolute; color: White; top: 50%; left: 45%;">Please wait...<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loader.gif"></p></div>');
                                       
        $.getJSON("<?php echo $this->createUrl('bill/getOrderitems'); ?>", {'id': id}, function(data) {
            var content = "";
            content += '<option value="">--Select Item--</option>';
            $.each(data.list, function(i, ct) {
                if (item_id == ct.item_id) {
                    content += '<option value="' + ct.item_id + '" selected>' + ct.item_name + '(' + ct.item_code + ')</option>';
                } else {
                    content += '<option value="' + ct.item_id + '">' + ct.item_name + '(' + ct.item_code + ')</option>';
                }
            });
            $('#show_msg').html('');
            $("#order_items").html(content);
        });
    }
</script>
