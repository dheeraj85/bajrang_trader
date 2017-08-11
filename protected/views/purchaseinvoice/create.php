<?php
/* @var $this PurchaseinvoiceController */
/* @var $model Purchaseinvoice */
?>

<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Purchase Invoice'=>array('admin'),
    'Purchase Invoice Entry',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Purchaseinvoice', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Purchaseinvoice', 'url' => array('admin')),
);
?>
<div class='form-css'>
   <?php
if (!empty($imodel)) {
    ?>
    <article class="module width_full table-responsive">
        <div class="box-header bg-green">
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
  <div class="modal-dialog" role="document" style="width:700px;">
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
                          <th id="purchaseinvoice-grid_c2">Invoice No</th>
                          <th id="purchaseinvoice-grid_c3">Invoice Date</th>
                          <th id="purchaseinvoice-grid_c0">Type</th>
                          <th id="purchaseinvoice-grid_c1">Vendor Name</th>
                          <th id="purchaseinvoice-grid_c1">Land Owner Name</th>
                          <th id="purchaseinvoice-grid_c1">Village</th>
                          <th id="purchaseinvoice-grid_c1">District</th>
                          <th id="purchaseinvoice-grid_c1">State</th>
                          <th>Action</th>
                          </thead>
                          <tbody>
                              <tr>
                                  <td><?php echo $imodel->invoice_no ?></td>
                                  <td><?php echo $imodel->invoice_date ?></td>
                                  <td><?php echo $imodel->invoice_type; ?></td>
                                  <td><?php echo $imodel->reqstatus($imodel); ?></td>
                                  <td><?php echo $imodel->land_owner ?></td>
                                  <td><?php echo $imodel->village ?></td>
                                  <td><?php echo $imodel->district ?></td>
                                  <td><?php echo $imodel->state ?></td>
                                  <td><a href="#" onclick="getinvoice(<?php echo $imodel->id; ?>)"><span class="fa fa-pencil"></span> Edit</a></td>
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
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Invoice Details</h4>
      </div>
      <div class="modal-body" id="getinvoice">          
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    function getinvoice(id){
        $.ajax({
            url: '<?php echo $this->createUrl('purchaseinvoice/getinvoice') ?>',
            data: "invoice_id="+id+'&YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>',
            cache: false,
            success: function(response) {
                $("#myModal2").modal('hide');
                $("#myModal3").modal('show');
                $("#getinvoice").html(response);
            }
        });
    }
</script>    