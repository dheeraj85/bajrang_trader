<?php
/* @var $this OffshelfsaleController */
/* @var $model Offshelfsale */
?>


<?php
$this->breadcrumbs = array(
    'Home' => array('pos/ots_items'),
    'Manage Internal Customer Sale',
);
?>

<style>
    .view{
        display: none;
    }
</style>
<?php if (empty($model->invoice_number)) { ?>
<style>
    .update, .delete{
        display: none;
    }
</style>
<?php } ?> 
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                    <h3 class="panel-title">Add Internal Customer Sale</h3>
                </div>
                <div class="panel-body">
                    <?php $this->renderPartial('_form', array('model' => $model)); ?>
                </div>
            </div>     
        </div>  
    </div>  
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-info">
                    <h3 class="panel-title">Manage Internal Customer Sale</h3>
                </div>
                <div class="panel-body">
                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'customer-grid',
                        'dataProvider' => $model->searchInternalCustomer(),
//                        'filter' => $model,
                        'columns' => array(
//        		'id',
                            'invoice_number',
                            'memo_number',
                            /*
                              'txn_type',
                              'customer_name',
                              'customer_mobile',
                             */
                            'customer.full_name',
                            'counter.counter_name',
                            'order_date',
                            /*
                              'created_by',
                              'order_time',
                              'comment',
                             */
                            array('header' => 'Action', 'value' => '$data->ActionInternalSale($data)'),
                            array(
                                'class' => 'bootstrap.widgets.BsButtonColumn',
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
</script>