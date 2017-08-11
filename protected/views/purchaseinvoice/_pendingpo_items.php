<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Purchase Items List of 
    <?php echo $name;?>
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
$pinvoice=Purchaseinvoice::model()->findByPk($id);
$list=Purchaseinvoiceitems::model()->findAllByAttributes(array("invoice_id" => $pinvoice->id,"is_added_to_stock"=>0));
if(!empty($list)){
    ?>
     <table class="table table-bordered">
         <tr>
             <th>#</th>
             <th>Item with scale</th>
             <th>Stock Qty</th>
             <th>Is Goods Return</th>
         </tr>
        <?php
        foreach ($list as $po) {
            ?>
            <tr>
                <td width="10%"><input type="checkbox" class="allcheckedcategory" id="checked_item_<?php echo $po->id ?>" name="item_id[]" value="<?php echo $po->id ?>"></td>
                <td width="55%"><?php echo $po->item->itemname ?> (<?php echo $po->item->item_scale; ?>)</td>    
                <td width="15%"><?php echo $po->stock_qty ?> </td>
                <td width="20%"><input type="checkbox" onclick="checkgr(<?php echo $po->id ?>)" id="good_return_<?php echo $po->id ?>" name="good_return[]" value="<?php echo $po->id ?>"></td>
            </tr>
        <?php } ?>
    </table>
<input type="hidden" id="vendor_id" name="vendor_id" value="<?php echo $vid;?>">
<input type="hidden" id="invoice_id" name="invoice_id" value="<?php echo $id;?>">
<textarea name="invoice_comment" rows="3" class="form-control" placeholder="Comments"></textarea><br/>
<div class="form-group">
    <button type="button" id="joinpoinvoice" class="btn btn-green">Add to Stock</button>
</div>
<?php }?>
 <?php $this->endWidget(); ?>
</div>
<script type="text/javascript">
    $(document).ready(function() {
    $("#joinpoinvoice").click(function(){
        var form = $('#purchase-post').serialize();
        $("#joinpoinvoice").attr('disabled', 'disabled').html("Submiting...");
        $.ajax({
            url: '<?php echo $this->createUrl('purchaseinvoice/addtostock') ?>',
            data: form+'&YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>',
            type: 'post',
            cache: false,
            success: function(response) {
                $("#joinpoinvoice").removeAttr('disabled').html('Add to Stock');
                $('#purchase-post')[0].reset();
                $('#myModal5').modal('hide');
                location.reload();
            }
        });
    });    
  });
  function checkgr(id){
    if($("#good_return_"+id).is(':checked')){
     //alert(true);
     $("#checked_item_"+id).attr("disabled","disabled");
    } else {
     //alert(false);
     $("#checked_item_"+id).removeAttr("disabled");
    }
  }
</script>