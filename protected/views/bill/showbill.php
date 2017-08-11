<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Generate Bill' => array('bill/create/'.$model->id),
    'Show Generated Bill',
);

$customer = Customer::model()->findByPk($model->customer_id);
?>
<div class='row'>
    <div class="col-lg-12">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                    <h3 class="panel-title">Details of Party Sale &emsp;
                        <b>

                            <?php echo '( INVOICE No. &emsp;:- &emsp;' . $model->bill_no . ')'; ?>


                            <label class="pull-right">
                                Place of Supply :- <?= Globalpreferences::getValueByParamName('place_of_supply_state_code'); ?>&nbsp; | &nbsp;
                                Party GSTIN :- <?= $model->customer->gstin_no; ?>&nbsp; | &nbsp;
                                &nbsp; | &nbsp; State :- <?= $model->customer->state; ?>
                            </label> 
                        </b>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class='row'>
                        <table class="table" style="background-color: #ff6600;color: #FFF;">
                            <tr>

                                <td style="border-top: none;"><h5><b>&emsp;Invoice Number :- &nbsp;&nbsp;<?php echo $model->bill_no; ?></b></h5></td>

                                <td style="border-top: none;"><h5><b>Party Name :-&nbsp;&nbsp;<?php echo $customer->full_name; ?></b></h5></td>
                                <td style="border-top: none;"><h5><b>Contact No :-&nbsp;&nbsp;<?php echo $customer->mobile_no; ?></b></h5></td>
                    
                            </tr>
                            <tr>
                                <td style="border-top: none;"><h5><b>&emsp; Bill Date :-&nbsp;&nbsp; <?php echo Utils::yyyymmdd_to_ddmmyyyy($model->bill_date); ?></b></h5></td>
                                <td style="border-top: none;"><h5><b>Billing Period:-From : <?php echo Utils::yyyymmdd_to_ddmmyyyy($model->bill_from_date); ?>
                                            &emsp;
                                            To : <?php echo Utils::yyyymmdd_to_ddmmyyyy($model->bill_to_date); ?></b></h5></td>
                                <td style="border-top: none;"><h5><b>Remark :-&nbsp;&nbsp;<?php echo $model->particulars; ?></b></h5></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>

        .alert {
            padding: 10px;
            background-color: #f44336; /* Red */
            color: white;
            margin-bottom: 15px;
            font-size: 22px;
            text-align: center;
        }

        /* The close button */
        .closebtn {
            margin-top: 5px;
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        /* When moving the mouse over the close button */
        .closebtn:hover {
            color: black;
        }
    </style>
    <div class="col-lg-12">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-equal">
                    <h3 class="panel-title">
                        Generated Bill Items
                        <span style="text-align: center;font-size: 22px;font-weight: bold;color: #ffff00" class="pull-right">
                           <?php   if($model->bill_type=='incremental_bill'){
                               echo "Incremental Bill";
                           }else{
                               echo "Cost Bill";
                           } ?>
                        
                        </span>
                    </h3>
                </div>
                <div class="panel-body">

                    <?php $this->renderPartial('_sgst', array('model' => $model, 'items' => $items)); ?>



                </div>   
            </div>   
        </div> 
    </div>
</div>
