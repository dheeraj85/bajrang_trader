<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'menusale-form',
//            'action' => $this->createUrl('productionkot/create'),
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));

$cash_drawer = Cashdrawer::model()->findByAttributes(array('date' => date('Y-m-d'), 'user_to' => Yii::app()->user->id), array('order' => 'id desc', 'limit' => 1));
$inv = Menusale::model()->findByAttributes(array(),array('order' => 'id desc', 'limit' => 1));
if (!empty($inv)) {
    $inv_no = $inv->invoice_number + 1;
} else {
    $inv_no = '1001';
}
?>
<div class="modal-body">
    <div class='row'>
        <div class='col-md-12'>
            <div style="background-color: #cce9f8;">
                <div class='row'>
                    <div class='col-md-12'>
                        <?php echo $form->hiddenField($model, 'invoice_number', array('value' => sprintf("%04d", $inv_no))); ?>
                        <?php echo $form->hiddenField($model, 'table_id', array('value' => $tid)); ?>
                        <?php echo $form->hiddenField($model, 'counter_id', array('value' => $cash_drawer->counter_id)); ?>
                        <div class='col-md-3'>
                            <?php echo $form->textFieldControlGroup($model, 'customer_name',array('placeholder'=>'Enter Customer Name')); ?>
                        </div>
                        <div class='col-md-3'>
                            <?php echo $form->textFieldControlGroup($model, 'customer_mobile',array('placeholder'=>'Enter Customer Contact No')); ?>
                        </div>
                        <div class='col-md-3'>
                            <?php echo $form->textAreaControlGroup($model, 'comments', array('rows' => 2,'placeholder'=>'Enter Comments Here...')); ?>
                        </div>
                        <div class='col-md-3'>
                            <?php echo $form->labelEx($model, 'order_date'); ?>
                            <?php
                            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'name' => 'Menusale[order_date]',
                                'id' => 'Menusale_order_date',
                                'value' => isset($model->order_date) ? $model->order_date : date('Y-m-d'),
                                'options' => array(
                                    'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
                                ),
                                'htmlOptions' => array(
                                    'style' => '',
                                    //'readonly' => 'readonly'
                                    'placeholder' => 'Order Date', 'class' => 'form-control',
                                ),
                            ));
                            ?>
                            <?php echo $form->error($model, 'deliver_by'); ?>
                            <?php // echo $form->textFieldControlGroup($model,'deliver_by');  ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class='col-md-12' >
                <table class="table">
                    <tr>
                        <th>KOT No</th>
                        <th>Item</th>
                        <th>Qty</th>
                        <th>Rate</th>
                        <th>Amount</th>
                    </tr>
                    <?php
                    $kot_item_amt = 0.00;
                    $kot_item_qty = 0.00;
                    foreach (Menukot::model()->findAllByAttributes(array('table_id' => $tid, 'counter_id' => $cash_drawer->counter_id, 'is_added_to_bill' => 0)) as $mk) {
                        foreach (Menukotitems::model()->findAllByAttributes(array('menu_kot_id' => $mk->id)) as $kot_items) {
                            $rate = Menuitems::model()->findByAttributes(array('item_id' => $kot_items->menu_item_id));
                            $item_name = Purchaseitem::model()->findByPk($kot_items->menu_item_id);
                            $kot_item_amt = $kot_item_amt + $kot_items->price;
                            $kot_item_qty = $kot_item_qty + $kot_items->qty;
                            ?>
                            <tr>
                                <td><?php echo $mk->kot_no; ?></td>
                                <td><?php echo $item_name->itemname; ?></td>
                                <td><?php echo $kot_items->qty; ?></td>
                                <td><?php echo $rate->sale_price; ?></td>
                                <td><?php echo $kot_items->price; ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                    <tr>
                        <td colspan="2"><b>Sub Total</b></td>
                        <td><b><?php echo $kot_item_qty; ?></b></td>
                        <td></td>
                        <td><b><?php echo $kot_item_amt; ?></b><input type="hidden" id="sub_total" name="Menusale[sub_total]" value="<?php echo $kot_item_amt; ?>"></td>
                    </tr>
                    <?php
                    $amt_after_tax = 0.00;
                    $tax_amt = 0.00;
                    $total_tax_amt = 0.00;
                    foreach (Categorytaxes::model()->findAllByAttributes(array('pos_type' => 'menu')) as $ct) {
                        if (empty($ct->p_category_id) && empty($ct->p_sub_category_id)) {
                            $tax = Postaxes::model()->findByPk($ct->tax_id);
                            $tax_amt = $kot_item_amt * ($tax->tax_percent / 100);
                            $total_tax_amt = $total_tax_amt + $tax_amt;
                            ?>
                            <tr>
                                <td colspan="4"><?php echo $tax->tax_name . ' ' . $tax->tax_percent . '%'; ?><input type="hidden" id="Menusale_tax_name" name="tax_name[]" value="<?php echo $tax->tax_name; ?>"></td>
                                <td><?php echo $tax_amt; ?><input type="hidden" id="Menusale_tax_percent" name="tax_percent[]" value="<?php echo $tax->tax_percent; ?>"></td>
                            </tr>
                            <?php
                        }
                    }
                    $amt_after_tax = $kot_item_amt + $total_tax_amt;
                    ?><input type="hidden" id="amt_after_tax" name="amt_after_tax" value="<?php echo $amt_after_tax; ?>">
                    <tr>
                        <td colspan="4">Discount (%)</td>
                        <td><input type="number" class="" id="discount_percent" name="Menusale[discount_percent]" ></td>
                    </tr>
                    <tr>
                        <td colspan="4"><b>Total</b></td>
                        <td><b id="total_amount"><?php echo $amt_after_tax; ?></b><input type="hidden" id="Menusale_total_amount" name="Menusale[total_amount]" value="<?php echo $kot_item_amt; ?>"></td>
                    </tr>
                </table>
            </div>
            <div class='col-md-12'>
                <?php // echo BsHtml::submitButton('Generate Bill', array('color' => BsHtml::BUTTON_COLOR_PRIMARY));      ?>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" id="close" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" data-loading-text="Loading Please wait..." id="generate_bill" onclick="GenerateBill();"><i class="fa fa-money fa-fw"></i>Generate Bill</button>
</div>
<?php $this->endWidget(); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#menusale-form").submit(function () {
            $(".btn").attr('disabled', 'disabled');
        });
        $('#close').click(function () {
            window.location.href='<?php echo $this->createUrl('pos/menu_items'); ?>'
        });
        $(".delete").click(function () {
            return confirm("Are you sure you want to delete this data?");
        });
        $("#discount_percent").change(function () {
            Calculate();
        });
        $("#discount_percent").keyup(function () {
            Calculate();
        });
    });

    function Calculate() {
        var sub_total = $("#amt_after_tax").val();
        var disc = $("#discount_percent").val();
        var total = parseFloat(sub_total) - (parseFloat(sub_total) * (disc / 100));
        if (isNaN(total)) {
        } else {
            $("#Menusale_total_amount").val(total.toFixed(2));
            $("#total_amount").html(total.toFixed(2));
        }
    }

    function GenerateBill() {
        var $btn = $("#generate_bill").button('loading');
        var datastring = $("#menusale-form").serialize();
        $.ajax({
            url: '<?php echo $this->createUrl('pos/savebilldetail'); ?>',
            data: datastring,
            type: 'post',
            success: function (response) {
                $("#bill").html(response);
                $btn.button('reset');
//                $("#myModal").modal({backdrop: 'static', keyboard: false});
            }
        });
    }
</script>
