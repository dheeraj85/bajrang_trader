<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Pending PO of 
    <?php if($id==1){?>    
    Open Market    
    <?php }else{?>    
    <?php echo $model->firm_name;?>
    <?php }?>    
    <span class="pull-right">
       Vendor GSTIN <?=isset($model->tin_no)?$model->tin_no:'Not Added Yet';  ?>
    </span>
    </h4>
</div>
<div class="modal-body">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
        'enableAjaxValidation' => false,
        'id'=>'purchase-post',
        'action' => "#",
    ));
    ?>   
<?php
if(!empty($list)){
    foreach ($list as $l){?>
    <legend><b><?php echo "PO-" . $l->id; ?></b>&nbsp;&nbsp;
    <input type="text" name="invoice_no_<?php echo $l->id ?>" 
        style="width: 140px;height: 29px;font-size: 14px;line-height: 1.42857143;color: #555555;
        background-color: #ffffff;background-image: none; border: 1px solid #cccccc;" id="sameinvoice_<?php echo $l->id ?>"><div class="pull-right" style="font-size:13px;padding-top: 10px;"><input type="checkbox" id="checked_po_<?php echo $l->id; ?>" name="poid[]" value="<?php echo $l->id; ?>"> Select All Items form Purchase Order</div></legend>
    <table class="table table-bordered">
        <?php
        foreach (Purchaseorderitems::model()->findAllByAttributes(array("purchase_order_id" => $l->id)) as $po) {
            ?>
            <tr>
                <td width="60%"><?php echo $po->item_name ?> (<?php echo $po->qty_scale; ?>) | <?php echo $po->item_brand ?></td>    
                <td width="20%">
                    <select name="is_item_supplied_<?php echo $po->id ?>" class="form-control" id="is_item_supplied_<?php echo $po->id ?>">
                        <option value="1" selected>Yes</option>
                        <option value="0">No</option>
                    </select>
                </td>
                <td width="20%"><input type="text" class="form-control" id="supplier_invoice_no_<?php echo $po->id ?>" name="supplier_invoice_no_<?php echo $po->id ?>"></td>
            </tr>
        <?php } ?>
    </table>
<?php }
?>
<input type="hidden" id="invoice_vendor_id" name="invoice_vendor_id" value="<?php echo $id;?>">
<div class="form-group">
    <button type="button" id="joinpoinvoice" class="btn btn-green">Join PO & Invoice</button>
</div>
<?php }?>
 <?php $this->endWidget(); ?>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        <?php
if(!empty($list)){
    foreach ($list as $l){?>
     $("#sameinvoice_<?php echo $l->id ?>").change(function() {
          <?php
    foreach (Purchaseorderitems::model()->findAllByAttributes(array("purchase_order_id" => $l->id)) as $po) {
        ?> 
      $("#supplier_invoice_no_<?php echo $po->id ?>").val($(this).val()).change();
      <?php }
?>
    });   
<?php } }?>    
    <?php
    foreach (Purchaseorderitems::model()->findAllByAttributes(array("purchase_order_id" => $l->id)) as $po) {
        ?>       
    $("#is_item_supplied_<?php echo $po->id ?>").change(function() {
        var input_type = $(this).val();
        if (input_type == "0") {
            $("#supplier_invoice_no_<?php echo $po->id ?>").attr("disabled","disabled");
        } else {
            $("#supplier_invoice_no_<?php echo $po->id ?>").removeAttr("disabled","");
        }
    }); 
    <?php }
?>
    $("#joinpoinvoice").click(function(){
        var form = $('#purchase-post').serialize();
        $("#joinpoinvoice").attr('disabled', 'disabled').html("Submiting...");
        $.ajax({
            url: '<?php echo $this->createUrl('purchaseinvoice/updatepoinvoice') ?>',
            data: form+'&YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>',
            type: 'post',
            cache: false,
            success: function(response) {
               // alert(response);
                $("#joinpoinvoice").removeAttr('disabled').html('Join PO & Invoice');
                $('#purchase-post')[0].reset();
                $('#myModal4').modal('hide');
            }
        });
    });    
  });
</script>