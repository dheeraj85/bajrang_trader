<?php if (!empty($list)) {
    ?>
    <legend><?php echo $list->order_no ?></legend>
    <div class="table-responsive" style="height:200px;overflow-y:scroll;">
        <table class='table table-bordered'>
            <thead>
                    <tr>
                        <th>Item with Scale</th>
                        <th>Brand</th>            
                        <th>Q.R.</th>            
                        <th>R.Date</th>  
                        <th>Action</th>
                    </tr>
                </thead>
            <tbody>
                <?php
                foreach (Purchaseorderitems::model()->findAllByAttributes(array("purchase_order_id"=>$list->id)) as $vs) {
                    ?>
                    <tr>
                        <td width="50%"><?php echo $vs->item_name ?> (<?php echo $vs->qty_scale; ?>)</td>
                        <td width="15%"><?php echo $vs->item_brand ?></td>
                        <td width="15%"><?php echo $vs->qty_req ?></td>
                        <td width="20%"><?php echo $vs->req_date ?></td>
                         <td width="5%"><a onclick='deleteitem(<?php echo $vs->item_id?>,<?php echo $vs->id?>,<?php echo $list->supplier_id ?>)'><i class='fa fa-trash-o'></i></a></td>
                    </tr> 
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
<?php } ?>  