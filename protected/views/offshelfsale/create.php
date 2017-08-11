<?php
$this->breadcrumbs = array(
    'Home' => array('pos/ots_items'),
    'Manage Special Customer Sale',
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
                    <h3 class="panel-title">Add Special Customer Sale</h3>
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
                    <h3 class="panel-title">Manage Special Customer Sale</h3>
                </div>
                <div class="panel-body">
                    <?php //$this->renderPartial('_search', array('model' => $model)); ?>
                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'customer-grid',
                        'dataProvider' => $model->search(),
//                        'filter' => $model,
                        'columns' => array(
//        		'id',
                            'invoice_number',
                            'memo_number',
                            //'tax_type',
                            //   'customer_name',
                            //   'customer_mobile',
                            'customer.full_name',
                            'invoice_type',
                            array('htmlOptions' => array('width' => '80'), 'header' => 'Total Amt &#8377;', 'type' => 'raw', 'value' => 'Offshelfsale::getTotalBillAmt($data)'),
                            array('htmlOptions' => array(), 'header' => 'StateCode', 'value' => '$data->supply_state_code'),
                            'counter.counter_name',
                            'order_date',
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
                                        'visible' => '$data->invoice_number==""',
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
</script>