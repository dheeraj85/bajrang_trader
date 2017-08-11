<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Expense Invoice'=>array('admin'),
    'Expense Invoice Entry',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Expenseinvoice', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Expenseinvoice', 'url'=>array('admin')),
);
?>
<div class='form-css'>
   <?php
if (!empty($imodel)) {
    ?>
    <article class="module width_full table-responsive">
        <div class="box-header bg-primary">
        <h3 class="panel-title">
            Invoice Details (Invoice No : <?php echo $imodel->invoice_no; ?> | Vendor : <?php echo $imodel->reqstatus($imodel); ?> | Invoice type : <?php echo $imodel->invoice_type; ?>) <button type='button' data-toggle="modal" data-target="#myModal2" class='btn btn-default btn-sm'>Show Details</button>
        <?php if($imodel->is_gstn_compliant==1) { ?>
            <a class="btn btn-danger blink">Conflict in GSTIN</a>
        <?php } ?>
        </h3>
        </div>
    </article>
<?php } ?>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="panel-body" style="padding:0px;">
                    <?php $this->renderPartial('_form', array('model'=>$model,'imodel'=>$imodel)); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Invoice Details</h4>
      </div>
      <div class="modal-body">
    <article class="module width_full table-responsive">
        <div class="module_content">
            <fieldset>
                <table class="table table-bordered">
                    <thead>
                    <th>Invoice Type</th>
                    <th>Vendor Name</th>
                    <th>Invoice No</th>
                    <th>Invoice Date</th>
                    <th>Received By</th>
                    <th>Discount Type</th>
                    <th>Created By</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $imodel->invoice_type; ?></td>
                            <td><?php echo $imodel->reqstatus($imodel); ?></td>
                            <td><?php echo $imodel->invoice_no; ?></td>
                            <td><?php echo $imodel->invoice_date; ?></td>
                            <td><?php echo $imodel->receivedby->empname; ?></td>
                            <td><?php echo $imodel->discount_type($imodel); ?></td>
                            <td><?php echo $imodel->createdby->name; ?></td> 
                         </tr>
                    </tbody>
                </table>
            </fieldset>           
        </div>
    </article>
      </div>
    </div>
  </div>
</div>