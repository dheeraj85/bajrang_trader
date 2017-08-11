<?php
if (!empty($list)) {
    ?>
    <article class="module width_full">
        <div class="box-header bg-red">
            <h3 class="panel-title">Finished Items</h3>
        </div>
        <div class="module_content">
            <fieldset>
                <table class="items table table-bordered">
                    <thead>
                        <tr>
<!--                            <th id="itemstock-grid_c0">Category</th>
                            <th id="itemstock-grid_c1">Sub Category</th>-->
                            <th id="itemstock-grid_c2">Item</th>
                            <th id="itemstock-grid_c4">Particulars</th>
                            <th id="itemstock-grid_c5">Stock Qty</th>
                            <th id="itemstock-grid_c7">Mrd No</th>
                            <th id="itemstock-grid_c8">Make Date</th>
                            <th id="itemstock-grid_c9">Processed Date</th>
                            <th id="itemstock-grid_c10">Discard Date</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($list as $lists) {
                        ?>
                        <tr>
                            <td><?php echo $lists->item->itemname . "(" . $lists->stock_taking_scale . ")" . "-" . $lists->item->brand?></td>                            
                            <td><?php echo $lists->particulars?></td>
                            <td><?php echo $lists->stock_qty?></td>
                            <td><?php echo $lists->mrd_no?></td>
                            <td><?php echo $lists->make_date?></td>
                            <td><?php echo $lists->ready_date?></td>
                            <td><?php echo $lists->discard_date?></td>
                            <td><a title='remove' onclick="itemdelete(<?php echo $lists->id?>)"><i class='fa fa-trash-o'></i></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a title='Edit' onclick="edititem(<?php echo $lists->id?>)"><i class='fa fa-pencil'></i></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a title='View' href='<?php echo $this->createUrl('finisheditem/view',array("id"=>$lists->id)); ?>'><i class='fa fa-eye'></i></a></td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </fieldset>           
        </div>
    </article>
<br/>
<a href="<?php echo $this->createUrl('finisheditem/admin')?>" class="btn bg-red pull-right">View All Items</a>
<div style="clear:both"></div>
<br/>
<?php } ?>
<script type="text/javascript">  
    function itemdelete(id, invoice_id) {
        $.ajax({
            url: '<?php echo $this->createUrl('finisheditem/itemdelete') ?>',
            data: {'id': id, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
            type: 'post',
            success: function(response) {
                getpartial(invoice_id);
            }
        });
    }
    
    function edititem(id,vid) {
         $("#additem").hide();
         $("#edititem").show();
         $('#purchaseinvoice-form')[0].reset();
         $.getJSON("<?php echo $this->createUrl('finisheditem/getitemdata'); ?>", {"id": id}, function(data) {
             $("#processed_item_id").val(data.model.id);
             $("#itemname").fadeIn(1000).slideDown();
             GetItemname(data.model.item_id);
             if(vid==null){
              Getvendoritems(data.model.item_id);   
             }
             $("#Purchaseinvoice_item_particulars").val(data.model.particulars);
             $("#Purchaseinvoice_item_v_qty").val(data.model.v_qty);
             GetScale(data.model.v_scale);
             GetItype(data.model.input_type);
             if (data.model.input_type == "Convert") {
             $("#convertvalue").fadeIn(1000).slideDown();
             }
             $("#Purchaseinvoice_item_c_unit_value").val(data.model.c_unit_value);
             $("#Purchaseinvoice_item_stock_qty").val(data.model.stock_qty);
             $("#Purchaseinvoice_item_rate").val(data.model.rate);
             $("#Purchaseinvoice_item_amount").val(data.model.amount);
             $("#discount").val(data.model.discount);
             GetMrd(data.model.is_mrd);
             if(data.model.is_mrd=="Yes"){
                 $("#mrdform").fadeIn(1000).slideDown();
                 $("#Purchaseinvoice_item_mrd_no").val(data.model.mrd_no);
                 $("#make_date").val(data.model.make_date);
                 $("#ready_date").val(data.model.ready_date);
                 $("#discard_date").val(data.model.discard_date);
             }
             scheduled(data.model.item_id);
                $("#schedule_date").val(data.model.schedule_date);
                $("#remarks").val(data.model.remarks);
              $.each(data.taxmodel, function(i, ct) {
               if(ct.label!=null){ 
                  $("#taxtype_"+ct.label).val(ct.tax_percent);
                    }
                });
        });
    }
    function GetItemname(itemid){
         $.ajax({
            url: '<?php echo $this->createUrl('finisheditem/getItemname') ?>',
            data: {'id': itemid},
            type: 'get',
            dataType: 'JSON',
            cache: false,
            success: function(response) {
              $('#item_name').val(response.itemname+"("+response.brand+")");
            }
        });
    }
</script>