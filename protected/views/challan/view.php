<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Challan' => array('challan/admin'),
        //'Purchase Order List',
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">   
            <div class="box">
                <div class="box-header bg-green">
                    <h3 class="panel-title">
                        <div class="pull-left">View Challan</div>
                    </h3>
                </div>
                <div class="panel-body">
                    <?php
                    $this->widget('zii.widgets.CDetailView', array(
                        'htmlOptions' => array(
                            'class' => 'table table-striped table-condensed table-hover',
                        ),
                        'data' => $model,
                        'attributes' => array(
                            'id',
                            'customer.full_name',
                            'challan_date',
                            array(
                            'label'=>'Purchase Order',
                            'value'=>$model->purchaseorder->order_no,
                            ),
                            'ex_station',
                            'truck_wagon_no',
                        ),
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>