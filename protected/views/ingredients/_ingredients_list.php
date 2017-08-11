<?php if (!empty($list)) { ?>
    <form id="ingredients_form">
        <input type="hidden" id="rid" name="rid" value="<?php echo $rid; ?>">
        <table class="table">
            <thead>
            <th style="width: 5%;">S No</th>
            <th style="width: 30%;">Item Name</th>
            <th style="width: 25%;">Weight In Gm</th>
            <th style="width: 35%;">Description</th>
            <th style="width: 5%;"></th>
            </thead>
            <tbody>
                <?php
                $c = 0;
                foreach ($list as $item) {
                    $item_name = Purchaseitem::model()->findByPk($item->item_id);
                    ?>
                    <tr>
                        <td><?php echo ++$c; ?></td>
                        <td><?php echo $item_name->itemname; ?></td>
                        <td><input type="text" class="form-control" onkeyup="getweight()" id="weight<?php echo $c; ?>" name="<?php echo $item->id; ?>weight" placeholder="Weight In Gm" value="<?php echo $item->weight_in_gm; ?>"></td>
                        <td><textarea class="form-control" id="description<?php echo $c; ?>" name="<?php echo $item->id; ?>description" placeholder="Description"><?php echo $item->description; ?></textarea></td>
                        <td><a href='#'><span class="glyphicon glyphicon-remove label-danger" onclick="Delete(<?php echo $item->id; ?>)"></span></a></td>
                    </tr>
                <?php } ?>
            <input type="hidden" id="count" value="<?php echo $c; ?>">
            </tbody>
        </table>
        <div class="row">
            <div class="col-lg-12">
                <button type="button" id="save_ingredients" class="btn btn-primary"><i class="glyphicon glyphicon-saved"></i>&nbsp;&nbsp;save</button>
            </div>
        </div>
    </form>
<?php } ?>
<script type="text/javascript">
    $(document).ready(function() {
        getweight();
        $('#save_ingredients').click(function() {
            var datastring = $('#ingredients_form').serialize();
            $.ajax({
                url: "<?php echo $this->createUrl('ingredients/saveweight'); ?>",
                data: datastring,
                type: 'post',
                success: function(data) {
                    var rid = $('#rid').val();
                    var item = $('#item').val();
                    alert("Details Has Been Saved..!!");
                    GetItemList(rid, item);
                }
            });
        });
    });

    function getweight() {
        var count = $('#count').val();
        var wght_in_gm = $('#wght_in_gm').html();
        var total = 0.00;
        for (var i = 1; i <= count; i++) {
            var weight = $('#weight' + i).val();
            if (weight != '') {
                total = parseFloat(total) + parseFloat(weight);
            } else {
                total = parseFloat(total) + 0.00;
            }
            if (wght_in_gm == total) {
                $('#save_ingredients').removeAttr('disabled');
            } else {
                $('#save_ingredients').attr('disabled', 'disabled');
            }
        }
    }
    
    function Delete(id) {
        var r = confirm("Are you sure you want to delete this item ?");
        if(r = true){
        $.ajax({
                url: "<?php echo $this->createUrl('ingredients/deleteitem'); ?>",
                data: {'id':id},
                success: function(data) {
                    var rid = $('#rid').val();
                    var item = $('#item').val();
                    GetItemList(rid, item);
                }
            });
            }else{
            
            }
    }
</script>
