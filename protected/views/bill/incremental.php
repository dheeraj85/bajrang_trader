<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Create New Bill',
);
?>

<style>
    .view{
        display: none;
    }
</style>
<?php if (empty($model->invoice_number)) { ?>
    <style>
        /*        .update{
                    display: none;
                }*/
    </style>
<?php } ?> 
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                    <h3 class="panel-title">Create Incremental Bill</h3>
                </div>
                <div class="panel-body">
                    <?php $this->renderPartial('_formIncremental', array('model' => $model)); ?>
                </div>
            </div>         
        </div>  
    </div>  
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-info">
                    <h3 class="panel-title">Manage Customer/Party Incremental Bill</h3>
                </div>
                <div class="panel-body">
                    <?php //$this->renderPartial('_search', array('model' => $model)); ?>
                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'customer-grid',
                        'dataProvider' => $model->searchIncrementalBill(),
//                        'filter' => $model,
                        'columns' => array(
//        		'id',
                            'bill_no',
                            'bill_date',
                            //   'purchaseOrder.order_no',
                            'item.itemname',
                            //'tax_type',
                            //   'customer_name',
                            //   'customer_mobile',
                            'customer.full_name',
                 
                            array('htmlOptions' => array('width' => '80'), 'header' => 'Weight', 'type' => 'raw', 'value' => 'Bill::getWeight($data)'),
                            array('htmlOptions' => array('width' => '80'), 'header' => 'Rate', 'type' => 'raw', 'value' => 'Bill::getRate($data)'),
                            array('htmlOptions' => array('width' => '80'), 'header' => 'Total Amt &#8377;', 'type' => 'raw', 'value' => 'Bill::getTotalBillAmt($data)'),
                            'bill_from_date',
                            'bill_to_date',
                            /*
                              'created_by',
                              'order_time',
                              'comment',
                             */
                            array('header' => 'Action', 'value' => '$data->Action($data)'),
                            array(
                                'class' => 'bootstrap.widgets.BsButtonColumn',
                                'buttons' => array(
                                    'delete' => array(
                                        'visible' => '$data->bill_no==""',
                                    ),
                                    'update' => array
                                        (
                                        'label' => 'Edit',
                                        //'imageUrl' => Yii::app()->request->baseUrl . '/images/email.png',
                                        'url' => 'Yii::app()->createUrl("bill/editincremental", array("id"=>$data->id))',
                                    ),
                                ),
                            ),
                        ),
                    ));
                    ?>
                </div>
            </div>     
        </div>  
    </div>  
</div>  
<script type="text/javascript">
    $(".delete").click(function() {
        return confirm("Are you sure you want to delete customer ?");
    });

//    function GetPurchaseOrders() {
//        $("#purchase_order").html("");
//        $.getJSON("<?php echo $this->createUrl('bill/getOrderList'); ?>", function(data) {
//            var content = "";
//            content += '<option value="">--Select Order--</option>';
//            $.each(data.list, function(i, ct) {
//                content += '<option value="' + ct.id + '">' + ct.order_no + '</option>';
//            });
//            $("#purchase_order").html(content);
//        });
//    }
    function getOrderItems(id) {
        $("#order_items").html("");
        $.getJSON("<?php echo $this->createUrl('bill/getOrderitems'); ?>", {'id': id}, function(data) {
            var content = "";
            content += '<option value="">--Select Item--</option>';
            $.each(data.list, function(i, ct) {
                content += '<option value="' + ct.item_id + '">' + ct.item_name + '(' + ct.item_code + ')</option>';
            });
            $("#order_items").html(content);
        });
    }

    function getChallanList() {
        var url = "<?php echo $this->createUrl('bill/getchllanlist'); ?>";
        $.ajax({
            url: url,
            data: $("#chllan_form_filter").serialize(),
            success: function(response) {
                $('#challan_list').html(response);
            }
        });
    }
</script>