<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Purchase Orders' => array('purchaseorder/admin'),
    'Purchase Order List',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Purchaseorderitems', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Purchaseorderitems', 'url'=>array('admin')),
);
$data=Purchaseorder::model()->findByPk($id);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">      
            <div class="box">
                <div class="box-header bg-green">
                    <h3 class="panel-title">Purchase Order Items</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Order No.</th>
                            <th>GST No.</th>
                            <th>Delivery Period From</th>
                            <th>Delivery Period To</th>
                            <th>Location</th>
                        </tr>
                        <tr>
                            <td><?php echo $data->order_no?></td>
                            <td><?php echo $data->gst_no?></td>
                            <td><?php echo $data->delivery_form?></td>
                            <td><?php echo $data->delivery_to?></td>
                            <td><?php echo $data->place?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="box">
                <div class="box-header bg-green">
                    <h3 class="panel-title">Add Purchase Order Items</h3>
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