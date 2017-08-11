<?php if (!empty($list)) {
    ?>
    <div class="table-responsive" style="height:250px;overflow-y:scroll;">
        <table class='table table-bordered'>
            <tbody>
                <?php
                foreach ($list as $v) {
                    ?>
                    <tr>
                        <td width="10%"><a href="#" onclick="getitemssupplier(<?php echo $v->item_id ?>)" class="allcheckedcategory"><?php echo $v->item_name ?> (<?php echo $v->qty_scale; ?>) | <?php echo $v->item_brand ?></a></td>
                    </tr> 
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
<?php }?>