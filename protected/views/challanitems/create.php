<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Challan' => array('challan/admin'),
    'Challan Items List',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Purchaseorderitems', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Purchaseorderitems', 'url'=>array('admin')),
);
$data=Challan::model()->findByPk($id);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">      
            <div class="box">
                <div class="box-header bg-green">
                    <h3 class="panel-title">Challan Items</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Challan No.</th>
                            <th>Customer</th>
                            <th>Challan Date</th>
                            <th>Order No.</th>
                            <th>Ex-Station</th>
                            <th>Truck Wagon No.</th>
                        </tr>
                        <tr>
                            <td><?php echo $data->id?></td>
                            <td><?php echo $data->customer->full_name?></td>
                            <td><?php echo $data->challan_date?></td>
                            <td><?php $po_data=explode("-", $data->purchase_order_item);
                                echo Purchaseorder::model()->findByPk($po_data[0])->order_no;?></td>
                            <td><?php echo $data->ex_station?></td>
                            <td><?php echo $data->truck_wagon_no?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="box">
                <div class="box-header bg-green">
                    <h3 class="panel-title">Add Challan Items</h3>
                </div>
                <div class="panel-body">  
                    <?php if (Yii::app()->user->hasFlash('success')) { ?>
                        <div class="alert1 alert-success">
                            <?php echo Yii::app()->user->getFlash('success'); ?>
                        </div><br/>
                    <?php } ?>
                    <?php $this->renderPartial('_form', array('model' => $model,'id'=>$id)); ?>
                </div>
             </div>
        </div>
    </div>
</div>