<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Purchase Invoice' => array('purchaseinvoice/admin'),
    'Add Kata Parchy',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Purchaseorder', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Purchaseorder', 'url' => array('admin')),
);
$data = Purchaseinvoice::model()->findByPk($id);
$challan_details=Challan::model()->findByAttributes(array("purchase_invoice_id"=>$id,"is_cancel"=>0));
if(!empty($challan_details)){
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">      
            <div class="box">
                <div class="box-header bg-green">
                    <h3 class="panel-title">Invoice Details</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tr>
                            <th id="purchaseinvoice-grid_c2">Purchase In-ward</th>
                            <th id="purchaseinvoice-grid_c3">Invoice Date</th>
                            <th id="purchaseinvoice-grid_c0">Type</th>
                            <th id="purchaseinvoice-grid_c1">Land Owner Name</th>
                            <th id="purchaseinvoice-grid_c1">Village</th>
                            <th id="purchaseinvoice-grid_c1">District</th>
                            <th id="purchaseinvoice-grid_c1">State</th>
                        </tr>
                        <tr>
                            <td><?php echo $data->id ?></td>
                            <td><?php echo $data->invoice_date ?></td>
                            <td><?php echo $data->invoice_type; ?></td>
                            <td><?php echo $data->land_owner ?></td>
                            <td><?php echo $data->village ?></td>
                            <td><?php echo $data->district ?></td>
                            <td><?php echo $data->state ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="box">
                <div class="box-header bg-green">
                    <h3 class="panel-title">Add Kata Parchy</h3>
                </div>
                <div class="panel-body">  
                    <?php if (Yii::app()->user->hasFlash('success')) { ?>
                        <div class="alert1 alert-success">
                            <?php echo Yii::app()->user->getFlash('success'); ?>
                        </div><br/>
                    <?php } ?>
                    <?php $this->renderPartial('_form', array('model' => $model, 'id' => $id,'challan_details'=>$challan_details)); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }else{?>
        <div class="alert alert-danger">Your Alloted Challan No is Cancelled.Please select another Challan No.</div>
<?php } ?>